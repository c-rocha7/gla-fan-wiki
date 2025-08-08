<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'sometimes|string|max:255',
            'icon'  => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
