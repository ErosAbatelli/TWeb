<!DOCTYPE html>



<html>



@include('helpers/stile')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>
let map;
let service;
let infowindow;



function initMap() {
 //const city = new google.maps.LatLng({{$evento->lat}}, {{$evento->lon}});
    infowindow = new google.maps.InfoWindow();
    map = new google.maps.Map(document.getElementById("map"), {
        //center: city,
        zoom: 15,
    });
    const request = {
        query: "{{$evento->luogo}},{{$evento->comune}},{{$evento->indirizzo}}",
        fields: ["name", "geometry"],
    };
    service = new google.maps.places.PlacesService(map);
    service.findPlaceFromQuery(request, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && results) {
            for (let i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
            map.setCenter(results[0].geometry.location);
        }
    });
}

function createMarker(place) {
    if (!place.geometry || !place.geometry.location) return;
    const marker = new google.maps.Marker({
        map,
        position: place.geometry.location,
    });
    google.maps.event.addListener(marker, "click", () => {
        infowindow.setContent(place.name || "");
        infowindow.open(map);
    });
}
</script>




<body>
	<div class="wrapper">
		<!-- Top Bar Start -->
		@include('helpers/topBar')
		<!-- Top Bar End -->
		<?php
                    session(['progressive_flag' => 1]);
                    $timezone = date_default_timezone_get();
                    $d= date_create($evento->data);
                    $t =date_create($timezone);

                    $interval = date_diff($d, $t)->format('%a');
                    if(($interval) <3 ){

                       $importo_tot = ((($evento->prezzo_biglietto)*1)-((($evento->prezzo_biglietto)/100)*($evento->sconto)));
                    }else{
                       $importo_tot = (($evento->prezzo_biglietto)*1);
                    }
                ?>

		<div class="dettagli_evento" style="border-radius:20px; border-color:black;">
			<div class="evento_contenuto">
				<div id="map" class="posizione" style="float: right; margin-right : 50px; margin-top: 30px; height: 400px; width: 400px;"></div>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdI_MSfrIefIF8NohjeAWqsQB6kkEp9I&callback=initMap&libraries=places&v=weekly" async></script>
                                <div class="evento_dettagli" style="color: aliceblue;">
					<h2 style="text-align: left; color : #ffc107;">
						INFORMAZIONI SULL'EVENTO
					</h2>
					<hr width="300px">



					<p><b>Nome Evento</b>: {{ $evento->nome_evento }}</p>
					<p> <b>Organizzato da</b>: {{ $evento->organizzatore }}</p>
					<p><b>Regione</b>: {{ $evento->regione }}</p>
          @if($evento->luogo  == $evento->comune )
					<p><b>Luogo</b>: {{ $evento->luogo }}, {{ $evento->indirizzo }}</p>
          @else
          <p><b>Luogo</b>: {{ $evento->luogo }}, {{ $evento->comune }}, {{ $evento->indirizzo }}</p>
          @endif
				<p><b>Data</b>:
            <?php
                $time = strtotime($evento->data);
                $data = date("d/m/Y", $time);
                $ora = date("H:i",$time);
                echo $data;
                echo " alle ore: ";
                echo $ora;
            ?>
        </p>
					<p><b>Descrizione </b>: {{ $evento->descrizione }}</p>
					<p><b>Programma </b>: {{ $evento->programma }}</p>


                                        @if(($interval<3)&&($evento->sconto > 0))
                                        <p style="display : inline"><b>Costo biglietto : <span style="text-decoration: line-through;">{{$evento->prezzo_biglietto}}€</span>  <span style="font-size : 25px;color : yellow">{{$importo_tot}}€ </span></b></p>
                                        <p style="display : inline; margin-left: 20px">&#8592; Sconto del {{$evento->sconto}}%</p>
                                        @else
                                        <p><b>Costo biglietto : <span style="font-size : 20px">{{$importo_tot}}€ </span></b></p>
                                        @endif


					<p><b>Parteciperanno all'evento: {{$evento->partecipazioni}} persone/a</b></p>

					<br>


				</div>




				@if((session('utente')!=null)&&(session('categoria')==2))
				<?php
				$partecipazione = DB::table('partecipazione')
					->where('utente', 'like', session('utente'))
					->where('evento', '=', $evento->cod_evento)->first();

				?>
				@if($partecipazione==null)
				Parteciperò: <a href="{{ route('partecipa', [$evento->cod_evento]) }}" class="square_btn" style="border-color: orange;"><i class="glyphicon glyphicon-ok"></i></a>
				@else
                                <p style="font-size: 20px;color:#ffc107">Parteciperai a questo evento &#9996;</p>
                                @endif
				<p></p>
				<p></p>
				<a href="{{ route('payment', [$evento->cod_evento]) }}" class="part_line"><i class="fa fa-caret-right"></i>Acquista Biglietto</a>
				@endif

				@if((session()->has('utente'))&&(session('categoria')==3)&&($evento->organizzatore==session('utente')))
				<?php
        $ords= DB::table('ordine')->where('evento','=',$evento->cod_evento)->get();
        $incassotot=0;
        foreach ($ords as $ord) {
          $incassotot += $ord->importotot;
        }
        //echo $ords;
				echo "<br><br><hr><div style='text-align : center'>"
					. "<p style='font-size : 25px; text-decoration: underline;'> STATISTICHE EVENTO </p>"
					. "<br>";
				echo "<p><b>Biglietti venduti </b>: " . $evento->n_b_venduti . "/" . $evento->n_biglietti . "</p><br>";
				if ($evento->n_biglietti == 0) {
					echo "<p><b>Percentuale Biglietti venduti </b>: 0% </p><br>";
				} else {
					echo "<p><b>Percentuale Biglietti venduti </b>: " . ($evento->n_b_venduti * 100) / $evento->n_biglietti . "%</p><br>";
				}
				echo "<p><b>Incasso totale </b>: " . $incassotot . "€</p><br>";
				echo "</div>";
				?>
				@endif
			</div>
		</div>



		<!-- Footer Start-->



		@include('helpers/footer')



		<!-- Footer End-->



	</div>
</body>



</html>
