<?php

namespace App\Http\Requests;

use App\Common\Utils;
use App\Enums\PaymentMethod;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * @class StorePaymentRequest
 */
class StorePaymentRequest extends FormRequest
{
    use Utils;

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
        $cpf = $this->get('cpf');
        return [
            'name_client' => 'required|max:255|min:10',
            'cpf' => [
                'required' ,
                Rule::prohibitedIf(!$this->cpfIsValid($cpf))
            ],
            'description' => 'required|max:255|min:10',
            'amount' => 'required|numeric|gt:0',
            'payment_method' => [
                'required',
                'string',
                Rule::enum(PaymentMethod::class)
            ]
        ];
    }

    public function messages()
    {
        return [
            'cpf.prohibited' => 'The CPF is invalid.',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
