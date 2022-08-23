<!DOCTYPE html>





<html>





<body>
    <div class="wrapper">
        <!-- Top Bar Start -->
        @include('helpers/topBar')
        <!-- Top Bar End -->



        @if(session('categoria')!=4)
        <!--USER FAQs Start -->
        <div class="faqs">
            <div class="container">
                <div class="section-header text-center">
                    <p style="font-size : 30px">Risposte a domande frequenti</p>
                </div>

                <div id="accordion-2" style="margin : auto">
                    <div class="card wow fadeInRight" data-wow-delay="0.1s">
                        @foreach($faq as $_faq)
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapse{{ $_faq->cod_domanda }}" aria-expanded="false">
                                {{ $_faq->domanda }}
                            </a>
                        </div>

                        <div id="collapse{{ $_faq->cod_domanda }}" class="collapse" data-parent="#accordion-2">
                            <div class="card-body" style="font-style: italic">
                                {{ $_faq->risposta }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>


            </div>
        </div>
        @else
        <!--ADMIN FAQs Start -->
        <div class="faqs">
            <div class="container">
                <div class="section-header text-center">
                    <p style="font-size : 30px">GESTIONE PAGINA FAQ</p>
                </div>
                <div style="text-align: center;padding:10px;margin-bottom:20px;margin-top:20px; font-size: 20px;font-style: normal;background-color: graytext;font-weight: bold;">NUOVA FAQ</div>
                    <form action="{{route('newFAQ')}}" style="text-align: center;" method="post">

                        @csrf
                        <textarea rows="3" cols="80" type="text" style="width: -webkit-fill-available;" name="domanda" required placeholder="Nuova Domanda"></textarea>
                        <p><textarea rows="3" cols="80" type="text" style="width: -webkit-fill-available;" required name="risposta" placeholder="Risposta alla Domanda"></textarea></p>
                        <input style="margin:auto; border-radius: 4px; font-size: large; background-color: grey; border-color: black;" type="submit" value="Salva">

                    </form>
                <hr style="border: 0;border-top: 1px solid gray; margin: 20px 0;">
                <h3 style="text-align: center; font-family: unset;">Lista Faq</h3>
                <div id="accordion-2" style="margin : auto">
                    <div class="card wow fadeInRight" data-wow-delay="0.1s">
                        @foreach($faq as $_faq)
                        <form action="{{route('editFAQ')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$_faq->cod_domanda}}" name="cod_domanda">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapse{{ $_faq->cod_domanda }}" aria-expanded="false">
                                    <textarea name="edit_domanda" required="" rows="1" cols="105">{{ $_faq->domanda }}</textarea>
                                </a>
                            </div>

                            <div id="collapse{{ $_faq->cod_domanda }}" class="collapse" data-parent="#accordion-2">
                                <div class="card-body" style="font-style: italic">
                                    <textarea name="edit_risposta" required="" rows="3" cols="80">{{ $_faq->risposta }}</textarea>
                                    <a href="{{route('deleteFAQ',[$_faq->cod_domanda])}}" style='float : right;padding-right:10px;margin-left: 10px'>
                                    <button type="button" onclick="return confirm('Cancellare definitivamente?');" style="background-color: #f44336; font-style: normal; border-radius: 3px;">Elimina FAQ</button></a>

                                    <input type="submit" value="Salva" style="background-color: green; font-style: normal; border-radius: 3px; float : right;">

                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>




        @endif





        <style>
            textarea {
                margin: 0px;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-color: transparent;

                border: 1px solid #000;
                resize: none;
            }
        </style>



        <!-- FAQs End -->





        @include('helpers/footer')





        <!-- Footer -->





    </div>
</body>





</html>
