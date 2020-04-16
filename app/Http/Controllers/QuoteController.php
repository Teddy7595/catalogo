<?php

namespace App\Http\Controllers;

use App\models\cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    private $message = array();

    public function index()
    {
        $message['response'] = cotizacion::all();
        $message['status'] = 200;
        return json_encode($message);
    }

    public function show($id)
    {
        //METODO QUE RETORNARA LAS COTIZACIONES
        if (cotizacion::where('id',$id)->exists())
        { 
            $message['response'] = cotizacion::where('id',$id)->get();
            $message['status'] = 200; 

        }else
        {
            $message['response'] = 'No se encontro la cotizacion';
            $message['status'] = 400;
        }

        return json_encode($message);
    }


    private function create($request)
    {
        try
        {
            $quote = cotizacion::create
            ([
                'precio_BS_DLS' => str_replace(',','.',$request->dls),
                'precio_BS_EUR' => str_replace(',','.',$request->eur),
                'create_at' => date('d-m-Y H:i:s')
            ]);

            $this->message['response'] = $quote;
            $this->message['status'] = 201;

            return response()->json($this->message);

        }catch(\Throwable $e)
        {
            $this->message['response'] = 'Error al guardar los datos. Por favor reintente...';
            $this->message['status'] = 500;

            cotizacion::where('id',$quote->id)->delete();

            return response()->json($this->message);
        }
    }

    public function store(Request $request)
    {
        
        //METODO QUE AGREGA UN NVA COTIZACION
        $validator = Validator::make($request->all(), 
        [
            'dls' => 'required',
            'eur' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if (cotizacion::where('id', $request->id)->exists()) 
        {
            $this->message['response'] = 'Esta cotizacion ya esta en el sistema';
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        return $this->create($request);
        
    }

    public function update(Request $request, $id)
    {
        //METODO QUE ACTUALIZA UNA COTIZACION ID
        $quote = cotizacion::find($id);

        $validator = Validator::make($request->all(), 
        [
            'dls' => 'required',
            'eur' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if ($quote) 
        {
            $quote->precio_BS_DLS = str_replace(',','.',$request->dls);
            $quote->precio_BS_EUR = str_replace(',','.',$request->eur);

            $quote->save();
            $this->message['response'] = $quote;
            $this->message['status'] = 202;
            
            return response()->json($message);
        }else
        {
            $this->message['response'] = 'USUARIO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($message); 
        }

    }

    public function destroy(Request $request, $id)
    {
        //METODO QUE BORRA UNA COTIZACION EN BASE A SU ID
        $quote = cotizacion::find($id);

        if ($quote) 
        {
            $this->message['response'] = $quote;
            $this->message['status'] = 202;
            $quote->delete();

            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'COTIZACION no encontrada o no valida';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }
    }
}
