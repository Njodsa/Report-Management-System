@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @include('layouts.inc.error')
            <div class="card">
                <div class="card-header"> {{$subject}} </div>
                <div class="card-body">
                  {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
