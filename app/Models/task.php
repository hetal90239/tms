<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $table="task";
    protected $primarykey="id";

    //public function employee()
    //{
       // return $this->belongsTo(employee::class);
   // }
}

