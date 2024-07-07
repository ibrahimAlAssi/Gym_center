<?php

namespace App\Src\Coach\Club\Controllers;

use App\Domains\Club\Models\Product;
use App\Http\Controllers\Controller;
use App\Src\Coach\Club\Resources\ProductGridResource;

class ProductController extends Controller
{
    public function __construct(protected Product $product)
    {

    }

    public function index()
    {
        return ProductGridResource::collection(
            $this->product->getForGrid()
        )->additional(['message' => __('shared.response_messages.success')]);
    }
}
