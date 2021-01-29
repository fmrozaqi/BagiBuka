<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\CookiesController;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->cookie('transaksi') == null ){
            return redirect('/');
        }

        $id = $request->cookie('transaksi');
        $subtotalDonasi = Transaction::subtotalDonasi($id);
        $status = Transaction::status($id);

        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addHour();
             
        $result = $status->created_at;
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $result);
        $end->addHour(12);
        $now = Carbon::now();
        $different = $end->diff($now);
        $duration = $different->h*3600 + $different->i*60 + $different->s;
        
        if($now->greaterThan($end) && $status->status == 0){
            Cookie::queue(Cookie::forget('transaksi'));
            return redirect('/');
        }

        $pembayaran = $status->pembayaran;
        $status = $status->status;

        return view('donations.payment',compact('id','subtotalDonasi','status','duration','pembayaran'));
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
        if( $request->cookie('transaksi') != null ){
            return redirect('/transaction');
        }

        $transaction = Transaction::create([
            'status' => 0,
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->phone,
            'pembayaran' => $request->pembayaran
        ]);

        $cart = session('cart_donasi');

        foreach ($cart as $id => $jumlah){
            if($jumlah == 0)continue;
            Transaction_detail::create([
                'transaction_id' => $transaction->id,
                'donation_id' => $id,
                'jumlah' => $jumlah
            ]);
        }
        Cookie::queue('transaksi', $transaction->id, 60 * 12);
        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        Transaction::where('id',$transaction->id)
                    ->update(['status' => 1]);
        return redirect('/transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Cookie::queue(Cookie::forget('transaksi'));
        return redirect('/');
    }

    public function cancel($id)
    {
        Transaction::where('id',$id)
                    ->update(['status' => 3]);
        Cookie::queue(Cookie::forget('transaksi'));
        return redirect('/');
    }
}
