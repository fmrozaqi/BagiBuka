<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RmadminProfileController extends Controller
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

        $user = session('user');

        $restaurant = Restaurant::where('user_id',$user['id'])->first();
        $user = User::where('id',$user['id'])->first();
        
        return view('rmadmin.profile', compact('restaurant','user'));
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
        User::where('id',$id)
            ->update([
                'username' => $request->username
            ]);
        Restaurant::where('user_id',$id)
                ->update([
                    'nama_resto' => $request->namae_resto,
                    'alamat' => $request->alamat
                ]);

        return redirect('/rmadmin/profile')->with('status_berhasil','Ubah Profile Berhasil!');
        
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

    public function change_password(Request $request, $id)
    {
        $user = User::where('id',$id)->first();

        if(!Hash::check($request->password, $user->password)){
            return redirect('/rmadmin/profile')->with('status','password lama salah!');
        }

        if($request->new_password != $request->confirm_password){
            return redirect('/rmadmin/profile')->with('status','Konfirmasi password salah!');
        }

        if($request->new_password == $request->password){
            return redirect('/rmadmin/profile')->with('status','Password baru tidak boleh sama dengan yang lama!');
        }

        User::where('id',$id)
            ->update([
                'password' => Hash::make($request->new_password)
            ]);
        
        return redirect('/rmadmin/profile')->with('status_berhasil','Ubah Password Berhasil!');
    }
}
