<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: Jory|jorycn@163.com
 * Date: 2016/6/28
 * Time: 15:37
 */
class DemoController extends BaseController
{
    protected $request;
    protected $input;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function code()
    {
        $_data = [
            'code'=>$this->request->input('code'),
            'grant_type'=>$this->request->input('grant_type'),
            'client_id'=>$this->request->input('client_id'),
            'client_secret'=>$this->request->input('client_secret'),
            'redirect_uri'=>$this->request->input('redirect_uri')
        ];
        $res = $this->phpPost('oauth/access_token', $_data);

        dd($res);

    }
}