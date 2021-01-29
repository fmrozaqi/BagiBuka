<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puasa;

class AdminPuasaController extends Controller
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
        $puasa = $puasa->reset();

        return view('admin.puasa', compact('puasa'));
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
        Puasa::create([
            'nama_puasa' => $request->nama,
            'tanggal' => $request->tanggal,
            'status' => 0
        ]);

        return redirect('admin/puasa');
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
        Puasa::where('id',$id)->delete();

        return redirect('/admin/puasa');
    }

    public function activate($id)
    {
        Puasa::where('id',$id)
            ->update([
                'status' => 1
            ]);

        return redirect('/admin/puasa');
    }

    public function deactivate($id)
    {
        Puasa::where('id',$id)
            ->update([
                'status' => 0
            ]);

        return redirect('/admin/puasa');
    }
}
