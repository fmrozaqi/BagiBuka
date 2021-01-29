<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_puasa','tanggal','status'
    ];

    public function reset()
    {
        $puasas = Puasa::orderByDesc('tanggal')
                    ->get();
        foreach($puasas as $puasa){
            $date = strtotime($puasa->tanggal);            
            $date = strtotime("18 hours", $date);
            $now = time();
            if($now>$date){
                $puasa->update([
                    'status' => -1
                ]);
            }
        }

        return $puasas;
    }
}
