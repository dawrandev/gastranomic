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
            'comments' => ['nullable', 'array', 'max:3'],
            'comments.*.question_id' => ['required', 'integer', 'exists:questions_categories,id'],
            'comments.*.text' => ['required', 'string', 'max:1000'],
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
            'comments.max' => 'Может быть не более 3 комментариев.',
            'comments.*.question_id.required' => 'ID вопроса обязателен для каждого комментария.',
            'comments.*.question_id.integer' => 'ID вопроса должен быть числом.',
            'comments.*.question_id.exists' => 'Один или несколько ID вопросов не существуют.',
            'comments.*.text.required' => 'Текст комментария обязателен.',
            'comments.*.text.string' => 'Текст комментария должен быть строкой.',
            'comments.*.text.max' => 'Текст комментария не должен превышать 1000 символов.',
            'phone.string' => 'Номер телефона должен быть строкой.',
            'phone.max' => 'Номер телефона не должен превышать 20 символов.',
            'selected_option_ids.array' => 'selected_option_ids должен быть массивом.',
            'selected_option_ids.*.integer' => 'Каждый ID опции должен быть числом.',
            'selected_option_ids.*.exists' => 'Один или несколько выбранных вариантов ответа не существуют.',
        ];
    }

    /**
     * Custom validation for comments - ensure they're linked to open-ended questions
     * and that rating conditions are met.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $comments = $this->input('comments', []);
            $rating = $this->input('rating');

            foreach ($comments as $index => $comment) {
                $questionId = $comment['question_id'] ?? null;

                if ($questionId) {
                    $question = \App\Models\QuestionCategory::find($questionId);

                    // Reject if question has options (multiple choice)
                    if ($question && $question->options()->count() > 0) {
                        $validator->errors()->add(
                            "comments.{$index}.question_id",
                            "Question ID {$questionId} is for multiple choice, not text comments."
                        );
                    }

                    // Validate rating condition
                    if ($question && $question->condition) {
                        $condition = $question->condition;
                        if (!$this->evaluateCondition($rating, $condition)) {
                            $validator->errors()->add(
                                "comments.{$index}.question_id",
                                "Question ID {$questionId} is not applicable for rating {$rating}."
                            );
                        }
                    }
                }
            }
        });
    }

    /**
     * Evaluate rating condition.
     *
     * @param int $rating The given rating
     * @param array $condition The condition array with 'field', 'operator', 'value'
     * @return bool Whether the condition is met
     */
    private function evaluateCondition($rating, $condition): bool
    {
        $field = $condition['field'] ?? null;
        $operator = $condition['operator'] ?? null;
        $value = $condition['value'] ?? null;

        if ($field !== 'rating') {
            return true;
        }

        return match($operator) {
            '<=' => $rating <= $value,
            '>=' => $rating >= $value,
            '==' => $rating == $value,
            '<' => $rating < $value,
            '>' => $rating > $value,
            default => true,
        };
    }
}
