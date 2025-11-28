@extends('admin.master')
@section('title','Edit Category')

@section('breadcrumb')
    @parent
    <li class=" "> Edit / <u style="color: blue">Categories</u></li>

@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Category</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
              @include('dashboard.categories._form',[
    'button_label' => 'Update'
])
@endsection
