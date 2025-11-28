<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $products = Product::with(['category', 'store'])
            ->when($user->store_id, function ($query) use ($user) {
                return $query->where('store_id', $user->store_id);
            })
            ->filter($request->query())
            ->orderBy('name')
            ->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $parents = Product::all();
        $product = new Product();
        return view('dashboard.products.create', get_defined_vars());
    }

    public function store(Request $request)
    {

        $request->validate(Product::rules());

        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->UploadImage($request);
        $product = Product::create($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Product Created');
    }



    public function edit($id)
    {

        $product = Product::find($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit',  get_defined_vars());
    }



    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update($request->except('tags'));


        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'product Delete Successfully');
    }

    protected function UploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file =  $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('dashboard.products.trash', get_defined_vars());
    }
    public function restore(Request $request, $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.trash')
            ->with('success', 'product is Restore Successfully');
    }

    public function forceDelete(Request $request, $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('dashboard.products.trash')
            ->with('success', 'product is delete Successfully');
    }

    public function viewDesc($id)
    {
        $products = Product::where('id', $id)->first();
        return view('dashboard.products.view-desc', compact('products'));
    }
}
