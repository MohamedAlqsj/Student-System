@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
        <h2>Welcome {{auth()->user()->name}}</h2>
            </div>
            </div>
    </div>
</div>
@endsection
