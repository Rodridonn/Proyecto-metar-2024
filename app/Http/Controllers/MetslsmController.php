<?php

namespace App\Http\Controllers;

use App\Models\Metslsm;
use Illuminate\Http\Request;

class MetslsmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslsm = Metslsm::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslsm->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslsm->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslsm->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslsm->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslsm->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslsm->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslsm->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslsm->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslsm->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslsm->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslsm = $metslsm->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslsm = $metslsm->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslsm->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslsm->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslsm->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslsm->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslsm->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslsm->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslsm->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslsm->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslsm->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslsm->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslsm->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslsm = $metslsm->paginate(1000);
    
        return view('metSLSM.index' , compact('metslsm')) ;
        
        
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLSM.create');
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
        

        $metslsm = new Metslsm();

        $metslsm-> fecha = $request->input('fecha');
        $metslsm-> gg = $request->input('gg');
        $metslsm-> oaci = $request->input('oaci');
        $metslsm-> dd = $request->input('dd');
        $metslsm-> ff = $request->input('ff');
        $metslsm-> fmfm = $request->input('fmfm');
        $metslsm-> vvvv = $request->input('vvvv');
        $metslsm-> dv = $request->input('dv');
        $metslsm-> ww = $request->input('ww');
        $metslsm-> ww1 = $request->input('ww1');        
        $metslsm-> www = $request->input('www');
        $metslsm-> ns1 = $request->input('ns1');
        $metslsm-> hhh1 = $request->input('hhh1');
        $metslsm-> cbtcu1 = $request->input('cbtcu1');
        $metslsm-> ns2 = $request->input('ns2');
        $metslsm-> hhh2 = $request->input('hhh2');
        $metslsm-> cbtcu2 = $request->input('cbtcu2');
        $metslsm-> ns3 = $request->input('ns3');
        $metslsm-> hhh3 = $request->input('hhh3');
        $metslsm-> cbtcu3= $request->input('cbtcu3');
        $metslsm-> ns4 = $request->input('ns4');
        $metslsm-> hhh4 = $request->input('hhh4');
        $metslsm-> tt = $request->input('tt');
        $metslsm-> tbh = $request->input('tbh');
        $metslsm-> td = $request->input('td');
        $metslsm-> qfe = $request->input('qfe');
        $metslsm-> qnh = $request->input('qnh');
        $metslsm-> pulg_hg = $request->input('pulg_hg');
        $metslsm-> uuu = $request->input('uuu');
        $metslsm-> notas = $request->input('notas');
        $metslsm->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslsm')->with(compact('notification'));
    }

    public function edit(Metslsm $metslsm)
    {

        return view('metslsm.edit', compact('metslsm'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metslsm $metslsm)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslsm-> fecha = $request->input('fecha');
        $metslsm-> gg = $request->input('gg');
        $metslsm-> oaci = $request->input('oaci');
        $metslsm-> dd = $request->input('dd');
        $metslsm-> ff = $request->input('ff');
        $metslsm-> fmfm = $request->input('fmfm');
        $metslsm-> vvvv = $request->input('vvvv');
        $metslsm-> dv = $request->input('dv');
        $metslsm-> ww = $request->input('ww');
        $metslsm-> ww1 = $request->input('ww1');        
        $metslsm-> www = $request->input('www');
        $metslsm-> ns1 = $request->input('ns1');
        $metslsm-> hhh1 = $request->input('hhh1');
        $metslsm-> cbtcu1 = $request->input('cbtcu1');
        $metslsm-> ns2 = $request->input('ns2');
        $metslsm-> hhh2 = $request->input('hhh2');
        $metslsm-> cbtcu2 = $request->input('cbtcu2');
        $metslsm-> ns3 = $request->input('ns3');
        $metslsm-> hhh3 = $request->input('hhh3');
        $metslsm-> cbtcu3= $request->input('cbtcu3');
        $metslsm-> ns4 = $request->input('ns4');
        $metslsm-> hhh4 = $request->input('hhh4');
        $metslsm-> tt = $request->input('tt');
        $metslsm-> tbh = $request->input('tbh');
        $metslsm-> td = $request->input('td');
        $metslsm-> qfe = $request->input('qfe');
        $metslsm-> qnh = $request->input('qnh');
        $metslsm-> pulg_hg = $request->input('pulg_hg');
        $metslsm-> uuu = $request->input('uuu');
        $metslsm-> notas = $request->input('notas');
        $metslsm->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslsm')->with(compact('notification'));
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslsm $metslsm)
    {
        $deleteName = $metslsm->oaci;
        $deleteid = $metslsm->id;

        $metslsm->delete('/metslsm');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslsm')->with(compact('notification'));
    }
}
