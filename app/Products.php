<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}