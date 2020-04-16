<?php

namespace App\Http\Controllers;

use App\models\banco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BanksController extends Controller
{
    protected $message = array();
    
    public function index()
    {
        $message['response'] = banco::all();
        $message['status'] = 200;
        return json_encode($message);
    }
    public function show($id)
    {
        //METODO QUE RETORNARA LOS BANCOS
        if (banco::where('id',$id)->exists())
        { 
            $message['response'] = banco::where('id',$id)->get();
            $message['status'] = 200; 

        }else
        {
            $message['response'] = 'No se encontro el banco';
            $message['status'] = 400;
        }

        return json_encode($message);
    }

    public function store(Request $request)
    {
        
        //METODO QUE AGREGA UN NVO BANCO
        $validator = Validator::make($request->all(), 
        [
            'id' => 'required',
            'name' => 'required',
            'tipo' => 'required',
            'nro' => 'required',
            'titular' => 'required',
            'titular_ci' => 'required',
            'titular_tlf' => 'required',
            'titular_mail' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message['response'] = $validator->messages();
            $message['status'] = 400;
            return response()->json($message);
        }

        if (banco::where('id', $request->id)->exists()) 
        {
            $message['response'] = 'Este producto ya esta en el sistema';
            $message['status'] = 400;
            return response()->json($message);
        }

        try
        {
            $bank = banco::create
            ([
                'id' => $request->id;
                'name' => $request->name;
                'tipo' => $request->tipo;
                'nro' => $request->nro;
                'titular' => $request->titular;
                'titular_ci' => $request->titular_ci;
                'titular_tlf' => $request->titular_tlf;
                'titular_mail' => $request->titular_mail;
            ]);

            $bank->create_at = date('d-m-Y H:i:s');
            $bank->save();

            $message['response'] = $bank;
            $message['status'] = 201;

            return response()->json($message);

        }catch(\Throwable $e)
        {
            $message['response'] = 'Error al guardar los datos. Por favor reintente...';
            $message['status'] = 500;
            banco::where('id',$bank->id)->delete();

            return response()->json($message);
        }
    }

    public function update(Request $request, $id)
    {
        //METODO QUE ACTUALIZA UN BANCO ID
        $bank = banco::find($id);

        if ($bank) 
        {
            bank->id = $request->id;
            bank->name_banco = $request->name;
            bank->tipo_cuenta = $request->tipo;
            bank->nro_cuenta = $request->nro;
            bank->name_titular = $request->titular;
            bank->ci_titular = $request->titular_ci;
            bank->tlf_titular = $request->titular_tlf;
            bank->mail_titular = $request->titular_mail;


            $product->save();
            $message['response'] = $bank;
            $message['status'] = 202;
            
            return response()->json($message);
        }else
        {
            $message['response'] = 'USUARIO no encontrado o no valido';
            $message['status'] = 400;

            return response()->json($message); 
        }

    }

    public function destroy(Request $request, $id)
    {
        //METODO QUE BORRA UN BANCO EN BASE A SU ID
        $bank = banco::find($id);
        if ($bank) 
        {
            $message['response'] = $bank;
            $message['status'] = 202;
            $bank->delete();

            return response()->json($message);
        }else
        {
            $message['response'] = 'USUARIO no encontrado o no valido';
            $message['status'] = 400;

            return response()->json($message); 
        }
    }
}
