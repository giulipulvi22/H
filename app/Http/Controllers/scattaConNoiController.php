<?php
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class scattaConNoiController extends Controller{

        public function index(){
            return view('scattaConNoi');
        }

        public function IPGeolocation($luogo, $data){
            $json = Http::get('https://api.ipgeolocation.io/astronomy', [
                'apiKey'=>env('IPGkey'),
                'location'=>$luogo,
                'date'=>$data
            ]);
            if($json->failed()) abort(500);
            return $json;
        }
    }
?>