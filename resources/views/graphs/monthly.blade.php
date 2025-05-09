@extends('layouts/app')

@section('content')


@php
    use App\Http\Controllers\InterlocuteurController;

    $interlocuteurcontroller = new InterlocuteurController();
  
@endphp

@section('content')
    <div class="row">
    
        <!-- left column -->
        <div class="col-md-12">
            <p class="bg-primary">
                <ul>
                    <li>Pour rechercher un mois, <b>Selectionnez le mois en question et un jour quelquonque de ce mois</b><br></li>
                    <li>Pour rechercher une année, <b>Selectionnez l'année en question et un mois et un jours quelquonque de cette année</b><br></li>
                </ul>
            </p>
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                     @php
                        echo 'Chiffre d\'affaire au mois de ';
                        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                            //echo utf8_encode(strftime( '%B ')). '<br>';
                            echo $francais. '<br>';
                    @endphp
                </h3><br>
                @php
                    echo  number_format($total, 2, ".", " ")." XOF";
                @endphp

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                    <!-- my own chart import-->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                   
                    <!--my chart-->
                    <canvas id="mychart" aria-label="chart" style="height:580px;"></canvas>
                    
                    <script>
                        //FONCTION POUR RECUPERER LE NOMBRE DE JOURS DU MOIS
                        function NonbreJourMois(mois, annee)
                        {
                            var nbreJour = 0;
                            
                            if (mois <= 6)
                            {
                                if (mois%2 == 0)
                                {
                                    nbreJour = 31;
                                }
                                else
                                {
                                    nbreJour = 30;
                                }
                            }
                            
                            else
                            {
                                if (mois%2 == 1)
                                {
                                    nbreJour = 30;
                                }
                                else
                                {
                                    nbreJour = 31;
                                }
                            }
                            if (mois == 1)
                            {
                            if(annee%4==0)
                            {
                            if(annee%100==0)
                                {
                                if(annee%400==0)
                                {
                                    nbreJour = 29;
                                }
                                else
                                {
                                    nbreJour = 28;
                                }

                                }
                                else
                                {
                                nbreJour = 29;
                                }
                            }
                            else
                            {
                            nbreJour = 28;
                            }

                            }
                            
                            return nbreJour;
                            
                        }

                        let thedate = new Date();
                        
                        //Récuper le mois et l'année
                        let mois = thedate.getMonth();
                        let annee = thedate.getFullYear();

                        //Récupérer le nombre de jours du mois en cours
                        const nb_jour = NonbreJourMois(mois, annee);

                        //Créer un tableau pour récuperer tous les numéros des jours du mois 
                        var tableau = ["1", "2", "3"];
                        for(let i = 4; i <= nb_jour; i++)
                        {
                            tableau.push(''+i+'');
                        }

                        const ctx = document.getElementById('mychart').getContext('2d');
                        let date1 = new Date();

                        let dateperso = date1.toLocaleString('fr-FR',{
                            weekday: 'short',
                            day: 'numeric',
                            month: 'short',
                            year: '2-digit',
                            hour: 'numeric',
                            minute: 'numeric',
                            second: 'numeric'});

                        const barchart = new Chart(ctx, {
                            type : "bar",
                            data : {

                                //LE LABELS POUR LES ABSCISSES DU GRAPHE
                                labels: tableau,
                                datasets: [{
                                    label: 'Total facture du jour',
                                    data: @json($data),
                                    backgroundColor: ["#9B59B6", "#F6DDCC", "#A57548", "#7E5109", "#1D8348", 
                                    "#A93226", "#F4D03F", "#1A5276", "#82DDF0", "#040F0F",
                                    "#9B59B6", "#F6DDCC", "#979A9A", "#7E5109", "#2BA84A",
                                     "#A55A5A", "#47C526", "#A9CCE3 ", "#BFC9CA", "#F6DDCC",
                                      "#979A9A", "#FCFFFC", "#696D7D", "#138A36", "#D4DF9E",
                                      "#34403A", "#12100E", "#4A4B2F", "#FA198B", "#256EFF",
                                      "#FF495C", "#46237A", "#EC7505", "#5B5B5B", "#FCB0B3"],
                                }]
                            },
                            options: {
                                layout: {
                                    padding: 20
                                }
                            }
                              
                        })
                    </script>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!--<div class="box">
                <div class="box-body">
                    <div class="box-header with-border">
                        <b>
                        <h3 class="box-title"> 
                            @php
                                //echo 'Chiffre d\'affaire au mois de ';
                                //setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                                 //echo utf8_encode(strftime( '%B ')). '<br>';
                                //echo $francais. '<br>';
                            @endphp
                        </h3><br>
                          @php
                            //echo  number_format($total, 2, ".", " ")." XOF";
                        @endphp
                    </div>
                  

                 
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    
                 
                </div>
            </div>-->
           
        </div>
      
    </div>
    <!-- Main row -->  
    <div class="row">
        <div class="col-md-5">
             <!--ON VA ESSAYER D' AFFICHER LES POURCENTAGE DE CHAQUE ENTREPRISE-->
            <div class="card card-warning">
                <div class="card-body">
                    <div class="card-header with-border">
                
                        <h3 class="card-title"> 
                            @php
                                echo 'Pourcentage (%) par client du mois de ';
                                setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                                 echo utf8_encode(strftime( '%B ')). '<br>';
                            @endphp
                        </h3><br>
                        
                    </div>
                    <!--my chart-->
                    <canvas id="percentchart" aria-label="chart" style="height:580px;"></canvas>
                    
                    <script>
                
                        const ctx2 = document.getElementById('percentchart').getContext('2d');
        

                        const barchart2 = new Chart(ctx2, {
                            type : "pie",
                            data : {

                                //LE LABELS POUR LES ABSCISSES DU GRAPHE
                                labels: @json($company),
                                datasets: [{
                                    label: 'Pourcentage',
                                    data: @json($percent),
                                    backgroundColor: @json($colors),
                                }]
                            },
                            options: {
                                layout: {
                                    padding: 20
                                }
                            }
                              
                        })

                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            
            <div class="card">
                <div class="card-body">
                    <div class="card-header with-border">
                        <h3 class="card-title"> 
                            @php
                                echo 'Graphe des prestations du mois de ';
                                setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
                                 echo utf8_encode(strftime( '%B ')). '<br>';
                            @endphp
                        </h3><br>
                        
                    </div>
                    <!--my chart-->
                    <canvas id="servpercentchart" aria-label="chart" style="height:580px;"></canvas>
                    
                    <script>
                
                        const ctx3 = document.getElementById('servpercentchart').getContext('2d');
        

                        const piechart2 = new Chart(ctx3, {
                            type : "pie",
                            data : {

                                //LE LABELS POUR LES ABSCISSES DU GRAPHE
                                labels: @json($serv),
                                datasets: [{
                                    label: 'Répartition',
                                    data: @json($data_serv),
                                    backgroundColor: ["#A09ABC", "#173753", "#1B4353", "#F6BD60", "#7E5109",
                                    "#D0D3D4", "#1D8348", "#A93226", "#F4D03F", "#1A5276",
                                    "#9B59B6", "#F6DDCC", "#A57548", "#7E5109", "#1D8348", 
                                    "#A93226", "#F4D03F", "#1A5276", "#82DDF0", "#040F0F",
                                    "#9B59B6", "#F6DDCC", "#979A9A", "#7E5109", "#2BA84A",
                                     "#A55A5A", "#47C526", "#A9CCE3 ", "#BFC9CA", "#F6DDCC",
                                      "#979A9A", "#FCFFFC", "#696D7D", "#138A36", "#D4DF9E",
                                      "#34403A", "#12100E", "#4A4B2F", "#FA198B", "#256EFF",
                                      "#FF495C", "#46237A", "#EC7505", "#5B5B5B", "#FCB0B3"],
                                }]
                            },
                            options: {
                                layout: {
                                    padding: 20
                                }
                            }
                              
                        })

                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-2">
             <!--ON VA ESSAYER D' AFFICHER LES POURCENTAGE DE CHAQUE ENTREPRISE-->
            <div class="card">
                <div class="card-body">
                    <div class="card-header with-border">
                        <b><h3 class="card-title"> RECHERCHER UN MOIS</h3><br>
                    </div>

                    <!-- form start -->
                    <form role="form" action="search_monthly_chart" method="post">
                        @csrf
                           
                        <div class="form-group">
                                <label >Mois:</label>
                                <input type="date" class="form-control input-lg" name="month" required>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">RECHERCHER</button>
                        </div>
                        
                    </form>
               
                </div>
            </div>
        </div>
      
    </div>

   

@endsection
     
    
   