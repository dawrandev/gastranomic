<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'translations' => ['required', 'array'],
            'translations.*.name' => ['required', 'string', 'max:255'],
            'translations.*.description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'logo.required' => 'Логотип обязателен для заполнения.',
            'logo.image' => 'Файл должен быть изображением.',
            'logo.mimes' => 'Допустимые форматы: jpg, jpeg, png, svg.',
            'logo.max' => 'Размер файла не должен превышать 2MB.',
            'translations.required' => 'Переводы обязательны.',
            'translations.*.name.required' => 'Название обязательно для заполнения.',
            'translations.*.name.max' => 'Название не должно превышать 255 символов.',
            'translations.*.description.max' => 'Описание не должно превышать 1000 символов.',
        ];
    }
}
