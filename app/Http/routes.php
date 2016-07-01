<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as'=>'home', 'middleware'=>'auth', 'uses'=>'HomeController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Authorization code grant
Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', 'auth'], function() {
   $authParams = Authorizer::getAuthCodeRequestParams();
   $formParams = array_except($authParams,'client');
   $formParams['client_id'] = $authParams['client']->getId();

   $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
       return $scope->getId();
   }, $authParams['scopes']));
   return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
}]);

Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['check-authorization-params', 'auth'], function() {
    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = Auth::user()->id;
    $redirectUri = '/';
    // If the user has allowed the client to access its data, redirect back to the client with an auth code.
    if (Request::has('approve')) {
        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
    }
    // If the user has denied the client to access its data, redirect back to the client with an error message.
    if (Request::has('deny')) {
        $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }
    return Redirect::to($redirectUri);
}]);

//get token
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

//auth demo
Route::get('user', ['middleware' => 'oauth', function() {
    $user_id=Authorizer::getResourceOwnerId(); // the token user_id
    $user=\App\User::find($user_id);// get the user data from database

    return Response::json($user);
}]);

//dingo api demo
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

    $api->group(['middleware' => ['oauth']],function($api){

        $api->group(['middleware'=>'oauth-user'],function($api){
            //password模式授权内容

        });
        $api->group(['middleware'=>'oauth-client'],function($api){
            //client_credentials 模式授权
            $api->get('my',function(){
                return Response::json([
                    'errcode'=>0,
                    'data'=>[
                        'title'=>'hello api'
                    ]
                ]);
            });

            //微信接口分布demo
            $api->group(['middleware'=>'oauth:wechat_mp_subscribe'],function($api){
                //订阅号最低权限

                $api->group(['middleware'=>'oauth:wechat_mp_subscribe_checked'],function($api){
                    //认证订阅号
                    $api->group(['middleware'=>'oauth:wechat_mp_serve'],function($api){
                        //服务号
                        $api->group(['middleware'=>'oauth:wechat_mp_serve'],function($api){
                            //认证服务号
                        });
                    });
                });
            });
        });

    });
});

//password oauth grant demo
Route::get('demo/resource', ['as'=>'demo.resource', function(){
    return view('demo');
}]);