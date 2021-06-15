<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recensione extends Model{
    protected $table="recensione";
    protected $primaryKey="ID";
    protected $keyType="integer";

    public $timestamps=false;

    protected $fillable=[
        "voto", "testo", "acquisto"
    ];
    // 1-N hasMany 1-N inversa belongsTo

    // 1-1 hasOne 1-1 inversa belongsTo

    // N-N belongsToMany 
    public function Acquisto(){
        return $this->belongsTo("App\Models\Acquisto");
    }
}
?>