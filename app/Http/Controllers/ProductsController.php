<?php

namespace App\Http\Controllers;

use App\models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    private $message = array();

    public function index()
    {
        $this->message['response'] = producto::all();
        $this->message['status'] = 200;
        return json_encode($this->message);
    }

    public function show($id)
    {
        //METODO QUE RETORNARA LOS PRODUCTOS
        if (producto::where('id',$id)->exists())
        { 
            $this->message['response'] = producto::where('id',$id)->get();
            $this->message['status'] = 200; 

        }else
        {
            $this->message['response'] = 'No se encontro el producto';
            $this->message['status'] = 400;
        }

        return json_encode($this->message);
    }

    private function create($request)
    {
        //METODO QUE SE ENCARGA DE RECIBIR LA PETICION Y CREAR EL PRODUCTO
        try
        {
            $product = producto::create
            ([
                'cod' => $request->id,
                'name' => $request->name,
                'descp' => $request->descp,
                'photo' => $request->photo,
                'precio_dls' => $request->dls,
                'precio_eur' => $request->eur,
                'iva' => $request->iva,
                'create_at' => date('d-m-Y H:i:s'),
                'cantidad' => $request->cant
            ]);

            $this->message['response'] = $product;
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
        //METODO QUE AGREGA UN NVO PRODUCTO
        $validator = Validator::make($request->all(), 
        [
            'id' => 'required',
            'name' => 'required',
            'descp' => 'required',
            'photo' => 'required',
            'dls' => 'required',
            'eur' => 'required',
            'iva' => 'required',
            'cant' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if (producto::where('cod', $request->id)->exists()) 
        {
            $this->message['response'] = 'Este producto ya esta en el sistema';
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        return $this->create($request);
    }

    public function update(Request $request, $id)
    {
        //METODO QUE ACTUALIZA UN PRODUCTO ID
        $product = producto::find($id);
        $validator = Validator::make($request->all(), 
        [
            'id' => 'required',
            'name' => 'required',
            'descp' => 'required',
            'photo' => 'required',
            'dls' => 'required',
            'eur' => 'required',
            'iva' => 'required',
            'cant' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if ($product) 
        {
            $product->cod = $request->id;
            $product->name = $request->name;
            $product->descp = $request->descp;
            $product->photo = $request->photo;
            $product->precio_dls = $request->dls;
            $product->precio_eur = $request->eur;
            $product->iva = $request->iva;
            $product->cantidad = $request->cant;
            $product->update_at = date('d-m-Y H:i:s');

            $product->save();
            $this->message['response'] = $product;
            $this->message['status'] = 202;
            
            return response()->json($this->message);

        }else
        {
            $this->message['response'] = 'PRODUCTO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }
    }

    public function destroy(Request $request, $id)
    {
        //METODO QUE BORRA UN PRODUCTO EN BASE A SU ID
        $product = producto::find($id);

        if ($product) 
        {
            $this->message['response'] = $product;
            $this->message['status'] = 202;
            $product->delete();

            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'USUARIO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }
    }
}
