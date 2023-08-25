<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zones extends Model

{

    protected $table='zones';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
         'Plnt', 'Name1', 'Street', 'Street2', 'Street3', 'Street4',
         'City', 'District', 'PostalCode', 'Description', 'CCd'
    ];

}


























