@extends('layouts.app')

@section('content')
<h1>
<!-- resources/views/products/index.blade.php -->

<h1>Product List</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{  App\helpers::currency_converter($product->price) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</h1>
@endsection
