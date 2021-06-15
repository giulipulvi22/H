<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Salvato extends Model{
    protected $table="salvato";
    protected $primaryKey="ID";
    protected $keyType="integer";

    public $timestamps=false;

    protected $fillable=[
        "stampa", "utente"
    ];
    
    public function SalvatoUtente(){
        return $this->belongsTo("App\Models\Users");
    }
    public function SalvatoStampa(){
        return $this->belongsTo("App\Models\Stampa");
    }
}
?>