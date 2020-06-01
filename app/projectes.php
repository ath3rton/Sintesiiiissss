<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projectes extends Model
{
    protected $fillable = ['nom_projecte','descripcio','feedback','objectiu','fraccio','estat','actiu','emp_id'];
}
