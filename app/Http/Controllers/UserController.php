<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Handle Users

    public function GetById($id)
    { 
        //dd($id);  
        $get = DB::table('users')
        ->join('departements', 'users.departements_id', '=', 'departements.id')
       
        ->where('users.id', '=', $id)
        ->get(['users.*', 'departements.libele_departement',]);

       return $get;
    }
    
    public function GoProfil(Request $request)
    {
        //dd($request->id_user);
        
        return view('admin/profile',
            [
                'id_user' => $request->id_user,
            ]
        );
    }

    public function EditForm(Request $request)
    {
        //dd($request->id_user);
        
        return view('admins/edit_user_form',
            [
                'id_user' => $request->id_user,
            ]
        );
    }

    public function EditUser(Request $request)
    {
       //dd($request->all());
        $affected = DB::table('users')
        ->where('users.id', '=', $request->id_user)
       
        ->update(['login' => $request->email, 'nom_prenoms'=> $request->nom_prenoms, 
        'departements_id'=> $request->departements_id, 'poste' => $request->poste,
            ]);
        

        return redirect('users')->with('success', 'Modification Effectuée avec succès');
    }

    public function UpdatePermissions(Request $request)
    {
        //dd($request->all());
        $get_of_user = User::find($request->id_user);
        if(isset($request->Ecriture))
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', $request->Ecriture)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //nothing
            }
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->permissions()->attach($request->Ecriture);
            }
        }
        else
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', 1)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //SUPPRIMER L'ENREGISTREMENT
                $delete = DB::table('permission_user')->where('user', $request->id_user)->where('permission_id', 1)->delete();
            }
            else
            {
                //nothing
             
            }
        }

        if(isset($request->Suppression))
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', $request->Suppression)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //nothing
            }
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->permissions()->attach($request->Suppression);
            }
        }
        else
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', 2)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                $delete = DB::table('permission_user')->where('user_id', $request->id_user)->where('permission_id', 2)->delete();
            }
            else
            {
                //nothing
            }
        }

        return redirect('users')->with('success', 'Mise à jour des permissions effectuées');
       
    }

    public function EditPassword(Request $request)
    {
        $user_password = Hash::make($request->password);

        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['password' =>  $user_password, ]);

        //dd($request->id);

        return redirect('users')->with('success', 'Modification Effectuée avec succès');
    }

    public function EditPasswordFristLog(Request $request)
    {
        $user_password = Hash::make($request->password);

        //ON VA AUSSI CHANGER LE COUNT LOGIN DE LA PREMIERE
        $affected = DB::table('users')
        ->where('id', $request->id)
        ->update(['password' =>  $user_password, 'count_login' => 1]);

        //dd($request->id);

        return redirect('login')->with('success', 'Modification Effectuée avec succès. Vueillez vous connecter à nouveau.');
    }

    public function DisableUser(Request $request)
    {
        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['active' =>  0, ]);

        return redirect('users')->with('success', 'Utilisateur désactivé');
    }

    public function EnableUser(Request $request)
    {
        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['active' =>  1, ]);

        return redirect('users')->with('success', 'Utilisateur activé');
    }
    
    public function GetAll()
    {
        $get = DB::table('users')
        ->join('departements', 'users.departements_id', '=', 'departements.id')
        ->get(['users.*', 'departements.libele_departement']);

        return $get;

    }

    public function AddUser(Request $request)
    {
        
        $user_password = Hash::make("123456");
        if(Utilisateur::where('login', $request->login)->count() == 0)
        {
            $Insert = Utilisateur::create([
                'login' => $request->login, 
                'password' => $user_password,
                 'nom_prenoms' => $request->nom_prenoms, 
                 'departements_id' => $request->departement, 
                 'poste' => $request->poste, 
                 'roles_id' => $request->role,
                 'active' => 1,
                  'created_by' => auth()->user()->id,
                  'count_login' => 0,
           ]);
            //dd($request->all());
            if(isset($request->Suppression))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
            {
                $Insert->permissions()->attach($request->Suppression);
            }
            
            if(isset($request->Ecriture))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
            {
                $Insert->permissions()->attach($request->Ecriture);
            }
    
            
    
           return redirect('users')->with('success', 'Enregistrement effectué');
        }

        return redirect('users')->with('error', 'Adresse mail est déja utilisée');
       
    }

    public function ResetPassword(Request $request)
    {
       
        $user_password = Hash::make(123456);
        //dd($user_password);
        //dd( DB::table('users')->where('id', $request->id_user));

        $affected = DB::table('users')->where('id', $request->id_user)
        ->update(['password' =>  $user_password, 'count_login' => 0]);

        return redirect('users')->with('success', 'Réinitialisation Effectuée avec succès');
    }

    public function updateRoles(Request $request)
    {
        //dd($request->all());
        $get_of_user = User::find($request->id_user);
        if(isset($request->commercial))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->commercial)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->commercial);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'commercial')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //dd('ici');
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
           
        }
        if(isset($request->admin))
        {
          
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->admin)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->admin);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'admin')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->statisticien))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->statisticien)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->statisticien);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'statisticien')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->super_admin))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->super_admin)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->super_admin);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'super_admin')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->standard))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->standard)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->standard);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'standard')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->employe))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->employe)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->employe);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'employe')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->caissier))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->caissier)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->caissier);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'caissier')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        if(isset($request->facturier))
        {
            $get_role_in_table = DB::table('role_user')->where('role_id', $request->facturier)->where('user_id', $request->id_user)->count();
            if($get_role_in_table != 0){}
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->roles()->attach($request->facturier);
            }
        }
        else
        {
            $id_role = DB::table('roles')->where('intitule', 'facturier')->get('id');
            foreach($id_role as $id_role)
            {
                $get_role_in_table = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->count();
                if($get_role_in_table != 0)
                {
                    //SUPPRIMER L'ENREGISTREMENT
                    $delete = DB::table('role_user')->where('role_id', $id_role->id)->where('user_id', $request->id_user)->delete();
                }
                else{}
            }
        }

        return back()->with('success', 'Modification effectuée');
    }

    public function tryDelete(Request $request)
    {
        //dd($request->all());
        //verifier si l'utilisateur n'a pas fait des enregistrement dans la base
        $v = DB::table('cotations')->where('id_user', $request->id)->count();

        if($v != 0)
        {
            //Déclenche l'evenement  #[On('do-delete')] 
            return back()->with('error', 'Désolé, vous ne pouvez supprimer cet utilisateur car des devis ont été créés par ce dernier');
          
        }
        else
        {
            User::destroy($request->id);

            return back()->with('success', 'Utilisateur supprimé avec succès');
        }
    }
}

