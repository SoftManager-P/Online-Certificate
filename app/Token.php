<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Token extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'token';

    public function total($table){
    return app("App\\".$table)->all();

    }
}