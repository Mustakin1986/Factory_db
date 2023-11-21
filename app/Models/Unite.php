<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function Line()
    {
     return $this->hasMany(Line::class);
    }
    public function Efficiency()
    {
     return $this->hasMany(Efficiency::class);
    }
}

