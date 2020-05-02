<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Requests\Quote\QuoteCreateRequest;

class QuoteController extends Controller
{
    //funcion que me retorna todas las cotizaciones
    public function index()
    {

        if (Quote::count() == 0) 
        {
            $this->json['response'] = 'Ups!, No se encontraron cotizaciones =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

        }else
        {
            $this->json['response'] = 'Se encontró '.Quote::count().' cotizaciones';
            $this->json['error'] = null;
            $this->json['data'] = Quote::all();
            $this->json['ok'] = true;
            $this->json['status'] = 200;
        }

        return response()->json($this->json,200);
    }

    //funcion que me retorna en base a su ID una cotizacion
    public function show($id)
    {
        $quote = Quote::find($id);

        if ($quote) 
        { 
            $this->json['response'] = 'Cotizacion encontrada! ;-)';
            $this->json['data'] = $quote;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 200;

            return response()->json($this->json,200);
        }else
        {
            $this->json['response'] = 'Cotizacion no encontrada =/';
            $this->json['data'] = null;
            $this->json['error'] = null;
            $this->json['ok'] = true;
            $this->json['status'] = 400;

            return response()->json($this->json,400);
        }
    }

    //funcion que me guarda una cotizacion
    public function store(QuoteCreateRequest $request)
    {
        try
        {
            $data = $request->validated(); 
            $data['bsdls'] = str_replace(',','.',$data['bsdls']); 
            $data['bseur'] = str_replace(',','.',$data['bseur']); 

            $this->json['response'] = 'Cotización creada!! ;-)';
            $this->json['data'] = Quote::Create($data);
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

    //funcion que me edita una cotizacion basado en su id
    public function update(QuoteCreateRequest $request, $id)
    { 

        $quote = Quote::find($id);
        $data = $request->validated();

        try
        {
            if ($quote) 
            {
                $quote->update($data);

                $this->json['response'] = 'Cotización actualizada ;-)';
                $this->json['data'] = $data; 
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cotización no encontrada =/';
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

    //funcion que elimina una cotizacion basado en su id
    public function destroy($id)
    {
        $quote = Quote::find($id);
        try
        {
            if ($quote) 
            {
                $this->json['response'] = 'Cotización eliminada ;-)';
                $this->json['data'] = $quote;
                $this->json['error'] = null;
                $this->json['ok'] = true;
                $this->json['status'] = 200;

                $quote->delete();

                return response()->json($this->json,200);
            }else
            {
                $this->json['response'] = 'Cotización no encontrado =/';
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
