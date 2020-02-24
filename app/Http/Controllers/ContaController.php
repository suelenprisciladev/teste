<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Conta;
use App\API;

class ContaController extends Controller {

    private $conta;

    public function __construct(Conta $conta) {
        $this->conta = $conta;
    }

    //lista todas as contas
    public function index() {
        try {
            $data = ['data' => $this->conta->all()];
            return response()->json($data, 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(Api::errorMessage($e->getMessage(),1010));
            }

            return response()->json(['message' => 'Error ao realizar a operação'], 500);
        }
    }

    //uma conta a partir do id
    public function conta($id) {
        try {
            $conta = $this->conta
                    ->join('clientes', 'contas.id_cliente', '=', 'clientes.id')
                    ->select('clientes.nome', 'clientes.endereco', 'contas.*')
                    ->where('contas.id', '=', $id)
                    ->get();
            return response()->json(['data' => $conta], 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(Api::errorMessage($e->getMessage(),1010));
            }
            return response()->json(['message' => 'Error ao realizar a operação'], 500);
        }
    }

    //fazer o depósito
    public function deposito(Request $request, $id) {
        try {
            //validando se o campo está com valor
            $validator = Validator::make($request->all(), [
                'valor' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Valor Invalido'], 404);
            } else {
                $conta = $this->conta->find($id);

                //depósito do saldo
                $conta->saldo = $conta->saldo + $request->valor;
                $conta->save();

                return response()->json(['message' => 'Deposito Efetuado com sucesso'], 200);
            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(Api::errorMessage($e->getMessage(),1010));
            }

            return response()->json(['message' => 'Error ao realizar a operação'], 500);
        }
    }

    //fazer o saque
    public function saque(Request $request, $id) {
        try {
            //validando se o campo está com valor
            $validator = Validator::make($request->all(), [
                'valor' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Valor Invalido'], 404);
            } else {
                $conta = $this->conta->find($id);

                if ($request->valor > $conta->saldo) {
                    return response()->json(['message' => 'Saldo Insuficiente.'], 200);
                }
                else
                {
                    //saque do saldo
                    $conta->saldo = $conta->saldo - $request->valor;
                    $conta->save();

                    return response()->json(['message' => 'Saque Efetuado Com Sucesso'], 200);
                }

            }
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(Api::errorMessage($e->getMessage(),1010));
            }

            return response()->json(['message' => 'Error ao realizar a operação'], 500);
        }
    }

}
