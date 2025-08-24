<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProofRequest extends FormRequest
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
            'activitytype_id' => 'required',
            'title' => 'required|string',
            'file_upload' => 'required',
            'hours_earned' => 'required',
        ];
    }
}
