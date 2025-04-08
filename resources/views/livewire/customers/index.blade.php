@php
    use App\Http\Controllers\CustomerController;
@endphp

<div>
    @include('livewire.customers.edit')
    @include('livewire.customers.editparticulier')
    @include('livewire.customers.detailsparticulier')
    @include('livewire.customers.details') 
    @include('livewire.customers.add')
    @include('livewire.customers.addparticulier')
    @include('livewire.customers.customers-list')
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

            @this.on('addmodal', (event)=>{
               $("#addModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

            @this.on('addmodalparticulier', (event)=>{
               $("#addModalParticulier").modal(
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

             @this.on('editmodalparticulier', (event)=>{
               $("#editModalParticulier").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

             @this.on('details', (event)=>{
               $("#detailsModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

            @this.on('detailsparticulier', (event)=>{
               $("#detailsModalParticulier").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )

            })

            @this.on('closeAddModal', (event)=>{
                $("#addModal").modal(
                   "hide"
                )

            })

            @this.on('closeAddModalParticulier', (event)=>{
                $("#addModalParticulier").modal(
                   "hide"
                )

            })

            @this.on('closeUpdateModal', (event)=>{
               $("#editModal").modal(
                   "hide"
                )

            })

             @this.on('closeUpdateModalParticulier', (event)=>{
               $("#editModalParticulier").modal(
                   "hide"
                )

            })
            
        })
        
    </script>   


</div>

