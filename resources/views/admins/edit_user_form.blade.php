@extends('layouts/app')
@php


    use App\Http\Controllers\UserController;
     use App\Http\Controllers\DepartementController;

    $usercontroller = new UserController();
    $departementcontroller = new DepartementController();

    use App\Models\Permission;

@endphp

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">

    
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <b><h3 class="card-title">MODIFICATION </h3><br></b>
                </div>
                @php
                
                    $retrive = $usercontroller->GetById($id_user);
                
                @endphp
                @foreach($retrive as $user)
                    <!-- form start -->
                    <form role="form" action="edit_user" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nom & Prénom(s)</label>
                                <input type="text" class="form-control " name="nom_prenoms" value="{{$user->nom_prenoms}}" onkeyup='this.value=this.value.toUpperCase()'>
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-4 col-form-label">Département</label>
                                <div class="col-sm-8">
                                
                                <select class="form-control" name="departements_id" required >
                                    @php
                                    $dep = $departementcontroller->GetAll();
                                    @endphp
                                     <option value="{{$user->departements_id}}">{{$user->libele_departement}}</option>
                                    @foreach($dep as $dep)
                                        <option value="{{$dep->id}}">{{$dep->libele_departement}}</option>
                                        
                                    @endforeach
                                </select>

                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label  class="col-sm-4 col-form-label" >Intiutlé du poste</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" maxlength="60" value="{{$user->poste}}" name="poste" required onkeyup='this.value=this.value.toUpperCase()' />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control " name="email" value="{{$user->login}}" required>
                                </div>
                            </div>
                                 
                        
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">VALIDER</button>
                        </div>
                    </form>
                
                @endforeach
            
            </div>		
        </div>
        <!--/.col (right) -->
        <div class="col-md-6">
            <div class="card card-info">
                @foreach($retrive as $user)
                    <!-- form start -->
                    <div class="card-header">
                            <b><h3 class="card-title">Réinitialiser le mot de passe</h3><br></b>
                    </div>
                    <form role="form" action="reset_password" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="card-body">
                            Mot de passe par défaut(123456)
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">REINITIALISER LE MOT DE PASSE</button>
                        </div>
                    </form><hr>
                        <div class="card-header">
                            <h3 class="card-title">Permissions</h3>
                        </div>
                    <form role="form" action="update_permissions" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="card-body">
                            <div class="form-group">
                                @php
                                    $permissions = Permission::all()
                                
                                @endphp
                                @foreach($permissions as $permissions)
                                <label>
                                    @php
                                        $per= DB::table('permission_user')->where('user_id', $user->id)->where('permission_id', $permissions->id)->count();
                                        
                                    @endphp
                                    @if($per != 0)
                                        <input type="checkbox" class="minimal" id="{{$permissions->libele}}" value="{{$permissions->id}}" name="{{$permissions->libele}}" checked="checked">
                                    @else
                                        <input type="checkbox" class="minimal" id="{{$permissions->libele}}" value="{{$permissions->id}}" name="{{$permissions->libele}}">
                                    @endif
                                
                                    {{$permissions->libele}}
                                </label>
                                
                                @endforeach
                            
                                
                            </div>
                    
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >METTRE A JOUR LES PERMISSIONS</button>
                        </div>
                    
                    </form><hr>

                    <div class="card-header">
                        <h3 class="card-title">Modifier le mot de passe</h3>
                    </div>
                    <form role="form" action="edit_password" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control  " required name="password" id="pwd1">
                            </div>
                            
                            <div class="form-group">
                                <label>Confirmer le mot de passe</label>
                                <input type="password" class="form-control  " required  id="pwd2" equired onkeyup="verifyPassword()">
                            </div>
                            <div class="col-md-12 form-group" id="match">            
                            </div>
                        
                                        
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >MODIFIER LE MOT DE PASSE</button>
                        </div>
                        <script type="text/javascript">
                                    
                            /*UN SCRIPT QUI VA VERFIER SI LES DEUX PASSWORDS MATCHENT*/
                            function verifyPassword()
                            {
                                var msg; 
                                var str = document.getElementById("pwd1").value; 
                                var button = document.getElementById("bt")

                                var text1 = document.getElementById('pwd1').value;
                                var text2 = document.getElementById('pwd2').value;
                                
                                
                                if((text1 == text2))
                                {  
                                    
                                    
                                    var theText = "<p style='color:green'>Correspond.</p>"; 
                                    button.removeAttribute("disabled");
                                    document.getElementById("match").innerHTML= theText; 
                                    
                                }
                                else
                                {
                                    
                                    var theText = "<p style='color:red'>Ne correspond pas.</p>";
                                    document.getElementById("match").innerHTML= theText;
                                    button.setAttribute("disabled", "true");
                                }
                            }
                                    
                        </script>     
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Main row -->  
     
@endsection
     
    
   