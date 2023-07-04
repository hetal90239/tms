<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model implements 
\Illuminate\Contracts\Auth\Authenticatable

{
    
    use HasFactory;
    protected $table="employee_detail";
    protected $primarykey="id";

    protected $guard = "employee_detail";
    protected $fillable = [
    'empname',
    'empemail',
    'emprole',
    'password',
    'cpassword',
    ];
  
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
        
    }
    public function getAuthIdentifierName(){

    }
public function getAuthIdentifier(){

}
public function getAuthPassword(){

}
public function getRememberToken(){

}
public function setRememberToken($value){

}
public function getRememberTokenName(){

}

}    