<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Puasa;
use App\Models\Restaurant;

class RmadminController extends Controller
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
            if($user['role']==1){
                return redirect('/admin');
            }
        }

        $puasa = new Puasa;
        $puasa->reset();

        $donation = new Donation;
        $donation->reset();

        $donation->allDonation();


        $user = session('user');

        $restaurant = Restaurant::where('user_id',$user['id'])->first();

        $donation = Donation::where('restaurant_id',$restaurant->id)
                            ->where('proses',2)
                            ->join('puasas','puasa_id','=','puasas.id')
                            ->select('donations.*','nama_puasa')
                            ->first();

        $donations = Donation::where('restaurant_id',$restaurant->id)
                            ->join('puasas','puasa_id','=','puasas.id')
                            ->join('menus','menu_id','=','menus.id')
                            ->where('proses','>',0)
                            ->select('donations.*','nama_puasa','tanggal','nama_menu','harga','status')
                            ->get();

        // return $donations;

        return view('rmadmin.index',compact('donation','donations'));
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
}
