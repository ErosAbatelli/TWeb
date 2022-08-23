<!DOCTYPE html>

<html>

@include('helpers/stile')



<body>
    <!-- Top Bar Start -->
    @include('helpers/topBar')
    <!-- Top Bar End -->


    @if($events->isEmpty())
        <h5 style="text-align: center;font-size: x-large; margin-top: revert;">Nessun evento registrato</h5>
    @endif

    @foreach($events as $event)
        
        <div class='catalogo_list'>
            <div class='evento'>
                <div class='immagine_evento' style='float : left; margin-right : 50px'><img src="{{$event->url_img}}"  border-color: #ffc107' height='180' width='180'> </div>
                <div class='evento_dettagli' style="color: #fff;">
                    <h3 style='color : #ffc107;'>
                        {{$event->nome_evento}}
                        <p style='font-style : italic'><small style='color : #ffc107'>Organizzatore: {{$event->organizzatore}}</small></p>
                    </h3>
                    <p class='prezzo'>Prezzo biglietto : ${{$event->prezzo_biglietto}}</p>
                    <p class='partecipanti'>{{($event->n_biglietti)-($event->n_b_venduti)}} Biglietti Rimanenti</p>

                    <a href="{{ route('InfoEvento',[$event->cod_evento]) }}"> <button class='w3-button w3-black w3-round-xlarge'>Dettagli</button> </a>
                    <a href="{{ route('editEvento',[$event->cod_evento]) }}"> <button class='w3-button w3-black w3-round-xlarge'>Modifica</button> </a>
                    <a href="{{ route('deleteEvent',[$event->cod_evento]) }}"> <button onclick="return confirm('Cancellare definitivamente?');" class='w3-button w3-black w3-round-xlarge'>Cancella Evento</button> </a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Start FOOTER -->
    @include('helpers/footer')

</body>

</html>