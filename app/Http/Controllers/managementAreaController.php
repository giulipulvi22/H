<?php
    use Illuminate\Routing\Controller;
    use App\Models\Utente;
    use App\Models\Fotografo;
    use App\Models\Foto;
    use App\Models\Stampa;
    use App\Models\Salvato;
    use App\Models\Acquisto;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class managementAreaController extends Controller{

        public function index(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return view('managementArea');
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function dati($tipo){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    if($tipo==='fotografi'){
                        $fotografi=Fotografo::get();
                        if($fotografi){
                            return['type'=>'fotografi', 'items'=>$fotografi];
                        }
                    }
                    if($tipo==='foto'){
                        $foto=Foto::get();
                        if($foto){
                            return['type'=>'foto', 'items'=>$foto];
                        }
                    }
                    if($tipo==='stampe'){
                        $stampe=Stampa::join('foto', 'stampa.foto', '=', 'foto.id')->select('stampa.id as ID', 'stampa.foto as foto', 'foto.titolo as titolo', 'stampa.prezzo as prezzo', 'stampa.altezza as altezza', 'stampa.larghezza as larghezza', 'stampa.materiale as materiale')->orderBy('stampa.id')->get();
                        if($stampe){
                            $likeT=array();
                            $orderT=array();
                            $stampeArr=json_decode($stampe);
                            $num=count($stampeArr);
                            for($i=0; $i<$num; $i++){
                                $id=$stampeArr[$i]->ID;
                                $liked=Salvato::where('stampa', $id)->count();
                                if($liked>=0){
                                    $likeT[]=['liked'=>json_encode($liked)];
                                }
                                $ordered=Acquisto::where('stampa', $id)->count();
                                if($ordered>=0){
                                    $orderT[]=['ordered'=>json_encode($ordered)];
                                }
                            }
                            $response=['type'=>'stampe', 'items'=>$stampe, 'likes'=>$likeT, 'ordered'=>$orderT];
                            return json_encode($response);
                        }
                    }
                    
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }
        public function addFotografo(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $request=request();
                    $errors=array();
                    $error=$this->Complete($request);
                    $errorFile=$this->caricaFile($request);
                    if(((strcmp($error['ans'],'ok'))==0)&&((strcmp($errorFile['ans'],'ok'))==0)){
                        $newFotografo = Fotografo::create([
                            'nome' => $request['nome'],
                            'cognome' => $request['cognome'],
                            'citta' => $request['citta'],
                            'data_nascita' => $request['datan'],
                            'CF' => $request['cf'],
                            'data_inizio' => $request['datai'],
                            'eta' => 0,
                            'negozio'=>'1',
                            'propic'=>$errorFile['file'],
                            'facebook'=>$request['fb'],
                            'spotify'=>$request['sp'],
                            'instagram'=>$request['ig']
                        ]);
                        if($newFotografo){
                            return redirect('managementArea');
                        }
                        else {$errors[]="Si è verificato un problema.";}
                    }
                    else{
                        if($error['ans']=="no"){
                            $errors[]=$error['respo'];
                        }
                        if((strcmp($errorFile['ans'],'no'))==0){
                            for($i=0; $i<count($errorFile['file']); $i++){
                                $errors[]=$errorFile['file'][$i];
                            }
                        }
                        return redirect('managementArea')->with(['err'=>$errors]);
                    }
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        private function Complete($data){
            if(!($data["nome"])||!($data["cognome"])||!($data["citta"])||!($data["cf"])||!($data["datan"])||!($data["datai"])||!($data["sp"])) {
                $error='Compilare correttamente tutti i campi.';
                $resp=['ans'=>'no', 'respo'=>$error];
                return $resp;
            }
            else{
                $resp=['ans'=>'ok', 'respo'=>'ok'];
                return $resp;
            }
        }

        private function CompleteFoto($data){
            if(!($data["titolo"])||!($data["data"])||!($data["genere"])||!($data["cfFotografo"])||!($data["descrizione"])) {
                $error='Compilare correttamente tutti i campi.';
                $resp=['ans'=>'no', 'respo'=>$error];
                return $resp;
            }
            else{
                $resp=['ans'=>'ok', 'respo'=>'ok'];
                return $resp;
            }
        }

        private function caricaFile($data){
            $error=array();
            if(($data->hasFile('propic'))||($data->hasFile('foto'))){
                if($data->hasFile('propic')){
                    $file=$data->file('propic');
                }
                else if($data->hasFile('foto')){
                    $file=$data->file('foto');
                }
                if($file->isValid()){
                    $name=$file->getClientOriginalName();
                    $ext=$file->getClientOriginalExtension();
                    $rpath=$file->getRealPath();
                    $size=$file->getSize();

                    if($ext=='jpg'||$ext=='png'||$ext=='jpeg'){
                        if($size){
                            if($size<=7000000){
                                $size=7000000;
                            }
                            $destinationPath = "immagini/";
                            $file->move($destinationPath,$file->getClientOriginalName());
                            return ['ans'=>'ok', 'file'=>$destinationPath.$file->getClientOriginalName()];
                        }
                        else{
                            $error[] = "L'immagine non deve avere dimensioni maggiori di 7MB";
                        }
                    }
                    else{
                        $error[] = "I formati consentiti sono .png, .jpeg, e .jpg";
                    }
                }
            }
            else{
                $error[] = "Errore nel carimento del file.";
            }
            return ['ans'=>'no','file'=>$error];
            
        }

        public function addFoto(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $request=request();
            $errors=array();
            $error=$this->CompleteFoto($request);
            $errorFile=$this->caricaFile($request);
            if(((strcmp($error['ans'],'ok'))==0)&&((strcmp($errorFile['ans'],'ok'))==0)){
                $newFotografo = Foto::create([
                    'ID' => '0',
                    'titolo' => $request['titolo'],
                    'data_scatto' => $request['data'],
                    'genere' => $request['genere'],
                    'fotografo' => $request['cfFotografo'],
                    'descrizione' => $request['descrizione'],
                    'file' => $errorFile['file']
                ]);
                if($newFotografo){
                    return redirect('managementArea');
                }
                else {$errors[]="Si è verificato un problema.";}
            }
            else{
                if($error['ans']=="no"){
                    $errors[]=$error['respo'];
                }
                if((strcmp($errorFile['ans'],'no'))==0){
                    for($i=0; $i<count($errorFile['file']); $i++){
                        $errors[]=$errorFile['file'][$i];
                    }
                }
                return redirect('managementArea')->with(['errFoto'=>$errors]);
            }
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function addStampa($altezza, $larghezza, $materiale, $prezzo, $foto){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $newStampa = Stampa::create([
                        'altezza' => $altezza,
                        'larghezza' => $larghezza,
                        'materiale' => $materiale,
                        'prezzo' => $prezzo,
                        'foto' => $foto
                    ]);
                    if($newStampa){
                        $ID=Stampa::max('ID');
                        return ['ID'=>$ID, "altezza"=>$altezza, "larghezza"=>$larghezza, "materiale"=>$materiale, "prezzo"=>$prezzo, "foto"=>$foto];
                    }
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function removeFotografo($cf){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $foto=Foto::where('fotografo', $cf)->get();
                    $foto=json_decode($foto);
                    $foto_ID=array();
                    for($i=0; $i<count($foto); $i++){
                        $foto_ID[$i]=['ID'=>$foto[$i]->ID];
                        $stampa=Stampa::where('foto', $foto[$i]->ID)->delete();
                        $fotod=Foto::where('ID', $foto[$i]->ID)->delete();
                    }
                    $fotografo=Fotografo::where('CF', $cf)->delete();
                    return ['cf'=>$cf, 'foto'=>$foto_ID];
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function removeFoto($id){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $stampa=Stampa::where('foto', $id)->delete();
                    $foto=Foto::where('ID', $id)->delete();
                    return json_encode($id);
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }

        public function removeStampa($id){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    $stampa=Stampa::where('ID', $id)->delete();
                    return json_encode($id);
                }
                else{
                    return redirect('userArea')->with('user', session('usernamelog'));
                }
    
            }
            else return redirect('login');
        }
    }
    
?>