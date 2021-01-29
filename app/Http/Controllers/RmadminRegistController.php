<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puasa;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Donation;

class RmadminRegistController extends Controller
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
                return redirect('/rdmin');
            }
        }

        $puasa = new Puasa;
        $puasa->reset();

        $donation = new Donation;
        $donation->reset();


        $user = session('user');
        $menu = Menu::where('user_id',$user['id'])->get();
        $puasa = Puasa::where('status',0)->get();
        $restaurant = Restaurant::where('user_id',$user['id'])->first();

        $donasi = Donation::where('restaurant_id',$restaurant->id)
                            ->join('menus','menu_id','=','menus.id')
                            ->join('puasas','puasa_id','=','puasas.id')
                            ->select('nama_puasa','tanggal','nama_menu','harga','target','proses')
                            ->get();

        return view('rmadmin.regist',compact('menu','puasa','donasi'));
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
        $user = session('user');
        $restaurant = Restaurant::where('user_id',$user['id'])->first();

        Donation::create([
            'restaurant_id' => $restaurant->id,
            'menu_id' => $request->menu,
            'puasa_id' => $request->puasa,
            'target' => $request->target,
            'dibayar' => 0,
            'dalam_proses' => 0,
            'proses' => 0
        ]);

        return redirect('rmadmin/regist');
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
