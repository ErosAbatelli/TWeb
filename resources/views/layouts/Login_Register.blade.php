<!DOCTYPE html>

<head>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login_register.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @include('helpers/topBar')
</head>


<body style="background-color: currentColor;">
    <div class="hero">

        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()" style="border: none;">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()" style="border: none;">Register</button>
            </div>

            <form id="login" method="POST" class="input-groupAccedi" action="{{ url('/login')}}" style="border-color: black;">
                {{csrf_field()}}
                <div class="logo2TWEB">
                    <img src="{{ URL::to('/assets/img/favi_ticket.jpg') }}" alt="" class="centerlogo">
                    <p></p>
                </div>
                <input type="text" class="input-field" placeholder="Username" required name="nome_utente">
                <input type="password" class="input-field" placeholder="Password" required name="password">
                <input type="hidden" value="login" name="flag">
                <p></p>
                <button type="submit" class="submit-btn">Accedi</button>
                <p></p>
                @if(isset($error))
                <br>
                <p style="color: red ; font-size: 20px; text-align: center">{{$error}}</p>
                @endif
            </form>

            <form method="POST" id="register" class="input-groupRegistrati" action="{{ url('/login')}}">
                {{csrf_field()}}
                <p></p>
                <input type="text" class="input-field" placeholder="Username" required name="nome_utente">
                <input type="text" class="input-field" placeholder="Nome" required name="nome">
                <input type="text" class="input-field" placeholder="Cognome" required name="cognome">
                <input type="email" class="input-field" placeholder="e-mail" required name="email">
                <input type="password" class="input-field" placeholder="Password" id="passwordID" required name="password">
                <input type="password" class="input-field" placeholder="Conferma Password" id="confirmPw" required>
                <input type="hidden" value="register" name="flag">
                <p></p>
                <button type="submit" class="submit-btn">Registrati</button>
            </form>
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


        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>

    @include('helpers/footer')

</body>

</html>