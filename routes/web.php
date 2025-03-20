<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\DepartementController;

use App\Http\Controllers\RoleController;

use App\Http\Controllers\ArticleController;

use App\Http\Controllers\TypearticleController;

use App\Http\Controllers\ServiceController;

use App\Http\Controllers\DepenseController;

use App\Http\Controllers\CustomerController;


Route::middleware(['guest'])->group(function(){

    //PAGE DE CONNEXION
    Route::get('/', function () {
        return view('auth/login');
    })->name('login');

    Route::get('login', function () {
        return view('auth/login');
    })->name('login');

    Route::post('go_login', [AuthController::class, 'AdminLogin']);

    //DECONNEXION
    //Route::get('logout', [AuthController::class, 'logoutUser']);
    Route::get('code_form', function () {
        return view('code_form');
    });

    Route::get('edit_pass_firstlog', function () {
        return view('edit_pass_firstlog');
    });

    Route::post('go_login', [AuthController::class, 'AdminLogin']);

    Route::post('login_code', [AuthController::class, 'LoginCode']);

    Route::post('update_pass_firstlog', [UserController::class, 'EditPasswordFristLog']);

     
});


//SI IL EST DEJA CONNECTE 
Route::middleware(['auth'])->group(function(){
    
    //TABLEAU DE BORD
    Route::get('welcome', function () {
        return view('welcome');
    })->name('home');

    Route::get('users', function () {
        return view('admins/users');
    });

    /* ROUTES POUR L'ADMNISTRATION*/
    
            //MODIFIER MOT DE PASSE
            Route::post('edit_password', [UserController::class, 'EditPassword']);

            //REINITIALISER LE MOT DE PASSE
            Route::post('reset_password', [UserController::class, 'ResetPassword']);

            //MODIFIER LES PERMISSION
            Route::post('update_permissions', [UserController::class, 'UpdatePermissions']);

            //DESACTIVER L'UTILISATEUR
            Route::post('disable_user', [UserController::class, 'DisableUser']);

            //ACTIVER L'UTILISATEUR
            Route::post('enable_user', [UserController::class, 'EnableUser']);


            //DECONNEXION
            Route::post('logout', [AuthController::class, 'logoutUser']);
            Route::get('logout', [AuthController::class, 'logoutUser']);

            //MISE A JOUR DES ROLES UTILISATEURS
            Route::post('update_roles', [UserController::class, 'updateRoles']);

            //PROFIL UTILISATEUR
            Route::post('edit_user_form', [UserController::class, 'EditForm']);

            //MODIFIER L'UTILISATEUR
            Route::post('edit_user', [UserController::class, 'EditUser']);

            //SUPPRIMER UN UTILISARTEUR
            Route::post('deleteuser', [UserController::class, 'tryDelete']);

            //LES DEPARTEMENTS
            Route::get('departements', function () {
                return view('admins/departements');
            });
            
            //SUPPRIMER LE DEPARTEMENT
            Route::post('deletedepartement', [DepartementController::class, 'tryDelete']);

            //LES ROLES

               Route::get('roles', function () {
                return view('admins/roles');
            });

             //SUPPRIMER LE ROLE
             Route::post('deleterole', [RoleController::class, 'deleteRole']);

             //LES TYPES D'ARTICLES
             Route::get('types', function () {
                return view('admins/typearticles');
            });
        
            //SUPPRIMER LE TYPE
            Route::post('deletetype', [TypearticleController::class, 'DeleteType']);

            //LES ARTICLES
            Route::get('articles', function () {
                return view('admins/articles');
            });

            //SUPPRIMER L'ARTICLE
            Route::post('deletearticle', [ArticleController::class, 'TryDelete']);

            //LES SERVICES
            Route::get('services', function () {
                return view('admins/services');
            });

            //SUPPRIMER LE SERVICE
            Route::post('deleteservice', [ServiceController::class, 'TryDelete']);

            //LES DEPENSES
            Route::get('depenses', function () {
                return view('admins/depenses');
            });

            //SUPPRIMER LA DEPENSE
            Route::post('deletedepense', [DepenseController::class, 'TryDelete']);

            //CUSTOMER (CLIENT)
            Route::get('customers', function () {
                return view('admins/customers');
            });

            //SUPPRIMER LE CLIENT
            Route::post('deletecustomer', [CustomerController::class, 'TryDelete']);

});
