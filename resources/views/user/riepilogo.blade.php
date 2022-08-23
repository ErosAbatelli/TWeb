<!DOCTYPE html>





<html>
@include('helpers/stile')





<body>
    <div class="wrapper">
        <!-- Top Bar Start -->
        @include('helpers/topBar')
        <!-- Top Bar End -->
        <?php
            session()->pull('progressive_flag');
        ?>


        <div class="payment">
            <div class="container">
                <div class="section-header text-center">
                    <div style="margin-top: 40px">
                        <h2 style="font-size : 40px">
                            Grazie per il tuo acquisto!
                        </h2>
                        <div style="margin-top: 20px">
                            <p style="font-size: 20px; color: black"> Ecco i dati del tuo acquisto:</p>
                            <hr>
                            <p class='userItem' style="color: black;">
                                <br>Nome Evento: {{ $evento->nome_evento }}</br>
                                <br>Organizzato da: {{ $evento->organizzatore }}</br>
                                <br>Regione: {{ $evento->regione }}</br>
                                <br>Luogo: {{ $evento->luogo }}</br>
                                <br>Data: {{ $evento->data }}</br>
                                <br>Codice Ordine: {{ $ordine->cod_ordine}}</br>
                            </p>
                            <style>
                                .userItem{
                                    padding : 15px;
                                    border: groove;
                                    border-radius: 10px;
                                }            
                            </style>
                        </div>
                    </div>
                </div>
            </div>


            @include('helpers/footer')


            <!-- Footer -->
        </div>



    </div>
</body>

</html>