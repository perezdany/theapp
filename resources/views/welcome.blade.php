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
        
            <!--begin::Latest Order Widget-->
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Orders</h3>
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
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Popularity</th>
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
                        <td><div id="table-sparkline-1"></div></td>
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
                        <td><div id="table-sparkline-2"></div></td>
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
                        <td><div id="table-sparkline-3"></div></td>
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
                        <td><div id="table-sparkline-4"></div></td>
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
                        <td><div id="table-sparkline-5"></div></td>
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
                        <td><div id="table-sparkline-6"></div></td>
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
                        <td><div id="table-sparkline-7"></div></td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <!-- /.table-responsive -->
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
       
  
@endsection