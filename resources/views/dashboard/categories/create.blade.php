@extends('admin.master')
@section('title','Category')

@section('breadcrumb')

    @parent
    <li class=" ">Categories</li>

@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Add Category</strong>
        </div>
        <div class="card-body">
            <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
    @include('dashboard.categories._form')



@endsection

