<?php



namespace App\Models\Resources;



use Illuminate\Database\Eloquent\Model;



class Order extends Model
{

protected $table = 'ordine';

protected $fillable = ['cod_ordine','evento','utente','n_biglietti','importotot'];
protected $primaryKey = 'cod_ordine';
public $timestamps = false;

public function newOrder($evento,$utente,$n_biglietti,$importotot){
Order::create([
    'cod_ordine' => ($this->maxCodice())+1,
    'evento' => $evento,
    'utente' => $utente,
    'n_biglietti' => $n_biglietti,
    'importotot' => $importotot,
]);
}


public function maxCodice(){
$max_codice = Order::max('cod_ordine');
return $max_codice;
}
}