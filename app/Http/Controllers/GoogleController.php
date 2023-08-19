<?php

namespace App\Http\Controllers;
use App\Services\GeneralService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Exception;
class GoogleController extends Controller
{
    //
    protected $GeneralService;
    public function __construct(GeneralService $GeneralService,)
    {
    $this->GeneralService = $GeneralService;
 
    }
    public function googleSignInPage()
    {
        return socialite::driver('google')->redirect();
    }

    public function getData(Request $request)
    {
      //  return"test";
      //return $request;
      try{
        $user=socialite::driver('google')->userFromToken($request->token);
        return response()->json(
            ["code"=>"200",

            "data"=>['email'=>$user->email,'name'=>$user->name]
           
        ]);
      } 
       catch (Exception $e) {
        return response()->json(
            ["code"=>"402",

            "message"=>$e->getMessage()
        ]);
    }
     
      
        //return $request;
    }
    public function googleCallBack(Request $request)
    {
        try {
      
            $user = socialite::driver('google')->user();
        
            $finduser = User::where('google_id', $user->id)->first();
            $cookieExpiration = 60 * 22;
            if($finduser!=null)

            {
       
                Auth::login($finduser);
      
                $response=[
                    "code"=>"200",
                    "data"=>
                    [
                        "data"=>Auth::user(),
                        "token"=> $user->token  
                    ],
                            
                ];
                $request->session()->put('user_token', $user->token);

        // Redirect the user to the target route
        return redirect()->route('target.main');
                return view('main', ['token' => $user->token]);
                return $response;
                //return $user->token;
                $cookiesToken= new RedirectResponse(route('target.main'));
                $redirectResponse =$cookiesToken->withCookie(cookie('googleToken',$user->token,$cookieExpiration,null, null, false, false));
                return $redirectResponse;
               
       
            }

            else

            {
           
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                
                ]);
      
                Auth::login($newUser);
      
                $response=[
                    "code"=>"200",
                    "data"=>
                    [
                        "data"=>Auth::user(),
                        "token"=> $user->token  
                    ],
                            
                ];
                return view('main', ['token' => $user->token]);
                return $response;
                $cookiesToken= new RedirectResponse(route('target.main'));
                $redirectResponse =$cookiesToken->withCookie(cookie('googleToken',$user->token,$cookieExpiration,null, null, false, false));
                return $redirectResponse;
               
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
