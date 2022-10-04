<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreticketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'user_id' => 'required|exists:users,id',
            'priority_id' => 'required|exists:priorities,id',
            'status_id' => 'required|exists:statuses,id',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}