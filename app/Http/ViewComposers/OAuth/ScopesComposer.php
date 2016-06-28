<?php
namespace App\Http\ViewComposers\OAuth;

use \App\Repositories\OAuth\ScopeRepositoryInterface;

class ScopesComposer {

	/**
	 * @var \OAuth\ScopeRepositoryInterface
	 */
	protected $scopes;


    /**
     * @param ScopeRepositoryInterface $scopes
     */
    public function __construct(ScopeRepositoryInterface $scopes)
	{
		$this->scopes = $scopes;
	}

	/**
	 * Bind scopes to view.
	 *
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose($view)
	{
		$view->with('scopes', $this->scopes->all());
	}

}
