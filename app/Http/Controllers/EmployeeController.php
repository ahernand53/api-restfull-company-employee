<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return $this->showAll($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validations = [
            'rules' => [
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|email|unique:employees',
                'salary'        => 'required|numeric',
                'company_id'    => 'required'
            ],
            'message' => [
                'first_name.required'   => 'the field (first name) is required',
                'last_name.required'    => 'the field (first name) is required',
                'email.unique'          => 'this name already in use, please another name',
                'email.required'        => 'the field (email) is required',
                'salary.required'       => 'the field (salary) is required',
                'company_id.required'   => 'the field (company) is required'
            ]
        ];

        $this->validate(
            $request,
            $validations['rules'],
            $validations['message']
        );

        $fields = $request->all();
        $employee = Employee::create($fields);

        return $this->showOne($employee, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $employeeLoad = Employee::findOrFail($employee->id);

        return $this->showOne($employeeLoad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $validation = [
            'rules' => [
                'email'         => 'email|unique:companies,email,' . $employee->id
            ],
            'message' => [
                'email.unique'          => 'this email already in use, please another email',
            ]
        ];

        $this->validate($request, $validation['rules'], $validation['message']);

        if ($request->has('first_name') && $request->first_name != $employee->first_name) {
            $employee->first_name = $request->first_name;
        }

        if ($request->has('address')) {
            $employee->address = $request->address;
        }

        if ($request->has('city')) {
            $employee->city = $request->city;
        }

        if ($request->has('email') && $employee->email != $request->email) {
            $employee->email = $request->email;
        }

        if ($request->has('phone')) {
            $employee->phone = $request->phone;
        }

        if ($request->has('company_id')) {
            $employee->company_id = $request->company_id;
        }

        if (!$employee->isDirty()) {
            return response()->json(
                [
                    'error' => 'You must specify at least one value to update the data',
                    'code'  => '422'
                ],
                422
            );
        }

        $employee->save();

        return $this->showOne($employee, 202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return $this->showOne($employee, 202);
    }
}
