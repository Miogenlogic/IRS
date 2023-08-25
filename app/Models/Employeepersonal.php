<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Employeepersonal extends Model

{

 public $timestamps = false;

    protected $table='master_employee';



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


























