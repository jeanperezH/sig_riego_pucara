<?php

namespace App\Http\Controllers;

use App\Chacra;
use Illuminate\Http\Request;


class ChacraController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $chacras=Chacra::where('zona','=','1')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $chacras=Chacra::where('zona','=','1')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        return[
            'pagination' => [
                'total'        => $chacras->total(),
                'current_page' => $chacras->currentPage(),
                'per_page'     => $chacras->perPage(),
                'last_page'    => $chacras->lastPage(),
                'from'         => $chacras->firstItem(),
                'to'           => $chacras->lastItem(),
            ],
            'chacras'=>$chacras
        ];
    }

    public function index2(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $chacras=Chacra::where('zona','=','2')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $chacras=Chacra::where('zona','=','2')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        return[
            'pagination' => [
                'total'        => $chacras->total(),
                'current_page' => $chacras->currentPage(),
                'per_page'     => $chacras->perPage(),
                'last_page'    => $chacras->lastPage(),
                'from'         => $chacras->firstItem(),
                'to'           => $chacras->lastItem(),
            ],
            'chacras'=>$chacras
        ];
    }

    public function index3(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $chacras=Chacra::where('zona','=','3')
            ->orderBy('id','asc')
            ->paginate(5);
        }else{
            $chacras=Chacra::where('zona','=','3')
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('id','asc')
            ->paginate(3);
        }

        return[
            'pagination' => [
                'total'        => $chacras->total(),
                'current_page' => $chacras->currentPage(),
                'per_page'     => $chacras->perPage(),
                'last_page'    => $chacras->lastPage(),
                'from'         => $chacras->firstItem(),
                'to'           => $chacras->lastItem(),
            ],
            'chacras'=>$chacras
        ];
    }
}
