<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empreses extends Model
{
    protected $fillable = ['nom_empresa','cif','ciutat','owner'];
}
