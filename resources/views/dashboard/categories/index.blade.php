@extends('admin.master')
@section('title', 'Category')

@section('breadcrumb')

    <li class=" ">
        Categories</li>

@endsection
@section('content')
    <div>
        <a href="{{ route('dashboard.categories.create') }}" class="mb-5 btn  btn-outline-primary">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="mb-5 btn  btn-outline-dark">Trash</a>

    </div>
    <form action="{{ \Illuminate\Support\Facades\URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form-input name="name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
        </select>
        <button class="btn btn-dark">Filter</button>
    </form>
    <table class="table table-hover">
        <x-alerts type="success" />
        <thead>
            <tr>
                <th>#</th>
                <th class="text-dark">Image</th>
                <th class="text-dark">Name</th>
                <th class="text-dark">Parent</th>
                <th class="text-dark">Product Count</th>
                <th class="text-dark">Status</th>
                <th class="text-dark">Created At</th>
                <th class="text-dark"></th>
                <th class="text-dark"></th>


            </tr>
        </thead>
        <tbody>

            @forelse($categories as  $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category image" width="90"
                                height="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.categories.show', $category->id) }}" class="category-link">
                            {{ $category->name }}
                        </a>
                    </td>

                    <td>{{ $category->parent?->name ?? '' }}</td>
                    <td>{{ $category->products_count }}</td>

                    <td>
                        @if ($category->status == 'active')
                            <span class="text-success">{{ $category->status }}</span>
                        @elseif($category->status == 'inactive')
                            <span class="text-danger">{{ $category->status }}</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn-sm btn btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('dashboard.categories.destroy', $category->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Record Not Result</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endsection
