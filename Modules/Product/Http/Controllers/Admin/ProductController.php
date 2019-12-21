<?php
		
		namespace Modules\Product\Http\Controllers\Admin;
		
		use Illuminate\Http\Response;
		use Modules\Core\Http\Controllers\Admin\AdminBaseController;
		use Modules\Product\Entities\Product;
		use Modules\Product\Events\ProductWasCreated;
		use Modules\Product\Events\ProductWasDeleted;
		use Modules\Product\Events\ProductWasUpdated;
		use Modules\Product\Http\Requests\CreateProductRequest;
		use Modules\Product\Http\Requests\UpdateProductRequest;
		use Modules\Product\Repositories\ProductRepository;
		
		class ProductController extends AdminBaseController
		{
				/**
					* @var ProductRepository
					*/
				private $product;
				
				public function __construct(ProductRepository $product)
				{
						parent::__construct();
						
						$this->product = $product;
				}
				
				/**
					* Display a listing of the resource.
					*
					* @return Response
					*/
				public function index()
				{
						$products = $this->product->all();
						return view('product::admin.products.index', compact('products'));
				}
				
				/**
					* Show the form for creating a new resource.
					*
					* @return Response
					*/
				public function create()
				{
						return view('product::admin.products.create');
				}
				
				/**
					* Store a newly created resource in storage.
					*
					* @param CreateProductRequest $request
					* @return Response
					*/
				public function store(CreateProductRequest $request)
				{
						$product = [
										'name' => $request->name,
										'price' => floatval($request->price),
										'description' => $request->description,
										'image' => 'Null',
						];
						
						$productCreated = $this->product->create($product);
						
						event(new ProductWasCreated($productCreated, $request->all()));
						
						$productImages = $productCreated->files()->where('zone', 'product_image')->get();
						
						$this->product->update($productCreated, ['image'=>$productImages[0]['path_string']]);
						
						return redirect()->route('admin.product.product.index')
										->withSuccess(trans('core::core.messages.resource created',
														['name' => trans('product::products.title.products')]));
				}
				
				/**
					* Show the form for editing the specified resource.
					*
					* @param Product $product
					* @return Response
					*/
				public function edit(Product $product)
				{
						return view('product::admin.products.edit', compact('product'));
				}
				
				/**
					* Update the specified resource in storage.
					*
					* @param Product $product
					* @param UpdateProductRequest $request
					* @return Response
					*/
				public function update(Product $product, UpdateProductRequest $request)
				{
						$productUpdate = [
										'name' => $request->name,
										'price' => floatval($request->price),
										'description' => $request->description
						];
						
						$productUpdated = $this->product->update($product, $productUpdate);
						
						event(new ProductWasUpdated($productUpdated, $request->all()));
						
						$productImages = $productUpdated->files()->where('zone', 'product_image')->get();
						$this->product->update($productUpdated, ['image'=>$productImages[0]['path_string']]);
						
						return redirect()->route('admin.product.product.index')
										->withSuccess(trans('core::core.messages.resource updated',
														['name' => trans('product::products.title.products')]));
				}
				
				/**
					* Remove the specified resource from storage.
					*
					* @param Product $product
					* @return Response
					*/
				public function destroy(Product $product)
				{
						$this->product->destroy($product);
						
						event(new ProductWasDeleted($product));
						
						return redirect()->route('admin.product.product.index')
										->withSuccess(trans('core::core.messages.resource deleted',
														['name' => trans('product::products.title.products')]));
				}
		}
