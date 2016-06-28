<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Client extends Model {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'oauth_clients';

	/**
	 * {@inheritDoc}
	 */
	public $incrementing = false;

	/**
	 * @var string
	 */
	protected static $endpointModel = 'App\Endpoint';

	/**
	 * @var string
	 */
	protected static $grantsModel = 'App\Grant';

	/**
	 * @var string
	 */
	protected static $scopesModel = 'App\Scope';

	/**
	 * The name of the "client id" column.
	 *
	 * @var string
	 */
	const CLIENT_ID = 'id';

	/**
	 * The name of the "client secret" column.
	 *
	 * @var string
	 */
	const CLIENT_SECRET = 'secret';

	/**
	 * {@inheritDoc}
	 */
	protected static function boot()
	{
		parent::boot();

		// Here we add the UUID formatted client ID and secret during creation.
		static::creating(function ($model) {
            $model->{$model::CLIENT_ID}     = (string) Uuid::generate(4);
            $model->{$model::CLIENT_SECRET} = (string) Uuid::generate(4);
        });
	}

	/**
	 * Returns the client endpoint relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function endpoint()
	{
		return $this->hasOne(static::$endpointModel);
	}

	/**
	 * Returns the client grants relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function grants()
	{
		return $this->belongsToMany(static::$grantsModel, 'oauth_client_grants')->withTimestamps();
	}

	/**
	 * Returns the client scopes relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function scopes()
	{
		return $this->belongsToMany(static::$scopesModel, 'oauth_client_scopes')->withTimestamps();
	}

}
