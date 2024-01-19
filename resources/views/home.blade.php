@extends('layouts.app')
@section('content')
<!-- Bootstrap CSS -->
<!-- Bootstrap CSS from CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript dependencies from CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- jQuery from CDN (required for Bootstrap JavaScript) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown link
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                      <div class="currency-dropdown">
                        @php
                            App\helpers::currency_load();
                            $currency_code = session('currency_code');
                            $currency_symbol = session('currency_symbol');

                            if ($currency_symbol=="") {
                                    $system_default_currency_info = session('system_default_currency_info');
                                    $currency_symbol = $system_default_currency_info->symbol;
                                    $currency_code = $system_default_currency_info->code;
                            }
                        @endphp
                        <label for="currency">Select Currency:</label>
                        <select id="currencySelect" onchange="currency_change(this.value)">
                            <option value="">
                                {{ $currency_symbol }} {{ $currency_code }}
                            </option>
                            @foreach(\App\Models\Currencies::all() as $currency)
                                <option value="{{ $currency['code'] }}">
                                    {{ $currency->symbol }} {{ \Illuminate\Support\Str::upper($currency->code) }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                </div>

            </div>
        </div>
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

    </div>
</div>

@endsection
<!-- Popper.js -->
<script>
    function currency_change(currency_code) {
        // alert(currency_code);
        $.ajax({
            type: "POST",
            url: "{{route('currency.load')}}",
            data: {
               currency_code:currency_code,
               _token: '{{ csrf_token() }}',
            },
            success: function (response) {
              if(response['status']){
                location.reload();
              }else{
                alert('Server | error');
              }
            }
        });
        // You can perform additional actions here based on the selected currency code
    }
</script>
