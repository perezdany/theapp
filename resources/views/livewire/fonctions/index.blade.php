@php
    use App\Http\Controllers\FoncTIONController;

    $cotationcontroller = new FonctionController();
@endphp

<div>
    @include("livewire.fonctions.edit")
    @include("livewire.fonctions.add")
    @include("livewire.fonctions.fonctions-list")

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

        })

        
    </script>   


</div>
