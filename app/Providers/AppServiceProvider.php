<?php

namespace App\Providers;

use App\Models\Instalment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        //
        Validator::extend('inst_amount', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $amount_piid = $inputs['amount_paid'];
            // dd($inputs);    
            $id = $inputs['id'];
            $i= Instalment::find($id);
            if($i->amount < $amount_piid){
                return false;
            }
            return true;
        });
  
    }
}
