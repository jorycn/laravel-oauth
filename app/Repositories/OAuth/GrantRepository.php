<?php

namespace App\Repositories\OAuth;

use Illuminate\Events\Dispatcher;

class GrantRepository implements GrantRepositoryInterface {

	use \App\Traits\RepositoryTrait;
	use \App\Traits\EventTrait;

	/**
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected $model = '\App\Grant';

	/**
	 * Bind the event dispatcher to the class.
	 *
	 * @param  \Illuminate\Events\Dispatcher  $dispatcher
	 */
	public function __construct(Dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Create a new grant.
	 *
	 * @param  string  $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create($id)
	{
		$grant = $this->createModel();

		$this->fireEvent( 'oauth.grant.creating', compact('id') );

		// Here we create a new grant.
		$grant->id = $id;
		$grant->save();

		$this->fireEvent( 'oauth.grant.created', compact('id') );

		return $grant;
	}

}
