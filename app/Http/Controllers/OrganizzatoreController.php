<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filter;
use App\Models\Catalog;
use App\Models\faqs;
use App\Models\Resources\Event;
use App\Models\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resources\Order;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Validator;
use Illuminate\Support\Facades\Auth;

class OrganizzatoreController extends Controller {

    protected $_user;
    protected $_event;

    public function __construct() {
        $this->_user = new User;
        $this->_event = new Event;
    }

    /* Mostra tutti gli eventi dell'organizzatore */

    public function eventiOrganizzatore() {
        $Events = DB::table('evento')->where('organizzatore', 'like', session('utente'))->get();

        return view('organizer/eventiOrganizzatore')->with('events', $Events);
    }

    /* Form evento da modificare */

    public function editEvent($cod_evento) {
        $Event = $this->_event->getEventbyCodice($cod_evento);
        return view('organizer/editEvento')->with('evento', $Event);
    }

    /* Cancella evento dell'organizzatore */

    public function deleteEvent($cod_evento) {
        $Event = Event::find($cod_evento);
        $Event->delete();

        $Events = DB::table('evento')
                        ->where('organizzatore', 'like', session('utente'))->get();

        return redirect('/eventiOrganizzatore')->with('events', $Events);
    }

    /* Modifica le credenziali dell'organizzatore */

    public function editProfileOrg(Request $request) {
        $message = "E-Mail già in uso";
        $user = DB::table('utente')->where('email','like',$request->email)->first();
        if(($user!=null)&&(session('email')!=$request->input('email'))){
            return view('organizer/organizzatorePage')
                ->with('message',$message);
        }else{
            $this->_user->updateUser(
                    $request->input('nome'),
                    $request->input('cognome'),
                    $request->input('password'),
                    $request->input('telefono'),
                    $request->input('data_nascita'),
                    $request->input('email')
            );


            $request->session()->put('nome', $request->input('nome'));
            $request->session()->put('cognome', $request->input('cognome'));
            $request->session()->put('email', $request->input('email'));
            $request->session()->put('telefono', $request->input('telefono'));
            $request->session()->put('data_nascita', $request->input('data_nascita'));

            return redirect('organizzatorePage');

        }
    }

    /* Form: Crea evento */

    public function createEvent() {
        return view('organizer/creaEvento');
    }

    public function saveNewEvent(Request $request) {

        $this->_event->nome_evento = $request->nome_evento;
        $this->_event->organizzatore = session('utente');
        $this->_event->data = $request->data;
        $appoggio = $request->input('regione');
        $appoggio1 = $request->input('provincia');
        $appoggio2 = $request->input('comune');
        $app=DB::table('regioni')->select('regione')->where('id','=',$appoggio)->get();
        $app1=DB::table('province')->select('provincia')->where('id','=',$appoggio1)->get();
        $app2=DB::table('comuni')->select('comune')->where('id','=',$appoggio2)->get();
        foreach($app as $a)
        foreach($app1 as $a2)
        foreach($app2 as $a3)
        $this->_event->regione = $a->regione;
        $this->_event->luogo = $a2->provincia;
        $this->_event->comune = $a3->comune;
        $this->_event->prezzo_biglietto = $request->prezzo_biglietto;
        $this->_event->n_biglietti = $request->n_biglietti;
        $this->_event->n_b_venduti = 0;
        $this->_event->indirizzo = $request->indirizzo;
        $this->_event->programma = $request->programma;
        $this->_event->descrizione = $request->descrizione;
        $this->_event->cod_evento = $this->_event->maxCodice() + 1;
        $this->_event->partecipazioni = 0;
        $this->_event->sconto = $request->sconto;

        $target_dir = "../public/assets/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "";
                $uploadOk = 1;
            } else {
                echo "<center>File is not an image.</center>";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "<center>Sorry, file already exists.</center>";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "<center>Sorry, your file is too large.</center>";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<center>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</center>";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<center>Sorry, your file was not uploaded.</center>";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<center><i><h4>The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.</h4></i></center>";
            } else {
                echo "<center>Sorry, there was an error uploading your file.</font></center>";
            }
        }


        //-------------------
        $this->_event->url_img = $target_file;
        //------------------------------



        $this->_event->save();

        $Events = DB::table('evento')->where('organizzatore', 'like', session('utente'))->get();

        return redirect('eventiOrganizzatore')->with('events', $Events);
    }

    public function ApplyMod(Request $request) {
        $Event = Event::find($request->cod_evento);
        $Events = DB::table('evento')->where('organizzatore', 'like', session('utente'))->get();

        $differenza = $request->biglietti_rimasti - ($Event->n_biglietti - $Event->n_b_venduti);

        $Event->nome_evento = $request->nome_evento;
        $Event->data = $request->data;
        $appoggio = $request->input('regione');
        $appoggio1 = $request->input('provincia');
        $appoggio2 = $request->input('comune');
        $app=DB::table('regioni')->select('regione')->where('id','=',$appoggio)->get();
        $app1=DB::table('province')->select('provincia')->where('id','=',$appoggio1)->get();
        $app2=DB::table('comuni')->select('comune')->where('id','=',$appoggio2)->get();
        foreach($app as $a)
        $Event->regione = $a->regione;
        foreach($app1 as $a2)
        $Event->luogo = $a2->provincia;
        foreach($app2 as $a3)
        $Event->comune = $a3->comune;
        $Event->indirizzo = $request->indirizzo;
        $Event->prezzo_biglietto = $request->prezzo_biglietto;
        $Event->n_biglietti += $differenza;
        $Event->programma = $request->programma;
        $Event->descrizione = $request->descrizione;
        $Event->sconto = $request->sconto;

        $Event->save();

        return redirect('eventiOrganizzatore')->with('events', $Events);
    }

    public function filtra() {
      if(!empty($_POST["codRegione"]))
      {
          $codreg=$_POST["codRegione"];
          $pro=DB::table('province')->where('id_regione','=',$codreg)->get();
          echo '<option value="">Seleziona la Provincia</option>';
          foreach($pro as $p)
      	{
              echo '<option value="'.$p->id.'">'.$p->provincia.'</option>';
          }
      }
      else
      {
      	if(!empty($_POST["codProvincia"]))
      	{
      		$codpro=$_POST["codProvincia"];
          $com=DB::table('comuni')->where('id_provincia','=',$codpro)->get();
          echo '<option value="">Seleziona il Comune</option>';
          foreach($com as $c)
      	{
              echo '<option value="'.$c->id.'">'.$c->comune.'</option>';
          }
      	}
      }


    }

}
