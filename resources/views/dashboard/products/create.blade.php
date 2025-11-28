@extends('admin.master')
@section('title', 'product')

@section('breadcrumb')

    @parent
    <li class=" ">Products</li>

@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Add Product</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                @include('dashboard.products._form')
            @endsection
