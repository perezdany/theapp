@extends('layouts/app')
@php

    use App\Http\Controllers\DepartementController;
    use App\Http\Controllers\UserController;

     use App\Http\Controllers\RoleController;

     use App\Models\Permission;

    $usercontroller = new UserController();
    $departementcontroller = new DepartementController();
    $rolecontroller =  new RoleController();
@endphp

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-gear-fill"></i>
                </span>
                <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10
                    <small>%</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                </span>
                <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <!-- <div class="clearfix hidden-md-up"></div> -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                <i class="bi bi-cart-fill"></i>
                </span>
                <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm">
                <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <!--begin::Row-->
        <div class="row">
            <!-- Start col -->
            <div class="col-md-8">
            
               <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                    <div class="card-header"><div class="card-title">Quick Example</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form>
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                        />
                        <div id="emailHelp" class="form-text">
                          We'll never share your email with anyone else.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" />
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" />
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                      </div>
                      <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">
                    Place New Order
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">
                    View All Orders
                    </a>
                </div>
                <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
            
            
            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                    <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Status</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR9842</a
                            >
                            </td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge text-bg-success"> Shipped </span></td>
                        
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR1848</a
                            >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                            
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                            >
                            </td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge text-bg-danger"> Delivered </span></td>
                            
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                            >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-info">Processing</span></td>
                            
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR1848</a
                            >
                            </td>
                            <td>Samsung Smart TV</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                            
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR7429</a
                            >
                            </td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="badge text-bg-danger"> Delivered </span></td>
                            
                        </tr>
                        <tr>
                            <td>
                            <a
                                href="pages/examples/invoice.html"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                >OR9842</a
                            >
                            </td>
                            <td>Call of Duty IV</td>
                            <td><span class="badge text-bg-success">Shipped</span></td>
                        
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase"> View All Products </a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
    <div class="row">
   
      
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <div class="box box-aeneas">
                <div class="box-header with-border">
                    <b><h3 class="box-title">MODIFICATION </h3><br></b>
                </div>
                @php
                   
                    $retrive = $usercontroller->GetById($id_user);
                   
                @endphp
                @foreach($retrive as $user)
                     <!-- form start -->
                    <form role="form" action="edit_user" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control " name="email" value="{{$user->login}}">
                            </div>
                            <div class="form-group">
                                <label >Nom & Prénom(s)</label>
                                <input type="text" class="form-control  " name="nom" value="{{$user->nom_prenoms}}" onkeyup='this.value=this.value.toUpperCase()'>
                            </div>
                            <div class="form-group">
                                <label >Département</label>
                                <select class="form-control " name="departement">
                                    <option value={{$user->departements_id}}>{{$user->libele_departement}}</option>
                                        
                                    @php
                                        $get = $departementcontroller->GetAll();
                                    @endphp
                                    
                                    @foreach($get as $departement)
                                        <option value={{$departement->id}}>{{$departement->libele_departement}}</option>
                                        
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Rôle:</label>
                                <select class="form-control " name="role">
                                  <option value={{$user->roles_id}}>{{$user->intitule}}</option>
                                @php
                                        $role = $rolecontroller->GetAll();
                                    @endphp
                                    
                                    @foreach($role as $role)
                                        <option value={{$role->id}}>{{$role->intitule}}</option>
                                        
                                    @endforeach
                                    
                                </select>
                                
                            </div>     
                            <div class="form-group">
                                <label >Fonction</label>
                                <input type="text" class="form-control  " name="poste" value="{{$user->poste}}" onkeyup='this.value=this.value.toUpperCase()'/>
                            </div>
                           
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">VALIDER</button>
                        </div>
                    </form>
                   
                @endforeach
               
            </div>      
        </div>
        <!--/.col (right) -->
         <div class="col-md-6">
            <div class="box box-aeneas">
                @foreach($retrive as $user)
                     <!-- form start -->
                    <div class="box-header with-border">
                            <b><h3 class="box-title">Réinitialiser le mot de passe</h3><br></b>
                    </div>
                    <form role="form" action="reset_password" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                         <div class="box-body">
                            Mot de passe par défaut(123456)
                        </div>
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">REINITIALISER LE MOT DE PASSE</button>
                        </div>
                    </form><hr>
                        <div class="box-header">
                            <h3 class="box-title">Permissions</h3>
                        </div>
                    <form role="form" action="update_permissions" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="box-body">
                            <div class="form-group">
                                @php
                                    $permissions = Permission::all()
                                   
                                @endphp
                                @foreach($permissions as $permissions)
                                <label>
                                    @php
                                        $per= DB::table('permission_utilisateur')->where('utilisateur_id', $user->id)->where('permission_id', $permissions->id)->count();
                                    @endphp
                                    @if($per != 0)
                                        <input type="checkbox" class="minimal" id="{{$permissions->libele}}" value="{{$permissions->id}}" name="{{$permissions->libele}}" checked>
                                    @else
                                        <input type="checkbox" class="minimal" id="{{$permissions->libele}}" value="{{$permissions->id}}" name="{{$permissions->libele}}">
                                    @endif
                                   
                                    {{$permissions->libele}}
                                </label>
                                
                                @endforeach
                            
                                
                            </div>
                     
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="bt" >METTRE A JOUR LES PERMISSIONS</button>
                        </div>
                     
                    </form><hr>

                     <div class="box-header">
                        <h3 class="box-title">Modifier le mot de passe</h3>
                    </div>
                    <form role="form" action="edit_password" method="post">
                        @csrf
                        <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                        <div class="box-body">
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
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="bt" >MODIFIER LE MOT DE PASSE</button>
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
     
    
   