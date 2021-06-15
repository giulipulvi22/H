<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Stampa extends Model{
    protected $table="stampa";
    protected $primaryKey="ID";
    protected $keyType="integer";
    public $timestamps=false;

    protected $fillable=[
        "foto", "prezzo", "altezza", "larghezza", "materiale"
    ];

    public function Foto(){
        return $this->belongsTo("App\Models\Foto");
    }
    public function Salvato(){
        return $this->hasMany("App\Models\Salvato");
    }
    public function Carrello(){
        return $this->hasMany("App\Models\Carrello");
    }
    public function Acquisto(){
        return $this->hasMany("App\Models\Acquisto");
    }
}
?>