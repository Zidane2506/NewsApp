<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{
    public function index()
    {
        $title = 'Profile - Index';
        return view('home.profile.index', compact('title'));
    }

    public function changePassword()
    {
        $title = 'Profile - Change Password';
        return view('home.profile.changePassword', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'currentPassword' => 'required',
            'password' => 'required|min:6',
            'confirmationPassword' => 'required|min:6'
        ]);

        $currentPasswordStatus = Hash::check(
            $request->currentPassword,
            auth()->user()->password
        );

        if ($currentPasswordStatus) {
            if ($request->password == $request->confirmationPassword) {
                $user = auth()->user();

                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'Password Has Been Updated');
            } else {
                return redirect()->back()->with('error', 'Password Does Not Match MotherFather');
            }
        } else {
            return redirect()->back()->with('error', 'Current Password Is Wrong');
        }
    }

    public function allUser()
    {
        $title = 'All User';
        $user = User::where('role', 'user')->get();

        return view('home.user.index', compact('title', 'user'));
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make('123456');
        $user->save();

        return redirect()->back()->with(
            'success',
            'Password Has Been Reset'
        );
    }

    public function createProfile()
    {
        $title = 'Profile - Create';

        return view('home.profile.create', compact('title'));
    }

    public function storeProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:208000'
        ]);
        $image = $request->file('image');
        $image->storeAs('public/profile', $image->getClientOriginalName());

        $user = auth()->user();

        $user->profile()->create([
            'first_name' => $request->first_name,
            'image' => $image->getClientOriginalName()
        ]);

        return redirect()->route('profile.index')->with(
            'success',
            'Password Has Been Reset'
        );
    }

    public function editProfile()
    {
        $title = 'Profile - Edit';

        $user = auth()->user();

        return view('home.profile.edit', compact('title', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:208000'
        ]);

        $user = auth()->user();

        if ($request->file('image') == '') {
            $user->profile->update([
                'first_name' => $request->first_name
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile Has Been Updated');
        } else {
            Storage::delete('public/profile/' . basename($user->profile->image));

            $image = $request->file('image');
            $image->storeAs('public/profile', $image->getClientOriginalName());

            $user->profile->update([
                'first_name' => $request->first_name,
                'image' => $image->getClientOriginalName()
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile Has benn Updated');
        }
    }
}
