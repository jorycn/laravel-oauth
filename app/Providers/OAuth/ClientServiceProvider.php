<?php

namespace App\Providers\OAuth;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OAuth\ClientRepository;

class ClientServiceProvider extends ServiceProvider {

	/**
	 * {@inheritdoc}
	 */
	public function boot()
	{
		$this->app->bind('App\Repositories\OAuth\ClientRepositoryInterface', function ($app) {
			return $app['oauth.clients'];
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
	 * Register the client repository.
	 */
	protected function registerRepository()
	{
		$this->app->singleton('oauth.clients', function ($app) {
			return new ClientRepository($app['events']);
		});
	}

	/**
	 * Register the client routes.
	 */
	protected function registerRoutes()
	{
		$this->app->booted(function ($app) {

			# Clients
			$app['router']->resource(
				'clients', 'App\Http\Controllers\OAuth\ClientController',
				[
					'names' => [
						'index'  => 'oauth.clients.index',
						'create' => 'oauth.clients.create',
						'store'  => 'oauth.clients.store',
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
			'oauth.clients',
			'App\Repositories\OAuth\ClientRepositoryInterface'
		];
	}

}
