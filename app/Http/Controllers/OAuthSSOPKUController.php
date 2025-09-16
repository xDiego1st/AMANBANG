<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OAuthSSOPKUController extends Controller
{

    public function redirect(Request $request)
    {
        try {
            // Redirect to SSO PKU oauth authorize route
            $request->session()->put('state', $state = Str::random(40));
            $query = http_build_query([
                'client_id' => env('SSO_PKU_CLIENT_ID'),
                'redirect_uri' => env('SSO_PKU_REDIRECT_URI'),
                'response_type' => 'code',
                'scope' => '',
                'state' => $state,
                'prompt' => 'consent',
            ]);
            return redirect(env('SSO_PKU_URL') . '/oauth/authorize?' . $query);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        try {
            // Check state (state is like csrf)
            $state = $request->session()->pull('state');
            if (!(strlen($state) > 0 && $state === $request->state)) {
                return redirect('/login')->withErrors('Invalid state value !');
            }

            // Send / post data client to get SSO PKU oauth token
            $tokenResponse = Http::asForm()->post(env('SSO_PKU_URL') . '/oauth/token', [
                'grant_type' => 'authorization_code',
                'client_id' => env('SSO_PKU_CLIENT_ID'),
                'client_secret' => env('SSO_PKU_CLIENT_SECRET'),
                'redirect_uri' => env('SSO_PKU_REDIRECT_URI'),
                'code' => request('code'),
            ]);
            $tokenResult = $tokenResponse->json();

            if ($tokenResponse->failed() || !isset($tokenResult['access_token'])) {
                return redirect('/login')->withErrors('SSO login failed !');
            }

            // Check authorize user from SSO PKU
            $userResponse = Http::withToken($tokenResult['access_token'])
                ->get(env('SSO_PKU_URL') . '/api/check-user');
            $userResult = $userResponse->json();
            $userResult = $userResult['data'];

            // Check user verified by email from user SSO PKU result
            if (!$userResult['email_verified_at']) {
                return redirect('/login')->withErrors(
                    'Maaf, user belum terverifikasi, silahkan lakukan verifikasi email melalui halaman SSO Pekanbaru !'
                );
            }

            // Check exist local/client user from database / you can check your user data with other field from user SSO response
            $checkMyUser = User::where('email', $userResult['email'])->first();

            // Reject - if only internal user can access application
            // if (! $checkMyUser) {
            //     return redirect('/login')->withErrors('Maaf, user tidak mempunyai akses aplikasi !');
            // }
            // // - OR - Create New - if public can access application
            $defaultPW = $userResult['username'] . rand(1000, 9999);
            if (!$checkMyUser) {
                $checkMyUser = User::create([
                    'name' => $userResult['name'],
                    'role' => "PEMOHON",
                    'username' => $userResult['username'] . rand(1000, 9999),
                    'password' => bcrypt($defaultPW),
                    'email' => $userResult['email'],
                    'email_verified_at' => $userResult['email_verified_at'],
                    'no_wa' => $userResult['phone_number'], // Nomor WA dengan awalan 62
                ]);
            }

            // Login user to client app
            Auth::login($checkMyUser);

            // Save session token (if needed)
            session([
                'sso_pku_access_token' => $tokenResult['access_token'],
                'sso_pku_refresh_token' => $tokenResult['refresh_token'],
                'sso_pku_expires_in' => $tokenResult['expires_in'],
            ]);

            // Redirect back to your route :)
            $urlIntended = session('url.intended') ? session('url.intended') : route('dashboard');
            return redirect($urlIntended);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
