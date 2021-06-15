<?php
    use Illuminate\Routing\Controller;
    use App\Models\Fotografo;
    use App\Models\Proprietario;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;

    class AboutUsController extends Controller{
        public function index(){
            return view('AboutUs');
        }
        public function fotografi(){
            $fotografi=Fotografo::get();
            return ['fotografi'=>$fotografi];
        }
        public function playlist($id){
            $token=Http::asForm()->withHeaders(['Authorization' => 'Basic '.base64_encode(env('client_id').':'.env('client_secret'))])
            ->post('https://accounts.spotify.com/api/token',[
                'grant_type'=>'client_credentials'
            ]);
            if($token->failed()) abort(500);
            $playlist=Http::withHeaders([
                'Authorization'=>'Bearer '.$token['access_token']])
                ->get('https://api.spotify.com/v1/playlists/'.$id,
            []);

            if($playlist->failed()) abort(500);
            return $playlist->body();
        }
    }
?>