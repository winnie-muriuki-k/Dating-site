<?php

namespace App\Providers;

use App\Matches;
use App\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use View as BaseView;

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
        BaseView::composer('*', function($view)
        {
            if(Auth::check()){
                $confirmed_recent_activity=  Matches::where(['initator'=>Auth::user()->id,'confirmed'=>'1'])->where('recipient', '!=', Auth::user()->id )->latest()->limit(6)->get();
                $viewed_profiles = View::where(['viewer'=>Auth::user()->id])->latest()->limit(3)->get();
                $my_viewers = View::where(['recipient'=>Auth::user()->id])->latest()->limit(4)->get();
                $view->with(['confirmed_recent_activity'=>$confirmed_recent_activity, 'viewed_profiles'=>$viewed_profiles,'my_viewers'=>$my_viewers]);
            }

        });
        Schema::defaultStringLength(191);
    }
}
