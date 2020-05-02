<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Requests\Bank\BankCreateRequest;

class BankController extends Controller
{
    //funcion que me retorna todos los BANCOS
    public function index()
    {
        //funcion que retorna todos los BANCOS registrados

        if (Bank::count() == 0) 
        {
            $this->json['response'] = 'Ups!, No se encontraron bancos resgitrados =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.Bank::count().' cuentas bancarias registradas';
            $this->json['error'] = null;
            $this->json['data'] = Bank::all();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }

    //funcion que me retorna en base a su ID un BANCO
    public function show($id)
    {
        //BUSCO EL BANCO, LO ENCUENTRA HAGO EL POCEDIMIENTO, DE LO CONTRARIO DEVUELVO
        //NO ENCONTRADO
        $bank = Bank::find($id);

        if ($bank) 
        { 
            $this->json['response'] = 'Cuenta bancaria encontrada! ;-)';
            $this->json['data'] = $bank;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;
 
            return response()->json($this->json,200);
        }else
        {
            $this->json['response'] = 'Cuenta bancaria no encontrada =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;
 
            return response()->json($this->json,400);
        }
    }

    //funcion que me permite guardar un banco
    public function store(BankCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 

            $this->json['data'] = Bank::create($data);
            $this->json['response'] = 'Cuenta bancaria creada! ;-)';
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 201;

            return response()->json($this->json,201);

        }catch(\Throwable $e)
        {
            $this->json['response'] = 'Ups!, ha ocurrido un error =/'.$e->getmessage();
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = false;
            $this->json['status'] = 500;

            return response()->json($this->json, 500);
        }
    }

    //funcion que me edita un banco basado en su id
    public function update(BankCreateRequest $request, $id)
    { 

        $bank = Bank::find($id);
        $data = $request->validated();

        try
        {
            if ($bank) 
            {
                $bank->update($data);

                $this->json['response'] = 'Cuenta bancaria actualizada ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cuenta bancaria no encontrada =/';
                $this->json['data'] = null;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 400;

                return response()->json($this->json,400);
            }
        }catch(\Throwable $e)
        {
            $this->json['response'] = $e->getmessage();//'Ups!, ha ocurrido un error =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = false;
            $this->json['status'] = 500;

            return response()->json($this->json, 500);
        }
    }

    //funcion que me permite borrar un banco
    public function destroy($id)
    {
        $bank = Bank::find($id);
        try
        {
            if ($bank) 
            {
                $this->json['response'] = 'Cuenta bancaria  eliminada ;-)';
                $this->json['data'] = $bank;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $bank->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cuenta bancaria  no encontrada =/';
                $this->json['data'] = null;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 400;

                return response()->json($this->json,400);
            }
        }catch(\Throwable $e)
        {
            $this->json['response'] = 'Ups!, ha ocurrido un error =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = false;
            $this->json['status'] = 500;

            return response()->json($this->json, 500);
        } 
    }


}
