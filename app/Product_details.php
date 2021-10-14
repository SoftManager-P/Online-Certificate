<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Product_details extends Model
{
    protected $table = 'Product_details';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}