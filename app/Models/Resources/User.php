<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Session;

class User extends Model 
{
    
    protected $table = 'utente';
    protected $fillable = ['nome_utente','nome','cognome','password','email','data_nascita','telefono','categoria'];
    protected $primaryKey = 'nome_utente';
    public $timestamps = false;
    
    public function getUserByCreds($nome_utente,$password){
        return User::where([['nome_utente', 'like',$nome_utente],
                ['password', 'Like' ,$password]])->first();

    }
    
    public function newUser($nome,$cognome,$nome_utente,$password,$email){
        User::create([
            'nome_utente' => $nome_utente,
            'password' => $password,
            'nome' => $nome,
            'cognome' => $cognome,
            'email' => $email,
            'categoria' => 2,
        ]);
    }


   
    public function updateUser($nome,$cognome,$password,$telefono,$data_nascita){
        
        $user=User::find(session('utente'));
        
        $user->nome =$nome;
        $user->cognome =$cognome;
        $user->data_nascita =$data_nascita;
        $user->email = session('email');
        $user->password =$password;
        $user->telefono =$telefono; 


        session(['nome'=>$nome,
                 'cognome'=>$cognome,
                 'email'=>session('utente'),
                 'password'=>$password,
                 'data_nascita'=>$data_nascita,
                 'telefono'=>$telefono]);
        
        $user->save();

    }
    
    
    public function userExists($nome_utente,$email){
        $user = User::where([['nome_utente', 'like',$nome_utente]])->first();
        if($user!=null){ return 1; }
        $user = User::where([['email', 'like',$email]])->first();
        if($user!=null){ return 2; }
        return 0;
    }


    
}