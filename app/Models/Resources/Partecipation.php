<?php



namespace App\Models\Resources;



use Illuminate\Database\Eloquent\Model;



class Partecipation extends Model
{



    protected $table = 'partecipazione';
    protected $fillable = ['cod_partecipazione', 'utente', 'evento'];
    protected $primaryKey = 'cod_partecipazione';
    public $timestamps = false;



    public function newPartecipazione($utente, $evento)
    {
        $max_cod = Partecipation::max('cod_partecipazione');
        Partecipation::create([
            'cod_partecipazione' => $max_cod + 1,
            'utente' => $utente,
            'evento' => $evento,
        ]);
    }
}
