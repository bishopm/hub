<?php namespace Bishopm\Hub\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Bishopm\Hub\Hub;
use Bishopm\Hub\Http\Middleware\AdminRoute;
use Bishopm\Hub\Livewire\Calendar;
use Bishopm\Hub\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HubServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('adminonly', AdminRoute::class);
        Schema::defaultStringLength(191);
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'hub');
        Paginator::useBootstrapFive();
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        if (Schema::hasTable('settings')) {
            Config::set('database.connections.church.database',setting('database.database'));
            Config::set('database.connections.church.username',setting('database.username'));
            Config::set('database.connections.church.password',setting('database.password'));
            Config::set('database.connections.church.driver','mysql');
            Config::set('database.connections.church.host',env('DB_HOST'));
            Config::set('google-calendar.calendar_id',setting('email.hub_email'));
            Config::set('mail.default',setting('email.mailer'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.host',setting('email.mail_host'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.port',setting('email.mail_port'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.username',setting('email.mail_username'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.password',setting('email.mail_password'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.encryption',setting('email.mail_encryption'));
            Config::set('mail.from.address',setting('email.mail_from_address'));
            Config::set('mail.from.name',setting('email.mail_from_name'));    
            Config::set('filesystems.disks.google.driver','google');
            Config::set('filesystems.disks.google.clientId',setting('services.drive_clientid'));
            Config::set('filesystems.disks.google.clientSecret',setting('services.drive_clientsecret'));
            Config::set('filesystems.disks.google.refreshToken',setting('services.drive_refreshtoken'));
            Config::set('broadcasting.pusher.driver','pusher');
            Config::set('broadcasting.pusher.key',setting('services.pusher.key'));
            Config::set('broadcasting.pusher.secret',setting('services.pusher.secret'));
            Config::set('broadcasting.pusher.app_id',setting('services.pusher.app_id'));
            Config::set('broadcasting.pusher.options.cluster',setting('services.pusher.app_cluster'));
            Config::set('broadcasting.pusher.options.useTLS',true);
        }
        Config::set('auth.providers.users.model','Bishopm\Hub\Models\User');
        Config::set('filament-spatie-roles-permissions.clusters.permissions',\Bishopm\Hub\Filament\Clusters\Settings::class);
        Config::set('filament-spatie-roles-permissions.clusters.roles',\Bishopm\Hub\Filament\Clusters\Settings::class);
        Config::set('filament-spatie-roles-permissions.scope_to_tenant',false);
        Config::set('filament-spatie-roles-permissions.should_redirect_to_index.roles.after_edit',true);
        Config::set('filament-spatie-roles-permissions.should_redirect_to_index.roles.after_create',true);
        Config::set('filament-spatie-roles-permissions.should_redirect_to_index.permissions.after_edit',true);
        Config::set('filament-spatie-roles-permissions.should_redirect_to_index.permissions.after_create',true);
        Config::set('filament-spatie-roles-permissions.guard_names',['web'=>'web']);
        Config::set('filament-spatie-roles-permissions.default_guard_name','web');
        Config::set('filament-spatie-roles-permissions.generator.guard_names',['web'=>'web']);
        Config::set('filament-spatie-roles-permissions.generator.model_directories',[base_path('vendor/bishopm/hub/src/Models')]);
        Config::set('filament-spatie-roles-permissions.generator.user_model', \Bishopm\Hub\Models\User::class);
        Config::set('filament-spatie-roles-permissions.generator.policies_namespace','Bishopm\Hub\Filament\Policies');
        Config::set('filesystems.disks.google.folder','');
        Livewire::component('calendar', Calendar::class);
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Blade::componentNamespace('Bishopm\\Hub\\Resources\\Views\\Components', 'hub');
        Relation::morphMap([
            'course' => 'Bishopm\Hub\Models\Course',
            'group' => 'Bishopm\Hub\Models\Group',
            'tenant' => 'Bishopm\Hub\Models\Tenant',
            'household' => 'Bishopm\Hub\Models\Household',
            'individual' => 'Bishopm\Hub\Models\Individual',
            'project' => 'Bishopm\Hub\Models\Project'
        ]);
        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() ? true: null;     
        });
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('queue:work')->withoutOverlapping();
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/hub.php', 'hub');

        $this->app->singleton('hub', function ($app) {
            return new Hub;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hub'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../../config/hub.php' => config_path('hub.php'),
        ], 'hub.config');

        // Publishing the views.
        // $this->publishes([
        //    __DIR__.'/../Resources' => public_path('vendor/bishopm'),
        // ], 'hub.views');

        // Publishes assets.
        $this->publishes([
            __DIR__.'/../Resources/assets' => public_path('hub'),
          ], 'assets');
        

        // Registering package commands.
        $this->commands([
            'Bishopm\Hub\Console\Commands\InstallHub'
        ]);
    }
}
