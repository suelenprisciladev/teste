<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = ['saldo'];
    protected $guarded = ['id','id_cliente','conta','status','created_at','update_at'];
    protected $table = 'contas';
}
