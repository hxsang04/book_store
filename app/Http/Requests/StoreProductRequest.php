<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueColor;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    { 
        return [
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'category_id' => 'required|integer',
            'name' => 'required|string|unique:products,name',
            'product_code' => 'required|string|unique:products,product_code',
            'discount' => 'nullable|integer|between:0,100',
            'initial_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' =>'required|string',
            'image' => 'required|image',
        ];
    }

    public function messages(): array
    {
        return [
            'author_id.required' => 'Vui lòng chọn tên tác giả.', 
            'publisher_id.required' => 'Vui lòng chọn tên nhà xuất bản.', 
            'category_id.required' => 'Vui lòng chọn tên danh mục.', 
            'name.required' => 'Vui lòng nhập tên sách.',
            'product_code.required' => 'Vui lòng nhập mã sách.',
            'initial_price.required' => 'Vui lòng nhập giá.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'image.required' => 'Vui lòng thêm ảnh.',
        ];
    }
}
