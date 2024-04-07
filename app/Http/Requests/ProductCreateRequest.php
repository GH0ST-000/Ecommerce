<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Psy\Util\Str;

class ProductCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'barcode'=>rand(1,100000),
            'sku'=>rand(1,100000),
            'name'=>'required',
            'small_description'=>'required',
            'full_description'=>'required',
            'size'=>'required',
            'color'=>'required',
            'brand'=>'required',
        ];
    }
}
