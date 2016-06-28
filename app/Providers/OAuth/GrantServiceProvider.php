<?php

namespace App\Providers\OAuth;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OAuth\GrantRepository;

class GrantServiceProvider extends ServiceProvider {

	/**
	 * {@inheritdoc}
	 */
	public function boot()
	{
		$this->app->bind('App\Repositories\OAuth\GrantRepositoryInterface', function ($app) {
			return $app['oauth.grants'];
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$this->registerRepository();
		$this->registerRoutes();
	}

	/**
	 * Register the grant repository.
	 */
	protected function registerRepository()
	{
		$this->app->singleton('oauth.grants', function ($app) {
			return new GrantRepository($app['events']);
		});
	}

	/**
	 * Register the grant routes.
	 */
	public function registerRoutes()
	{
		$this->app->booted(function ($app) {

			# Grants
			$app['router']->resource(
				'grants', 'App\Http\Controllers\OAuth\GrantController',
				[
					'names' => [
						'index' => 'oauth.grants.index',
						'create' => 'oauth.grants.create',
						'store'  => 'oauth.grants.store',
					],
					'except' => ['show', 'edit', 'update', 'destroy'],
				]
			);

		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function provides()
	{
		return [
			'oauth.grants',
			'App\Repositories\OAuth\GrantRepositoryInterface'
		];
	}

}
