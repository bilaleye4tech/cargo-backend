<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'id' => 'required|exists:car_requests,id',
            'departure' => 'required',
            'destination' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'car_detail' => 'required',
            'fare' => 'required',
            'seats' => 'required', 
        ];
    }
}
