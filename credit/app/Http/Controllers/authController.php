<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Exception;

class authController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credetions = ['email' => $request->email, 'password' => sha1($request->password)];
        $result = User::where($credetions)->get();
        if (count($result) >= 1) {
            //  Str::random(60);
            $token = base64_encode(base64_encode($result[0]->_id));
            User::where($result[0]->_id)->update(['token' => $token, 'dateToken' => date("Y-m-d")]);

            return response()->json([
                'status' => 200,
                'access_token' => $token,
                'token_type' => 'bearer'
            ],200);
        } else {
            return response()->json([
                'status' => 401,
                'message' => "usuário não existe"
            ],401);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'name'=> $request->name,
                'email' => $request->email,
                'password' => sha1($request->password)
            ];

            Validator::make($data, [
                'email' => 'required',
                'password' => 'required'
            ])->validate();

            try {
                User::create($data);
            } catch (\Throwable $th) {
                // dd($th->getMessage());
                throw new Exception($th->getMessage());
            }

            return response(
                [
                    'status' => 201,
                    'message' => 'Usuário foi criado com sucesso!',
                    'info' =>  ['name' => $data['name']]
                ],
                201
            )
                ->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response([
                'status' => 500,
                'message' => $e->getMessage()

            ], 500)
                ->header('Content-Type', 'application/json');
        }
    }
}
