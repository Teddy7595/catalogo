<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use Illuminate\Http\Request;
use App\Http\Requests\Buy\BuyCreateRequest;
use App\Http\Requests\Buy\BuyUpdateRequest;

class BuyController extends Controller
{
    //funcion que me permite ver todas las compras
    public function index()
    {
        if (Buy::count() == 0) 
        {
            $this->json['response'] = 'Ups!, No se encontraron categorias resgitradas =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.Buy::count().' categorias registradas';
            $this->json['error'] = null;
            $this->json['data'] = Buy::all();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }

    //funcion que me retorna en base a su ID las compras
    public function show($id)
    {
        $buy = Buy::find($id);

        if ($buy) 
        { 
            $this->json['response'] = 'Compra encontrada! ;-)';
            $this->json['data'] = $buy;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

            return response()->json($this->json,200);
        }else
        {
            $this->json['response'] = 'Compra no encontrada =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;

            return response()->json($this->json,400);
        }
    }

    //funcion que me guarda un cliente
    public function store(BuyCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 

            $this->json['response'] = 'Compra en espera de confirmación! ;-)';
            $this->json['data'] = Buy::create($data);
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 201;

            return response()->json($this->json,201);

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

    //funcion que me edita un cliente basado en su id
    public function update(ClientUpdateRequest $request, $id)
    { 

        $buy = Buy::find($id);
        $data = $request->validated();

        try
        {
            if ($buy) 
            {
                $buy->update($data);

                $this->json['response'] = 'Compra actualizado ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Compra no encontrado =/';
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

    //funcion que elimina cliente basado en su id
    public function destroy($id)
    {
        $buy = Buy::find($id);
        try
        {
            if ($buy) 
            {
                $this->json['response'] = 'Compra eliminado ;-)';
                $this->json['data'] = $buy;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $buy->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Compra no encontrado =/';
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
