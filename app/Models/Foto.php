<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model{
    protected $table="foto";
    protected $primaryKey="ID";
    protected $keyType="integer";
    public $timestamps=false;

    protected $fillable=[
        "titolo", "data_scatto", "genere", "fotografo", "descrizione", "file"
    ];
    public function Stampa(){
        return $this->hasMany("App\Models\Stampa");
    }
    public function Fotografo(){
        return $this->belongsTo("App\Models\Fotografo");
    }
}
?>