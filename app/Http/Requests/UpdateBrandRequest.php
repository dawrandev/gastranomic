<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')->ignore($this->brand->id)
            ],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле название обязательно для заполнения',
            'name.unique' => 'Бренд с таким названием уже существует',
            'name.max' => 'Название не должно превышать 255 символов',
            'logo.image' => 'Файл должен быть изображением',
            'logo.mimes' => 'Допустимые форматы: jpg, jpeg, png, svg',
            'logo.max' => 'Размер файла не должен превышать 2MB',
            'description.max' => 'Описание не должно превышать 1000 символов',
        ];
    }
}
