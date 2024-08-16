<?php

namespace Vanguard\UserActivity;

use Event;
use Route;
use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;
use Vanguard\UserActivity\Http\View\Composers\ShowUserComposer;
use Vanguard\UserActivity\Listeners\PermissionEventsSubscriber;
use Vanguard\UserActivity\Listeners\RoleEventsSubscriber;
use Vanguard\UserActivity\Listeners\UserEventsSubscriber;
use Vanguard\UserActivity\Repositories\Activity\ActivityRepository;
use Vanguard\UserActivity\Repositories\Activity\EloquentActivity;
use View;

class UserActivity extends Plugin
{
    /**
     * {@inheritDoc}
     */
    public function sidebar(): Item
    {
        return Item::create(__('Activity Log'))
            ->route('activity.index')
            ->icon('fas fa-server')
            ->active('activity*')
            ->permissions('users.activity');
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class);
    }

    /**
     * Bootstrap services.
     *
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'user-activity');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'user-activity');
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->app->booted(function () {
            $this->mapWebRoutes();

            if ($this->app['config']->get('auth.expose_api')) {
                $this->mapApiRoutes();
            }
        });

        $this->attachViewComposers();

        $this->registerEventListeners();

        $this->publishAssets();
    }

    /**
     * Map web plugin related routes.
     */
    protected function mapWebRoutes(): void
    {
        Route::group([
            'namespace' => 'Vanguard\UserActivity\Http\Controllers\Web',
            'middleware' => 'web',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Map API plugin related routes.
     */
    protected function mapApiRoutes(): void
    {
        Route::group([
            'namespace' => 'Vanguard\UserActivity\Http\Controllers\Api',
            'middleware' => 'api',
            'prefix' => 'api',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    /**
     * Register event subscribers for the plugin.
     */
    private function registerEventListeners(): void
    {
        Event::subscribe(PermissionEventsSubscriber::class);
        Event::subscribe(RoleEventsSubscriber::class);
        Event::subscribe(UserEventsSubscriber::class);
    }

    /**
     * Attach view composers to add necessary data to the view.
     */
    private function attachViewComposers(): void
    {
        View::composer('user.view', ShowUserComposer::class);
    }

    /**
     * Publish public assets.
     */
    protected function publishAssets(): void
    {
        $this->publishes([
            realpath(__DIR__.'/../dist') => $this->app['path.public'].'/vendor/plugins/activity-log',
        ], 'public');
    }
}
