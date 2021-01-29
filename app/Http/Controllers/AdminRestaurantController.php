<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRestaurantController extends Controller
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

        $restaurants = DB::table('restaurants')
                        ->join('users','users.id','=','user_id')
                        ->select('*')
                        ->get();
        return view('admin.resto', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->username),
            'role' => 0
        ]);

        $restaurant = new Restaurant([
            'nama_resto' => $request->nama,
            'alamat' => $request->alamat
        ]);

        $user->restaurant()->save($restaurant);

        return redirect('/admin/restaurant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        Restaurant::where('id',$id)
                    ->update([
                        'nama_resto' => $request->nama,
                        'alamat' => $request->alamat
                    ]);
        return redirect('/admin/restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Restaurant::where('id',$id)->delete();

        return redirect('/admin/restaurant');
    }
}
