<?php

namespace App\Http\Controllers\Content;

use Midtrans\Snap;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ManajemenLangganan;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;

class LanggananController extends Controller
{
    public function store(Request $request, $slug)
    {
        $user = auth()->user();
        $slugParts = explode('-', $slug);
        $kategori = str_replace('-', ' ', array_shift($slugParts));
        $jenis = str_replace('-', ' ', implode(' ', $slugParts));

        // Cari paket berdasarkan kategori dan jenis
        $paket = Paket::where('kategori', 'LIKE', $kategori)
                    ->where('jenis', 'LIKE', $jenis)
                    ->firstOrFail();

        // Nominal awal
        $harga = $paket->harga;
        $ppn = $harga * 0.11;
        $totalHarga = $harga + $ppn;

        return view('frontend.langganan', compact('paket', 'ppn', 'totalHarga'));
    }

    public function paymentCallback(Request $request)
    {
        $orderId = $request->order_id;
        $transactionStatus = $request->transaction_status;

        $langganan = ManajemenLangganan::query()
            ->firstWhere('serial_number', $orderId);

        if (!$langganan) {
            return response()->json(['status' => 'error', 'message' => 'Langganan tidak ditemukan!'], 404);
        }

        $user = User::find($langganan->user_id);

        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $expired_at = now()->addDays(180);
                $langganan->update(['status' => $transactionStatus, 'expired_at' => $expired_at]);

                $user->account_status = 'pro';
                $user->langganan_id = $langganan->id;
                $user->account_expires_at = $expired_at;
                $user->save();

                $mahasiswas = [];

                $password = bcrypt('password123');
                $created_at = now();

                for ($i = 0; $i < $langganan->jumlah; $i++) {
                    $mahasiswas[] = [
                        'role_id'           => 4,
                        'pts_id'            => $user->pts_id,
                        'name'              => $user->name . ' (' . ($i + 1) . ')',
                        'email'             => 'user' . time() . rand(100, 999) . '@example.com',
                        'password'          => $password,
                        'account_status'    => 'pro',
                        'langganan_id'      => $langganan->id,
                        'account_expires_at'=> $expired_at,
                        'created_at'        => $created_at,
                    ];
                }

                User::insert($mahasiswas);

                $newMahasiswaUsers = User::query()
                    ->where('langganan_id', $langganan->id)
                    ->get();

                $newMahasiswa = [];

                foreach ($newMahasiswaUsers as $mahasiswaUser) {
                    $mahasiswaUser->syncRoles(['Mahasiswa']);
                    
                    $newMahasiswa[] = [
                        'user_id'             => $mahasiswaUser->id,
                        'univ_id'             => $user->id,
                        'name'                => $mahasiswaUser->name,
                        'email'               => $mahasiswaUser->email,
                        'slug'                => Str::slug($mahasiswaUser->name, '-'),
                        'created_at'          => $created_at,
                    ];
                }

                Mahasiswa::insert($newMahasiswa);

                return response()->json(['status' => 'success', 'message' => 'Pembayaran berhasil']);

            case 'expire':
                $langganan->update(['status' => $transactionStatus]);
                $user->account_status = 'biasa';
                $user->save();
                return response()->json(['status' => 'failed', 'message' => 'Pembayaran kedaluwarsa']);

            case 'deny':
            case 'cancel':
                $langganan->update(['status' => $transactionStatus]);
                return response()->json(['status' => 'failed', 'message' => 'Pembayaran ditolak']);

            default:
                return response()->json(['status' => 'unknown', 'message' => 'Status transaksi tidak diketahui']);
        }
    }

    public function pembayaran(Request $request)
    {
        $user  = auth()->user();
        $paket = Paket::findOrFail($request->paket_id);

        $serial_number = strtoupper($paket->kategori . $paket->jenis . '-' . bin2hex(random_bytes(5)));

        $params = [
            'transaction_details' => [
                'order_id' => $serial_number,
                'gross_amount' => $request->total_harga,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            ManajemenLangganan::create([
                'user_id'       => $user->id,
                'paket_id'      => $paket->id,
                'serial_number' => $serial_number,
                'jumlah'        => $request->jumlah ?? 1,
                'total_harga'   => $request->total_harga,
                'status'        => 'pending',
            ]);

            return response()->json(['snapToken' => $snapToken], 200);
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membuat pembayaran.');
        }
    }
}
