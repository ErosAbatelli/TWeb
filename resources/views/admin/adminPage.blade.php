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
                                <a href="{{route('Faq') }}">Gestione FAQ</a>
                            </div>
                        </div>
                    </div>
                      
                    <div class="col-md-8 mt-1" style="margin: auto;">
                        <div class="card mb-3 content" style="font-size: x-large; align-items: center;">
                        <hr>
                            Benvenuto Amministratore {{session('nome')}}
                            <hr>
                            <img src="{{ URL::to('/assets/img/favi_ticket.jpg') }}" class="rounded-circle" width="100">  
                            <hr>                               
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