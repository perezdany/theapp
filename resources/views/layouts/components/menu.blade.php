
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">The App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="welcome" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </a>
          </li>
         
          @php
            //VOIR SI IL EST SUPER ADMIN ON S'OCCUPE PLUS DES HABILITATIONS7
            $find_super = DB::table('role_user')->where('user_id', auth()->user()->id)->where('role_id', 6)->count();
          @endphp
          @if($find_super != 0)
            <li class="nav-item">
              <a href="devis" class="nav-link">
                <i class="nav-icon fa fa-file-invoice"></i>
                <p>
                Devis
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="factures" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>
                  Factures
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="paiements" class="nav-link">
                <i class="nav-icon fa fa-money-bill"></i>
                <p>
                  Paiements
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="projets" class="nav-link">
                <i class="nav-icon fa fa-folder"></i>
                <p>
                  Projets
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                <p>
                  Gestions
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="customers" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                      Clients
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="interlocuteurs" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                      Interlocuteurs
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="fonctions" class="nav-link">
                    <i class="nav-icon fa fa-info"></i>
                    <p>
                      Fonction d'interlocuteurs
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="fournisseurs" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                      Fournisseurs
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="depenses" class="nav-link">
                    <i class="nav-icon fa fa-money-bill"></i>
                    <p>
                      Dépenses
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="services" class="nav-link">
                    <i class="nav-icon fa fa-gavel"></i>
                    <p>
                      Services
                    </p>
                  </a>
                </li>
              
              </ul>
            </li>
          
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-calendar"></i>
                <p>
                  Suivi commercial
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="suivi" class="nav-link">
                    <i class="nav-icon fa fa-calendar"></i>
                    <p>
                    Calendrier
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="suivi_table" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>Tableau récapitulatif</p>
                  </a>
                </li>
              
              </ul>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                <p>
                  Articles
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="articles" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Articles</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="types" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Type d'Articles</p>
                  </a>
                </li>
              
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Administrations
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="users" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Utilisateurs</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="departements" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Départements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="roles" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                  </a>
                </li>
              
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                <p>
                  Graphes
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="monthly" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chiffre d'affaire Mensuel</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="yearly" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chiffre d'affaire Annuel</p>
                  </a>
                </li>
              
              </ul>
            </li>
          @else
            @can("commercial")
              <li class="nav-item">
                <a href="devis" class="nav-link">
                  <i class="nav-icon fa fa-file-invoice"></i>
                  <p>
                  Devis
                  </p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="projets" class="nav-link">
                  <i class="nav-icon fa fa-folder"></i>
                  <p>
                    Projets
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Gestions
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="customers" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Clients
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="interlocuteurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Interlocuteurs
                      </p>
                    </a>
                  </li>
                
                  <li class="nav-item">
                    <a href="fournisseurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Fournisseurs
                      </p>
                    </a>
                  </li>
                
                  <li class="nav-item">
                    <a href="services" class="nav-link">
                      <i class="nav-icon fa fa-gavel"></i>
                      <p>
                        Services
                      </p>
                    </a>
                  </li>
                
                </ul>
              </li>
            
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-calendar"></i>
                  <p>
                    Suivi commercial
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="suivi" class="nav-link">
                      <i class="nav-icon fa fa-calendar"></i>
                      <p>
                      Calendrier
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="suivi_table" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>Tableau récapitulatif</p>
                    </a>
                  </li>
                
                </ul>
              </li>
              <li class="nav-item">
                  <a href="articles" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Articles</p>
                </a>
              </li>
             
            @endcan
          
            @can("admin")            
        
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  Administrations
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="users" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Utilisateurs</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="departements" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Départements</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="roles" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Roles</p>
                    </a>
                  </li>
                
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Graphes
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="monthly" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chiffre d'affaire Mensuel</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="yearly" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chiffre d'affaire Annuel</p>
                    </a>
                  </li>
                
                </ul>
              </li>
            @endcan

            @can("statisticien")

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Gestions
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="customers" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Clients
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="interlocuteurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Interlocuteurs
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="fonctions" class="nav-link">
                      <i class="nav-icon fa fa-info"></i>
                      <p>
                        Fonction d'interlocuteurs
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="fournisseurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Fournisseurs
                      </p>
                    </a>
                  </li>
                
                  <li class="nav-item">
                    <a href="services" class="nav-link">
                      <i class="nav-icon fa fa-gavel"></i>
                      <p>
                        Services
                      </p>
                    </a>
                  </li>
                
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Graphes
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="monthly" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chiffre d'affaire Mensuel</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="yearly" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chiffre d'affaire Annuel</p>
                    </a>
                  </li>
                
                </ul>
              </li>
            @endcan

            @can("standard")
            
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gift"></i>
                  <p>
                    Gestions
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="customers" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Clients
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="interlocuteurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Interlocuteurs
                      </p>
                    </a>
                  </li>
                
                  <li class="nav-item">
                    <a href="fournisseurs" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Fournisseurs
                      </p>
                    </a>
                  </li>
                
                  <li class="nav-item">
                    <a href="services" class="nav-link">
                      <i class="nav-icon fa fa-gavel"></i>
                      <p>
                        Services
                      </p>
                    </a>
                  </li>
                
                </ul>
              </li>
            
            @endcan
            <!-- LE FACTURIER ET LE CAISSIER -->
            
            @php
               $finds = DB::table('role_user')->where('user_id', auth()->user()->id)
               ->where('role_id',10)->count();
            @endphp
            @if($finds != 0)
              @can("facturier")
                <li class="nav-item">
                  <a href="devis" class="nav-link">
                    <i class="nav-icon fa fa-file-invoice"></i>
                    <p>
                    Devis
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="factures" class="nav-link">
                    <i class="nav-icon fas fa-receipt"></i>
                    <p>
                      Factures
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="paiements" class="nav-link">
                    <i class="nav-icon fa fa-money-bill"></i>
                    <p>
                      Paiements
                    </p>
                  </a>
                </li>
                
              
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gift"></i>
                    <p>
                      Gestions
                      <i class="fas fa-angle-left right"></i>
                      
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                      <a href="fournisseurs" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                          Fournisseurs
                        </p>
                      </a>
                    </li>
                  
                    <li class="nav-item">
                      <a href="services" class="nav-link">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>
                          Services
                        </p>
                      </a>
                    </li>
                  
                  </ul>
                </li>
              @endcan
            @else
              @php
                $finds = DB::table('role_user')->where('user_id', auth()->user()->id)
                ->where('role_id',9)->count();
              @endphp
              @if($finds != 0)
                @can("caissier")
              
                  <li class="nav-item">
                    <a href="factures" class="nav-link">
                      <i class="nav-icon fas fa-receipt"></i>
                      <p>
                        Factures
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="paiements" class="nav-link">
                      <i class="nav-icon fa fa-money-bill"></i>
                      <p>
                        Paiements
                      </p>
                    </a>
                  </li>
                  
              
                @endcan
              @else
              @endif
            @endif
            <!-- FIN LE FACTURIER ET LE CAISSIER -->

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-gift"></i>
                <p>
                  Articles
                  <i class="fas fa-angle-left right"></i>
                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="articles" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Articles</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="types" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Type d'Articles</p>
                  </a>
                </li>
              
              </ul>
            </li>
          @endif

          <!---->
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
