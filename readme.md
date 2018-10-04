## Api RestFull Companies and Employees

#### Route

| **Method** | **URI** | **Name** | **Description** | **Middleware**
|----------|----------|----------|----------|--------|
GET|api/companies|companies.index|Devuelve todas las empresas existentes|api|
POST      | api/companies                     | companies.store     | Crea una empresa         | api
GET  | api/companies/{company}           | companies.show      | Devuelve una empresa dado el **id**         | api        |
PATCH | api/companies/{company}           | companies.update    | Actualiza una empresa dado el **id**        | api        |
DELETE    | api/companies/{company}           | companies.destroy   | Elimina una empresa dado el **id**       | api        |
GET  | api/companies/{company}/employees | companies.employees | Devuelve los empleados de una empresa dado el **id** | api        |
GET  | api/employees                     | employees.index     | Devuelve todos los empleados existentes        | api        |
POST      | api/employees                     | employees.store     | Crea un empleado        | api        |
GET  | api/employees/{employee}          | employees.show      | Devuelve un empleado dado el **id**        | api        |
PATCH | api/employees/{employee}          | employees.update    | Actualiza un empleado dado el **id**       | api        |
DELETE    | api/employees/{employee}          | employees.destroy   | Elimina un empleado dado el **id**      | api        |

