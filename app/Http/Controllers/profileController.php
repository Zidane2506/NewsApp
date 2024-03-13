<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function index() {
        $title = 'Profile - Index';
        return view('home.profile.index', compact('title'));
    }

    public function changePassword() {
        $title = 'Profile - Change Password';
        return view('home.profile.changePassword', compact('title'));
    }
}
