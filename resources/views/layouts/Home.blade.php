<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('helpers/stile')




    @include('helpers/topBar')


<?php
$events = DB::table('evento')->get()->first();
$eventi = DB::table('evento')->get()->skip(1)->take(3);
?>
    <!-- Carousel Start -->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
            <li data-target="#carousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ $events->url_img }}" alt="Carousel Image">
                <div class="carousel-caption">
                    <h1 class="animated fadeInLeft">{{$events->nome_evento}}</h1>
                    <a class="btn animated fadeInUp" href="{{ route('InfoEvento',[$events->cod_evento]) }}">Visualizza</a>
                </div>
            </div>
            
                @foreach($eventi as $eventis)
            <div class="carousel-item ">
                <img src=" {{$eventis->url_img}} " alt="Carousel Image">
                <div class="carousel-caption">
                    <h1 class="animated fadeInLeft">{{$eventis->nome_evento}}</h1>
                    <a class="btn animated fadeInUp" href="{{ route('InfoEvento',[$eventis->cod_evento]) }}">Visualizza</a>
                </div>
            </div>
                @endforeach

        </div>



        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>



    </div>
    <!-- Carousel End -->



    <!-- Footer Start-->
    <div id="footer">
        @include('helpers/footer')
    </div>



</div>
</body>
</html>
