<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Service_history extends Model
{
    protected $table = 'service_history';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}