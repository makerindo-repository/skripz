<?php

namespace App\Http\Controllers\Content;

use Midtrans\Snap;
use App\Models\Paket;
use Illuminate\Http\Request;
use App\Models\ManajemenLangganan;
use App\Http\Controllers\Controller;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $harga = $paket->harga; // Nominal dasar pembayaran
        $ppn = $harga * 0.11; // Hitung PPN 11%
        $totalHarga = $harga + $ppn; // Total pembayaran


        return view('frontend.langganan', compact('paket', 'ppn', 'totalHarga'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentCallback(Request $request)
    {
        // Ambil parameter dari request
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $transactionStatus = $request->transaction_status;

        // Pisahkan kategori dan jenis dari order_id
        $orderIdParts = explode('-', $orderId);
        $kategoriJenis = $orderIdParts[0]; // Bagian sebelum `-` adalah kategori + jenis
        $kategori = substr($kategoriJenis, 0, strpos($kategoriJenis, 'PRO')); // Contoh pemisahan berdasarkan "PRO"
        $jenis = 'pro'; // Sesuaikan dengan format jenis pada order_id

        // Cari paket berdasarkan kategori dan jenis
        $paket = Paket::where('kategori', 'LIKE', $kategori)
                      ->where('jenis', 'LIKE', $jenis)
                      ->first();

        if (!$paket) {
            return response()->json(['status' => 'error', 'message' => 'Paket tidak ditemukan'], 404);
        }

        $user = auth()->user();

        // Update status berdasarkan transaksi
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement': // Pembayaran berhasil
                $user->account_status = 'pro';
                $user->account_expires_at = now()->addDays(180); // Sesuaikan durasi paket
                $user->save();

                return response()->json(['status' => 'success', 'message' => 'Pembayaran berhasil']);

            case 'expire': // Pembayaran kedaluwarsa
                $user->account_status = 'biasa';
                $user->save();

                return response()->json(['status' => 'failed', 'message' => 'Pembayaran kedaluwarsa']);

            case 'deny': // Pembayaran ditolak
            case 'cancel': // Pembayaran dibatalkan
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

        // Detail transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $serial_number,
                'gross_amount' => $request->total_harga, // Nominal untuk upgrade ke akun pro (misal Rp100,000)
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];


        try {
            $snapToken = Snap::getSnapToken($params);
            ManajemenLangganan::create([
                'user_id'           => $user->id,
                'paket_id'          => $paket->id,
                'serial_number'     => $serial_number,
                'jumlah'            => $request->jumlah,
                'total_harga'       => $request->total_harga,
            ]);
            return response()->json(['snapToken' => $snapToken], 200);
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membuat pembayaran.');
        }
    }
}
