<!DOCTYPE html>
<?php
        if (($evento->n_biglietti - $evento->n_b_venduti) == 0) {
            session()->pull('progressive_flag');
        }


        ?>

<html>
@include('helpers/stile')

<body>
    <div class="wrapper">
        <!-- Top Bar Start -->
        @include('helpers/topBar')
        <!-- Top Bar End -->

        @if((session('utente') != null))

        @if(($evento->n_biglietti - $evento->n_b_venduti)>0)

        <!--Payment options Start-->
        <div class="payment">
            <div class="container">
                <div class="section-header text-center">
                    <div style="margin-top: 40px">
                        <h2 style="font-size : 40px">
                            Modalità di pagamento
                        </h2>
                    </div>
                    <div style="margin-top: 20px">
                        <p style="font-size: 20px"> Inserisci i dati della carta e procedi al pagamento</p>
                    </div>

                    <?php

                        $timezone = date_default_timezone_get();
                        $d = date_create($evento->data);
                        $t = date_create($timezone);

                        $interval = date_diff($d, $t)->format("%a");

                        if(($interval) <3 ){
                           $importo_tot = ((($evento->prezzo_biglietto)*1)-((($evento->prezzo_biglietto)/100)*($evento->sconto)));
                        }else{
                           $importo_tot = (($evento->prezzo_biglietto)*1);
                        }
                    ?>
                    <p style="margin-top: 40px; color: #0099ff">Importo Totale: {{$importo_tot}}€</p>
                    <a></a>



                    <form action="/riepilogo.php" style="padding-top:40px" style="text-align: center; margin-top:40px">





                        <label style="margin-right: 50px"><img src="{{ URL::to('assets/img/visa.jpg') }}" width="100px" height="60px"> <br><input required type="radio" name="method" value="visa"></label>
                        <label style="margin-right: 50px"> <img src="{{ URL::to('assets/img/mastercard.png') }}" width="100px" height="60px"><br><input required id="lf" type="radio" name="method" value="mstrcrd"></label>
                        <label style="margin-right: 50px"><img src="{{ URL::to('assets/img/paypall.jpg') }}" width="100px" height="60px"> <br><input required type="radio" name="method" value="ppal"></label>
                        <br>
                        <label style=" margin-top:20px"> Numero Carta: <input required rows="1" cols="16" type="text" maxlength="16"></label>
                        <br>
                        <label style=" margin-top:20px"> Scadenza: <input required rows="1" cols="2" type="month"></label>
                        <label style="margin-left: 50px"> CVV: <input required rows="1" cols="3" type="text" maxlength="3" width="80px"></label>
                        <hr>
                        <a class="square_btn3" style="align-content: center;" href="{{ route('showRiepilogo',[$evento->cod_evento]) }}">Compra</a>






                    </form>







                </div>
            </div>
        </div>



        @else



        <div>
            <p style="text-align: center; font-size: 30px;">BIGLIETTI ESAURITI :( </p>
        </div>



        @endif



        @else
        <p style="margin-left:40%">EHHHH VOLEVI! Registrati prima</p>
        <img src="{{ URL::to('/assets/img/zeb.jpg') }}" height="500px" width="900px" style="margin-left: 15%">
        @endif
        @include('helpers/footer')
        <!-- Footer -->
    </div>



</body>





</html>
