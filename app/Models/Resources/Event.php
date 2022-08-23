<?php



/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/



namespace App\Models\Resources;



use Illuminate\Database\Eloquent\Model;



class Event extends Model
{

    protected $table = 'evento';
    protected $primaryKey = 'cod_evento';
    protected $fillable = ['nome_evento', 'organizzatore', 'data', 'regione', 'prezzo_biglietto', 'n_biglietti', 'n_b_venduti', 'programma', 'descrizione', 'luogo', 'cod_evento', 'partecipazioni', 'url_img'];
    public $timestamps = false;



    public function getEventbyCodice($codice)
    {
        return Event::where('cod_evento', $codice)->first();
    }

    public function maxCodice(){
        $max_cod_event = Event::max('cod_evento');
        return $max_cod_event;
        }



    public function updateEvent($nome_evento, $data, $regione, $prezzo_biglietto, $n_biglietti, $programma, $descrizione, $luogo)
    {

        $event = Event::find('cod_evento');

        $event->nome_evento = $nome_evento;
        $event->data = $data;
        $event->regione = $regione;
        $event->prezzo_biglietto = $prezzo_biglietto;
        $event->n_biglietti = $n_biglietti;
        $event->programma = $programma;
        $event->descrizione = $descrizione;
        $event->luogo = $luogo;

        $event->save();
    }
}
