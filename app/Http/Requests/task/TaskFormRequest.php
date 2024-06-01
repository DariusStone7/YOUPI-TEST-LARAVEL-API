<?php

namespace App\Http\Requests\task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskFormRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ];
    }

    
    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            'message' => 'erreur de validation',
            'errorList' => $validator->errors(),
        ]));
    }

    public function messages(){
        
        return [
            'user_id.required' => 'Veuillez entrer un utilisateur',
            'user_id.exists' => 'Utilisateur inexistant',
            'title.required' => 'Veuillez entrer un titre',
            'description.required' => 'Veuillez entrer une description',
            'end_date.required' => 'Veuillez entrer une date d\'échéance',
            'end_date.date' => 'Veuillez entrer une date d\'échéance valide',
            'status.required' => 'Veuillez entrer un status',
            'status.boolean' => 'Veuillez entrer un status valide',
        ];
    }
}
