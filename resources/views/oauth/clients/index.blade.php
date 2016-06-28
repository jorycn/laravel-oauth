@extends("layouts.oauth")

@section("content")
<div class="page-header">
    <div class="btn-toolbar pull-right">
        <a class="btn btn-primary" href="{{route("oauth.clients.create")}}">Add client</a>
    </div>

    <h2>Clients</h2>
</div>

@include('oauth.clients.partials_index.clients', ['clients' => $clients])

<div class="btn-toolbar">
    {{ $clients->links() }}
</div>
@endsection