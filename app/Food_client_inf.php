<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Food_client_inf extends Model
{
    protected $table = 'food_client_inf';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}