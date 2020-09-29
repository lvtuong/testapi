<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateUpdateProductResquest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|min:5|max:255',
            'sku' => 'required',
            'price' => 'required|integer|min:10|max:100000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "name is required!",
            'description' => "description is required!",
            'description.min' => "min 5 characters",
            'description.max' => "max 255 characters",
            'sku' => "sku is required!",
            'price.required' => "price is required!",
            'price.integer' => "price integer",
            'price.min' => "min 10",
            'price.max' => "max 100000",
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

}
