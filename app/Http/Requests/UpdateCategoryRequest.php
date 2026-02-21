<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'translations' => ['nullable', 'array'],
            'translations.*' => ['nullable', 'array'],
            'translations.*.name' => ['nullable', 'string', 'min:3', 'max:255'],
            'translations.*.description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'icon.image' => 'Файл должен быть изображением.',
            'icon.mimes' => 'Допустимые форматы: jpg, jpeg, png, svg.',
            'icon.max' => 'Размер файла не должен превышать 2MB.',
            'translations.*.name.min' => 'Название должно содержать минимум :min символа.',
            'translations.*.name.max' => 'Название не должно превышать :max символов.',
            'translations.*.description.max' => 'Описание не должно превышать :max символов.',
        ];
    }
}
