<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Service_details extends Model
{
    protected $table = 'service_details';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}