<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\View\Factory as ViewFactory;
use App\Repositories\OAuth\ScopeRepositoryInterface;

class ScopeController extends Controller {

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
	 * @var \OAuth\ScopeRepositoryInterface
	 */
	protected $scopes;

	/**
	 * @var array
	 */
	protected $rules = [
		'create' => [
			'id'          => 'required|unique:oauth_scopes',
			'description' => 'required',
		],
	];

	/**
	 * Bind required instances to the class.
	 *
	 * @param  \Illuminate\Http\Request          $request
	 * @param  \Illuminate\Routing\Redirector    $redirector
	 * @param  \Illuminate\Validation\Factory    $validationFactory
	 * @param  \Illuminate\View\Factory          $viewFactory
	 * @param  \OAuth\ScopeRepositoryInterface   $scopes
	 */
	public function __construct(
		Request $request,
		Redirector $redirector,
		ValidationFactory $validationFactory,
		ViewFactory $viewFactory,
		ScopeRepositoryInterface $scopes
	)
	{
		parent::__construct($viewFactory);

		$this->request = $request;

		$this->redirector = $redirector;

		$this->validationFactory = $validationFactory;

		$this->scopes = $scopes;
		$this->middleware(['web','auth']);
	}

	/**
	 * List API scopes.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
        return view('oauth.scopes.index', [
            'scopes'=>$this->scopes->paginate()
        ]);
	}

	/**
	 * Display create scope form.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
        return view('oauth.scopes.create');
	}

	/**
	 * Store the scope
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
			return $this->redirector->back()
				->withInput()
				->withErrors($validator);
		}

		$this->scopes->create(
			$this->request->get('id'),
			$this->request->get('description')
		);

		return $this->redirector->route('oauth.scopes.index')
			->with('success', "Scope added successfully.");
	}

}
