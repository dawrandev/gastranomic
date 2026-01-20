<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'translations' => ['required', 'array', 'min:1'],
            'translations.*' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле имя обязательно для заполнения',
            'name.max' => 'Имя не должно превышать 255 символов',
            'icon.image' => 'Файл должен быть изображением',
            'icon.mimes' => 'Допустимые форматы: jpg, jpeg, png, svg',
            'icon.max' => 'Размер файла не должен превышать 2MB',
        ];
    }
}
