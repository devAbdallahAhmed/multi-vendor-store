<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product=  Product::filter($request->query())
        ->with('category:id,name','store:id,name','tags:id,name')->paginate();

        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gte:price',
        ]);

        $user = $request->user();
        $user->tokenCan('products.create') || abort(403,'Not enough permissions');
        $product = Product::create($request->all());
        return Response()->json($product,201,[
            'Location' => route('products.show',['product' => $product->id])
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return ProductResource::make($product);
        // return $product->load('category:id,name','store:id,name','tags:id,name');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
          $request->validate([
            'name' => 'sometimes|string|min:3|max:255|',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gte:price',
        ]);
        $user = $request->user();
          $user->tokenCan('products.update') || abort(403,'Not enough permissions');

        $product->update($request->all());
        return Response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $user = Auth::guard('sanctum')->user();
        if(  !$user->tokenCan('products.delete') )
            { return response()->json(['message' => 'Not enough permissions'], 403);}
        Product::destroy($id);
        return ['message' => 'Product deleted successfully'];

    }
}
