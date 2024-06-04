<?php

namespace App\Http\Controllers;

use App\Models\Metslra;
use Illuminate\Http\Request;

class MetslraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslra = Metslra::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslra->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslra->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslra->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslra->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslra->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslra->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslra->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslra->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslra->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslra->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslra = $metslra->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslra = $metslra->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslra->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslra->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslra->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslra->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslra->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslra->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslra->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslra->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslra->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslra->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslra->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslra = $metslra->paginate(1000);
    
        return view('metSLRA.index' , compact('metslra')) ;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLRA.create');
    }

    public function sendData(Request $request)
    {
        $rules = [
            'oaci' => 'required|min:4'
        ];
        $messages = [
            'oaci.required' => 'La sigla OACI es obligatoria',
            'oaci.min' => 'La sigla OACI debe tener 4 caracteres'
        ];
        $this->validate($request, $rules, $messages);
        

        $metslra = new Metslra();

        $metslra-> fecha = $request->input('fecha');
        $metslra-> gg = $request->input('gg');
        $metslra-> oaci = $request->input('oaci');
        $metslra-> dd = $request->input('dd');
        $metslra-> ff = $request->input('ff');
        $metslra-> fmfm = $request->input('fmfm');
        $metslra-> vvvv = $request->input('vvvv');
        $metslra-> dv = $request->input('dv');
        $metslra-> ww = $request->input('ww');
        $metslra-> ww1 = $request->input('ww1');        
        $metslra-> www = $request->input('www');
        $metslra-> ns1 = $request->input('ns1');
        $metslra-> hhh1 = $request->input('hhh1');
        $metslra-> cbtcu1 = $request->input('cbtcu1');
        $metslra-> ns2 = $request->input('ns2');
        $metslra-> hhh2 = $request->input('hhh2');
        $metslra-> cbtcu2 = $request->input('cbtcu2');
        $metslra-> ns3 = $request->input('ns3');
        $metslra-> hhh3 = $request->input('hhh3');
        $metslra-> cbtcu3= $request->input('cbtcu3');
        $metslra-> ns4 = $request->input('ns4');
        $metslra-> hhh4 = $request->input('hhh4');
        $metslra-> tt = $request->input('tt');
        $metslra-> tbh = $request->input('tbh');
        $metslra-> td = $request->input('td');
        $metslra-> qfe = $request->input('qfe');
        $metslra-> qnh = $request->input('qnh');
        $metslra-> pulg_hg = $request->input('pulg_hg');
        $metslra-> uuu = $request->input('uuu');
        $metslra-> notas = $request->input('notas');
        $metslra->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslra')->with(compact('notification'));
    }

    
    public function edit(Metslra $metslra)
    {

        return view('metslra.edit', compact('metslra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metslra $metslra)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslra-> fecha = $request->input('fecha');
        $metslra-> gg = $request->input('gg');
        $metslra-> oaci = $request->input('oaci');
        $metslra-> dd = $request->input('dd');
        $metslra-> ff = $request->input('ff');
        $metslra-> fmfm = $request->input('fmfm');
        $metslra-> vvvv = $request->input('vvvv');
        $metslra-> dv = $request->input('dv');
        $metslra-> ww = $request->input('ww');
        $metslra-> ww1 = $request->input('ww1');        
        $metslra-> www = $request->input('www');
        $metslra-> ns1 = $request->input('ns1');
        $metslra-> hhh1 = $request->input('hhh1');
        $metslra-> cbtcu1 = $request->input('cbtcu1');
        $metslra-> ns2 = $request->input('ns2');
        $metslra-> hhh2 = $request->input('hhh2');
        $metslra-> cbtcu2 = $request->input('cbtcu2');
        $metslra-> ns3 = $request->input('ns3');
        $metslra-> hhh3 = $request->input('hhh3');
        $metslra-> cbtcu3= $request->input('cbtcu3');
        $metslra-> ns4 = $request->input('ns4');
        $metslra-> hhh4 = $request->input('hhh4');
        $metslra-> tt = $request->input('tt');
        $metslra-> tbh = $request->input('tbh');
        $metslra-> td = $request->input('td');
        $metslra-> qfe = $request->input('qfe');
        $metslra-> qnh = $request->input('qnh');
        $metslra-> pulg_hg = $request->input('pulg_hg');
        $metslra-> uuu = $request->input('uuu');
        $metslra-> notas = $request->input('notas');
        $metslra->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslra')->with(compact('notification'));
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslra $metslra)
    {
        $deleteName = $metslra->oaci;
        $deleteid = $metslra->id;

        $metslra->delete('/metslra');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslra')->with(compact('notification'));
    }
}