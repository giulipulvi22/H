<?php
    use Illuminate\Routing\Controller;
    use App\Models\Negozio;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class doveSiamoController extends Controller{
        public function index(){
            return view('doveSiamo');
        }

        public function info(){
            $info=Negozio::join('proprietario', 'proprietario.username', '=', 'negozio.proprietario')->get();
            return $info;
        }
    }

?>