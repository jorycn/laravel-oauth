@extends('layouts.oauth')

@section('content')
<div class="page-header">
    <div class="btn-toolbar pull-right">
        <a href="{{ route('oauth.scopes.create') }}" class="btn btn-primary">Add Scope</a>
    </div>

    <h2>Scopes</h2>
</div>

@include('oauth.scopes.partials_index.scopes', ['scopes' => $scopes])

<div class="btn-toolbar">
    {{ $scopes->links() }}
</div>
@endsection