<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    public static  function detail_menu($cart){
        $detail_menu = [];
        foreach($cart as $id => $jumlah){
            $donasi = Donation::where('id',$id)->first();
            array_push($detail_menu,Menu::where('id',$donasi->menu_id)->first());
        }
        return $detail_menu;
    }

    public static  function detail_rm($cart){
        $detail_rm = [];
        foreach($cart as $id => $jumlah){
            $donasi = Donation::where('id',$id)->first();
            array_push($detail_rm,Restaurant::where('id',$donasi->restaurant_id)->first());
        }
        return $detail_rm;
    }
}
