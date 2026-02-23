<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'device_id' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:20'],
            'selected_option_ids' => ['nullable', 'array'],
            'selected_option_ids.*' => ['integer', 'exists:questions_options,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'device_id.required' => 'Идентификатор устройства обязателен.',
            'device_id.string' => 'Идентификатор устройства должен быть строкой.',
            'device_id.max' => 'Идентификатор устройства слишком длинный.',
            'rating.required' => 'Оценка обязательна.',
            'rating.integer' => 'Оценка должна быть числом.',
            'rating.min' => 'Оценка должна быть не менее 1.',
            'rating.max' => 'Оценка не должна превышать 5.',
            'comment.max' => 'Комментарий не должен превышать 1000 символов.',
            'phone.string' => 'Номер телефона должен быть строкой.',
            'phone.max' => 'Номер телефона не должен превышать 20 символов.',
            'selected_option_ids.array' => 'selected_option_ids должен быть массивом.',
            'selected_option_ids.*.integer' => 'Каждый ID опции должен быть числом.',
            'selected_option_ids.*.exists' => 'Один или несколько выбранных вариантов ответа не существуют.',
        ];
    }
}
