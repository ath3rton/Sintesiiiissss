<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['user_mail','user_password','rol'];
    
    /**
     * Generacio del token per l'usuari
     * 
     */
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
