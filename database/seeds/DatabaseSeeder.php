<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        DB::table('companies')->truncate();
//        DB::table('employees')->truncate();

        $numberEmployees = 200;
        $numberCompanies = 5;

        factory(Company::class, $numberCompanies)->create();
        factory(Employee::class, $numberEmployees)->create();
    }
}
