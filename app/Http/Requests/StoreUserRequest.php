<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'min:3',
            ],
            'phone_number' => [
                'required',
                'numeric',
                'min_digits:7',
                'max_digits:10',
                Rule::unique((new User())->getTable(),'phone_number')
            ],
        ];
    }
}
