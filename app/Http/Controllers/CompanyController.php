<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use PhpParser\JsonDecoder;

class CompanyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return $this->showAll($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = [
            'rules' => [
                'name_company'  => 'required|unique:companies',
                'email'         => 'required|email|unique:companies',
                'city'          => 'required',
                'phone'         => 'required'
            ],
            'message' => [
                'name_company.required' => 'the field (name company) is required',
                'name_company.unique'   => 'this name already in use, please another name',
                'city.required'         => 'the field (city) is required',
                'phone.required'        => 'the field (phone) is required',
                'email.unique'          => 'this email already in use, please another name',
                'email.required'        => 'the field (email) is required'
            ]
        ];

        $this->validate(
            $request,
            $validation['rules'],
            $validation['message']
        );

        $fields = $request->all();
        $company = Company::create($fields);

        return $this->showOne($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return $this->showOne($company);
    }

    /**
     * Display add for me.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function showEmployees(Company $company) {

        $employees = $company->employees;

        return $this->showAll($employees);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $validation = [
            'rules' => [
                'name_company'  => 'unique:companies',
                'email'         => 'email|unique:companies,email,' . $company->id
            ],
            'message' => [
                'name_company.unique'   => 'this name already in use, please another name',
                'email.unique'          => 'this email already in use, please another name',
            ]
        ];

        $this->validate($request, $validation['rules'], $validation['message']);

        if ($request->has('name_company') && $request->name_company != $company->name_company) {
            $company->name_company = $request->name_company;
        }

        if ($request->has('address')) {
            $company->address = $request->address;
        }

        if ($request->has('city')) {
            $company->city = $request->city;
        }

        if ($request->has('email') && $company->email != $request->email) {
            $company->email = $request->email;
        }

        if ($request->has('phone')) {
            $company->phone = $request->phone;
        }

        if (!$company->isDirty()) {
            return $this->errorResponse(
                'You must specify at least one value to update the data',
                422
            );
        }

        $company->save();

        return $this->showOne($company, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return $this->showOne($company);

    }
}
