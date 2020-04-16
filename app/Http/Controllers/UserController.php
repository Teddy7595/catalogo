<?php

namespace App\Http\Controllers;

use App\models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

   private $message = array();

   public function token()
   {
        return csrf_token();
   }

   public function login()
   {
        //CERTIFICARÁ MEDIANTE UNA VARIABLE DE SESION EL LOGIN DE USUARIO Y ESTABLECERÁ UN TOKEN DE USO
   }


   public function index()
   {
        //MENTODO QUE RETORNA TODOS LOS USUARIOS
        $this->message['response'] = usuario::all();
        $this->message['status'] = 200;
        return json_encode($this->message);
   }

   public function show($id)
   {
        //METODO QUE RETORNARA LOS USUARIOS EN BASE A SU ID
        if (usuario::where('id',$id)->exists())
        { 
            $this->message['response'] = usuario::where('id',$id)->get();
            $this->message['status'] = 200; 

        }else
        {
            $this->message['response'] = 'No se encontro el usuario';
            $this->message['status'] = 400;
        }

        return json_encode($message);
   }

   private function create($request)
   {
        //METODO QUE CREA UN USUARIO
        try
        {
            $user = usuario::create
            ([
                'name'=> $request->name,
                'lstname' => $request->lstname,
                'pass' => hash('sha256', $request->pass),
                'mail' => $request->mail,
                'photo' => 'default.png'
            ]);

            $user->create_at = date('d-m-Y H:i:s');
            $user->role = 'ROLE_USR';
            $user->key_api = Crypt::encryptString($request->mail);
            $user->save();

            $this->message['response'] = $user;
            $this->message['status'] = 201;

        }catch(\Throwable $e)
        { 
            $this->message['response'] = 'Error al guardar los datos. Por favor reintente...';
            $this->message['status'] = 500;
            usuario::where('mail',$user->mail)->delete();
        }

        return response()->json($this->message);
   }

   public function store(Request $request)
   {
        
        //METODO QUE AGREGA UN NVO USUARIO
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'lstname' => 'required',
            'mail' => 'required',
            'pass' => 'required'
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if (usuario::where('mail', $request->mail)->exists()) 
        {
            $this->message['response'] = 'Este correo ya esta siendo utilizado';
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        return $this->create($request);
   }

   public function update(Request $request, $id)
   {
        //METODO QUE ACTUALIZA UN USUARIO ID
        $user = usuario::find($id);
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'lstname' => 'required',
            'mail' => 'required',
            'pass' => 'required'
        ]);

        if ($validator->fails()) 
        {
            $this->message['response'] = $validator->messages();
            $this->message['status'] = 400;
            return response()->json($this->message);
        }

        if ($user) 
        {
            $user->name = $request->name;
            $user->lstname = $request->lstname;
            $user->mail = $request->mail;
            $user->pass = hash('sha256', $request->pass);

            $user->save();
            $this->message['response'] = $user;
            $this->message['status'] = 202;
            
            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'USUARIO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }

   }

   public function destroy(Request $request, $id)
   {
        //METODO QUE BORRA UN USUARIO EN BASE A SU ID
        $user = usuario::find($id);
        if ($user) 
        {
            $this->message['response'] = $user;
            $this->message['status'] = 202;
            $user->delete();

            return response()->json($this->message);
        }else
        {
            $this->message['response'] = 'USUARIO no encontrado o no valido';
            $this->message['status'] = 400;

            return response()->json($this->message); 
        }
   }
}
