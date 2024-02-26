<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteFamilyRequest extends FormRequest
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
            'inviteEmail' => 'email|required',
            'inviteNameFirst' => 'string|nullable',
            'inviteNameLast' => 'string|nullable',
            'inviteNameMiddle' => 'string|nullable',
            'inviteDateBirth' => 'date|nullable',
            'inviteBiologicalSex' => 'string|nullable',
            'inviteRelationshipId' => 'integer|required',
        ];
    }
}
