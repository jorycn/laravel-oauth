<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model {

    public $incrementing = false;
	/**
	 * {@inheritDoc}
	 */
	protected $table = 'oauth_scopes';

	/**
	 * @var string
	 */
	protected static $clientsModel = 'App\Client';

	/**
	 * Returns the client scopes relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function clients()
	{
		return $this->belongsToMany(static::$clientsModel, 'oauth_client_grants')->withTimestamps();
	}

}
