<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemp extends Model
{

    protected $table='report_temp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       // 'name', 'email', 'password',
    ];


    /*
        protected $primaryKey = "";
        public $incrementing = false;
        public $timestamps = false;
    */
}
