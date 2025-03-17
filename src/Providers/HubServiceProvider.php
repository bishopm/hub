<?php namespace Bishopm\Hub\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Bishopm\Hub\Church;
use Bishopm\Hub\Http\Middleware\AdminRoute;
use Bishopm\Hub\Livewire\BarcodeScanner;
use Bishopm\Hub\Livewire\BookReview;
use Bishopm\Hub\Livewire\Calendar;
use Bishopm\Hub\Livewire\Find;
use Bishopm\Hub\Livewire\Live;
use Bishopm\Hub\Livewire\LoginForm;
use Bishopm\Hub\Livewire\PastoralNote;
use Bishopm\Hub\Models\Individual;
use Bishopm\Hub\Models\Pastor;
use Bishopm\Hub\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'church');
        Paginator::useBootstrapFive();
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        if (Schema::hasTable('settings')) {
            Config::set('app.name',setting('general.church_abbreviation'));
            Config::set('google-calendar.calendar_id',setting('email.church_email'));
            Config::set('mail.default',setting('email.mailer'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.host',setting('email.mail_host'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.port',setting('email.mail_port'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.username',setting('email.mail_username'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.password',setting('email.mail_password'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.encryption',setting('email.mail_encryption'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.from_address',setting('email.mail_from_address'));
            Config::set('mail.mailers.' . setting('email.mailer') . '.from_name',setting('email.mail_from_name'));    
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
        Config::set('filament-spatie-roles-permissions.generator.model_directories',[base_path('vendor/bishopm/church/src/Models')]);
        Config::set('filament-spatie-roles-permissions.generator.user_model', \Bishopm\Hub\Models\User::class);
        Config::set('filament-spatie-roles-permissions.generator.policies_namespace','Bishopm\Hub\Filament\Policies');
        Config::set('filesystems.disks.google.folder','');
        Livewire::component('barcodescanner', BarcodeScanner::class);
        Livewire::component('bookreview', BookReview::class);
        Livewire::component('calendar', Calendar::class);
        Livewire::component('find', Find::class);
        Livewire::component('live', Live::class);
        Livewire::component('login', LoginForm::class);
        Livewire::component('pastoralnote', PastoralNote::class);
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Blade::componentNamespace('Bishopm\\Hub\\Resources\\Views\\Components', 'church');
        Relation::morphMap([
            'book' => 'Bishopm\Hub\Models\Book',
            'course' => 'Bishopm\Hub\Models\Course',
            'prayer' => 'Bishopm\Hub\Models\Prayer',
            'sermon' => 'Bishopm\Hub\Models\Service',
            'post' => 'Bishopm\Hub\Models\Post',
            'song' => 'Bishopm\Hub\Models\Song',
            'group' => 'Bishopm\Hub\Models\Group',
            'event' => 'Bishopm\Hub\Models\Event',
            'task' => 'Bishopm\Hub\Models\Task',
            'tenant' => 'Bishopm\Hub\Models\Tenant',
            'household' => 'Bishopm\Hub\Models\Household',
            'individual' => 'Bishopm\Hub\Models\Individual',
            'pastoralcase' => 'Bishopm\Hub\Models\Pastoralcase'
        ]);
        Gate::policy(Role::class, \Bishopm\Hub\Filament\Policies\RolePolicy::class);
        Gate::policy(Permission::class, \Bishopm\Hub\Filament\Policies\PermissionPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Individual::class, \Bishopm\Hub\Filament\Policies\IndividualPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Household::class, \Bishopm\Hub\Filament\Policies\HouseholdPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Group::class, \Bishopm\Hub\Filament\Policies\GroupPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Roster::class, \Bishopm\Hub\Filament\Policies\RosterPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Person::class, \Bishopm\Hub\Filament\Policies\PersonPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Statistic::class, \Bishopm\Hub\Filament\Policies\StatisticPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Meeting::class, \Bishopm\Hub\Filament\Policies\MeetingPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Task::class, \Bishopm\Hub\Filament\Policies\TaskPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Gift::class, \Bishopm\Hub\Filament\Policies\GiftPolicy::class);
        Gate::policy(\Bishopm\Hub\Models\Employee::class, \Bishopm\Hub\Filament\Policies\EmployeePolicy::class);
        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() ? true: null;     
        });
        $member=array();
        if (isset($_COOKIE['wmc-mobile']) and (isset($_COOKIE['wmc-access']))){
            $phone=$_COOKIE['wmc-mobile'];
            $uid=$_COOKIE['wmc-access'];
            $indiv=Individual::with('user.roles')->where('cellphone',$phone)->where('uid',$uid)->first();
            if (!isset($_COOKIE['wmc-id'])){
                setcookie('wmc-id',$indiv->id, 2147483647,'/');
            }
            if ($indiv){
                $member['id']=$indiv->id;
                $member['firstname']=$indiv->firstname;
                $member['fullname']=$indiv->fullname;
                $pastor = Pastor::where('individual_id',$member['id'])->first();
                if ($pastor){
                    $member['pastor_id']=$pastor->id;
                }
                $member['directory']=false;
                if (isset($indiv->user->roles)){
                    foreach ($indiv->user->roles as $role){
                        if ($role->name=="Super Admin"){
                            $member['directory']=true;
                        }
                    }
                }
                Config::set('member',$member);    
            }
        }
        View::share('member',$member);
        if (env('APP_ENV')=="local"){
            $this->publishes([
                __DIR__.'/../Resources/pwa/local_manifest.json' => public_path('manifest.json'),
                __DIR__.'/../Resources/pwa/local_serviceworker.js' => public_path('serviceworker.js'),
            ]);
        } else {
            $this->publishes([
                __DIR__.'/../Resources/pwa/manifest.json' => public_path('manifest.json'),
                __DIR__.'/../Resources/pwa/serviceworker.js' => public_path('serviceworker.js'),
            ]);
        }
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('queue:work')->withoutOverlapping();
            $schedule->command('church:birthdayemail')->weeklyOn(intval(setting('automation.birthday_day')), '6:30');
            $schedule->command('church:maintenanceemail')->weeklyOn(intval(setting('automation.maintenance_day')), '6:00');
            $schedule->command('church:checkinemail')->weeklyOn(intval(setting('automation.followup_day')), '8:30');
            $schedule->command('church:monthlymeasures')->monthlyOn(1, '5:30');
            $schedule->command('church:givingemail')->dailyAt('9:00');
            $schedule->command('church:livemessages')->dailyAt('21:30');
            $schedule->command('church:recurringtasks')->dailyAt('5:00');
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/church.php', 'church');

        $this->app->singleton('church', function ($app) {
            return new Church;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['church'];
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
            __DIR__.'/../../config/church.php' => config_path('church.php'),
        ], 'church.config');

        // Publishing the views.
        // $this->publishes([
        //    __DIR__.'/../Resources' => public_path('vendor/bishopm'),
        // ], 'church.views');

        // Publishes assets.
        $this->publishes([
            __DIR__.'/../Resources/assets' => public_path('church'),
          ], 'assets');
        

        // Registering package commands.
        $this->commands([
            'Bishopm\Hub\Console\Commands\BirthdayEmail',
            'Bishopm\Hub\Console\Commands\CheckinEmail',
            'Bishopm\Hub\Console\Commands\GivingEmail',
            'Bishopm\Hub\Console\Commands\InstallChurch',
            'Bishopm\Hub\Console\Commands\LiveMessages',
            'Bishopm\Hub\Console\Commands\MaintenanceEmail',
            'Bishopm\Hub\Console\Commands\MonthlyMeasures',
            'Bishopm\Hub\Console\Commands\RecurringTasks'
        ]);
    }
}
