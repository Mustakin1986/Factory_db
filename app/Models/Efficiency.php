<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efficiency extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function Unite()
    {
     return $this->belongsTo(Unite::class);
    }
}

