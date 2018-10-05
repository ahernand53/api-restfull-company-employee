<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="mx-auto" style="margin-top: 10%">
                    <div class="col-12">
                        <div class="jumbotron">
                            <h1 class="display-4">Empresas</h1>
                            <p class="lead">Resusmen de todas las actividades que se pueden realizar con las empresas</p>
                            <hr class="my-4">
                            <p>Las rutas las pueden encontrar en el <a href="https://github.com/ahernand53/api-restfull-company-employee">repositorio</a></p>
                            <a class="btn btn-primary btn-lg" href="#" role="button">GO</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="jumbotron">
                            <h1 class="display-4">Empleados</h1>
                            <p class="lead">Se denota que los empleados dependen de las empresas creadas, todas sus actividades que se pueden realizar con los empleados</p>
                            <hr class="my-4">
                            <p>En el <a href="https://github.com/ahernand53/api-restfull-company-employee">repositorio</a> pueden encontrar las distintas maneras de como filtrar y limitar</p>
                            <a class="btn btn-primary btn-lg" href="/empleados" role="button">GO</a>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </body>
</html>
