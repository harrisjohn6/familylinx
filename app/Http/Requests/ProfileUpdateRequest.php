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
            'nameFirst' => ['required', 'string', 'max:255'],
            'nameMiddle' => ['string', 'max:255'],
            'nameLast' => ['string', 'max:255'],
            'prefix' => ['nullable', 'string', 'max:255'],
            'suffix' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'dateBirth' => ['date'],
            'genderId' => ['integer'],
            'biologicalSex' => ['nullable','string'],
            'addressLine1' => ['nullable','string'],
            'addressLine2' => ['nullable',],
            'city' => ['string'],
            'state' => ['string'],
            'zip' => ['string'],
            'phoneNumber' => ['string'],
            'phoneType' => ['string'],
        ];
    }
}
