<?php

namespace App\Http\Requests;

use App\Models\Members;
use Illuminate\Foundation\Http\FormRequest;

class StoreMembersRequest extends FormRequest
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
        return array_merge(Members::rules(),['image'=>'required|file|image|max:10000']);
    }

//    /**
//     * Customize error messages for validation rules.
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'email.unique' => 'The email address has already been taken.',
//            'phone.unique' => 'The phone number has already been taken.',
//            'position_id.exists' => 'The selected position does not exist.',
//            'committee_id.exists' => 'The selected committee does not exist.',
//            // Add more custom messages as needed
//        ];
//    }
}
