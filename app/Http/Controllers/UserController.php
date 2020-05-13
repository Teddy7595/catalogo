<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\ClientCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{

    public function token(){ return csrf_token();}

    //funcion que me retorna todos los usuarios
    public function index()
    {
        //funcion que retorna todos los usuarios registrados

        if (User::count() == 0) 
        {
            $this->json['response'] = 'ops!, No se encontraron usuarios =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.User::count().' usuarios';
            $this->json['error'] = null;
            $this->json['data'] = User::with('client')->get();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }    

    //funcion que me retorna en base a su ID un usuario
    public function show($id)
    {
        $user = User::find($id);

        if ($user) 
        { 
            $this->json['response'] = 'Usuario encontrado! ;-)';
            $this->json['data'] = $user;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 202;

            return response()->json($this->json,202);
        }else
        {
            $this->json['response'] = 'Usuario no encontrado =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;

            return response()->json($this->json,400);
        }
    }

    //funcion que me guarda un usuario 
    public function store(UserCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 
            $data['password'] = hash('sha256', $data['password']); 
            $var = User::create($data);
            Client::create(
            ([
                'user_id' => $var->id,
                'adress1' => $data['adress1'],
                'adress2' => 'No Disponible',
                'phone1' => 'No Disponible',
                'phone2' => 'No Disponible',
            ]));


            $this->json['response'] = 'Usuario creado! verifique su cuenta ;-)';
            $this->json['data'] = User::with('client')->find($var->id);
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 201;

            return response()->json($this->json,201);

        }catch(\Throwable $e)
        {
            $this->json['response'] = 'Ups!, ha ocurrido un error =/' .$e->getMessage();
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = false;
            $this->json['status'] = 500;

            return response()->json($this->json, 500);
        }
    }

    //funcion que me edita un usuario basado en su id
    public function update(UserUpdateRequest $request, $id)
    { 

        $user = User::find($id);
        $data = $request->validated();
        $data['password'] = hash('sha256', $data['password']);

        try
        {
            if ($user) 
            {
                $user->update($data);
                $data['password'] = '*************************';

                $this->json['response'] = 'Usuario actualizado ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Usuario no encontrado =/';
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

    //funcion que elimina usuarios basado en su id
    public function destroy($id)
    {
        $user = User::find($id);
        try
        {
            if ($user) 
            {
                $this->json['response'] = 'Usuario eliminado ;-)';
                $this->json['data'] = $user;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $user->client()->delete();
                $user->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Usuario no encontrado =/';
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
