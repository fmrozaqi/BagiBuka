<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;

class RmadminMenuController extends Controller
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

        $menus = DB::table('menus')
                        ->select('*')
                        ->get();
        return view('rmadmin.menu', compact('menus'));
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

        $user = User::where('id',$user['id'])->first();

        $menu = new Menu([
            'nama_menu' => $request->nama,
            'harga' => $request->harga
        ]);
        
        $user->menu()->save($menu);

        return redirect('/rmadmin/menu');
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
        Menu::where('id',$id)
            -> update([
                'nama_menu' => $request->nama,
                'harga' => $request->harga
            ]);

        return redirect('/rmadmin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::where('id',$id)->delete();
        return redirect('/rmadmin/menu');
    }
}
