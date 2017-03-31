<?php

namespace App\Ship\Parents\Providers;

use App\Ship\Engine\Loaders\RoutesLoaderTrait;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class RoutesProvider.
 *
 * A.K.A app/Providers/RouteServiceProvider.php
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesProvider extends LaravelRouteServiceProvider
{
    use RoutesLoaderTrait;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Instance of the Laravel default Router Class.
     *
     * @var \Illuminate\Routing\Router
     */
    private $webRouter;

    /**
     * Instance of the Dingo Api router.
     *
     * @var \Dingo\Api\Routing\Router
     */
    public $apiRouter;

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        // initializing an instance of the Dingo Api router
        $this->apiRouter = app(Router::class);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $webRouterParam
     */
    public function map(Router $webRouterParam)
    {
        $this->webRouter = $webRouterParam;

        $this->runRoutesAutoLoader();
    }
}
