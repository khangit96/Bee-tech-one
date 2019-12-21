<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => trans('product::products.validation.name'),
            'price.required' => trans('product::products.validation.price'),
            'description.required' => trans('product::products.validation.description'),
            'image.required' => trans('product::products.validation.image')
        ];
    }
}
