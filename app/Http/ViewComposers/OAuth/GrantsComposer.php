<?php

namespace App\Http\ViewComposers\OAuth;

use Illuminate\View\View;
use \App\Repositories\OAuth\GrantRepositoryInterface;

class GrantsComposer {

	/**
	 * @var \OAuth\GrantRepositoryInterface
	 */
	protected $grants;

    /**
     * @param GrantRepositoryInterface $grants
     */
    public function __construct(GrantRepositoryInterface $grants)
	{
		$this->grants = $grants;
	}

	/**
	 * Bind grants to view.
	 *
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('grants', $this->grants->all());
	}

}
