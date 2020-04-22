<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserDeleteRequest;

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
            $this->json['response'] = 'Se encontró '.User::all()->count().' usuarios';
            $this->json['error'] = null;
            $this->json['data'] = User::all();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,202);
    }    

    //funcion que me retorna en base a su ID un usuario
    public function show($id)
    {
        //BUSCO EL USUARIO Y LO ENCUENTRA HAGO EL POCEDIMIENTO, DE LO CONTRARIO DEVUELVO
        //NO ENCONTRADO

        if (User::find($id)) 
        { 
            $this->json['response'] = 'Usuario encontrado! ;-)';
            $this->json['data'] = User::find($id);
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
            $data['is_admin'] = false;

            $this->json['response'] = 'Usuario creado! verifique su cuenta ;-)';
            $this->json['data'] = User::create($data);
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

    //funcion que me edita un usuario basado en su id
    public function update(UserUpdateRequest $request, $id)
    { 

        $user = User::find($id);
        $data = $request->validated();
        try
        {
            if ($user) 
            {
                $this->json['response'] = 'Usuario actualizado ;-)';
                $this->json['data'] = $user;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $user->name = $data['name'];
                $user->ci = $data['ci'];
                $user->email = $data['email'];
                $user->password = hash('sha256', $data['password']); 

                $user->save();

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
    public function delete($id)
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
