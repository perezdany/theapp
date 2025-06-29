@php
    use App\Http\Controllers\Calculator;
    use App\Http\Controllers\FactureController;
    use App\Http\Controllers\ArticleController;
    $calculator = new Calculator();
    $facturecontroller = new FactureController();
    $articlecontroller = new ArticleController();
@endphp
@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-file-invoice"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Factures</span>
            <span class="info-box-number">
                @php
                    $f = $calculator->CountFacture();
                @endphp
                {{$f}}
                <!--<small>%</small>-->
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Article</span>
            <span class="info-box-number">
                @php
                    $a = $calculator->CountArticle();
                @endphp
                {{$a}}
            </span>
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
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Clients</span>
            <span class="info-box-number">
                @php
                    $c = $calculator->CountCustomer();
                @endphp
                {{$c}}
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bullseye "></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Prospects</span>
            <span class="info-box-number">
                @php
                    $p = $calculator->CountProspect();
                @endphp
                {{$p}}
            </span>
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
        <div class="col-md-6">
        
            <!--begin::Latest Order Widget-->
           @include('recentes-factures')
        </div>
        <!-- /.col -->
        <div class="col-md-6">
        
        
            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Articles récemment ajoutés</h3>
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
                            <th>Code</th>
                            <th>Désignation</th>
                            <th>Type</th>
                            
                        </tr>
                        </thead>
                        <tbody>

                            @php
                                $articles = $articlecontroller->GetLastest();
                            @endphp
                            @foreach($articles as $article)
                            
                                <tr>
                                    <td><b>{{$article->code}}</b> </td>
                                    <td>{{$article->designation}}</td>
                                    <td>{{$article->libele}}</td>
                                
                                </tr>
                            
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer text-center">
                <a href="articles" class="uppercase"> Voir tous les articles </a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!--end::Row-->
       
  
@endsection