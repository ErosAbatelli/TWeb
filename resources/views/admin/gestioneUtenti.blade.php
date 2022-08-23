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
                            
                            @foreach ($utenti as $utente)
                                    <p class='userItem'>
                                        {{$utente->nome}}
                                        <a href="{{route('deleteUser',[$utente->nome_utente])}}" style='float : right;padding-right:10px;'>
                                        <button onclick="return confirm('Cancellare definitivamente?');" style='background-color: #f44336; margin-top: -3px; border-radius: 3px;'>Elimina</button></a>
                                        </p>
                            @endforeach

                            <span style="margin: auto">
                                {{ $utenti->links() }}
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
        </div>
    @else
    <p style="margin-left:40%">EHHHH VOLEVI! Registrati prima</p>
    <img src="{{ URL::to('/assets/img/zeb.jpg') }}" height="500px" width="900px" style="margin-left: 15%">


    @endif

    @include('helpers/footer')


</body>


</html>


