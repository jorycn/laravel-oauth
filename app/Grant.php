<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'oauth_grants';

	/**
	 * @var string
	 */
	protected static $clientsModel = 'App\Client';

    public $incrementing = false;

	/**
	 * Returns the client grants relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function clients()
	{
		return $this->belongsToMany(static::$clientsModel, 'oauth_client_grants')->withTimestamps();
	}

}
