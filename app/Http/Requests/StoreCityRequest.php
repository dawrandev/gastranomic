<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:cities,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле название обязательно для заполнения',
            'name.unique' => 'Город с таким названием уже существует',
            'name.max' => 'Название не должно превышать 255 символов',
        ];
    }
}
