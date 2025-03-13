<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\PengumumanBroadcast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PengumumanNotification;

class PengumumanController extends Controller
{
    // Tampilkan form pengumuman
    public function index()
    {
        $pengumuman = auth()->user()->notifications;
        return view('pages.pengumuman.index', compact('pengumuman'));
    }
    public function create()
    {
        return view('pages.pengumuman.create');
    }

    // Kirim pengumuman ke semua user
    public function sendPengumuman(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $title = $request->title;
        $message = $request->message;
        $createdAt = Carbon::now()->diffForHumans(); // Tambahkan waktu saat ini

        // Kirim notifikasi ke semua user
        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new PengumumanNotification($title, $message));
        }

        // Broadcast event dengan created_at
        broadcast(new PengumumanBroadcast($title, $message, $createdAt));

        return response()->json(['message' => 'Pengumuman berhasil dikirim.'], 200);
    }

    // Ambil list notifikasi
    public function getNotifications()
    {
        return auth()->user()->notifications;
    }

    public function markAsRead($id)
    {
        // Cek apakah pengumuman ada
        $pengumuman = auth()->user()->notifications()->find($id);

        // Update status pengumuman sebagai dibaca
        $pengumuman->update(['read_at' => Carbon::now()]);

        return response()->json(['success' => true]);
    }

}
