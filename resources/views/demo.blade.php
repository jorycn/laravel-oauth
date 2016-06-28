@extends('layouts.oauth')

@section('content')
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
        {!! BootForm::submit('Go get it', 'btn-primary') !!}
        <span style="margin-left: 20px;" id="cont-wrap">If correct here will change to show result!</span>
    </div>
</div>
{!! BootForm::close() !!}

<script>
    $("button[type=submit]").click(function(){
        var _form=$(this).parents("form");
        $.ajax({
            url: _form.attr("action"),
            type: "post",
            data: _form.serialize(),
            success: function(res){
                $("#cont-wrap").html(JSON.stringify(res));
            }
        })
        return false;
    })
</script>

@endsection