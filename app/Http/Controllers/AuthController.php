<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){

        $credentials = $request->only(['email', 'password']);

        $token = auth('api')->attempt($credentials);

        if($token){ //Logado com sucesso
            return response()->json(['token' => $token]);
        }else{
            return response()->json(['error' => "User/password incorrect"], 403);
        }
        //401 = não autorizado
        //403 = proibido
    }

    public function me(){
        return response()->json(auth()->user());
    }
    
    public function logout(){
        auth('api')->logout(); 
        return response()->json(['msg' => 'Logut feito com sucesso!']);
    }

    public function refresh(){
        $token = auth('api')->refresh(); //Esta funcionando
        return response()->json(['token' => $token]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
