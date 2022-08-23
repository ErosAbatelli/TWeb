<html>



<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/userProfile.css') }}">
</head>


@include('helpers/topBar')

<body>

    @if((session('categoria') == 4))


    <div class="container">
        <div class="main">
            <div class="topbar" style="font-size: large;">
                <p style="color: white; margin-top: revert; text-align: center">PAGINA AMMINISTRATORE</p>
            </div>
            <div class="row">

                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="card-body">

                            <a href="{{route('userList')}}">Gestione Utenti</a>

                            <hr>
                            <a href="{{route('orgList')}}">Gestione Organizzatori</a>

                            <hr>
                            <a href="{{route('Faq')}}">Gestione FAQ</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mt-1">
                    <div class="card-body">
                        <form style="background-color: #fdbe33; padding: 20px; border-radius: 7px; border: solid;   border-color: darkgrey;" action="{{route('newOrg')}}" method="post">
                            @csrf
                            <p style="text-align: center;"> AGGIUNGI ORGANIZZATORE</p>
                            <input style="margin: 5px;" type="text" name="nome_utente" required placeholder="Nome Utente">
                            <input style="margin: 5px;" type="text" name="nome" required placeholder="Nome Organizzatore">
                            <input style="margin: 5px;" type="email" name="email" required placeholder="E-Mail"><br>
                            <input style="margin: 5px;" type="digit" maxlength="10" name="telefono" required placeholder="Telefono">
                            <input style="margin: 5px;" type="text" name="password" required placeholder="Password">
                            <input style="margin: 5px; float: right; margin-right: 40px; border-radius:5px; background: black; color: white; border-color: black;" type="submit" value="Crea profilo">
                        </form>
                        @if(isset($message))
                            <br>
                            <p style="color: red ; font-size: 20px; text-align: center">{{$message}}</p>
                        @endif
                        <hr><hr>
                        <h3 style="text-align: center; font-family: unset;">Lista Organizzatori</h3>
                        @if(isset($message1))
                            <p style="color: red ; font-size: 20px; text-align: center">{{$message1}}</p>
                        @else
                            <h5 style="text-align: center; font-family: unset; color:red;">*ATTENZIONE: Cancellare un utente comporterà l'eleminazione di tutti i suoi eventi, quindi non saranno visibili sul catalogo.</h5>
                        @endif

                        <hr>
                        @if(!isset($_GET["action"]))
                        @foreach ($organizzatori as $organizzatore)

                        <p class='userItem'> {{$organizzatore->nome}}
                            <a href="{{route('deleteUser',[$organizzatore->nome_utente])}}" style='float : right;padding-right:10px;'>
                                <button onclick="return confirm('Cancellare definitivamente?');" style='background-color: #f44336; margin-top: -3px; border-radius: 3px;'>Elimina</button></a>
                            <a href='gestioneOrganizzatori?user={{$organizzatore->nome_utente}}&action=2' style='float : right;padding-right:10px'>
                                <button style='background-color: grey; margin-top: -3px; border-radius: 3px;'>Modifica</button></a>
                            <a href='gestioneOrganizzatori?user={{$organizzatore->nome_utente}}&action=1' style='float : right;padding-right:10px'>
                                <button style='background-color: white; margin-top: -3px; border-radius: 3px;'>Info</button></a>
                        </p>
                        @endforeach

                        <span style="margin: auto">
                            {{ $organizzatori->links() }}
                        </span>



                        <style>
                            .w-5 {
                                display: none
                            }



                            .pagination {
                                margin-left: 30%;
                                margin-top: 70px;
                                margin-bottom: 10px;
                            }
                        </style>

                        @else
                        @if($_GET["action"]==1)
                        <div class="userItem">
                            <?php
                            $org = DB::table('utente')
                                ->where('nome_utente', 'like', $_GET["user"])->first();
                            $events = DB::table('evento')->where('organizzatore', 'like', $_GET["user"])->get();
                            $totIncasso = 0;
                            $totBiglietti = 0;
                            foreach ($events as $event) {
                                $ords = DB::table('ordine')->where('evento','=',$event->cod_evento)->get();
                                foreach($ords as $ord){
                                    $totIncasso += $ord->importotot;
                                    $totBiglietti += $ord->n_biglietti;
                                }
                            }
                            echo "Nome Organizzatore : <b>" . $org->nome . "</b>";
                            echo "<br><br><br>TOTALE INCASSO : " . $totIncasso . "€";
                            echo "<br><br><br>BIGLIETTI VENDUTI : " . $totBiglietti;
                            ?>

                        </div>
                        @endif

                        @if($_GET["action"]==2)
                        <?php
                        $org = DB::table('utente')
                            ->where('nome_utente', 'like', $_GET["user"])->first();
                        ?>
                        <div>
                            <form action="{{route('editOrganizzatore')}}" method="post">
                                @csrf
                                <input type="hidden" name="nome_utente" value="{{$org->nome_utente}}"><br>
                                <label style="padding-top : 20px" for="nome">Nome Organizzatore :</label>
                                <input type="text" name="nome" value="{{$org->nome}}" required><br>
                                <label style="padding-top : 20px" for="email">E-Mail :</label>
                                <input type="email" name="email" value="{{$org->email}}" required><br>
                                <label style="padding-top : 20px" for="telefono">Telefono :</label>
                                <input type="text" name="telefono" value="{{$org->telefono}}" required><br>
                                <label style="padding-top : 20px" for="password">Password :</label>
                                <input type="text" name="password" value="{{$org->password}}" required><br>
                                <input type="submit" value="Modifica">
                                <!--  nome email telefono pass -->
                            </form>
                        </div>

                        @endif
                        @endif
                        <style>
                            .userItem {
                                padding: 15px;
                                border: groove;
                                border-radius: 10px;
                            }
                        </style>
                    </div>


                </div>


            </div>
        </div>
    </div>
    @else
    <p style="margin-left:40%">EHHHH VOLEVI! Registrati prima</p>
    <img src="{{ URL::to('/assets/img/zeb.jpg') }}" height="500px" width="900px" style="margin-left: 15%">


    @endif

    @include('helpers/footer')


</body>


</html>
