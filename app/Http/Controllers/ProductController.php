<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\SingleProductResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index($take): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = Product::orderBy('id','desc')->take($take)->get();
        return ProductListResource::collection($products);
    }

    public function store(ProductCreateRequest $request): \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
    {
        $product = Product::create($request->all());
        return $this->respond($product);
    }

    public function show(Product $product): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SingleProductResource::collection($product);
    }

    public function edit(Product $product): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SingleProductResource::collection($product);
    }

    public function update(ProductCreateRequest $request, Product $product): \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
    {
        $response = $product->update($request->all());
        return $this->respond($response);
    }

    public function destroy(Product $product): \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
    {
        $response = $product->delete();
        return $this->respond($response);
    }

    private function respond($result): \Flugg\Responder\Http\Responses\ErrorResponseBuilder|\Flugg\Responder\Http\Responses\SuccessResponseBuilder
    {
        return $result ? responder()->success() : responder()->error();
    }
}
