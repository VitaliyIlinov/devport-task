<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreUserLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
