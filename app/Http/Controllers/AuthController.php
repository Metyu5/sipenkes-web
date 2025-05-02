<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:administrasi,apoteker,dokter',
        ]);

        $email    = $request->input('email');
        $password = $request->input('password');
        $role     = $request->input('role');

        // Pilih tabel sesuai dengan role
        if ($role === 'administrasi') {
            $table = 'data_administrasis';
        } elseif ($role === 'apoteker') {
            $table = 'data_apotekers';
        } else {
            $table = 'dokters'; // Untuk dokter
        }

        // Cek apakah email ada dalam tabel yang sesuai
        $user = DB::table($table)->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // Simpan sesi login
            session([
                'user_role'  => $role,
                'user_email' => $user->email,
                'user_id'    => $user->id,
            ]);

            // Redirect ke dashboard sesuai peran
            return redirect()->route("$role.dashboard");
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget(['user_role', 'user_email', 'user_id']);
        Auth::logout();
        return redirect()->route('login');
    }
    
}
