<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'restaurant_id' , 'menu_id' , 'target' , 'dibayar' , 'dalam_proses' , 'puasa_id' , 'proses'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function allDonation()
    {
        DB::table('donations')->update([ 
            'dalam_proses' => 0,
            'dibayar' => 0
        ]);
        $pembayaran = DB::table('transaction_details')
                    ->join('transactions', 'transactions.id', '=', 'transaction_id')
                    ->join('donations', 'donations.id', '=', 'donation_id')
                    ->select('donations.id', 'jumlah', 'status','dibayar', 'dalam_proses', 'transactions.created_at')
                    ->get();
                
        foreach($pembayaran as $item){
            $now_donation = Donation::where('id',$item->id)->first();
            if($item->status == 2){
                Donation::where('id',$item->id)
                        ->update([
                            'dibayar' => $now_donation->dibayar + $item->jumlah
                        ]);
            } else {
                $date = strtotime($item->created_at);
                $end = strtotime("+12 hours", $date);
                $now = time();

                if($now > $end && $item->status == 0){
                    Transaction::where('id',$item->id)
                    ->update(['status' => 4]);
                }

                if($item->status == 0 || $item->status == 1){
                    Donation::where('id',$item->id)
                        ->update([
                            'dalam_proses' => $now_donation->dalam_proses + $item->jumlah
                        ]);
                }
            } 
        }

        $donations = DB::table('donations')
                    ->join('menus', 'menus.id', '=', 'menu_id')
                    ->join('restaurants', 'restaurants.id', '=', 'restaurant_id')
                    ->join('puasas','puasas.id','=','puasa_id')
                    ->where('puasas.status',1)
                    ->where('donations.proses',2)
                    ->select('donations.*', 'nama_menu', 'harga', 'nama_resto', 'alamat','nama_puasa','tanggal')
                    ->get();
        
        return $donations;
    }

    public function reset()
    {
        $donations = Donation::join('puasas','puasa_id','=','puasas.id')
                            ->select('donations.*','status')->get();
        foreach($donations as $donation){
            if($donation->status == -1 && $donation->proses == 0){
                $donation->update([
                    'proses' => -2
                ]);
            }
            if($donation->status == 1 && $donation->proses != -1){
                $donation->update([
                    'proses' => 2
                ]);
            }
            if($donation->status == -1 && $donation->proses == 2){
                $donation->update([
                    'proses' => 1
                ]);
            }
        }

        // return $donations;
    }
}
