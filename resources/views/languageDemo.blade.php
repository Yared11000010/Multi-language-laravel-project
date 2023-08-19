@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>{{__('messages.welcome')}}</h3>
        {{__('messages.login') }}
    </div>
</div>
@endsection
