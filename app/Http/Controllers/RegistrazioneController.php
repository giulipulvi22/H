<?php
    use Illuminate\Routing\Controller;
    use App\Models\Utente;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class RegistrazioneController extends Controller{

        public function index(){
            if(session('usernamelog') != null){

                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',session('usernamelog'))->first();
                if($proprietario!=null){
                    return redirect('managementArea');
                }
                else{
                    return redirect('userArea');
                }
    
            }
            else return view('registrazione')->with('csrf_token' , csrf_token());
        }

        protected function Registrazione() {
            $request = request();
            $errors=$this->Complete($request);
            if(($this->errorsNum($request) == 0)&&(!$errors)) {

                $pHash = Hash::make($request['password'], ['rounds' => 12]);
    
                $newUser = Utente::create([
                'username' => $request['username'],
                'pswd' => $pHash,
                'nome' => $request['nome'],
                'cognome' => $request['cognome'],
                'email' => $request['email'],
                'citta' => $request['citta'],
                'datanascita' => $request['data']
                ]);
                if ($newUser) {
                    $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',$request['username'])->first();
                    if($proprietario!==null){
                        Session::put('usernamelog', $request['username']);
                        return redirect('managementArea');
                    }
                    else{
                        Session::put('usernamelog', $request['username']);
                        return redirect('userArea');
                    }

    
                } 
    
                else {
                    return redirect('registrazione')->with('errors', $errors)->withInput();
                }
    
            }
    
            else return redirect('registrazione')->with('errors', $errors)->withInput();
    
        }

        private function errorsNum($data) {
            $error=null;

            //check data
            $birth = new DateTime($data['data']);
            $now = new DateTime();
            $interval = $now->diff($birth);
            $eta = $interval->y;
            if($eta>16){
                $date=$data['data'];
                
            }
            else{
                $error=1;
            }
    
            //check username
            if(!preg_match('/^[a-zA-Z0-9]{1,16}$/', $data['username'])){
                $error=1;
            }
            else{
                $query=Utente::where('username', $data['username'])->first();
                if($query!==null){
                    $error=1;
                }
            }

            //check password
            if (strlen($data["password"]) < 8) {
                $error=1;
            }

            //conferma password
            if (strcmp($data['password'], $data['confpassword']) != 0) {
                $error=1;
            }
            //check email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $error=1;
            } else {
                $query=Utente::where('email', $data['email'])->first();
                if ($query!==null) {
                $error=1;
                }
            }

            return $error;
        }

        private function Complete($data){
            if (!($data["username"])||!($data["nome"])||!($data["cognome"])||!($data["email"])||!($data["password"])||!($data["citta"])||!($data["data"])||!($data["confpassword"])) {
                $error='Compilare correttamente tutti i campi.';
                return $error;
            }
        }
    
        public function email($email) {

            $exist = Utente::where('email', $email)->exists();
    
            return ['exists' => $exist];
    
        }

        public function username($username) {
            $exist = Utente::where('username', $username)->first();
    
            return ['exists' => $exist];
    
        }

    }
?>