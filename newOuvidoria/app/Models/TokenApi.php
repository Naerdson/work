<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TokenApi extends Model
{
    protected $table = 'token_api';

    protected $fillable = ['token', 'descricao'];

    public static function generateTokenApi()
    {
        return Str::random(40);
    }
}
