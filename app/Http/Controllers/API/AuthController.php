<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\Events\ResponseReceived;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validate
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // cek Credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])) {
                return ResponseFormatter::error([
                    'message' => 'Unautorized'
                ], 'Authentication Failed', 500);
            }

            // cek jika password tidak sesuai
            $user = User::where('email', $credentials['email'])->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            //Jika berhasil cek password make loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        };
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confrim_password' => 'required|string|min:6'
            ]);

            //cek kondisi password dan confirm password
            if ($request->password != $request->confrim_password) {
                return ResponseFormatter::error([
                    'massage' => 'Password not match',
                ], 'Authentication Failed', 401);
            }

            //create akun
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated', 200);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success([
            $token, 'Token Revoked'
        ], 'Token Revoked', 200);
    }

    public function updatePassword(Request $request)
    {
        try {
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);
            $user = Auth::user();

            if (!Hash::check($request->old_password, $user->password)) {
                return ResponseFormatter::error([
                    'message' => 'Password Lama Tidak Dapat Diubah'
                ], 'Authentication Failed', 500);
            }

            if ($request->new_password !== $request->confirm_password) {
                return ResponseFormatter::error([
                    'message' => 'Password Tidak Sesuai'
                ], 'Authentication Failed', 500);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return ResponseFormatter::success([
                'message' => 'password Berhasil Diubah'
            ], 'Authenticated', 200);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function allUsers()
    {
        $user = User::where('role', 'user')->get();
        return ResponseFormatter::success(
            $user,
            'Data User Berhasil DiAmbil'
        );
    }

    public function storeProfile(Request $request)
    {
        try {
            //validate
            $this->validate($request, [
                'first_name' => 'required',
                'image' => 'required|image|max:2048|mimes:jpg,jpeg,png'
            ]);

            // get data user
            $user = auth()->user();

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/profile', $image->hashName());

            // create profile
            $user->profile()->create([
                'first_name' => $request->first_name,
                'image' => $image->hashName()
            ]);

            // get data profile
            $profile = $user->profile;

            return ResponseFormatter::success(
                $profile,
                'Profile berhasil diupdate'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $this->validate($request, [
                'first_name' => 'required',
                'image' => 'image|mimes:png,jpg,jpg|max:2024'
            ]);

            // get user
            $user = auth()->user();

            if(!$user->profile){
                return ResponseFormatter::error([
                    'message' => 'profile not found, Pleas create the profile'
                ], 'Authentic Failed', 200);
            }
            //cek kondisi image bila tidak di uplod
            if ($request->file('image') == '') {
                $user->profile->update([
                    'first_name' => $request->first_name
                ]);
            } else {
                Storage::delete('public/profile/' . basename($user->profile->image));

                $image = $request->file('image');
                $image->storeAs('public/profile', $image->getClientOriginalName());

                $user->profile->update([
                    'first_name' => $request->first_name,
                    'image' => $image->getClientOriginalName()
                ]);
            }

            return ResponseFormatter::success(
                $user,
                "data berhasil di edit"
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Someting error',
                'error' => $error
            ], 'Authenticated Failed', 500);
        }
    }
}
