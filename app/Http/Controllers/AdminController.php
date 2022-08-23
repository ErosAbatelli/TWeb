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
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Validator;
use Illuminate\Support\Facades\Auth;

 

 

class AdminController extends Controller
{

 

 

    protected $_user;
    protected $_faq;
    protected $_event;

 

 

    public function __construct()
    {
        $this->_user = new User;
        $this->_event = new Event;
        $this->_faq = new Faq;
    }

 

 

    public function getOrgList()
    {
        if (session('categoria') == 4) {
            $organizzatori = DB::table('utente')
                ->where('categoria', '=', 3)->paginate(5);
            return view('admin/gestioneOrganizzatori')->with('organizzatori', $organizzatori);
        } else {
            return redirect('/');
        }
    }

 

 

    public function getUserList()
    {
        if (session('categoria') == 4) {
            $users = DB::table('utente')
                ->where('categoria', '=', 2)->paginate(5);
            return view('admin/gestioneUtenti')->with('utenti', $users);
        } else {
            return redirect('/');
        }
    }

 

 

    public function editOrganizzatore(Request $request)
    {
        if (session('categoria') == 4) {
            
            $user = User::where('email', 'like', $request->email)->first();
            
            if($user!=null){
                $user = User::where('nome_utente', 'like', $request->nome_utente)->first(); 
                $message="";
                if($user->email!=$request->email){
                    $message = "E-Mail già in uso";
                }
                
                $organizzatori = DB::table('utente')
                   ->where('categoria', '=', 3)->paginate(5);
                return view('admin/gestioneOrganizzatori')
                    ->with('message1',$message)
                    ->with('organizzatori', $organizzatori);
            }else{
               $user = User::where('nome_utente', 'like', $request->nome_utente)->first();
               $user->nome = $request->nome;
               $user->email = $request->email;
               $user->password = $request->password;
               $user->telefono = $request->telefono;

               $user->save();

               $organizzatori = DB::table('utente')
                   ->where('categoria', '=', 3)->paginate(5);
               return view('admin/gestioneOrganizzatori')->with('organizzatori', $organizzatori);

            }
            
        } else {
            return redirect('/');
        }
    }

 

 

    public function deleteUser($nome_utente)
    {
        if (session('categoria') == 4) {
            $User = User::find($nome_utente);
            $User->delete();
            $users = null;
            if ($User->categoria == 2) {
                $users = DB::table('utente')
                    ->where('categoria', '=', 2)->paginate(5);
                return redirect('/gestioneUtenti')->with('utenti', $users);
            } elseif ($User->categoria == 3) {
                $users = DB::table('utente')
                    ->where('categoria', '=', 3)->paginate(5);
                return redirect('/gestioneOrganizzatori')->with('organizzatori', $users);
            }
        } else {
            return redirect('/');
        }
    }

 

 

    public function newOrg(Request $request)
    {
        if (session('categoria') == 4) {
            $checkFlag = $this->_user->userExists($request->input('nome_utente'), $request->input('email'));
            $message = "";
            switch ($checkFlag) {
                case 1:
                    $message = "Nome utente già in uso";
                    break;
                case 2:
                    $message = "Email già in uso";
                    break;
                case 0:
                    User::create([
                        'nome_utente' => $request->nome_utente,
                        'password' => $request->password,
                        'nome' => $request->nome,
                        'telefono' => $request->telefono,
                        'email' => $request->email,
                        'categoria' => 3,
                    ]);
                    $message = "Organizzatore registrato";
                    break;
            }
            
            $users = DB::table('utente')
                ->where('categoria', '=', 3)->paginate(5);
            
            return view('admin/gestioneOrganizzatori')
					->with('message',$message)
                    ->with('organizzatori', $users);
        } else {
            return redirect('/');
        }
    }

 

    public function newFAQ(Request $request)
    {
        if (session('categoria') == 4) {
            Faq::create([
                'cod_domanda' => ($this->_faq->maxCodice()) + 1,
                'domanda' => $request->domanda,
                'risposta' => $request->risposta,
            ]);
            $faqs = Faq::all();
            return redirect('/Faq')->with('faq', $faqs);
        } else {
            return redirect('/');
        }
    }
    public function editFAQ(Request $request)
    {
        if (session('categoria') == 4) {
            $faq = Faq::find($request->cod_domanda);
            $faq->domanda = $request->edit_domanda;
            $faq->risposta = $request->edit_risposta;
            $faq->save();
            $faqs = Faq::all();
            return redirect('/Faq')->with('faq', $faqs);
        } else {
            return redirect('/');
        }
    }
    public function deleteFAQ($cod_domanda)
    {
        if (session('categoria') == 4) {
            $Faq = Faq::find($cod_domanda);
            $Faq->delete();
            $faqs = Faq::all();
            return redirect('Faq')->with('faq', $faqs);
        } else {
            return redirect('/');
        }
    }
}