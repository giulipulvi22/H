<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model{
    protected $table="proprietario";
    protected $primaryKey="username";
    protected $autoIncrement=false;
    protected $keyType="String";

    protected $fillable=[
        "nome", "cognome", "citta", "data_nascita", "propic"
    ];

    public function SalvatoStampa(){
        return $this->hasMany("App\Models\Negozio");
    }
}
?>