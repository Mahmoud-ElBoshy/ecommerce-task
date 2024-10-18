<?php

namespace App\Http\Requests\Api\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-product', Product::findOrFail($this->route('product')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'price' => 'required|decimal:2,2|between:1,9999999999',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|between:1,1000',
        ];
    }
}
