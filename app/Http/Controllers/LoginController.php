<?php
    use Illuminate\Routing\Controller;
    use App\Models\Utente;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class LoginController extends Controller{
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
            else return view('login')->with('csrf_token' , csrf_token());
        }

        public function login() {
            $request=request();
            $errors=$this->logErrors($request);
            $utente = Utente::where('username', request('username'))->first();

            if(!$errors){
                $proprietario = Utente::join('proprietario','proprietario.username','=','utente.username')->where('utente.username',$request['username'])->first();
                if($proprietario!==null){
                    Session::put('usernamelog', $utente->username);
                    return redirect('managementArea')->with(['propr'=>'ok']);
                }
                else{
                    Session::put('usernamelog', $utente->username);
                    return redirect('userArea')->with(['propr'=>'no']);
                }
            }
            else return redirect('login')->with('errors', $errors)->withInput();
        }

        private function logErrors($data){
            $error=null;
            if($data['username']&&$data['password']){
                $utente = Utente::where('username', $data['username'])->first();
                if($utente==null){
                    $error="Nome utente errato";
                    return $error;
                }
                $password = $utente->pswd;
                if (!(Hash::check($data['password'], $password))){
                    $error="Password errata.";
                }
            }else $error="Compilare correttamente tutti i campi.";
            return $error;
        }

        public function logout(){
            Session::flush();
            return redirect('login');
        }

    }
?>