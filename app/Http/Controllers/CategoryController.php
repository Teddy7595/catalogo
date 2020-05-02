<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    //funcion que me permite ver todas las categorias
    public function index()
    {
        if (Category::count() == 0) 
        {
            $this->json['response'] = 'Ups!, No se encontraron categorias resgitradas =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.Category::count().' categorias registradas';
            $this->json['error'] = null;
            $this->json['data'] = Category::all();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }

    //funcion que me retorna en base a su ID una categoria
    public function show($id)
    {
        $category = Category::find($id);

        if ($category) 
        { 
            $this->json['response'] = 'Categoria encontrada! ;-)';
            $this->json['data'] = $category;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 202;

            return response()->json($this->json,202);
        }else
        {
            $this->json['response'] = 'Categoria no encontrada =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;

            return response()->json($this->json,400);
        }
    }

    //funcion que me permite agregar una categoria
    public function store(CategoryCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 

            $this->json['response'] = 'Categoria creada!! ;-)';
            $this->json['data'] = Category::Create($data);
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 201;

            return response()->json($this->json,201);

        }catch(\Throwable $e)
        {
            $this->json['response'] = 'Ups!, ha ocurrido un error =/';;
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = false;
            $this->json['status'] = 500;

            return response()->json($this->json, 500);
        }
    }

    //funcion que me edita una categoria y su departamento basado en su id
    public function update(CategoryUpdateRequest $request, $id)
    { 

        $category = Category::find($id);
        $data = $request->validated();

        try
        {
            if ($category) 
            {
                $category->update($data);

                $this->json['response'] = 'Categoria actualizada ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Categoria no encontrada =/';
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
        $category = Category::find($id);
        try
        {
            if ($category) 
            {
                $this->json['response'] = 'Categoria eliminada ;-)';
                $this->json['data'] = $category;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $category->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Categoria no encontrada =/';
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
