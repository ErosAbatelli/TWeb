
@include('helpers/stile')


<div class="top-bar">
    <div class="container">
        <!-- -->
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="logo">
                    <a href="{{ route('Home') }}" title="Home">
                        <p align=”left”>
                            <img src="{{ URL::to('/assets/img/EZ.png') }}" alt="Logo" width="300" height="100" />
                        </p>
                    </a>
                </div>
            </div>

            <div class="col-lg-8 col-md-2 d-none d-lg-block">
                <div class="row">
                    <div class="col-3">

                    </div>

                    <div class="col-9">


                    </div>

                    <div class="col-12">
                        <div class="top-bar-item">

                            <div>
                            
                                        <a href="{{ route('Catalogo') }}" title="Catalogo"> <button class="w3-button w3-black w3-round-xlarge" type="submit" style="border-color:none;">Catalogo</button></a>
                           
                                
                                
                            </div>
                            <div class="top-bar-text"></div>
                            <div class="top-bar-text"></div>

                            <div class="top-bar-icon" style="width: auto; display: flex; flex-direction: column;">
                                    @if(session()->has('utente') && (session('categoria')==2))
                                        <a href="{{route('userpage')}}" title='profile'><i class="fas fa-user fa-2x"></i></a>
                                       

                                    @elseif(session()->has('utente') && (session('categoria')==3))
                                        <a href="{{route('organizzatorePage')}}" title='profile'><i class="fas fa-user fa-2x"></i></a>
                                    @elseif(session()->has('utente') && (session('categoria')==4))
                                    <a href="{{route('adminPage')}}" title='profile'><i class="fas fa-user fa-2x"></i></a>
                                    @else
                                    <i class="fas fa-user fa-2x"></i>
        
                                    @endif
                            </div>
                            <div class="top-bar-text">
                                
                                    @if((session()->has('utente')))
                                        Welcome {{session('nome')}}

                                        @if(session()->has('utente') && (session('categoria')==2))
                                            <br>
                                            <a href="{{route('userpage')}}">Area utente</a>
                                        @endif
                                        @if(session()->has('utente') && (session('categoria')==3))
                                            <br>
                                            <a href="{{route('organizzatorePage')}}">Area utente</a>
                                        @endif
                                        @if(session()->has('utente') && (session('categoria')==4))
                                            <br>
                                            <a href="{{route('adminPage')}}">Area utente</a>
                                        @endif

                                        <br><a href="{{route('Logout')}}" title='Logout'>Logout</a>
                                            
                                    @else 
                                        <a href="{{route('Login')}}" title='Login'>Accedi/Registrati</a> 
                                
                                    @endif

                                    
                                    
                                    
                                    
             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
