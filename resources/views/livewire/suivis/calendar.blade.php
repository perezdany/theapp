<div class="content-header">
    <div class="container-fluid">
        <a href="suivi_table"><button class="btn btn-info" >
            <b><i class="fa fa-table"></i> ALLER AU TABLEAU</b></button></a>
    </div><!-- /.container-fluid data-toggle="modal" data-target="#addModal"-->
</div>


<div class="card">
   
    <div class="card-body">
    @can('admin')
        @php
            $t_colour = ["#00A36C", "#0047AB", "#9b59b6", "Black",
        "CornflowerBlue", "DarkGoldenRod", "DarkGreen", "DeepPink", "Gold",
        "Indigo", "LightCoral", "LightSeaGreen", "#4A919E", "#E1A624", 
        "#FF9CB6", "#FC4E00", "#7D4FFE", "#A4BD01",
        "#F27438", "#939597", "#74EC8D", "#8FB43A", "#003C57", "#000000", "#F8D7D7"];

            $us = DB::table('users')->get();
            foreach($us as $us)
            {
                echo"<i>".$us->nom_prenoms."</i>:<span style='background-color:".$t_colour[$us->id].";'>&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;";
            }
        @endphp
    @endcan
    </div>
    <div class="card-body">
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
</div>