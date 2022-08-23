<!-- Footer Start-->
<hr>

<div class="footer wow fadeIn" data-wow-delay="0.3s">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">
                    <h2>Servizi</h2>
                    <p><i class="fa fa-user"></i>Assistenza Clienti</p>
                    <p style="color : white"><i class="fa fa-map-marker-alt" ></i><a href="{{ route('where') }}" title="where">Dove trovarci</a></p>
                    <p><i class="fa fa-taxi"></i>Tempi di consegna</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">
                    <h2>Chi siamo</h2>
                    <p><i class="fa fa-user"></i>Recapito biglietti</p>
                    <p style="color : white"><i class="fas fa-user-shield"></i><a href="{{ route('who') }}" title="where">Chi siamo</a></p>
                    <p><i class="far fa-thumbs-up"></i>Recensioni</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">
                    <h2>Pagamenti accettati</h2>
                    <img src="{{ URL::to('assets/img/mastercard.png') }}" width="40px" height="30px">
                    <img src="{{ URL::to('assets/img/paypall.jpg') }}" width="40px" height="30px">
                    <img src="{{ URL::to('assets/img/visa.jpg') }}" width="40px" height="30px">

                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">    
                        <h2>Informazioni sito</h2>
                        <p style="color : white"><i class="far fa-comment"></i><a href="{{ route('Faq') }}" title="where">FAQ</a></p>
                        <p style="color : white"><i class="fas fa-book"><a href="{{ URL::to('/assets/pdf/EZ Ticket.pdf') }}" target="_blank"></i>Documentazione descrittiva</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>

<!-- Footer End-->