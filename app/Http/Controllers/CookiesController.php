<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookiesController extends Controller
{
    
    public function set(Request $request, $id)
    {
        Cookie::queue('transaksi', $id, 5);

        return redirect('/transaction');
    }

    public function delete(Request $request){
        Cookie::queue(Cookie::forget('transaksi'));
        return redirect('/transaction');
    }

    public function get(Request $request){
        return $request->cookie('transaksi');
    }
}
