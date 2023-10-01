<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ValidarRequestService
{
    public function validarRequest(Request $request, Model $model): bool
    {
        $validator = Validator::make($request->all(), $model->rules());

        if ($validator->fails()) {
            return false;
        }

        return true; 
    }
}