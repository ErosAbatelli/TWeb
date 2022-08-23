
<!DOCTYPE html>

<head>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/userProfile.css') }}">

    @include('helpers/topBar')
</head>


<body>
        
@if(isset($events))
<div class="container">
                <div class="main">
                        <div class="topbar">
        
                                <a href="{{ route('userpage') }}">Area Utente</a>
                                
                        </div>
                </div>
                
                @foreach($orders as $order)
                <?php
                foreach($events as $_event){
                    if($_event->cod_evento==$order->evento)
                    {
                        $event = $_event;
                    }
                }
                ?>
                <div class='catalogo_list'>
                <div class='evento'>
                    
                    <div class='evento_dettagli' style="color :aliceblue"> 

                    
                        <p class='nome_evento'>Evento : {{$event->nome_evento}}</p>
                        <p>Prezzo biglietto : € {{ $event->prezzo_biglietto }}</p>

                        <p class='organizzatore'>Organizzatore : {{$event->organizzatore}}</p>
                        <p class='luogo'>Luogo : {{$event->luogo}}</p>
                        <p class='data'>Data: {{($event->data)}} </p>
                    </div>
                </div>
            </div>
        @endforeach


</div>
@else
<hr>
<h3 style="text-align: center; font-family: unset;">Nessun biglietto acquistato!</h3>

@endif

@include('helpers/footer')
    
</body>

</html>
