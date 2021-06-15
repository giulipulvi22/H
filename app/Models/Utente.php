<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Utente extends Model{
    protected $table="utente";
    protected $primaryKey="username";
    protected $autoIncrement=false;
    protected $keyType="string";

    protected $fillable=[
        "username", "nome", "cognome", "datanascita", "citta", "email", "pswd"
    ];

    public $timestamps=false;
 
    public function Salva(){
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