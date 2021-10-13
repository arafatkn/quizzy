<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255',
            'time_limit' => 'bail|required|integer|min:1',
            'status' => 'bail|required|boolean',
            'total_questions' => 'bail|required|integer|min:1',
            'total_marks' => 'bail|required|integer|min:1',
        ];
    }
}
