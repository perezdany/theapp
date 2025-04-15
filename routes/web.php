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

use App\Http\Controllers\CotationController;

use App\Http\Controllers\FactureController;

use App\Http\Controllers\PaiementController;

use App\Http\Controllers\FonctionController;

use App\Http\Controllers\InterlocuteurController;

use App\Http\Controllers\ProjetController;

use App\Http\Controllers\SuiviController;


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

            //LES DEVIS
            Route::get('devis', function () {
                return view('admins/devis');
            });


            Route::get('add_devis', function () {
                return view('forms/add_devis');
            });

            //AJOUTER UN DEVIS
            Route::post('add_devis', [CotationController::class, 'AddDevis']);

            //ALLER AU FORMULAIRE DE MODIFICATION DES LIGNES
            //Route::post('edit_lines', [CotationController::class, 'GoFormLines']);

            //MODIFIER LES LIGNES DU DEVIS
            Route::post('edit_lines', [CotationController::class, 'EditLines']);

            //ALLER AU FORMULAIRE DE MODIFI DE LA COTATION
            Route::post('editcotation', [CotationController::class, 'GoEdit']);

            //MODIFIER LE DEVIS
            Route::post('edit_devis', [CotationController::class, 'EditDevis']);

            //SUPPRIMER LE DEVIS
            Route::post('deletedevis', [CotationController::class, 'TryDelete']);
            
            //VOIR LES DETAILS DU DEVIS
            Route::post('see_devis', [CotationController::class, 'GoDetails']);

            //ACTIVER LA TAXE AVEC L'ID DU DEVIS
            Route::post('manage_taxe', [CotationController::class, 'EnableTaxe']);

             //ACTIVER LA TAXE AVEC L'ID DU DEVIS
            Route::post('manage_taxes', [CotationController::class, 'EnableTVA']);
            
            //AJOUTER UN SERVICE 
            Route::post('addaservice', [CotationController::class, 'AddaService']);

            //AJOUTER UN ARTICLE
            Route::post('addanarticle', [CotationController::class, 'addanarticle']);

            //IMPRIMER LE DEVIS
            Route::post('print_devis', [CotationController::class, 'PrintDevis']);

            //VALIDER LE DEVIS ET GENERER UNE FACTURE
            Route::post('gocreateinvoice', [FactureController::class, 'CreateInvoice']);

            //IMPRIMER LA FACTURE
            Route::post('print_invoice', [FactureController::class, 'PrintInvoice']);

            //TABLEAU DES FACTURES
            Route::get('factures', function () {
                return view('admins/factures');
            });

            //UPLOAD FICHIER DE FACTURE
            Route::post('uploadfileinvoice', [FactureController::class, 'upload']);

            //APERCU DU FICHIER
            Route::post('dld_invoice', [FactureController::class, 'View']);

            //SUPPRIMER LA FACTURE
            Route::post('deletefacture', [FactureController::class, 'TryDelete']);

            Route::post('paiement_form', [PaiementController::class, 'GoForm']);

            //SUPPRIMER LES PAIEMENS
            Route::post('delete_paiement', [PaiementController::class, 'DeletePaiement']);
        
            //PAYER
            Route::post('do_paiement', [PaiementController::class, 'DoPaiement']);

            //EDITER UN PAIEMENT
            Route::post('edit_paiement_form', [PaiementController::class, 'EditPaiementForm']);

            Route::post('p_edit', [PaiementController::class, 'EditForm']);

            Route::post('updatepaiement', [PaiementController::class, 'UpdatePaiement']);

            Route::post('edit_paiement', [PaiementController::class, 'EditPaiement']);

            //TABLEAU DES PAIEMENTS
            Route::get('paiements', function () {
                return view('finances/paiements');
            });

            //SUPPRIMER LE PAIEMENT
            Route::post('deletepaiement', [PaiementController::class, 'DeletePaiement']);

            //LES FONCTIONS
            Route::get('fonctions', function () {
                return view('admins/fonctions');
            });

            //SUPPRIMER UNE FONCTION
            Route::post('deletefonction', [FonctionController::class, 'deletefonction']);

            //LES INTERLOCUTEURS
            Route::get('interlocuteurs', function () {
                return view('admins/interlocuteurs');
            });

            //SUPPRIMER L'INTERLOCUTEUR
            Route::post('deleteinterlocuteur', [InterlocuteurController::class, 'delete']);

            //LES PROJETS
            Route::get('projets', function () {
                return view('admins/projets');
            });

            //LES FOURNISSEURS
            Route::get('fournisseurs', function () {
                return view('admins/fournisseurs');
            });

            //SUPPRIMER LE PROJET
            Route::post('deleteprojet', [ProjetController::class, 'delete']);

            //SUIVI DES COMMERCIAUX
            Route::get('suivi', function () {
                return view('admins/suivis');
            });

            //ROUTE D'AJOUT D'EVENEMENT DANS LE CALENDRIER
            Route::post('addsuivi', [SuiviController::class, 'Add']);
            //MODIFICATION EN GLISSANT DANS LE CALENDRIER
            Route::patch('updatesuivi/{id}', [SuiviController::class, 'UpdateSuivi']);

            //EN CLIQUANT TU SUPPRIME DANS LE CALENDRIER 
            Route::delete('delete/{id}', [SuiviController::class, 'deleteSuivi']);

            //LE TABLEAU 
            Route::get('suivi_table', function () {
                return view('admins/suivitable');
            });


}); 
