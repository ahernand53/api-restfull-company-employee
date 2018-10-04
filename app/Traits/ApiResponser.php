<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{

    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

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

    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $collection = $this->sortData($collection);
        return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    protected function sortData(Collection $collection)
    {
        if (request()->has('sort')) {
            $attribute = request()->sort;
            dd($attribute);
            $collection = $collection->sortBy($attribute);
        }
        return $collection;
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

}