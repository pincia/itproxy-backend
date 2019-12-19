<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
     

        if(Auth::attempt(['username' => request('username'), 'password' => request('password'),'plant_code' => request('plant_code')]))
        { 

            $user = Auth::user();  
            $success['user']=$user;
            $success['token'] = $user->createToken('MyApp')-> accessToken; 
            $success['token_type'] = 'Bearer';
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 


        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 

            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        
        $input['password'] = bcrypt($input['password']); 
        $codice = \App\impianto::where('codice_impianto', $input['plant_code'])->first()->codice_registrazione;


  if($codice &&($input['codice_registrazione']==$codice)){
         $user = User::create($input); 
         $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['nome'] =  $user->nome.' '.$user->cognome;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }
    else   return response()->json(['error'=>"codice registrazione non valido"], 401);         
}
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}