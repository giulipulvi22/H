<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Carrello extends Model{
    protected $table="carrello";
    protected $primaryKey="ID_CARRELLO";
    protected $keyType="integer";

    public $timestamps=false;

    protected $fillable=[
        "stampa", "utente"
    ];

    public function CarrelloUtente(){
        return $this->belongsTo("App\Models\Users");
    }
    public function CarrelloStampa(){
        return $this->belongsTo("App\Models\Stampa");
    }
}
?>