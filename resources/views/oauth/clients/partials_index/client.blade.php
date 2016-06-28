<tr>
    <td>
        id: <strong>{{ $client->id }}</strong><br/>
        secret:<strong>{{ $client->secret }}</strong>
    </td>
    <td>
        {{ $client->name }}
        <small>{{ $client->endpoint->redirect_uri }}</small>
    </td>

    <td>
        <span class="badge">
            {{ $client->grants->count() }}
        </span>
    </td>

    <td>
        <span class="badge">
            {{ $client->scopes->count() }}
        </span>
    </td>

    <td>{{ $client->created_at }}</td>

    <td>
        <a href="{{
        route('oauth.authorize.get', [
            'client_id'=>$client->id,
            'redirect_uri'=>$client->endpoint->redirect_uri,
            'response_type'=>'code'
        ])
        }}" class="btn btn-danger" target="_blank">Test</a>
    </td>
</tr>
