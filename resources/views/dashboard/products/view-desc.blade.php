    @extends('admin.master')
    @section('title', 'product')
    @section('breadcrumb')

        <li class=" "> Products</li>
    @endsection

    @section('content')
        <a href="{{ route('dashboard.products.index') }}" class="mb-5 btn  btn-outline-dark">back</a>

        <table class="table table-hover">
            <x-alerts type="success" />
            <thead>
                <tr>
                    <th class="text-dark">Description</th>
                </tr>
            </thead>
            <tbody>


                <td>{{ $products->description }}</td>


            </tbody>
        </table>
    @endsection
