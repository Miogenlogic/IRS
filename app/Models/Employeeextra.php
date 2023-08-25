<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Employeeextra extends Model

{

 public $timestamps = false;

    protected $table='employee_personal_information';



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


























