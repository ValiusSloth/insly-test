<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'per_page' => 'sometimes|integer|min:1',
        ];
    }
}
