<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;

use App\Models\User;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        //DEFINITION DES GATES 
        Gate::after(function (User $user) {
    
            return $user->hasAnyRole([ "super_admin", "admin",]);
        });

        Gate::define("admin", function(User $user){
            return $user->hasAnyRole(["admin", "super_admin"]);
            //dd($user->hasAnyRole(["admin", "super_admin"]));
        });

       

        Gate::define("commercial", function(User $user){
            return $user->hasRole("commercial");
        });

        Gate::define("statisticien", function(User $user){
            return $user->hasRole("statisticien");
        });

        Gate::define("standard", function(User $user){
            return $user->hasRole("standard");
        });

        Gate::define("caissier", function(User $user){
            return $user->hasRole("caissier");
        });

        Gate::define("facturier", function(User $user){
            return $user->hasRole("facturier");
        });

        /*Gate::define("super_admin", function(User $user){
            return $user->hasRole("super_admin");
        });*/

         //GATE POUR SUPPRIMER
        Gate::define("delete", function(User $user){
            return $user->hasPermission("Suppression");
        });

        Gate::define("edit", function(User $user){
            return $user->hasPermission("Ecriture");
        });

        Gate::define("procuration", function(User $user){
            return $user->hasPermission("Procuration");
        });


        

    }
}
