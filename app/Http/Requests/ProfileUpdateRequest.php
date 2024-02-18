<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'date_birth' => ['date'],
            'gender_id' => ['integer'],
            'biological_sex'=>['string'],
            'address_line_1'=>['string'],
            'address_line_2'=>[],
            'city'=>['string'],
            'state'=>['string'],
            'zip_code'=>['string'],
            'phone_number'=> ['string'],
            'phone_type'=> ['string'],
        ];
    }
}
