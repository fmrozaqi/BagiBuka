<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class AdminController extends Controller
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
        $subtotal = DB::table('transactions')
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_id')
                    ->join('donations', 'donations.id', '=', 'donation_id')
                    ->join('menus', 'menus.id', '=', 'menu_id')                                    
                    ->select('transactions.*', DB::raw('sum(jumlah * harga) as subtotal'))
                    ->groupBy('transactions.id')
                    ->orderBy('transactions.updated_at', 'desc')
                    ->get();

        foreach($subtotal as $item){
            $date = strtotime($item->created_at);
            $end = strtotime("+12 hours", $date);
            $now = time();

            if($now > $end && $item->status == 0){
                Transaction::where('id',$item->id)
                    ->update(['status' => 4]);
            }
        }
        
        return view('admin.index', compact('subtotal'));
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
        Transaction::where('id',$id)
                    ->update(['status' => 2]);
        return redirect('/admin');
    }

    public function unverifikasi($id)
    {
        Transaction::where('id',$id)
                    ->update(['status' => 1]);
        return redirect('/admin');
    }
}
