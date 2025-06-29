@can("admin")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Factures pas encore reglées</h3>
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
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Date d'émission</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $nr = $facturecontroller->GetNoreglee();
                    @endphp
                    @foreach($nr as $facture)
                        @if($facture->numero_facture == NULL)
                        @else
                        <tr>
                            <td>
                                {{$facture->numero_facture}}
                            </td>
                            <td>{{$facture->nom}}</td>
                            <td>{{$facture->montant_facture}}</td>
                            <td>{{$facture->date_emission}}</td>
                        </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="devis" class="btn btn-sm btn-primary float-start">
                Ajouter une facture
            </a>
            <a href="factures" class="btn btn-sm btn-secondary float-end">
                Voir tout
            </a>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endcan

@can("facturier")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Factures pas encore reglées</h3>
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
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Date d'émission</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $nr = $facturecontroller->GetNoreglee();
                    @endphp
                    @foreach($nr as $facture)
                        @if($facture->numero_facture == NULL)
                        @else
                        <tr>
                            <td>
                                {{$facture->numero_facture}}
                            </td>
                            <td>{{$facture->nom}}</td>
                            <td>{{$facture->montant_facture}}</td>
                            <td>{{$facture->date_emission}}</td>
                        </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="devis" class="btn btn-sm btn-primary float-start">
                Ajouter une facture
            </a>
            <a href="factures" class="btn btn-sm btn-secondary float-end">
                Voir tout
            </a>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endcan

@can("caissier")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Factures pas encore reglées</h3>
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
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Date d'émission</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $nr = $facturecontroller->GetNoreglee();
                    @endphp
                    @foreach($nr as $facture)
                        @if($facture->numero_facture == NULL)
                        @else
                        <tr>
                            <td>
                                {{$facture->numero_facture}}
                            </td>
                            <td>{{$facture->nom}}</td>
                            <td>{{$facture->montant_facture}}</td>
                            <td>{{$facture->date_emission}}</td>
                        </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="devis" class="btn btn-sm btn-primary float-start">
                Ajouter une facture
            </a>
            <a href="factures" class="btn btn-sm btn-secondary float-end">
                Voir tout
            </a>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endcan

