<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [];
    protected $guarded = ['id','nome','endereco','created_at','update_at'];
    protected $table = 'clientes';
}
