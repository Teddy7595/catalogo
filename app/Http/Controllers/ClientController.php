<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client\ClientCreateRequest;

class ClientController extends Controller
{
    //funcion que me permite ver todas los clientes
    public function index()
    {
        if (Client::count() == 0) 
        {
            $this->json['response'] = 'Ups!, No se encontraron clientes resgitrados =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.Client::count().' clientes registrados';
            $this->json['error'] = null;
            $this->json['data'] = Client::with('user')->get();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }

    //funcion que me retorna en base a su ID un cliente
    public function show($id)
    {
        $client = Client::find($id)->user();

        if ($client) 
        { 
            $this->json['response'] = 'Cliente encontrado! ;-)';
            $this->json['data'] = $client;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

            return response()->json($this->json,200);
        }else
        {
            $this->json['response'] = 'Cliente no encontrado =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;

            return response()->json($this->json,400);
        }
    }

    //funcion que me guarda un cliente
    public function store(ClientCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 

            $this->json['response'] = 'Cuenta cliente configurada! ;-)';
            $this->json['data'] = Client::create($data);
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
    public function update(ClientCreateRequest $request, $id)
    { 

        $client = Client::find($id);
        $data = $request->validated();

        try
        {
            if ($client) 
            {
                $client->update($data);

                $this->json['response'] = 'Cliente actualizado ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cliente no encontrado =/';
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
        $client = Client::find($id);
        try
        {
            if ($client) 
            {
                $this->json['response'] = 'Cliente eliminado ;-)';
                $this->json['data'] = $client;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $client->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cliente no encontrado =/';
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
