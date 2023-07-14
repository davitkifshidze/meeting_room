<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = true;

    protected $table = "admins";

    protected $fillable = ['username', 'email'];

    protected $hidden = ['password', 'remember_token'];

    protected $guarded = array();

}
