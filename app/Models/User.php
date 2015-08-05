<?php

namespace App\Models;

use App\Services\SearchEngine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SearchEngine;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role', 'email', 'password', 'first_name', 'last_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Scope a query to only include super administrators.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuperAdmin($query)
    {
        return $query->where('role', '=', 'super_admin');
    }

    /**
     * Scope a query to only include administrators.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', '=', 'admin');
    }

    /**
     * Returns key-label roles.
     *
     * @return array
     */
    public static function roles()
    {
        return trans('app.roles');
    }
}
