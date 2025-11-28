@extends('admin.master')
@section('title', 'Edit product')

@section('breadcrumb')
    <li class=" "> Edit / Products</li>

@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit product</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @include('dashboard.products._form', ['button_label' => 'Update'])
            @endsection
