<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Http\Resources\ProductResource;


class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * Get all product
     * @param Request $request
     */
    public function all(Request $request)
    {   
        return $this->product->paginate(2);
    }
}
