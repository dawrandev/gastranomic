<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id' => ['sometimes', 'exists:brands,id'],
            'city_id' => ['sometimes', 'exists:cities,id'],
            'branch_name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['sometimes', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'new_images' => ['nullable', 'array', 'max:10'],
            'new_images.*' => ['required', 'image', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'brand_id.exists' => 'Выбранный бренд не существует.',
            'city_id.exists' => 'Выбранный город не существует.',
            'branch_name.string' => 'Название филиала должно быть строкой.',
            'branch_name.max' => 'Название филиала не должно превышать 255 символов.',
            'phone.string' => 'Номер телефона должен быть строкой.',
            'phone.max' => 'Номер телефона не должен превышать 20 символов.',
            'address.string' => 'Адрес должен быть строкой.',
            'address.max' => 'Адрес не должен превышать 500 символов.',
            'latitude.numeric' => 'Широта должна быть числом.',
            'latitude.between' => 'Широта должна быть между -90 и 90.',
            'longitude.numeric' => 'Долгота должна быть числом.',
            'longitude.between' => 'Долгота должна быть между -180 и 180.',
            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не должно превышать 1000 символов.',
            'new_images.array' => 'Изображения должны быть массивом.',
            'new_images.max' => 'Максимум 10 новых фотографий.',
            'new_images.*.image' => 'Файл должен быть изображением.',
            'new_images.*.max' => 'Размер изображения не должен превышать 5MB.',
        ];
    }
}
