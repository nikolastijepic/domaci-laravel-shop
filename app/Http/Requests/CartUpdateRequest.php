<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'quantity' => 'required|integer|min:1|max:' . $product->amount
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $id = $this->route('product')->id;

        throw new HttpResponseException(
            redirect()->back()
                ->withErrors([
                    'quantity_'.$id => $validator->errors()->first('quantity')
                ])
                ->withInput()
        );
    }
}
