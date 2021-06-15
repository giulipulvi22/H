<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Acquisto extends Model{
    protected $table="acquisto";
    protected $primaryKey="ID";
    protected $keyType="integer";

    protected $fillable=[
        "stampa", "utente", "dataordine", "created_at", "updated_at"
    ];

    public function Recensito(){
        return $this->hasMany("App\Models\Recensione");
    }
    public function AcquistoUtente(){
        return $this->belongsTo("App\Models\Users");
    }
    public function AcquistoStampa(){
        return $this->belongsTo("App\Models\Stampa");
    }
}