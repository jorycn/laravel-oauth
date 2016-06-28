<header class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="/" class="navbar-brand">OAuth2 Server Manager</a>
        </div>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('oauth.clients.index')}}">Clients</a></li>
                <li><a href="{{route('oauth.grants.index')}}">Grants</a></li>
                <li><a href="{{route('oauth.scopes.index')}}">Scopes</a></li>
            </ul>
        </div>
    </div>
</header>
