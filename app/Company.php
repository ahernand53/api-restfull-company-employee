<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function setNameCompanyAttribute($valor) {
        $this->attributes['name_company'] = strtolower($valor);
    }

    public function getNameCompanyAttribute($valor) {
        return strtoupper($valor);
    }

    public function setEmailAttribute($valor) {
        $this->attributes['email'] = strtolower($valor);
    }

    public function employees(){

        return $this->hasMany(Employee::class);
    }

}
