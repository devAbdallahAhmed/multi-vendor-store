@extends('admin.master')
@section('title', ' Trashed products')

@section('breadcrumb')
    .
    <li class=" ">
        products</li>
    <li class=" ">Trash</li>


@endsection
@section('content')
    <div>

        <a href="{{ route('dashboard.products.index') }}" class="mb-5 btn  btn-outline-primary">back</a>
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
                <th class="text-dark">Status</th>
                <th class="text-dark">Delete At</th>
                <th class="text-dark"></th>
                <th class="text-dark"></th>


            </tr>
        </thead>
        <tbody>

            @forelse($products as  $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="product image" width="90"
                                height="60">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if ($product->status == 'active')
                            <span class="text-success">{{ $product->status }}</span>
                        @elseif($product->status == 'inactive')
                            <span class="text-danger">{{ $product->status }}</span>
                        @endif
                    </td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <form method="post" action="{{ route('dashboard.products.restore', $product->id) }}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ route('dashboard.products.force-delete', $product->id) }}">
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
