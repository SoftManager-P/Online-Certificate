<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Services extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}
