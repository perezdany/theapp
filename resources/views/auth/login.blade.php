@extends('layouts.auth')


@section('content')
  <div class="login-box">
    <div class="login-logo">
      <h1 class="mb-0"><b>The</b>App</h1>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Entrez vos identifiants pour accéder à votre session</p>
        @if(session('success'))
          <div class="alert alert-success">
            {{session('success')}}
          </div>
        @endif

        @if(session('warn'))
          <div class="alert alert-warning">
            {{session('warn')}}
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger">
            {{session('error')}}
          </div>
        @endif
        <form action="go_login" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="login" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
            
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      

      
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->
 
@endsection