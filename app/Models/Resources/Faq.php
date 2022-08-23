<?php


namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {
    
    protected $table = 'faq';
    protected $primaryKey = 'cod_domanda';
    public $timestamps = false;
    protected $fillable = ['cod_domanda','risposta','domanda'];

    
    public function maxCodice(){
        $max_codice = Faq::max('cod_domanda');
        return $max_codice;
        }
    
    
}