@extends('admin.master')
@section('title', 'product')
@section('breadcrumb')

    <li class=" "> Products</li>
@endsection

@section('content')
    <div>
        <a href="{{ route('dashboard.products.create') }}" class="mb-5 btn  btn-outline-primary">Create</a>
        <a href="{{ route('dashboard.products.trash') }}" class="mb-5 btn  btn-outline-dark">Trash</a>

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
                <th class="text-dark">Number</th>
                <th class="text-dark">Name</th>
                <th class="text-dark">Description</th>
                <th class="text-dark">Price</th>
                <th class="text-dark">Compare price</th>
                <th class="text-dark">Status</th>
                <th class="text-dark">Rating</th>
                <th class="text-dark">Category </th>
                <th class="text-dark">Tags </th>
                <th class="text-dark">Store </th>
                <th class="text-dark">Created At</th>
                <th class="text-dark"></th>
                <th class="text-dark"></th>
            </tr>
        </thead>
        <tbody>

            @forelse($products as  $product)
                <tr aria-rowspan="15">
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="product image" width="90"
                                height="60">
                        @endif
                    </td>
                    <td>{{ $product->number }}</td>
                    <td>{{ $product->name }}</td>
                    <td><a href="{{ route('dashboard.view.desc', $product->id) }}">Review Description</a></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->compare_price }}</td>

                    <td>
                        @if ($product->status == 'active')
                            <span class="text-success">{{ $product->status }}</span>
                        @elseif($product->status == 'inactive')
                            <span class="text-danger">{{ $product->status }}</span>
                        @elseif($product->status == 'draft')
                            <span class="text-info">{{ $product->status }}</span>
                        @endif
                    </td>
                    <td>{{ $product->rating }}</td>
                    <td>{{ $product->category?->name ?? 'No Product' }}</td>
                    <td>
                        {{ $product->tags->pluck('name')->join(', ') ?: 'No Tags' }}
                    </td>
                    <td>{{ $product->store?->name ?? 'No Product' }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn-sm btn btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('dashboard.products.destroy', $product->id) }}">
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
    {{ $products->withQueryString()->links() }}
@endsection
