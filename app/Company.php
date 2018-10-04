<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $guarded = [];

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

    public static function sort($filter) {
        if ($filter['sort'] == 'name_asc') {
            return Company::orderBy('name_company', 'ASC')->paginate(1000);
        } else if ($filter['sort'] == 'name_desc') {
            return Company::orderBy('name_company', 'DESC')->paginate(1000);
        }
    }

}
