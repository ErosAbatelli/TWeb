<!DOCTYPE html>

<html>

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/userProfile.css') }}">

    </head>

    @include('helpers/topBar')


    <body>
        <script type="text/javascript">
            function check()
            {
                var p_biglietto = document.getElementById('prezzo_biglietto').value;
                var n_b = document.getElementById('n_biglietti').value;

                /* Controllo prezzo biglietto */
                if (p_biglietto < 0 || p_biglietto == 0)
                {
                    res = '*Errore nel prezzo del biglietto! Ci vogliamo guadagnare, non perdere ;)';

                    if (p_biglietto == 0 || p_biglietto == "")
                    {
                        res = '*Seleziona un prezzo!';

                    }
                    event.preventDefault();
                    document.getElementById('res').innerText = res;
                }else {
                res = '';
                event.preventDefault();
                document.getElementById('res').innerText = res;
            }
            



                if (n_b < 0 || n_b == "")
                {
                    ras = '*Errore nel numero dei biglietti';

                    if (n_b == "")
                    {
                        ras = '*Inserisci un numero di biglietti';

                    }
                    event.preventDefault();
                    document.getElementById('ras').innerText = ras;
                }else {
                ras = '';
                event.preventDefault();
                document.getElementById('ras').innerText = ras;
            }



            }
        </script>

        <form id="edit" method="POST" action="{{ route('ApplicaModifiche') }}" name="modulo">
            @csrf
            <div class="container">
                <div class="main">
                    <div class="col-md-8 mt-1" style="max-width: initial;">
                        <div class="card mb-3 content">
                            <h1 class="m-3 pt-3" style="align-self: center;">Modifica evento</h1>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Nome evento</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="hidden" style="width: 350px;" class="input-field" value="{{ $evento->cod_evento }}" name="cod_evento">
                                        <input type="text" id="nome_evento" style="width: 350px;" class="input-field" value="{{ $evento->nome_evento }}" name="nome_evento">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Organizzatore</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        {{ $evento->organizzatore }}
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Regione</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <select id="regione" name="regione" required>
                                            <option value="0" selected="selected">Seleziona la regione</option>
                                            <?php
                                            $reg = DB::table('regioni')->get();
                                            foreach ($reg as $r) {
                                                echo '<option value = "' . $r->id . '">' . $r->regione . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Provincia</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <select id="provincia" name="provincia" required>
                                            <option value="0" selected="selected">Seleziona la provincia</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Comune</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <select id="comune" name="comune" required>
                                            <option value="0" selected="selected">Seleziona il comune</option>
                                        </select>
                                    </div>
                                </div>


                                <script>
                                    $(document).ready(function () {


                                        $('#regione').on('change', function () {

                                            codRegione = $(this).val();
                                            if (codRegione != 0) {
                                                $.ajax({
                                                    type: 'POST',
                                                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                    url: '{{route("filtra")}}',
                                                    data: ({_token: $('meta[name="csrf-token"]').attr('content'), codRegione: codRegione}),
                                                    success: function (rispostahtml) {
                                                        $('#provincia').html(rispostahtml);
                                                        $('#comune').html('<option value="">Seleziona il comune</option>');
                                                    }
                                                });
                                            } else {
                                                $('#provincia').html('<option value="">Seleziona la Provincia</option>');
                                                $('#comune').html('<option value="">Seleziona il Comune </option>');
                                            }
                                        });

                                        $('#provincia').on('change', function () {

                                            codProvincia = $(this).val();
                                            if (codProvincia != 0) {
                                                $.ajax({
                                                    type: 'POST',
                                                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                    url: '{{route("filtra")}}',
                                                    data: ({_token: $('meta[name="csrf-token"]').attr('content'), codProvincia: codProvincia}),
                                                    success: function (rispostahtml) {
                                                        $('#comune').html(rispostahtml);
                                                    }
                                                });
                                            } else {
                                                $('#comune').html('<option value="">Seleziona il Comune</option>');
                                            }
                                        });
                                    });
                                </script>

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Indirizzo (Formato: Via e Numero civico, Arena, Stadio, etc.)</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" style="width: 350px;" class="input-field"
                                               value="{{ $evento->indirizzo }}" name="indirizzo" id="indirizzo">
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Data</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="datetime-local" id="datefield" name="data"
                                               value="{{$evento->data}}"
                                               max="2027-10-30" class="input-medium search-query"
                                               onkeypress="return false" required>
                                    </div>

                                    <script>

                                        var today = new Date();
                                        var dd = today.getDate() + 1;
                                        var mm = today.getMonth() + 1; //Gennaio ?? 0!
                                        var yyyy = today.getFullYear();
                                        var hh = today.getHours();
                                        var mm = today.getMinutes();
                                        var x = document.getElementById("datefield").value;


                                        if (dd < 10) {
                                            dd = '0' + dd
                                        }
                                        if (mm < 10) {
                                            mm = '0' + mm
                                        }

                                        today = yyyy + '-' + mm + '-' + dd + 'T' + hh + ':' + mm;
                                        document.getElementById("datefield").setAttribute("min", today);
                                    </script>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Descrizione</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" style="width: 350px;" class="input-field" value="{{ $evento->descrizione }}" name="descrizione" id="desc">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Programma</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <textarea rows="4" cols="60" class="input-field" style="width: 350px;" id="prog" name="programma">{{ $evento->programma }} </textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Prezzo biglietto</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="number" style="width: 350px;" id="prezzo_biglietto" class="input-field" value="{{ $evento->prezzo_biglietto }}" id="prezzo_biglietto" name="prezzo_biglietto">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Biglietti rimasti</h5>
                                    </div>
                                    <?php
                                    $biglietti_rimasti = $evento->n_biglietti - $evento->n_b_venduti;
                                    ?>
                                    <div class="col-md-9 text-secondary">
                                        <input type="number" style="width: 350px;" id="n_biglietti" class="input-field" value="{{ $biglietti_rimasti }}" id="biglietti_rimasti" name="biglietti_rimasti">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Sconto Last-Minute</h4>
                                        <h5>(Lo sconto viene applicato nei 3 giorni precedenti all'evento)</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="number" style="width: 100px;" class="input-field" value="{{ $evento->sconto }}" id="sconto" name="sconto">  %
                                    </div>
                                </div>


                                <hr>
                                <button type="submit" class="submit-btn" onclick="check()" >Applica Modifiche</button>
                                <hr>
                                <h4 style="color: red; text-align: center;" id="nomeE"></h4>
                                <h4 style="color: red; text-align: center;" id="reg"></h4>
                                <h4 style="color: red; text-align: center;" id="luo"></h4>
                                <h4 style="color: red; text-align: center;" id="com"></h4>
                                <h4 style="color: red; text-align: center;" id="indi"></h4>
                                <h4 style="color: red; text-align: center;" id="da"></h4>
                                <h4 style="color: red; text-align: center;" id="des"></h4>
                                <h4 style="color: red; text-align: center;" id="pro"></h4>
                                <h4 style="color: red; text-align: center;" id="ras"></h4>
                                <h4 style="color: red; text-align: center;" id="res"></h4>
                                <h4 style="color: red; text-align: center;" id="scon"></h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function check() {
            var p_biglietto = document.getElementById('prezzo_biglietto').value;
            var n_b = document.getElementById('n_biglietti').value;
            var nomeE = document.getElementById('nome_evento').value;
            var luogo = document.getElementById('provincia').value;
            var regione = document.getElementById('regione').value;
            var comune = document.getElementById('comune').value;
            var indirizzo = document.getElementById('indirizzo').value;
            var datefield = document.getElementById('datefield').value;
            var desc = document.getElementById('desc').value;
            var prog = document.getElementById('prog').value;
            var scon = document.getElementById('sconto').value;



            if ((scon > 100) || (scon < 0)) {
                scon = '*Inserire una percentuale di sconto valida';
                event.preventDefault();
                document.getElementById('scon').innerText = scon;
            } else {
                scon = '';
                event.preventDefault();
                document.getElementById('scon').innerText = scon;
            }
            if (desc == "") {
                desc = '*Inserisci una breve descrizione';
                event.preventDefault();
                document.getElementById('des').innerText = desc;
            } else
            {
                desc = '';
                event.preventDefault();
                document.getElementById('des').innerText = desc;
            }

            if (prog == "") {
                prog = '*Inserisci un programma';
                event.preventDefault();
                document.getElementById('pro').innerText = prog;
            } else {
                prog = '';
                event.preventDefault();
                document.getElementById('pro').innerText = prog;
            }



            if (datefield == "") {
                da = '*Inserisci una data e orario';
                event.preventDefault();
                document.getElementById('da').innerText = da;
            } else {
                da = '';
                event.preventDefault();
                document.getElementById('da').innerText = da;
            }



            if (luogo == "") {
                luo = '*Inserisci la provincia';
                event.preventDefault();
                document.getElementById('luo').innerText = luo;
            } else {
                luo = '';
                event.preventDefault();
                document.getElementById('luo').innerText = luo;
            }
            if (comune == "") {
                com = '*Inserisci il comune';
                event.preventDefault();
                document.getElementById('com').innerText = com;
            } else {
                com = '';
                event.preventDefault();
                document.getElementById('com').innerText = com;

            }



            if (regione == "") {
                reg = '*Inserisci la regione';
                event.preventDefault();
                document.getElementById('reg').innerText = reg;
            } else {
                reg = '';
                event.preventDefault();
                document.getElementById('reg').innerText = reg;
            }



            if (indirizzo == "") {
                indirizzo = "*Inserisci l'indirizzo";
                event.preventDefault();
                document.getElementById('indi').innerText = indi;
            } else {
                indirizzo = '';
                event.preventDefault();
                document.getElementById('indi').innerText = indi;
            }



            if (nomeE == "") {
                nomeEvento = '*Inserisci il nome evento';
                event.preventDefault();
                document.getElementById('nomeE').innerText = nomeEvento;
            } else {
                nomeEvento = '';
                event.preventDefault();
                document.getElementById('nomeE').innerText = nomeEvento;
            }



            /* Controllo prezzo biglietto */
            if (p_biglietto < 0 || p_biglietto == 0) {
                res = '*Errore nel prezzo del biglietto! Ci vogliamo guadagnare, non perdere ;)';



                if (p_biglietto == 0 || p_biglietto == "") {
                    res = '*Seleziona un prezzo!';



                }
                event.preventDefault();
                document.getElementById('res').innerText = res;
            } else {
                res = '';
                event.preventDefault();
                document.getElementById('res').innerText = res;
            }





            if (n_b < 0 || n_b == "") {
                ras = '*Errore nel numero dei biglietti';



                if (n_b == "") {
                    ras = '*Inserisci un numero di biglietti';



                }
                event.preventDefault();
                document.getElementById('ras').innerText = ras;
            } else {
                ras = '';
                event.preventDefault();
                document.getElementById('ras').innerText = ras;
            }
        }

    </script>


    <!-- Footer Start-->

    @include('helpers/footer')

    <!-- Footer End-->

</body>

</html>
