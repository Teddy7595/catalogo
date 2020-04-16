<?php

namespace App\Http\Controllers;

use App\models\compras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShoppingController extends Controller
{
    protected $message = array();

    public function index()
    {
    	$message['response'] = compras::all();
        $message['status'] = 200;
        return json_encode($message);
    }

    public function show($id)
    {
        //METODO QUE RETORNARA LAS COMPRAS
        if (compras::where('id',$id)->exists())
        { 
            $message['response'] = compras::where('id',$id)->get();
            $message['status'] = 200; 

        }else
        {
            $message['response'] = 'No se encontro la compras';
            $message['status'] = 400;
        }

        return json_encode($message);
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), 
        [
            'id_cliente' => 'required',
            'id_producto' => 'required',
            'monto' => 'required'
        ]);

        if ($validator->fails()) 
        {
            $message['response'] = $validator->messages();
            $message['status'] = 400;
            return response()->json($message);
        }

        try
        {

        	$buy = compras::create
        	([
        		'id_cliente' => 'required',
            	'id_producto' => 'required',
            	'monto' => 'required'
            	'status' => 'EN PROCESO'
        	]);

        	$buy->create_at = date('d-m-Y H:i:s');
        	$buy->save();

        }catch(\Throwable $e)
        {
        	$message['response'] = 'Error al guardar los datos. Por favor reintente...';
            $message['status'] = 500;

            return response()->json($message);
        }
    }
}
