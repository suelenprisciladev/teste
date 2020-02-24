<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    private $cliente;
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    //lista todos os clientes
    public function index()
    {
        try {
            $data = ['data'=> $this->cliente->all()];
            return response()->json($data, 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(['message' => $e->getMessage()], 1010);
            }

            return response()->json(['message' => 'Error ao realizar a operação'], 500);
        }
    }

}
