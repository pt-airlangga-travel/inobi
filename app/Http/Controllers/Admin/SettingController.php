<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function update(Request $request)
    {
        // Simpan ke file .env atau database
        // Untuk sekarang, kita simpan di session sebagai contoh

        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'admin_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'site_description' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Simpan ke session (contoh)
        session([
            'settings' => $request->except('_token'),
        ]);

        // Atau bisa juga simpan ke file config
        // Config::set('app.name', $request->site_name);

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully!');
    }
}
