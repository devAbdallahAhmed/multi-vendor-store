@extends('admin.master')
@section('title', 'Products')

@section('breadcrumb')

    <li class=" ">
        Products</li>

@endsection
@section('content')

    <table class="table table-hover">
        <x-alerts type="success" />
        <thead>
            <tr>
                <th>#</th>
                <th class="text-dark">Name</th>
                <th class="text-dark">Description</th>
                <th class="text-dark">Status</th>
                <th class="text-dark">Store </th>
                <th class="text-dark">Created At</th>
                <th class="text-dark">Created At</th>
            </tr>
        </thead>
        <tbody>

            @forelse($category->products as  $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="product image" width="90"
                                height="60">
                        @endif
                    </td>

                    <td>{{ $product->name }}</td>
                    <td><a href="{{ route('dashboard.view.desc', $product->id) }}">Review Description</a></td>

                    <td>
                        @if ($product->status == 'active')
                            <span class="text-success">{{ $product->status }}</span>
                        @elseif($product->status == 'inactive')
                            <span class="text-danger">{{ $product->status }}</span>
                        @elseif($product->status == 'draft')
                            <span class="text-info">{{ $product->status }}</span>
                        @endif
                    </td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Record Not Result</td>
                </tr>
            @endforelse

        </tbody>
    </table>

@endsection
