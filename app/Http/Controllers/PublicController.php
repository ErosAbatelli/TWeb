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
use App\Models\Resources\Partecipation;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Validator;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    protected $_eventModel;
    protected $_event;
    protected $_filter;
    protected $_faqModel;
    protected $_order;
    protected $_user;
    protected $_partecipation;

    public function __construct()
    {
        $this->_eventModel = new Catalog;
        $this->_event = new Event;
        $this->_user = new User;
        $this->_faqModel = new faqs;
        $this->_order = new Order;
        $this->_partecipation = new Partecipation;
    }


    /* Form: Home Page */
    public function backHome()
    {
        return view('layouts/Home');
    }

    /* Form: FAQ */
    public function showFaq()
    {
        $Faq = $this->_faqModel->getFaq();
        return view('helpers/FAQ')->with('faq', $Faq);
    }

    /* Mostra Catalogo con tutti gli eventi*/
    public function showCatalog(Filter $request)
    {
       
            
            
        
        if( $request['data']==null){
            
            
             if($request['luogo'] != null){
            $lista_eventi_per_luogo = DB::table('evento')
                    ->select('cod_evento')
                    ->orWhere('luogo', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('comune', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('indirizzo', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('regione', 'Like', '%' . $request['luogo'] . '%');
            
            
                    $Events = DB::table('evento')
                    ->where('descrizione', 'like', '%' . $request['descrizione'] . '%')
                    ->whereIn('cod_evento', $lista_eventi_per_luogo)
                    ->whereDate('data', '>', today())
                    ->where('organizzatore', 'Like', '%' . $request['organizzatore'] . '%')
                    ->paginate(5)->appends(
                        array(
                            'descrizione' => $request->descrizione,
                            'luogo' => $request->luogo,
                            'data' => $request->data,
                            'organizzatore' => $request->organizzatore,
                        )
                    );
            
                    
             }else{
                 $Events = DB::table('evento')
                    ->where('descrizione', 'like', '%' . $request['descrizione'] . '%')
                    ->whereDate('data', '>', today())
                    ->where('organizzatore', 'Like', '%' . $request['organizzatore'] . '%')
                    ->paginate(5)->appends(
                        array(
                            'descrizione' => $request->descrizione,
                            'luogo' => $request->luogo,
                            'data' => $request->data,
                            'organizzatore' => $request->organizzatore,
                            )
                            );
             }
            
            
            
            
            
     
            
            
            
            
            
            
            
            
        }else{
           
            if($request['luogo'] != null){
                    $lista_eventi_per_luogo = DB::table('evento')
                            ->select('cod_evento')
                    ->orWhere('luogo', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('comune', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('indirizzo', 'Like', '%' . $request['luogo'] . '%')
                    ->orWhere('regione', 'Like', '%' . $request['luogo'] . '%');
            
                            
                    $time=strtotime($request->data);
                    $month=date("m",$time);
                    $year=date("Y",$time);


                    $Events = DB::table('evento')
                    ->where('descrizione', 'like', '%' . $request['descrizione'] . '%')
                    ->whereIn('cod_evento',$lista_eventi_per_luogo)
                    ->whereDate('data', '>', today())
                    ->whereMonth('data', $month)
                    ->whereYear('data', $year)
                    ->where('organizzatore', 'Like', '%' . $request['organizzatore'] . '%')
                    ->paginate(5)->appends(
                        array(
                            'descrizione' => $request->descrizione,
                            'luogo' => $request->luogo,
                            'data' => $request->data,
                            'organizzatore' => $request->organizzatore,
                        )
            );
                    
             }else{
                    $time=strtotime($request->data);
                    $month=date("m",$time);
                    $year=date("Y",$time);


                    $Events = DB::table('evento')
                    ->where('descrizione', 'like', '%' . $request['descrizione'] . '%')
                    ->whereDate('data', '>', today())
                    ->whereMonth('data', $month)
                    ->whereYear('data', $year)
                    ->where('organizzatore', 'Like', '%' . $request['organizzatore'] . '%')
                    ->paginate(5)->appends(
                        array(
                            'descrizione' => $request->descrizione,
                            'luogo' => $request->luogo,
                            'data' => $request->data,
                            'organizzatore' => $request->organizzatore,
                        )
            );
             }
            
            
            
            
            
            
        }

        
        return view('layouts/Catalogo')->with('events', $Events);
    }

    /* Mostra evento selezionato dall'utente */
    public function showEvento($cod_evento)
    {
        $Event = $this->_event->getEventbyCodice($cod_evento);
        return view('layouts/InfoEvento')
            ->with('evento', $Event);
    }

    /* Form: Login/Register  */
    public function showLoginForm()
    {
        return view('layouts/Login_Register');
    }


    /* Controllo delle credenziali della Login/Register  */
    public function handleLogin(Request $request)
    {
        if (($request->input('flag')) == 'login') {
            $user = $this->_user->getUserByCreds($request->input('nome_utente'), $request->input('password'));
            $message = "Credenziali errate";
            if ($user == null) {
                return view('layouts/Login_Register')->with("error", $message);
            } else {
                $request->session()->put('utente', $request->input('nome_utente'));
                $request->session()->put('nome', $user->nome);
                $request->session()->put('cognome', $user->cognome);
                $request->session()->put('password', $user->password);
                $request->session()->put('email', $user->email);
                $request->session()->put('data_nascita', $user->data_nascita);
                $request->session()->put('telefono', $user->telefono);
                $request->session()->put('categoria', $user->categoria);

                switch ($user->categoria) {
                    case 2:
                        return view('user/userPage');
                        break;
                    case 3:
                        return view('organizer/organizzatorePage');
                        break;
                    case 4:
                        return view('admin/adminPage');
                        break;
                }
            }
        } else {
            $checkFlag = $this->_user->userExists($request->input('nome_utente'), $request->input('email'));
            switch ($checkFlag) {
                case 1:
                    $message = "Nome utente già in uso";
                    return view('layouts/Login_Register')->with("error", $message);
                    break;
                case 2:
                    $message = "Email già in uso";
                    return view('layouts/Login_Register')->with("error", $message);
                    break;
                case 0:
                    $this->_user->newUser(
                        $request->input('nome'),
                        $request->input('cognome'),
                        $request->input('nome_utente'),
                        $request->input('password'),
                        $request->input('email')
                    );

                    $request->session()->put('utente', $request->input('nome_utente'));
                    $request->session()->put('nome', $request->input('nome'));
                    $request->session()->put('cognome', $request->input('cognome'));
                    $request->session()->put('email', $request->input('email'));
                    $request->session()->put('password', $request->input('password'));
                    $request->session()->put('telefono', $request->input('telefono'));
                    $request->session()->put('data_nascita', $request->input('data_nascita'));
                    session(['categoria' => 2]);

                    return view('user/userPage');
                    break;
            }
        }
    }



    //---------------------------------------------LIVELLO 2 ---------------------------------------------//




    /* Modifica delle credenziali Utente livello 2 */
    public function editProfile(Request $request)
    {
        if (session('categoria') == 2) {
            
            $message = "E-Mail già in uso";
            $user = DB::table('utente')->where('email','like',$request->email)->first();
            if(($user!=null)&&(session('email')!=$request->input('email'))){
                return view('user/userPage')
                    ->with('message',$message);
            }else{
                $this->_user->updateUser(
                $request->input('nome'),
                $request->input('email'),
                $request->input('cognome'),
                $request->input('password'),
                $request->input('telefono'),
                $request->input('data_nascita')
                );
                $request->session()->put('nome', $request->input('nome'));
                $request->session()->put('cognome', $request->input('cognome'));
                $request->session()->put('email', $request->input('email'));
                $request->session()->put('telefono', $request->input('telefono'));
                $request->session()->put('data_nascita', $request->input('data_nascita'));  
                return view('user/userPage');
            }        
            
            
            
        } else {
            return redirect('/');
        }
    }



    /* Form: Acquisto del biglietto dell'evento selezionato */
    public function paymentPage($cod_evento)
    {
        if ((session('categoria') == 2) && (session('progressive_flag') == 1)) {
            $Event = $this->_event->getEventbyCodice($cod_evento);
            $max_cod = $this->_order->maxCodice();
            session(['progressive_flag' => 2]);
            return view('user/payment')
                ->with('evento', $Event)
                ->with('max_cod', $max_cod);
        } else {
            return redirect('/');
        }
    }



    public function PricePassing($cod_evento)
    {
        if (session('categoria') == 2) {
            $Event = $this->_event->getEventbyCodice($cod_evento);
            return view('user/payment')
                ->with('evento', $Event);
        } else {
            return redirect('/');
        }
    }



    /* Registra ordine dell'evento selezionato */
    public function registraOrdine($cod_evento)
    {
        if (session('categoria') == 2) {
            if (session('progressive_flag') == 2) {
                $Event = $this->_event->getEventbyCodice($cod_evento);
                $Event->n_b_venduti += 1;
                $Event->save();
                
                
                $timezone = date_default_timezone_get();
                $d= date_create($Event->data);
                $t =date_create($timezone);
                
                $interval = date_diff($d, $t)->format('%d');
                
                if(($interval) <3 ){
                    $this->_order->newOrder($cod_evento, session('utente'), 1, ((($Event->prezzo_biglietto)*1)-((($Event->prezzo_biglietto)/100)*($Event->sconto)))   );
                }else{
                    $this->_order->newOrder($cod_evento, session('utente'), 1, (($Event->prezzo_biglietto)*1)   );
                }
                
                
                
                $Order = Order::find($this->_order->maxCodice());
                session(['flag' => false]);
                return view('user/riepilogo')
                    ->with('evento', $Event)
                    ->with('ordine', $Order);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }



    /* Mostra tutti i biglietti acquistati dall'utente */
    public function showBigliettiAcquistati()
    {
        if (session('categoria') == 2) {
            $Orders = DB::table('ordine')
                ->where('utente', 'like', session('utente'))->get();

            $Events = null;

            foreach ($Orders as $order) {
                $Event = $this->_event->getEventbyCodice($order->evento);
                $Events[$Event->cod_evento] = $Event;
            }



            return view('user/bigliettiAcquistati')
                ->with('orders', $Orders)
                ->with('events', $Events);
        } else {
            return redirect('/');
        }
    }

    public function newPartecipazione($cod_evento) 
    {
        if (session('categoria') == 2) {
            $partecipazione = DB::table('partecipazione')
                            ->where('utente', 'like', session('utente'))
                            ->where('evento', '=', $cod_evento)->first();
            if ($partecipazione == null) {
                 $this->_partecipation->newPartecipazione(session('utente'), $cod_evento);
                $event =Event::where('cod_evento', '=', $cod_evento)->first();
                $event->partecipazioni += 1;
                $event->save();
            }
            return redirect('/InfoEvento/' . $cod_evento);
        }else 
        {
            return redirect('/InfoEvento/' . $cod_evento);
        }
    }
}
