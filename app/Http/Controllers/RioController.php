<?php

namespace App\Http\Controllers;

use App\Rio;
use Illuminate\Http\Request;

class RioController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $rios=Rio::where('zona','=','1')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $rios=Rio::where('zona','=','1')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$rios = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $rios->total(),
                'current_page' => $rios->currentPage(),
                'per_page'     => $rios->perPage(),
                'last_page'    => $rios->lastPage(),
                'from'         => $rios->firstItem(),
                'to'           => $rios->lastItem(),
            ],
            'rios'=>$rios
        ];
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $rios = Rio::findOrFail($request->id);
        $rios->gid=$request->gid;
        $rios->nombre=$request->nombre;
        $rios->tipo_rio=$request->tipo_rio;
        $rios->longitud_m=$request->longitud_m;
        
        //$rios->imagen=$request->imagen;
        /*if ($request->hasFile('imagen')) {
            $rios->imagen=$request->file('imagen')->store('public');
        }*/
        $rios->save();
    }

    public function index2(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $rios=Rio::where('zona','=','2')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $rios=Rio::where('zona','=','2')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$rios = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $rios->total(),
                'current_page' => $rios->currentPage(),
                'per_page'     => $rios->perPage(),
                'last_page'    => $rios->lastPage(),
                'from'         => $rios->firstItem(),
                'to'           => $rios->lastItem(),
            ],
            'rios'=>$rios
        ];
    }

    public function index3(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $rios=Rio::where('zona','=','3')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $rios=Rio::where('zona','=','3')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        //$rios = Compuerta::paginate(2);
        return[
            'pagination' => [
                'total'        => $rios->total(),
                'current_page' => $rios->currentPage(),
                'per_page'     => $rios->perPage(),
                'last_page'    => $rios->lastPage(),
                'from'         => $rios->firstItem(),
                'to'           => $rios->lastItem(),
            ],
            'rios'=>$rios
        ];
    }
}
