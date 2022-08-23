<!DOCTYPE html>



<html>
@include('helpers/stile')



<body>
    <div class="wrapper">
        <!-- Top Bar Start -->
        @include('helpers/topBar')
        <!-- Top Bar End -->

        <!--Who Start-->
        <div class="who">
            <div class="container">
                <div class="section-header text-center">
                    <div style="margin-top: 40px">
                        <h2 style="font-size: 45px">A proposito di noi...</h2>
                    </div>
                    <div style="margin-top: 30px">
                        <p style="font-size: 30px">Benvenuto su EZ Ticket</p>
                    </div>
                    <div class="row align-items-center" style="margin-top: 30px">
                        <div class="col-lg-6 col-md-6" style="position: relative" style="margin-right: 10px">
                            <div class="about-img">
                                <img src="assets/img/concerti-torino.jpeg" alt="Image" height="304px" width="465px">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6" style="position: relative">
                            <div class="section-header text-center" style='margin-bottom: 25px'>
                                <h2 style="font-size: 30px">Cos'è EZ Ticket?</h2>
                            </div>
                            <div class="about-text" style="font-style: italic">
                                <p style="color: black" style="font-size: 23px">
                                    Siamo un'organizzazione fondata nell'aprile 2021 con lo scopo prefissato di gestire eventi (musicali e non) e che offra al visitatore un'ampia gamma di possibilità di acquisto o di informazioni relative all'evento di suo interesse.
                                </p>
                                <p style="color: black" style="font-size: 23px">
                                    Leader nel settore, i nostri clienti si sono sempre ritenuti soddisfatti del servizio da noi offerto. Che cosa aspetti? Inizia a prenotare un posto per il tuo concerto dei sogni!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('helpers/footer')
    </div>
</body>

</html>