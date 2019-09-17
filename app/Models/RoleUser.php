<?php namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class RoleUser extends EntrustPermission
{
    protected $table='role_user';

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
