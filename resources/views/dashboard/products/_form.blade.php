@csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occrued!</h3>
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif
<div class="form-row">
    <div class="form-group col-md-6">
        <x-label>product Name</x-label>
        <x-form-input name="name" :value="$product->name" />
    </div>

    <div class="form-group col-md-6">
        <x-label>product category</x-label>
        <select class="form-control form-select" name="category_id">
            <option value="">Select category (optional)</option>
            @foreach (App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <div class="form-group col-md-12">
        <x-label>Description</x-label>
        <x-taxtarea-input name="description" :value="$product->description" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="form-group">
        <x-label>Image</x-label>
        <input type="file" class="form-control" name="image" accept="image/*">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="product image" width="100" class="mt-2">
        @endif
    </div>

    <div class="form-group col-md-6">
        <x-label> Price</x-label>
        <x-form-input name="price" :value="$product->price" />
    </div>


    <div class="form-group col-md-6">
        <x-label>Compare Price</x-label>
        <x-form-input name="compare_price" :value="$product->compare_price" />
    </div>

    <div class="form-group col-md-6">
        <x-label>Tag</x-label>
        <x-form-input name="tags" :value="$tags" />
    </div>

    <div class="form-group col-md-12">
        <label>Status</label>
        <x-form-radio name="status" :options="['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive']" :checked="$product->status" />
    </div>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary btn-sm">{{ $button_label ?? 'Save' }}</button>
    </div>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <script>
            var inputElm = document.querySelector('[name=tags]');
            tagify = new Tagify(inputElm);
        </script>
    @endpush

</div>
</form>
</div>
</div>
