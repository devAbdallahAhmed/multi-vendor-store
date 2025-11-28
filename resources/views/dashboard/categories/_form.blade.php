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
        <x-label>Category Name</x-label>
        <x-form-input name="name" :value="$category->name" />
    </div>

    <div class="form-group col-md-6">
        <x-label>Category Parent</x-label>
        <select class="form-control form-select" name="parent_id">
            <option value="">Select Parent (optional)</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
    </div>

    <div class="form-group col-md-12">
        <x-label>Description</x-label>
        <x-taxtarea-input name="description" :value="$category->description" />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="form-group">
        <x-label>Image</x-label>
        <input type="file" class="form-control" name="image" accept="image/*">
        @if ($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="category image" width="100" class="mt-2">
        @endif
    </div>

    <div class="form-group col-md-12">
        <label>Status</label>
        <x-form-radio name="status" :options="['active' => 'Active', 'inactive' => 'Inactive']" :checked="$category->status" />
    </div>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary btn-sm">{{ $button_label ?? 'Save' }}</button>
    </div>
</div>
</form>
</div>
</div>
