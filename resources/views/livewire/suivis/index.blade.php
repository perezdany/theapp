@php
    use App\Http\Controllers\DepartementController;

    $departementcontroller = new DepartementController();
@endphp

<div>
    @include("livewire.suivis.add-event")
    @include("livewire.suivis.calendar")
    
    @php
        //dd($events)
    @endphp

    <script type="text/javascript">
       
        /*POUR CHARGHER LE COMPOSANT CALENDAR*/
        document.addEventListener('livewire:initialized', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
          
            //Les données issues de la table, on converti en json pour afficher
            var suivi = @json($events);
            const calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                locale: 'FR',
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois', 
                    week: 'Semaine',
                    list: 'Liste',
                    day: 'Jour'
                },
                events: suivi,
                editable: true,
                selectable: true,
                //selectHelper : true,
                dateClick: function(info) {
                    /*alert('Clicked on: ' + info.dateStr);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('Current view: ' + info.view.type);
                    // change the day's background color just for fun
                    info.dayEl.style.backgroundColor = 'red';*/

                     $("#addModal").modal(
                    { "show" : true, "backup": "static"}  
                    );

                    $("#savebtn").click(function(){
                        var title = $("#title").val();
                        var end = $("#end").val().replace("T", " ");
                        var id_client = $("#id_client").val();
                        var id_projet = $("#id_projet").val();
                        var id_fournisseur = $("#id_fournisseur").val();
                        var startime = $("#startime").val();
                        var start = info.dateStr
                        //alert(title);
                        //var start = moment(start).format('YYYY-MM-DD');
                        //var end = moment(end).format('YYYY-MM-DD');
                        //console.log(start);
                    
                        $.ajax({
                            url:"addsuivi",
                            type:"POST",
                            dataType: "json",
                            data:{ 
                                    title, start, end, id_client, 
                                    id_projet, id_fournisseur, startime},
                            success:function(response)
                            {
                                
                                Swal.fire({
                                    position: 'top-end',
                                    icon: "success",
                                    toast: true,
                                    title: "Opération effectuée avec succès!",
                                    showCancelButton: false,
                                    timer: 3000,
                                })
                                location.reload(true);
                            },
                            error:function(error)
                            {
                                if(error.responseJSON.errors){
                                
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: "warning",
                                    toast: true,
                                    title: "Le titre et la date de fin sont obligatoire! Veuillez renseigner ces deux champ svp!",
                                    showCancelButton: false,
                                    timer:4000
                                    })
                                }
                                else
                                {

                                }
                            }
                            
                        })
                    })
                },

                eventDrop: function(info){
            
                    //alert(info.event.title + " was dropped on " + info.event.start.toISOString());
                   
                    //var start = moment(event.start).format('YYYY-MM-DD');
                    //console.log(info);
                    
                    var id = info.event.id;
                    var start = info.event.start.toISOString().replace("T", " ");
                    if(info.event.end == null)
                    {
                        end = info.event.start.toISOString().replace("T", " ");
                    }
                    else
                    {
                        var end = info.event.end.toISOString().replace("T", " ");
                    }

                    $.ajax({
                        url:"updatesuivi"+"/"+id,
                        type:"PATCH",
                        dataType: "json",
                        data:{ start, end },
                        success:function(response)
                        {
                            Swal.fire({
                                position: 'top-end',
                                icon: "success",
                                toast: true,
                                title: "Opération effectuée avec succès!",
                                showCancelButton: false,
                                timer: 3000,
                            })
                            location.reload(true);
                           
                        },
                        error:function(error)
                        {
                            Swal.fire({
                                position: 'top-end',
                                icon: "error",
                                toast: true,
                                title: "Oups! Une erreur s'est produite"+error,
                                showCancelButton: false,
                                timer: 3000,
                            })
                          
                        }
                        
                    })
                },

                eventClick: function(info){
                    var id = info.event.id;
                    
                    if(confirm('Voulez-vous vraiment supprimer cet evènement?'))
                    {
                        $.ajax({
                            url:"delete"+"/"+id,
                            type:"DELETE",
                            dataType: "json",
                            success:function(response)
                            {
                                console.log(response)
                                Swal.fire({
                                    position: 'top-end',
                                    icon: "success",
                                    toast: true,
                                    title: "Evènement supprimé",
                                    showCancelButton: false,
                                    timer: 3000,
                                })
                                location.reload(true);
                            
                            },
                            error:function(error)
                            {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: "error",
                                    toast: true,
                                    title: "Oups! Une erreur s'est produite"+error,
                                    showCancelButton: false,
                                    timer: 3000,
                                })
                            
                            }
                            
                        })
                    }

                   
                }

                   
                
            });
            
            calendar.render();
        });


        document.addEventListener('livewire:initialized', ()=>{

            @this.on('delete-prompt', (event)=>{
                Swal.fire({
                    title:  "Êtes vous sûre de continuer?",
                    text: "Vous êtes sur le point de supprimer un élément de la base de données.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continuer!",
                    cancelButtonText: "Annuler!",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('do-delete')
                    }
                });


            })

            @this.on('addmodal', (event)=>{
               $("#addModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

             @this.on('editmodal', (event)=>{
               $("#editModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

            @this.on('showAddSuccessMessage', (event)=>{
                Swal.fire({
                position: 'top-end',
                icon: "success",
                toast: true,
                title: "Opération effectuée avec succès!",
                showCancelButton: false,
                timer: 3000,
                })

              
            })

            @this.on('closeAddModal', (event)=>{
                $("#addModal").modal(
                   "hide"
                )

            })

            @this.on('closeUpdateModal', (event)=>{
               $("#editModal").modal(
                   "hide"
                )

            })
            
        })
        
    </script>   


</div>
