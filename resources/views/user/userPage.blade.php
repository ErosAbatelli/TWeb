<html>

<head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/userProfile.css') }}">
</head>


@include('helpers/topBar')

<body>

        @if(session('utente') != null)
        @if(session('categoria')!=2)
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        PAGINA NON DISPONIBILE
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        @else
        <form id="update" method="POST" action="{{ route('ModificaProfil') }}">
                <div class="container">
                        <div class="main">
                                <div class="topbar">
                                        @if(isset($_GET["action"]))
                                        <a href="userpage">Annulla Modifiche</a>
                                        <a></a>
                                        @else
                                        <a href="userpage?action">Modifica Profilo</a>
                                        <a href="{{ route('bigliettiAcquistati') }}">Visualizza Biglietti Acquistati</a>
                                        @endif
                                </div>
                                <div class="row">

                                        <div class="col-md-4 mt-1">
                                                <div class="card text-center sidebar">
                                                        <div class="card-body">
                                                                <img src="{{ URL::to('/assets/img/favi_ticket.jpg') }}" class="rounded-circle" width="150" style="padding-top: 150px;">

                                                                <div class="mt-3">
                                                                        <h3>{{session('utente')}}</h3>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="col-md-8 mt-1">
                                                <div class="card mb-3 content">
                                                        <h1 class="m-3 pt-3">Informazioni Utente</h1>
                                                        <?php
                                                            if(isset($message)){
                                                                echo "<p style='text-align : center; font-size : 20px ; color : red;'> ". $message ." </p>";
                                                            }

                                                        ?>
                                                        <div class="card-body">
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Nome</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                @if(isset($_GET["action"]))

                                                                                @csrf
                                                                                <input type="hidden" name="utente" value="{{session('utente')}}">

                                                                                <input type="text" class="input-field" value="{{session('nome')}}" name="nome" required>





                                                                                @else
                                                                                {{session('nome')}}
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Cognome</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                @if(isset($_GET["action"]))
                                                                                <input type="text" class="input-field" value="{{session('cognome')}}" name="cognome" required>

                                                                                @else
                                                                                {{session('cognome')}}
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Email</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                @if(isset($_GET["action"]))

                                                                                    <input type="email" class="input-field" value="{{session('email')}}" name="email" required>

                                                                                @else
                                                                                {{session('email')}}
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Data di nascita</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                @if(isset($_GET["action"]))

                                                                                <input type="date" id="datefield" max="2023-04-20" min="1950-04-01" class="input-field" value="{{session('data_nascita')}}" name="data_nascita"  class="input-medium search-query" onkeypress="return false">
                                                                                <script>
                                                                                        var today = new Date();
                                                                                        var dd = today.getDate() + 1;
                                                                                        var mm = today.getMonth() + 1; //Gennaio è 0!
                                                                                        var yyyy = today.getFullYear() - 14;


                                                                                        if (dd < 10) {
                                                                                                dd = '0' + dd
                                                                                        }
                                                                                        if (mm < 10) {
                                                                                                mm = '0' + mm
                                                                                        }

                                                                                        today = yyyy + '-' + mm + '-' + dd;
                                                                                        document.getElementById("datefield").setAttribute("max", today);
                                                                                </script>
                                                                                @else
                                                                                <?php
                                                                                $time = strtotime(session('data_nascita'));
                                                                                $data = date("d/m/Y", $time);
                                                                                echo $data;
                                                                                ?></p>
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Cellulare</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                @if(isset($_GET["action"]))
                                                                                <input type="digit" maxlength="10" class="input-field" value="{{session('telefono')}}" name="telefono">

                                                                                @else
                                                                                {{session('telefono')}}
                                                                                @endif
                                                                        </div>
                                                                </div>



                                                                @if(isset($_GET['action']))
                                                                <hr>
                                                                <div class="row">
                                                                        <div class="col-md-3">
                                                                                <h5>Modificare la password?</h5>
                                                                        </div>


                                                                        <div class="col-md-9 text-secondary">

                                                                                <label class="switch">
                                                                                        <input type="checkbox" id="myCheckbox" onchange="toggleCheck()">
                                                                                        <span class="slider round"></span>
                                                                                </label>




                                                                        </div>
                                                                </div>

                                                                <script>
                                                                        function toggleCheck() {
                                                                                if (document.getElementById("myCheckbox").checked === true) {

                                                                                        document.getElementById("pw").style.display = "flex";
                                                                                        document.getElementById("pw2").style.display = "flex";


                                                                                        document.getElementById("myCheckbox").disabled = true;
                                                                                        document.getElementById("passwordID").required = true;
                                                                                        document.getElementById("passwordID").value = '';
                                                                                        document.getElementById("confirmPw").value = '';
                                                                                        document.getElementById("passwordID").placeholder = "Modifica Password";
                                                                                        document.getElementById("confirmPw").placeholder = "Conferma Password";
                                                                                } else {

                                                                                        document.getElementById("passwordID").value;
                                                                                        document.getElementById("confirmPw").value;
                                                                                        document.getElementById("pw").style.display = "none";
                                                                                        document.getElementById("pw2").style.display = "none";

                                                                                }
                                                                        }
                                                                </script>







                                                                <hr>
                                                                <div class="row" id="pw" style="display: none;">
                                                                        <div class="col-md-3">
                                                                                <h5>Password</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                <input type="password" value="{{session('password')}}" class="input-field" id="passwordID" name="password">

                                                                        </div>
                                                                </div>



                                                                <hr>
                                                                <div class="row" id="pw2" style="display: none;">
                                                                        <div class="col-md-3">
                                                                                <h5>Conferma Password</h5>
                                                                        </div>
                                                                        <div class="col-md-9 text-secondary">
                                                                                <input type="password" class="input-field" value="{{session('password')}}" id="confirmPw">




                                                                        </div>
                                                                </div>




                                                                <hr>

                                                                <hr>
                                                                <hr>






                                                                <button type="submit" value="checkPW()" class="submit-btn">modifica</button>

                                                                <script>
                                                                        var password = document.getElementById("passwordID"),
                                                                                confirm_password = document.getElementById("confirmPw");

                                                                        function validatePassword() {
                                                                                if (password.value != confirm_password.value) {
                                                                                        confirm_password.setCustomValidity("Le password non sono uguali!");
                                                                                } else {
                                                                                        confirm_password.setCustomValidity('');
                                                                                }
                                                                        }



                                                                        password.onchange = validatePassword;
                                                                        confirm_password.onkeyup = validatePassword;
                                                                </script>


                                                                @endif


                                                        </div>
                                                </div>


                                        </div>


                                </div>

                        </div>
                </div>

        </form>
        @endif

        @else

        <p style="margin-left:40%">EHHHH VOLEVI! Registrati prima</p>
        <img src="{{ URL::to('/assets/img/zeb.jpg') }}" height="500px" width="900px" style="margin-left: 15%">


        @endif

        @include('helpers/footer')


</body>


</html>
