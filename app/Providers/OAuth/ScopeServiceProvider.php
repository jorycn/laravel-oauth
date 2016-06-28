<?php

namespace App\Providers\OAuth;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OAuth\ScopeRepository;

class ScopeServiceProvider extends ServiceProvider {

	/**
	 * {@inheritdoc}
	 */
	public function boot()
	{
		$this->app->bind('App\Repositories\OAuth\ScopeRepositoryInterface', function ($app) {
			return $app['oauth.scopes'];
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
	 * Register the scope repository.
	 */
	protected function registerRepository()
	{
		$this->app->singleton('oauth.scopes', function ($app) {
			return new ScopeRepository($app['events']);
		});
	}

	/**
	 * Register the scope routes.
	 */
	public function registerRoutes()
	{
		$this->app->booted(function ($app) {

			# Scopes
			$app['router']->resource(
				'scopes', 'App\Http\Controllers\OAuth\ScopeController',
				[
					'names' => [
						'index' => 'oauth.scopes.index',
						'create' => 'oauth.scopes.create',
						'store'  => 'oauth.scopes.store',
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
			'oauth.scopes',
			'App\Repositories\OAuth\ScopeRepositoryInterface'
		];
	}

}
