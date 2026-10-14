<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'tb_pedidos';
    ///protected $fillable = [];
    protected $guarded = [];
    public $timestamps = false;
}
