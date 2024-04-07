<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'barcode'=>$this->barcode,
            'sku'=>$this->sku,
            'name'=>$this->name,
            'small_description'=>$this->small_description,
            'full_description'=>$this->full_description,
            'size'=>$this->size,
            'color'=>$this->color,
            'brand'=>$this->brand,
        ];
    }
}
