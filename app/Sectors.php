<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Sectors extends Model
{
    protected $table = 'sector';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}