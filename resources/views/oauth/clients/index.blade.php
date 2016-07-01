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

<section>
    <h2><a data-toggle="collapse" href="#code" aria-expanded="true" aria-controls="code">Authorization code grant</a></h2>
    <div id="code" class="collapse">
        {!! BootForm::open()->action('oauth/access_token') !!}
        {!! BootForm::token() !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    After get code, input it and get access_token!
                </h2>
            </div>

            <div class="panel-body">
                {!! BootForm::text('code', 'code')  !!}
                {!! BootForm::text('grant_type', 'grant_type', 'authorization_code')  !!}
                {!! BootForm::text('client_id', 'client_id') !!}
                {!! BootForm::text('client_secret', 'client_secret') !!}
                {!! BootForm::text('redirect_uri', 'redirect_uri') !!}
            </div>

            <div class="panel-footer">
                {!! BootForm::submit('Go get it', 'btn-primary j_ajax') !!}
                <span style="margin-left: 20px;" class="code_wrap">If correct here will change to show result!</span>
            </div>
        </div>
        {!! BootForm::close() !!}
    </div>
</section>

<section>
    <h2><a data-toggle="collapse" href="#password" aria-expanded="true" aria-controls="password">Password Grant</a></h2>
    <div id="password" class="collapse">
        {!! BootForm::open()->action('oauth/access_token') !!}
        {!! BootForm::token() !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    After get code, input it and get access_token!
                </h2>
            </div>

            <div class="panel-body">
                {!! BootForm::text('grant_type', 'grant_type', 'password')->readonly()  !!}
                {!! BootForm::text('client_id', 'client_id') !!}
                {!! BootForm::text('client_secret', 'client_secret') !!}
                {!! BootForm::text('username', 'username') !!}
                {!! BootForm::text('password', 'password') !!}
            </div>

            <div class="panel-footer">
                {!! BootForm::submit('Go get it', 'btn-primary j_ajax') !!}
                <span style="margin-left: 20px;" class="code_wrap">If correct here will change to show result!</span>
            </div>
        </div>
        {!! BootForm::close() !!}
    </div>
</section>

<section>
    <h2><a data-toggle="collapse" href="#refresh" aria-expanded="true" aria-controls="refresh">Refresh Token Grant</a></h2>
    <div id="refresh" class="collapse">
        {!! BootForm::open()->action('oauth/access_token') !!}
        {!! BootForm::token() !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    After get code, input it and get access_token!
                </h2>
            </div>

            <div class="panel-body">
                {!! BootForm::text('grant_type', 'grant_type', 'refresh_token')->readonly()  !!}
                {!! BootForm::text('client_id', 'client_id') !!}
                {!! BootForm::text('client_secret', 'client_secret') !!}
                {!! BootForm::text('refresh_token', 'refresh_token') !!}
            </div>

            <div class="panel-footer">
                {!! BootForm::submit('Go get it', 'btn-primary j_ajax') !!}
                <span style="margin-left: 20px;" class="code_wrap">If correct here will change to show result!</span>
            </div>
        </div>
        {!! BootForm::close() !!}
    </div>
</section>

<section>
    <h2><a data-toggle="collapse" href="#Credentials" aria-expanded="true" aria-controls="Credentials">Client Credentials Grant</a></h2>
    <div id="Credentials" class="collapse">
        {!! BootForm::open()->action('oauth/access_token') !!}
        {!! BootForm::token() !!}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    After get code, input it and get access_token!
                </h2>
            </div>

            <div class="panel-body">
                {!! BootForm::text('grant_type', 'grant_type', 'client_credentials')->readonly()  !!}
                {!! BootForm::text('client_id', 'client_id') !!}
                {!! BootForm::text('client_secret', 'client_secret') !!}
            </div>

            <div class="panel-footer">
                {!! BootForm::submit('Go get it', 'btn-primary j_ajax') !!}
                <span style="margin-left: 20px;" class="code_wrap">If correct here will change to show result!</span>
            </div>
        </div>
        {!! BootForm::close() !!}
    </div>
</section>

<section>
    <h2><a data-toggle="collapse" href="#res" aria-expanded="true" aria-controls="res">Get Resource</a></h2>
    <div id="res" class="collapse">
        <input type="hidden" id="j_res_val" value="{{ url('/user')  }}"/>
        {!! BootForm::text('access_token', 'access_token') !!}
        {!! BootForm::submit('Go get it', 'btn-primary j_res') !!}
        <p style="margin-left: 20px;" class="code_wrap">If correct here will change to show result!</p>
    </div>

</section>

<script>
    $(".j_ajax").click(function(){
        var _form=$(this).parents("form");
        var _this=$(this);
        $.ajax({
            url: _form.attr("action"),
            type: "post",
            data: _form.serialize(),
            success: function(res){
                _this.next('.code_wrap').html(JSON.stringify(res));
            }
        })
        return false;
    });
    $(".j_res").click(function(){
        var _token=$("#access_token").val();
        var _url= $("#j_res_val").val()+'?access_token='+_token;
        var _this=$(this);
        $.ajax({
            url: _url,
            type: "get",
            success: function(res){
                _this.next('.code_wrap').html(JSON.stringify(res));
            }
        })
    });
</script>
@endsection