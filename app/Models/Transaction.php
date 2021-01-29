<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status' , 'nama' , 'email', 'telp' , 'pembayaran'
    ];

    public static function subtotalDonasi($id)
    {
        $subtotal = DB::table('transaction_details')
                    ->where('transaction_id','=',$id)
                    ->join('donations', 'donations.id', '=', 'donation_id')
                    ->join('menus', 'menus.id', '=', 'menu_id')
                    ->join('restaurants', 'restaurants.id', '=', 'restaurant_id')
                    ->select('nama_menu', 'harga', 'nama_resto', 'jumlah',DB::raw('(jumlah * harga) as subtotal'))
                    ->get();
        
        return $subtotal;
    }

    public static function status($id){
        $status = DB::table('transactions')
                    ->where('id', $id)
                    ->select('status', 'created_at', 'pembayaran')->first();
        return $status;
    }
}
