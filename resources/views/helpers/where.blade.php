<!DOCTYPE html>

 

<html>
    @include('helpers/stile')

 

    <body>
        <div class="wrapper">
            <!-- Top Bar Start -->
            @include('helpers/topBar')
            <!-- Top Bar End -->

 

 

            <!-- Where Start -->

 

            <div class="where">
                <div class="container">
                    <div class="section-header text-center" >
                        <div style="margin-top: 40px">
                        <h2 style="font-size : 40px">Vuoi venire a trovarci?</h2>
                        </div>
                        <div style="margin-top: 20px">
                        <p style="font-size : 20px">Puoi recarti a questo indirizzo</p>
                        </div>
                        <div style="margin-top: 20px">
                                <iframe width="638" height="525" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.9701299599988!2d13.516924699999999!3d43.5863385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132d80233dd931ef%3A0x161719e4f3f5daaf!2sUniversit%C3%A0%20Politecnica%20delle%20Marche%20-%20Facolt%C3%A0%20di%20Ingegneria!5e0!3m2!1sit!2sit!4v1624811088232!5m2!1sit!2sit"  ></iframe><br /><small><a href="http://maps.google.it/maps?f=q&amp;source=embed&amp;hl=it&amp;geocode=&amp;q=Via+Brecce+Bianche,+12,+Ancona&amp;aq=0&amp;sll=41.442726,12.392578&amp;sspn=23.377375,53.657227&amp;ie=UTF8&amp;hq=&amp;hnear=Via+Brecce+Bianche,+12,+60131+Ancona,+Marche&amp;z=14&amp;ll=43.581248,13.515684" style="color:#0000FF;text-align:left">Visualizzazione ingrandita della mappa</a></small>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Where End -->

 

            @include('helpers/footer')

 

            <!-- Footer -->

 

        </div>
    </body>

 

</html>
