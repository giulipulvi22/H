<?php
    use Illuminate\Routing\Controller;
    use App\Models\Utente;
    use App\Models\Carrello;
    use App\Models\Acquisto;
    use App\Models\Recensione;
    use App\Models\Salvato;
    use App\Models\Foto;
    use App\Models\Stampa;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class productsController extends Controller{
        public function index(){
            return view('products');
        }

        public function stampe($id){
            $stampe=Foto::join('stampa', 'foto.id', '=', 'stampa.foto')->join('fotografo', 'foto.fotografo', '=', 'fotografo.cf')->where('foto.id',$id)->get();
            return ['foto'=>$stampe];
        }

        public function foto(){
            $foto=Foto::get();
            return ['foto'=>$foto];
        }

        public function addCarrello($foto){
            if(session('usernamelog')==null){
                return json_encode(['type'=>'no', 'response'=>'Per poter aggiungere una foto al carrello devi effettuare il login.']);
            }
            else{
                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return json_encode(['type'=>'proprietario', 'response'=>'Per poter acquistare le foto è necessario effettuare il login come utente.']);
                }
                else{
                    $newCarrello=Carrello::create([
                        'ID_CARRELLO'=>'0',
                        'stampa'=>$foto,
                        'utente'=>session('usernamelog')
                    ]);
                    if($newCarrello){
                        return json_encode(['type'=>'si','response'=>"Elemento aggiunto al carrello. Puoi visualizzarlo nell'area personale."]);
                    }
                }
            }
        }

        public function addSalvato($stampa){
            if(session('usernamelog')==null){
                return json_encode(['type'=>'no', 'response'=>'Per poter salvare una foto devi effettuare il login.']);
            }
            else{
                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return json_encode(['type'=>'proprietario', 'response'=>'Per poter salvare le foto è necessario effettuare il login come utente.']);
                }
                else{
                    $check=Salvato::where('stampa', $stampa)->where('utente', session('usernamelog'))->first();
                    if($check){
                        return json_encode(['type'=>'done', 'response'=>'Hai già aggiunto questa stampa ai preferiti.']);
                    }
                    else{
                        $data = date('Y-m-d');
                        $newSalvato=Salvato::create([
                            'ID_PREF'=>'0',
                            'stampa'=>$stampa,
                            'utente'=>session('usernamelog'),
                            'datasalvataggio'=>$data
                        ]);
                        if($newSalvato){
                            return json_encode(['type'=>'si','response'=>"Elemento salvato. Puoi visualizzarlo nell'area personale."]);
                        }
                    }
                }
            }
        }

        public function recensioni($foto){
            $recensioni=Recensione::join('acquisto', 'recensione.acquisto', '=', 'acquisto.ID')->join('stampa', 'acquisto.stampa', '=', 'stampa.id')->join('foto', 'stampa.foto', '=', 'foto.id')->where('foto.id', $foto)->select('recensione.voto as voto', 'recensione.testo as testo', 'acquisto.utente as utente', 'stampa.altezza as altezza', 'stampa.larghezza as larghezza','stampa.materiale as materiale')->get();
            return ['items'=>$recensioni];
        }
    }
?>