<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|email:filter',
                'password'=>'required|string',
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json(['error'=>$error , 'status'=>'failed'],202);
                //throw $th;
        }

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);

        return (new UserResource($user))->additional(['error'=>"" , 'status'=>'done']);

       }

       public function login(Request $request){

        try {
            $request->validate([
                "email"=>"required|email:rfc",
                "password"=>"required|string",
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json(['error'=>$error , 'status'=>'failed'],202);
                //throw $th;
        }

        $user = User::where(['email'=>$request->email])->first();
        // Hash::check $request->password

        if (!$user) {
           return response()->json(['error'=>'impossible de se connecter ' , 'status'=>'failed'],202);
        }
        if (!Hash::check($request->password,$user->password) ) {
           return response()->json(['error'=>'mot de passe incorrect ' , 'status'=>'failed'],202);

        }
        $userToken = $user->createToken( "token",  ['*'], now()->addMinutes(3000000))->plainTextToken;
        return response()->json(['error'=>' ' ,"Token"=>$userToken,"id"=>$user->id,"Message"=>"connexion valider" ,'status'=>'done'],200);


       }
       public function logout($id = null, $token = null)
    {
        // On essaie de retrouver l'utilisateur à partir de son id
        // En cas d'erreur on la récupère et on retourne cette erreur
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                                        'error' => $e->getMessage(),
                                        'status' => 'failed'
                                    ], 202);
        }

        // Si tout se passe bien
        // On supprime tous les tokens
        $user->tokens()->delete();

        // La reponse est retounée
        return response()->json([
                                    'error' => '',
                                    'message' => "Deconnexion reussie",
                                    'status' => 'done'
                                ], 200);
    }

}
