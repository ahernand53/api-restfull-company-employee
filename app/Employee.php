<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';
    protected $guarded = [];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function setFirstNameAttribute($valor) {
        $this->attributes['first_name'] = strtolower($valor);
    }

    public function setLastNameAttribute($valor) {
        $this->attributes['last_name'] = strtolower($valor);
    }

    public function getFirstNameAttribute($valor) {
        return ucfirst($valor);
    }

    public function getLastNameAttribute($valor) {
        return ucfirst($valor);
    }

    public function setEmailAttribute($valor) {
        $this->attributes['email'] = strtolower($valor);
    }

    public function getCompany(User $user) {
        return $user->hasOne(Company::class);
    }

    public function company() {
        $this->belongsTo(Company::class);
    }

}
