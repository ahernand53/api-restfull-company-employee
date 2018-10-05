<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{

    /**
     * @param $data
     * @param $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    /**
     * @param $message
     * @param $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code)
    {
        return response()->json(
            [
            'error' => $message,
            'code' => $code
            ],
            $code
        );
    }

    /**
     * @param Collection $collection
     * @param int        $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $collection = $this->sortData($collection);
//        $collection = $this->paginate($collection);

        return $this->successResponse(['data' => $collection], $code);
    }

    /**
     * @param Model $instance
     * @param int   $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    /**
     * @param Collection $collection
     *
     * @return Collection|mixed
     */
    protected function sortData(Collection $collection)
    {
        $result = explode("-", request()->sort);
        if (request()->has('sort')) {
            $attribute = $result[0];
            $order = $result[1];
            if ($order == 'asc') {
                $collection = $collection->sortBy->{$attribute};
            } else {
                $collection = $collection->sortByDesc->{$attribute};
            }


        }
        return $collection;
    }

    /**
     * @param Collection $collection
     *
     * @return LengthAwarePaginator
     */
    protected function paginate(Collection $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];

        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;

        if (request()->has('limit')) {
            $perPage = (int) request()->limit;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPage(),
        ]);


        $paginated->appends(request()->all());

        return $paginated;
    }


    /**
     * @param String $message
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showMessage(String $message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

}