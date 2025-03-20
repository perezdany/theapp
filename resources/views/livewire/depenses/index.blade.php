@php

@endphp

<div>
    @include("livewire.depenses.details")
    @include("livewire.depenses.edit")
    @include("livewire.depenses.add")
    @include("livewire.depenses.depenses-list")
     
    
    <script>

     
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

             @this.on('detailsmodal', (event)=>{
               $("#detailsModal").modal(
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

            @this.on('showUpdSuccessMessage', (event)=>{
                Swal.fire({
                position: 'top-end',
                icon: "success",
                toast: true,
                title: "Opération effectuée avec succès!",
                showCancelButton: false,
                timer: 3000,
                })
              
            })

            @this.on('closeUpdateModal', (event)=>{
               $("#editModal").modal(
                   "hide"
                )

            })

            @this.on('closeAddModal', (event)=>{
                $("#addModal").modal(
                   "hide"
                )

            })
            
        })


      
            

        
    </script>   


</div>
