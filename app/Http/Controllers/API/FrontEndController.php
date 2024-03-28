<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    //
    public function index(){
        try {
            //code...
            $news = News::latest()->limit(3)->get();
            return ResponseFormatter::success(
                $news,
                'Data berrhasil terlist'
            );
        } catch (\Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
