<?php
    use Illuminate\Routing\Controller;
    use App\Models\Utente;
    use App\Models\Carrello;
    use App\Models\Acquisto;
    use App\Models\Recensione;
    use App\Models\Salvato;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class userAreaController extends Controller{

        public function index(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return redirect('managementArea');
                }
                else{
                    return view('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function removeCart($id){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $user=session('usernamelog');
                    $cart=Carrello::where('id_carrello',$id)->delete();
                    if($cart==true){
                        $num=Carrello::where('utente', $user)->count();
                        return ['npref'=>$num];
                    }
                }
    
            }
            else return redirect('login');
        }

        public function addOrder($stampa){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $orderDate = date('Y-m-d');
                    $newOrder = Acquisto::create([
                        'ID' => "0",
                        'stampa' => $stampa,
                        'utente' => session("usernamelog"),
                        'dataordine' => $orderDate,
                        'created_at'=>null,
                        'updated_at'=>null
                    ]);
                    if($newOrder){
                        $lastOrder = Acquisto::join('stampa','acquisto.stampa','=','stampa.id')->join('foto', 'foto.id', '=', 'stampa.foto')->where('stampa.id',$stampa)->where('utente', session('usernamelog'))->orderByDesc('acquisto.id')->select('*', 'acquisto.id as ID_ACQUISTO')->first();
                        return['items'=>$lastOrder];
                    }
                }
    
            }
            else return redirect('login');
        }

        public function addRec($voto, $testo, $acquisto){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $newRec=Recensione::create([
                        'ID'=>'0',
                        'voto'=>$voto,
                        'testo'=>$testo,
                        'acquisto'=>$acquisto
                    ]);
                    if($newRec){
                        $lastRec=Recensione::join('acquisto', 'recensione.acquisto', '=', 'acquisto.id')->join('stampa', 'stampa.id', '=', 'acquisto.stampa')->join('foto', 'foto.id', '=', 'stampa.foto')->join('utente', 'utente.username', '=', 'acquisto.utente')->where('acquisto.utente', session('usernamelog'))->orderByDesc('recensione.id')->select('recensione.voto as voto', 'recensione.testo as testo', 'stampa.materiale as materiale', 'stampa.prezzo as prezzo', 'stampa.larghezza as larghezza', 'stampa.altezza as altezza', 'foto.titolo as titolo')->first();
                        return['items'=>$lastRec];
                    }
                }
    
            }
            else return redirect('login');
        }

        public function addCart($stampa){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $newCart=Carrello::create([
                        'ID_CARRELLO'=>'0',
                        'stampa'=>$stampa,
                        'utente'=>session('usernamelog')
                    ]);
                    if($newCart){
                        $lastCart=Carrello::join('stampa', 'carrello.stampa', '=', 'stampa.id')->join('foto', 'foto.id', '=', 'stampa.foto')->where('stampa.id', $stampa)->where('carrello.utente', session('usernamelog'))->orderByDesc('carrello.ID_CARRELLO')->first();
                        return['items'=>$lastCart];
                    }
                }
    
            }
            else return redirect('login');
        }

        public function removePref($id){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $cart=Salvato::where('id_pref',$id)->delete();
                    if($cart==true){
                        $num=Salvato::where('utente', session('usernamelog'))->count();
                        return ['npref'=>$num];
                    }
                }
    
            }
            else return redirect('login');
        }

        public function recensioni(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $recensioni=Recensione::join('acquisto', 'recensione.acquisto', '=', 'acquisto.id')->join('stampa', 'stampa.id', '=', 'acquisto.stampa')->join('foto', 'foto.id', '=', 'stampa.foto')->where('acquisto.utente', session('usernamelog'))->select('recensione.voto as voto', 'recensione.testo as testo', 'stampa.materiale as materiale', 'stampa.prezzo as prezzo', 'stampa.larghezza as larghezza', 'stampa.altezza as altezza', 'foto.titolo as titolo')->get();
                    return['items'=>$recensioni];
                }
    
            }
            else return redirect('login');
        }
        public function carrello(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $carrello=Carrello::join('stampa', 'carrello.stampa', '=', 'stampa.id')->join('foto', 'foto.id', '=', 'stampa.foto')->where('carrello.utente', session('usernamelog'))->get();
                    return ['items'=>$carrello];
                }
    
            }
            else return redirect('login');
        }
        public function ordini(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $ordini=Acquisto::join('stampa', 'acquisto.stampa', '=', 'stampa.id')->join('foto', 'foto.id', '=', 'stampa.foto')->where('acquisto.utente', session('usernamelog'))->select('*', 'acquisto.id as ID_ACQUISTO')->get();
                    return ['items'=>$ordini];
                }
    
            }
            else return redirect('login');
        }
        public function user(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $user=Utente::where('username', session('usernamelog'))->get();
                    return $user;
                }
    
            }
            else return redirect('login');
        }
        public function preferiti(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    $preferiti=Salvato::join('stampa', 'stampa.id', '=', 'salvato.stampa')->join('foto', 'foto.id', '=', 'stampa.foto')->where('salvato.utente', session('usernamelog'))->get();
                    return ['items'=>$preferiti];
                }
    
            }
            else return redirect('login');
        }

    }
    
?>