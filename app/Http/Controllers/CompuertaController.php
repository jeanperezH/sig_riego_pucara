<?php

namespace App\Http\Controllers;

use App\Compuerta;
use App\Valvula;
use Illuminate\Http\Request;


class CompuertaController extends Controller
{
    /*public function ver_datos(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $valvulas = Valvula::all();
        return $valvulas;
    }*/
    
    // para zona 1
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $compuertas=Valvula::where('zona','=','1')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $compuertas=Valvula::where('zona','=','1')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$compuertas = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $compuertas->total(),
                'current_page' => $compuertas->currentPage(),
                'per_page'     => $compuertas->perPage(),
                'last_page'    => $compuertas->lastPage(),
                'from'         => $compuertas->firstItem(),
                'to'           => $compuertas->lastItem(),
            ],
            'compuertas'=>$compuertas
        ];
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $compuertas = Valvula::findOrFail($request->id);
        $compuertas->gid=$request->gid;
        $compuertas->nombre=$request->nombre;
        $compuertas->hora_inici=$request->hora_inici;
        $compuertas->hora_final=$request->hora_final;
        
        $compuertas->utmx=$request->utmx;
        $compuertas->utmy=$request->utmy;
        //$compuertas->imagen=$request->imagen;
        /*if ($request->hasFile('imagen')) {
            $compuertas->imagen=$request->file('imagen')->store('public');
        }*/
        $compuertas->save();
    }
    // para zona2 2
    public function index2(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $compuertas=Valvula::where('zona','=','2')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $compuertas=Valvula::where('zona','=','2')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$compuertas = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $compuertas->total(),
                'current_page' => $compuertas->currentPage(),
                'per_page'     => $compuertas->perPage(),
                'last_page'    => $compuertas->lastPage(),
                'from'         => $compuertas->firstItem(),
                'to'           => $compuertas->lastItem(),
            ],
            'compuertas'=>$compuertas
        ];
    }
    
    // para zona 3
    public function index3(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $compuertas=Valvula::where('zona','=','3')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $compuertas=Valvula::where('zona','=','3')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$compuertas = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $compuertas->total(),
                'current_page' => $compuertas->currentPage(),
                'per_page'     => $compuertas->perPage(),
                'last_page'    => $compuertas->lastPage(),
                'from'         => $compuertas->firstItem(),
                'to'           => $compuertas->lastItem(),
            ],
            'compuertas'=>$compuertas
        ];
    }
    
}
