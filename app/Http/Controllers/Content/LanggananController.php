<?php

namespace App\Http\Controllers\Content;

use Midtrans\Snap;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ManajemenLangganan;
use App\Http\Controllers\Controller;

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
        $statusCode = $request->status_code;
        $transactionStatus = $request->transaction_status;

        // Ambil kategori dan jenis dari order_id
        $orderIdParts = explode('-', $orderId);
        $kategori = substr($orderIdParts[0], 0, strpos($orderIdParts[0], 'PRO'));
        $jenis = 'pro';

        $paket = Paket::where('kategori', 'LIKE', $kategori)
                      ->where('jenis', 'LIKE', $jenis)
                      ->first();

        if (!$paket) {
            return response()->json(['status' => 'error', 'message' => 'Paket tidak ditemukan'], 404);
        }

        $user = auth()->user();
        $serial_number = strtoupper($paket->kategori . $paket->jenis . '-' . bin2hex(random_bytes(5)));

        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $user->account_status = 'pro';
                $user->account_expires_at = now()->addDays(180);
                $user->save();

                $langganan = ManajemenLangganan::create([
                    'user_id'       => $user->id,
                    'paket_id'      => $paket->id,
                    'serial_number' => $serial_number,
                    'jumlah'        => $request->jumlah ?? 1,
                    'total_harga'   => $request->total_harga,
                ]);

                if ($langganan->jumlah > 1) {
                    for ($i = 0; $i < $langganan->jumlah; $i++) {
                        User::create([
                            'name'              => $user->name . ' (' . ($i + 1) . ')',
                            'email'             => 'user' . time() . rand(100, 999) . '@example.com',
                            'password'          => bcrypt('password123'),
                            'account_status'    => 'pro',
                            'account_expires_at'=> now()->addDays(180),
                        ]);
                    }
                }

                return response()->json(['status' => 'success', 'message' => 'Pembayaran berhasil']);

            case 'expire':
                $user->account_status = 'biasa';
                $user->save();
                return response()->json(['status' => 'failed', 'message' => 'Pembayaran kedaluwarsa']);

            case 'deny':
            case 'cancel':
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
            return response()->json(['snapToken' => $snapToken], 200);
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membuat pembayaran.');
        }
    }
}
