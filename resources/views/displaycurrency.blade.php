@extends('layouts.app')

@section('content')
<h1>
<!-- resources/views/products/index.blade.php -->

<h1>Currency List</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Symbol</th>
            <th>Exchange Rate</th>
            <th>code</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allcurrency as $cur)
            <tr>
                <td>{{ $cur->name }}</td>
                <td>{{ $cur->symbol }}</td>
                <td>{{ $cur->exchange_rate }}</td>
                <td>{{ $cur->cdoe }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</h1>
@endsection
