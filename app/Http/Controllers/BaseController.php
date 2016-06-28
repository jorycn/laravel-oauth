<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\View\Factory as ViewFactory;

class BaseController extends Controller
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @var \Illuminate\View\View
     */
    protected $layout = 'layouts.master';
    /**
     * @var \Illuminate\View\Factory
     */
    protected $viewFactory;

    /**
     * Bind view factory instance to class.
     *
     * @param  \Illuminate\View\Factory  $viewFactory
     */
    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * Setup the layout used by the controller.
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout) ) {
            $this->layout = $this->viewFactory->make($this->layout);
        }
    }

    /**
     * @param $url
     * @param string $refer
     * @return mixed
     */
    public function phpGet($url,$refer=''){
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,         // return web page
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => true,         // follow redirects
            CURLOPT_ENCODING       => "",           // handle all encodings
            CURLOPT_USERAGENT      => "",           // who am i
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 5,            // timeout on connect
            CURLOPT_TIMEOUT        => 5,            // timeout on response
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
            CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_COOKIEFILE     =>'./',
            CURLOPT_COOKIEJAR      =>'./',
            CURLOPT_REFERER        =>$refer,
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param $url
     * @param $postfields
     * @param string $refer
     * @return mixed
     */
    public function phpPost($url, $postfields, $refer='')
    {
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,         // return web page
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => true,         // follow redirects
            CURLOPT_ENCODING       => "",           // handle all encodings
            CURLOPT_USERAGENT      => "",           // who am i
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
            CURLOPT_TIMEOUT        => 120,          // timeout on response
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
            CURLOPT_POST           => true,         // i am sending post data
            CURLOPT_POSTFIELDS     => $postfields,  // this are my post vars
            CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_COOKIEFILE     =>'',
            CURLOPT_COOKIEJAR      =>'',
            CURLOPT_REFERER        =>$refer,
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
