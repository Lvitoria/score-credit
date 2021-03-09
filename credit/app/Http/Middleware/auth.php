<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //verificar a data e o token e salvar um log

        if(!$request->bearerToken()) return response()->json(['status' => 401, 'error' => 'Nenhum token informado.'], 401);
        $id = base64_decode(base64_decode($request->bearerToken()));

        if($id === "") return response()->json(['status' => 401, 'error' => 'Token inválido.'], 401);


        $result =  User::where($id)->get();

        if(count($result) == 0)  return response()->json(['status' => 401, 'error' => 'Token inválido.'], 401);

        if ($result[0]->_id != $id) {
            return response()->json(['status' => 401, 'error' => 'Token inválido.'], 401);
        }
        if (strtotime($result[0]->dateToken) < strtotime(date("Y-m-d"))) {
            return response()->json(['status' => 401, 'error' => 'token expirado.'], 401);
        }

        return $next($request);
    }

}
