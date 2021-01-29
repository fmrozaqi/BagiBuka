<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Donation;
use App\Models\Puasa;

class AdminDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->session()->has('user')){
            return redirect('/login');
        } else {
            $user = session('user');
            if($user['role']==0){
                return redirect('/rmadmin');
            }
        }

        $puasa = new Puasa;
        $puasa->reset();

        $donation = new Donation;
        $donation->reset();

        $donation->allDonation();

        $donations = DB::table('donations')
                    ->join('menus', 'menus.id', '=', 'menu_id')
                    ->join('restaurants', 'restaurants.id', '=', 'restaurant_id')
                    ->select('donations.*', 'nama_menu', 'harga', 'nama_resto')
                    ->get();

        return view('admin.donation', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verifikasi($id)
    {
        $donasi = Donation::where('id',$id);
        $donasi->update([
            'proses' => 1
        ]);

        return redirect('admin/donation');
    }

    public function tolak($id)
    {
        $donasi = Donation::where('id',$id);
        $donasi->update([
            'proses' => -1
        ]);

        return redirect('admin/donation');
    }
}
