<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Negozio extends Model{
    protected $table="negozio";
    protected $primaryKey="codice";
    protected $keyType="integer";

    protected $fillable=[
        "nomeNegozio", "numero_fotografi", "indirizzo", "proprietario", "latitudine", "longitudine", "numCiv", "citta", "email", "prov", "telefono"
    ];
    public function Fotografi(){
        return $this->hasMany("App\Models\Fotografo");
    }
    public function Proprietario(){
        return $this->belongsTo("App\Models\Proprietario");
    }
}
?>