<?php

namespace App\Http\Controllers;

use App\Canal;
use Illuminate\Http\Request;

class CanalController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $canales=Canal::where('zona','=','1')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $canales=Canal::where('zona','=','1')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        
        return[
            'pagination' => [
                'total'        => $canales->total(),
                'current_page' => $canales->currentPage(),
                'per_page'     => $canales->perPage(),
                'last_page'    => $canales->lastPage(),
                'from'         => $canales->firstItem(),
                'to'           => $canales->lastItem(),
            ],
            'canales'=>$canales
        ];
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $canales = Canal::findOrFail($request->id);
        $canales->gid=$request->gid;
        $canales->nombre=$request->nombre;
        $canales->longitud=$request->longitud;
        $canales->valvula_in=$request->valvula_in;
        
        //$canales->imagen=$request->imagen;
        /*if ($request->hasFile('imagen')) {
            $canales->imagen=$request->file('imagen')->store('public');
        }*/
        $canales->save();
    }
    public function index2(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $canales=Canal::where('zona','=','2')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $canales=Canal::where('zona','=','2')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        
        return[
            'pagination' => [
                'total'        => $canales->total(),
                'current_page' => $canales->currentPage(),
                'per_page'     => $canales->perPage(),
                'last_page'    => $canales->lastPage(),
                'from'         => $canales->firstItem(),
                'to'           => $canales->lastItem(),
            ],
            'canales'=>$canales
        ];
    }
    public function index3(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $canales=Canal::where('zona','=','3')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $canales=Canal::where('zona','=','3')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        
        return[
            'pagination' => [
                'total'        => $canales->total(),
                'current_page' => $canales->currentPage(),
                'per_page'     => $canales->perPage(),
                'last_page'    => $canales->lastPage(),
                'from'         => $canales->firstItem(),
                'to'           => $canales->lastItem(),
            ],
            'canales'=>$canales
        ];
    }
}
