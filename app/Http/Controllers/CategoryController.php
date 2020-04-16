<?php

namespace App\Http\Controllers;

use App\models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    private $message = array();

    public function index()
    {
        $message['response'] = categoria::all();
        $message['status'] = 200;
        return json_encode($message);
    }

    public function show($id)
    {
        //METODO QUE RETORNARA LOS PRODUCTOS
        if (categoria::where('id',$id)->exists())
        { 
            $message['response'] = categoria::where('id',$id)->get();
            $message['status'] = 200; 

        }else
        {
            $message['response'] = 'No se encontro la categoria';
            $message['status'] = 400;
        }

        return json_encode($message);
    }

    private function create($request)
    {
        try
        {
            $category = categoria::create
            ([
                'name' => $request->name,
                'create_at' => date('d-m-Y H:i:s')
            ]);

            $this->message['response'] = $category;
            $this->message['status'] = 201;

            return response()->json($this->message);

        }catch(\Throwable $e)
        {
            $this->message['response'] = 'Error al guardar los datos. Por favor reintente...';
            $this->message['status'] = 500;

            return response()->json($this->message);
        }
    }

    public function store(Request $request)
    {
        
        //METODO QUE AGREGA UN NVA CATEGORIA
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required'
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;

            return response()->json($this->message);
        }

        if (categoria::where('name', $request->name)->exists()) 
        {
            $this->message['response'] = 'Este categoria ya esta en el sistema';
            $this->message['status'] = 400;

            return response()->json($this->message);
        }

        return $this->create($request);
    }


    public function update(Request $request, $id)
    {
        //METODO QUE ACTUALIZA UNA CATEGORIA ID
        $category = categoria::find($id);
        
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required'
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;

            return response()->json($this->message);
        }

        if ($category) 
        {
            $category->name = $request->name;
            $category->update_at = date('d-m-Y H:i:s');

            $category->save();
            
            $this->message['response'] = $category;
            $this->message['status'] = 202;
            
            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'CATEGORIA no encontrado o no valida';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }

    }

    public function destroy(Request $request, $id)
    {
        //METODO QUE BORRA UNA CATEGORIA EN BASE A SU ID
        $category = categoria::find($id);
        
        if ($category) 
        {
            $this->message['response'] = $category;
            $this->message['status'] = 202;
            $category->delete();

            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'USUARIO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }
    }
}

