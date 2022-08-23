<!DOCTYPE html>

<html>

@include('helpers/stile')





<body>
    <!-- Top Bar Start -->
    @include('helpers/topBar')
    <!-- Top Bar End -->



    <!-- Filtri -->
    <div class="catalogo">
        <div class="catalogo_form">
            <?php
            //Get all organizers

                $orgs = DB::table('utente')->where('categoria','=','3')->get();
                session(['progressive_flag' => 1]);

            ?>
            {{ Form::open(array( 'id' => 'ricerca','route' => 'Catalogo')) }}
            <table class="catalogo_form_table">
                <tr>
                    <td class="td_table_catalogo_form" style="vertical-align:top"><label for="descrizione">Descrizione:</label>
                        {{ Form::text('descrizione')}}
                    </td>
                    <td class="td_table_catalogo_form"><label for="organizzatore">Organizzatore:</label>

                        <select name="organizzatore" >
                            <option selected value="">
                                Tutti
                            </option>
                            @foreach($orgs as $org)<!-- comment -->
                                <option value="{{$org->nome_utente}}">{{$org->nome}}</option>
                            @endforeach

                        </select>
                    </td>
                    <td class="td_table_catalogo_form"><label for="data">Data:</label>
                        {{ Form::month('data')}}
                    </td>
                    <td class="td_table_catalogo_form"><label for="luogo">Luogo:</label>
                        {{ Form::text('luogo')}}
                    </td>
                    <td style="text-align:right; padding-left : 30px"> <input type="submit" class="CercaCatalogoBtn" value="Cerca">
                    </td>
                </tr>
            </table>
            {{Form::close()}}



        </div>
        <hr>
        <p style=" font-style : bold">
        <h1 style="text-align : center"> EVENTI </h1>
        </p>
        <hr>

        @forelse($events as $event)
            <div class='catalogo_list'>
                <div class='evento'>
                    <div class='immagine_evento' style='float : left; margin-right : 50px'><img src="{{$event->url_img}}" border-color: #ffc107 height='180' width='180'> </div>
                    <div class='evento_dettagli'>
                        <h3 style='color : #ffc107;'>
                            {{$event->nome_evento}}
                            <p style='font-style : italic'><small style='color : #ffc107'>Organizzatore: {{$event->organizzatore}}</small></p>
                        </h3>

                        <?php
                            $timezone = date_default_timezone_get();
                            $d= date_create($event->data);
                            $t =date_create($timezone);

                            $interval = date_diff($d, $t)->format('%a');
                            if(($interval) <3 ){

                               $importo_tot = ((($event->prezzo_biglietto)*1)-((($event->prezzo_biglietto)/100)*($event->sconto)));
                            }else{
                               $importo_tot = (($event->prezzo_biglietto)*1);
                           }
                        ?>
                        @if(($interval<3)&&($event->sconto > 0))
                        <p class='prezzo'>Prezzo biglietto : ${{$importo_tot}}  <span style="color:yellow">Prezzo Scontato!</span></p>
                        @else
                            <p class='prezzo'>Prezzo biglietto : ${{$event->prezzo_biglietto}}</p>
                        @endif


                        <p class='partecipanti'>{{($event->n_biglietti)-($event->n_b_venduti)}} Biglietti Rimanenti</p>

                        <a href="{{ route('InfoEvento',[$event->cod_evento]) }}"> <button class='w3-button w3-black w3-round-xlarge'>Dettagli</button> </a>

                    </div>
                </div>
            </div>
        @empty
        <p style="text-align: center; font-size : 30px; color : black">Nessun evento trovato<p>
        @endforelse



        <!--Paginazione -->
        <span style="margin: auto">
            {{ $events->links() }}
        </span>

        <style>
            .w-5 {
                display: none
            }

            .pagination {
                margin-left: 45%;
                margin-top: 70px;
                margin-bottom: 10px;
            }


            .ui-datepicker-calendar {
                display: none;
             }

        </style>


    </div>

    <!-- Start FOOTER -->
    @include('helpers/footer')

</body>

</html>
