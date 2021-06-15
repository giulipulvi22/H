<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fotografo extends Model{
    protected $table="fotografo";
    protected $primaryKey="CF";
    protected $autoIncrement=false;
    protected $keyType="string";

    public $timestamps=false;

    protected $fillable=[
        "CF","nome", "cognome", "citta", "data_nascita", "eta", "data_inizio", "negozio", "propic", "playlist", "facebook", "instagram"
    ];

    public function Foto(){
        return $this->hasMany("App\Models\Foto");
    }
    public function Negozio(){
        return $this->belongsTo("App\Models\Negozio");
    }
}
?>