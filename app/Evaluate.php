<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Evaluate extends Model
{
    protected $table = 'evaluate_history';
    protected $primaryKey = 'id';

    public function total($table){
    return app("App\\".$table)->all();

    }
}