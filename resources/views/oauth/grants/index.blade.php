@extends('layouts.oauth')

@section('content')
<div class="page-header">
    <div class="btn-toolbar pull-right">
        <a href="{{ route('oauth.grants.create') }}" class="btn btn-primary">Add grant</a>
    </div>

    <h2>Grants</h2>
</div>

@include('oauth.grants.partials_index.grants', ['grants' => $grants])
@endsection