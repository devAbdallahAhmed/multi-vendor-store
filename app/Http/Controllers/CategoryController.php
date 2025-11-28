<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::with('parent')->withCount('products')
            ->Filter($request->query())
            ->orderBy('name')
            ->paginate();


        return view('dashboard.categories.index', get_defined_vars());
    }

    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', get_defined_vars());
    }

    public function store(Request $request)
    {

        $request->validate(Category::rules());

        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->UploadImage($request);
        $category = Category::create($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrfail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Record Not Found');
        }
        // SELECT * FROM categories WHERE id <> $id
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->orwhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate(Category::rules($id));

        $category = Category::findOrfail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        $path = $this->UploadImage($request);
        if ($path) {
            $data['image'] = $path;
        }


        $category->update($data);
        if ($old_image && $path) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Update');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Delete Successfully');
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
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', get_defined_vars());
    }
    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category is Restore Successfully');
    }

    public function forceDelete(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category is delete Successfully');
    }
}
