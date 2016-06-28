<table class="table table-bordered">
    <thead>
        <th class="col-sm-5">code</th>
        <th class="col-sm-4">Name</th>
        <th class="col-sm-2">Grants</th>
        <th class="col-sm-2">Scopes</th>
        <th class="col-sm-4">Created At</th>
        <th class="col-sm-2">Operate</th>
    </thead>

    <tbody>
        @foreach( $clients as $client )
            @include('oauth.clients.partials_index.client', ['client' => $client])
        @endforeach
    </tbody>
</table>
