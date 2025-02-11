<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Debug Google user data
            Log::info('Google User Data:', [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'id' => $googleUser->id
            ]);

            if (!$googleUser->email) {
                throw new \Exception('Email is required from Google');
            }

            // Cari pengguna berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                // Jika pengguna ditemukan, perbarui google_id jika belum ada
                if (!$user->google_id) {
                    $user->google_id = $googleUser->id;
                    $user->save();
                }
                Auth::login($user);
                return redirect()->route('dashboard');
            }

            // Jika pengguna tidak ditemukan, buat pengguna baru
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make('password123')
            ]);

            Auth::login($newUser);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Authentication failed. Please try again.');
        }
    }
}