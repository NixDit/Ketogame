<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\admin\LogController;
use App\Country;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        Blade::directive('remaining_days', function ($date) {
            return $date;
            dd($date);
            $remaining = Carbon::now()->diffInDays($date, false);
            return $remaining > 0 ? "<?php echo $remaining dias restantes?>" : "<?php echo El evento sucedio hace $remaining dias ?>";
        });

        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        view()->composer('*', function($view) {
            $view->with([
                'logs'        => LogController::allLogs(),
                'notReadLogs' => LogController::dontReadLogs(),
                'countries'   => Country::all()
            ]);
        });
    }
}
