<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    protected $fillable = ['first_name','last_name','user_mail','nickname','dni','usuari'];
}
