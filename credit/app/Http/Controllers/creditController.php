<?php

namespace App\Http\Controllers;

use App\Models\BaseAModel;
use App\Models\BaseBModal;
use App\Models\BaseCModal;
use Exception;
use Validator;
use Illuminate\Http\Request;

class creditController extends Controller
{
    //
    public function __construct()
    {
    }

    public function baseA($cpf)
    {
        try {
            // dd("aqui");
            // if($cpf) throw new Exception("não existe nenhum cpf");
            try {
                $result = BaseAModel::whereRaw(['cpf' => base64_encode($cpf)])->get();
                if(count($result) == 0){
                    return response()->json(['status' => 404, 'error' => 'CPF inválido.'], 404);
                }

                $result[0]->cpf = base64_decode($result[0]->cpf);
            } catch (\Exception $th) {
                //throw $th;
                throw new Exception($th->getMessage());
            }
            return response(
                [
                    'status' => 200,
                    'info' =>  count($result) == 1 ? $result[0] : "Usuário não encontrado"
                ],
                200
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

    public function baseB($cpf)
    {
        try {
            try {
                $result = BaseBModal::whereRaw(['cpf' => base64_encode($cpf)])->get();
            } catch (\Exception $th) {
                //throw $th;
                throw new Exception($th->getMessage());
            }
            return response(
                [
                    'status' => 200,
                    'info' =>  count($result) == 1 ? $result[0] : "Usuário não encontrado"
                ],
                200
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

    public function baseC($cpf)
    {
        try {
            try {
                $result = BaseCModal::whereRaw(['cpf' => base64_encode($cpf)])->get();
                if(count($result) == 1){
                    if ($result[0]->bureau) $result[0]->bureau = $result[0]->bureau[0];
                    if ($result[0]->creditCardPurchases) $result[0]->creditCardPurchases = $result[0]->creditCardPurchases[0];
                }
            } catch (\Exception $th) {
                //throw $th;
                throw new Exception($th->getMessage());
            }
            return response(
                [
                    'status' => 200,
                    'info' =>  count($result) == 1 ? $result[0] : "Usuário não encontrado"
                ],
                200
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

    public function store(Request $request)
    {
        try {
            $data = [
                'name' => strip_tags($request->name),
                'cpf' => base64_encode(str_replace(['.', '-'], '', strip_tags($request->cpf))),
                'address' => strip_tags($request->address),
                'listOfDebts' => $request->listOfDebts,
                'dateOfBirth' => strip_tags($request->dateOfBirth),
                'listOfGoods' => $request->listOfGoods,
                'sourceOfIncome' => $request->sourceOfIncome,
                'bureau' => $request->bureau,
                'financialMovement' => $request->bureau,
                'creditCardPurchases' => $request->creditCardPurchases
            ];


            Validator::make($data, [
                'cpf' => 'required'
            ])->validate();

            try {
                BaseAModel::create($data);
            } catch (\Throwable $th) {
                // dd($th->getMessage());
                throw new Exception($th->getMessage());
            }

            return response(
                [
                    'status' => 201,
                    'message' => 'Usuário foi criado com sucesso!',
                    'info' =>  ['name' => $data['name'], 'cpf' => base64_decode($data['cpf'])]
                ],
                201
            )
                ->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            //throw $th;
            return response([
                'status' => 500,
                'message' => $e->getMessage()

            ], 500)
                ->header('Content-Type', 'application/json');
        }
    }
}
