<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\View\Factory as ViewFactory;
use \App\Repositories\OAuth\GrantRepositoryInterface;

class GrantController extends Controller {

	/**
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * @var \Illuminate\Routing\Redirector
	 */
	protected $redirector;

	/**
	 * @var \Illuminate\Validation\Factory
	 */
	protected $validationFactory;

	/**
	 * @var \OAuth\GrantRepositoryInterface
	 */
	protected $grants;

	/**
	 * @var array
	 */
	protected $rules = [
		'create' => [
			'id'	=> 'required|unique:oauth_grants',
		],
	];

	/**
	 * Bind required instances to the class.
	 *
	 * @param  \Illuminate\Http\Request          $request
	 * @param  \Illuminate\Routing\Redirector    $redirector
	 * @param  \Illuminate\Validation\Factory    $validationFactory
	 * @param  \Illuminate\View\Factory          $viewFactory
	 * @param  \OAuth\ClientRepositoryInterface  $clients
	 * @param  \OAuth\GrantRepositoryInterface  $grants
	 */
	public function __construct(
		Request $request,
		Redirector $redirector,
		ValidationFactory $validationFactory,
		ViewFactory $viewFactory,
		GrantRepositoryInterface $grants
	)
	{
		parent::__construct($viewFactory);

		$this->request = $request;

		$this->redirector = $redirector;

		$this->validationFactory = $validationFactory;

		$this->grants = $grants;
		$this->middleware(['web','auth']);
	}

	/**
	 * List API grants.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('oauth.grants.index',[
            'grants'=>$this->grants->get()
        ]);
	}

	/**
	 * Display create grant form.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
        return view('oauth.grants.create');
	}

	/**
	 * Store the grant
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$validator = $this->validationFactory->make(
			$this->request->except('_token', 'submit'),
			$this->rules['create']
		);

		if ( $validator->fails() ) {
			return redirect()->back()
				->withInput()
				->withErrors($validator);
		}

		$this->grants->create(
			$this->request->get('id')
		);

		return redirect()->route('oauth.grants.index')
			->with('success', "Grant added successfully.");
	}

}
