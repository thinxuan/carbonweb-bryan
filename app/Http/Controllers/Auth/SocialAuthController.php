<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24)),
                ]);
            }

            Auth::login($user);
            return redirect()->intended('/admin');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Something went wrong with Google authentication.');
        }
    }

    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();

            $user = User::where('microsoft_id', $microsoftUser->id)
                ->orWhere('email', $microsoftUser->email)
                ->first();

            if ($user) {
                if (!$user->microsoft_id) {
                    $user->update(['microsoft_id' => $microsoftUser->id]);
                }
            } else {
                $user = User::create([
                    'name' => $microsoftUser->name,
                    'email' => $microsoftUser->email,
                    'microsoft_id' => $microsoftUser->id,
                    'avatar' => $microsoftUser->avatar,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24)),
                ]);
            }

            Auth::login($user);
            return redirect()->intended('/admin');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Something went wrong with Microsoft authentication.');
        }
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();

            $user = User::where('apple_id', $appleUser->id)
                ->orWhere('email', $appleUser->email)
                ->first();

            if ($user) {
                if (!$user->apple_id) {
                    $user->update(['apple_id' => $appleUser->id]);
                }
            } else {
                $user = User::create([
                    'name' => $appleUser->name ?? 'Apple User',
                    'email' => $appleUser->email,
                    'apple_id' => $appleUser->id,
                    'avatar' => $appleUser->avatar,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24)),
                ]);
            }

            Auth::login($user);
            return redirect()->intended('/admin');
        } catch (\Exception $e) {
            return redirect('/register')->with('error', 'Something went wrong with Apple authentication.');
        }
    }
}
