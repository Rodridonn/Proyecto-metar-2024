<?php

namespace App\Http\Controllers;

use App\Models\Metslsa;
use Illuminate\Http\Request;

class MetslsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslsa = Metslsa::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslsa->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslsa->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslsa->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslsa->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslsa->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslsa->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslsa->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslsa->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslsa->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslsa->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslsa = $metslsa->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslsa = $metslsa->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslsa->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslsa->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslsa->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslsa->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslsa->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslsa->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslsa->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslsa->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslsa->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslsa->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslsa->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslsa = $metslsa->paginate(1000);
    
        return view('metSLSA.index' , compact('metslsa')) ;
        
        
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLSA.create');
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
        

        $metslsa = new Metslsa();

        $metslsa-> fecha = $request->input('fecha');
        $metslsa-> gg = $request->input('gg');
        $metslsa-> oaci = $request->input('oaci');
        $metslsa-> dd = $request->input('dd');
        $metslsa-> ff = $request->input('ff');
        $metslsa-> fmfm = $request->input('fmfm');
        $metslsa-> vvvv = $request->input('vvvv');
        $metslsa-> dv = $request->input('dv');
        $metslsa-> ww = $request->input('ww');
        $metslsa-> ww1 = $request->input('ww1');        
        $metslsa-> www = $request->input('www');
        $metslsa-> ns1 = $request->input('ns1');
        $metslsa-> hhh1 = $request->input('hhh1');
        $metslsa-> cbtcu1 = $request->input('cbtcu1');
        $metslsa-> ns2 = $request->input('ns2');
        $metslsa-> hhh2 = $request->input('hhh2');
        $metslsa-> cbtcu2 = $request->input('cbtcu2');
        $metslsa-> ns3 = $request->input('ns3');
        $metslsa-> hhh3 = $request->input('hhh3');
        $metslsa-> cbtcu3= $request->input('cbtcu3');
        $metslsa-> ns4 = $request->input('ns4');
        $metslsa-> hhh4 = $request->input('hhh4');
        $metslsa-> tt = $request->input('tt');
        $metslsa-> tbh = $request->input('tbh');
        $metslsa-> td = $request->input('td');
        $metslsa-> qfe = $request->input('qfe');
        $metslsa-> qnh = $request->input('qnh');
        $metslsa-> pulg_hg = $request->input('pulg_hg');
        $metslsa-> uuu = $request->input('uuu');
        $metslsa-> notas = $request->input('notas');
        $metslsa->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslsa')->with(compact('notification'));
    }

    public function edit(metslsa $metslsa)
    {

        return view('metslsa.edit', compact('metslsa'));
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
    public function update(Request $request, Metslsa $metslsa)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslsa-> fecha = $request->input('fecha');
        $metslsa-> gg = $request->input('gg');
        $metslsa-> oaci = $request->input('oaci');
        $metslsa-> dd = $request->input('dd');
        $metslsa-> ff = $request->input('ff');
        $metslsa-> fmfm = $request->input('fmfm');
        $metslsa-> vvvv = $request->input('vvvv');
        $metslsa-> dv = $request->input('dv');
        $metslsa-> ww = $request->input('ww');
        $metslsa-> ww1 = $request->input('ww1');        
        $metslsa-> www = $request->input('www');
        $metslsa-> ns1 = $request->input('ns1');
        $metslsa-> hhh1 = $request->input('hhh1');
        $metslsa-> cbtcu1 = $request->input('cbtcu1');
        $metslsa-> ns2 = $request->input('ns2');
        $metslsa-> hhh2 = $request->input('hhh2');
        $metslsa-> cbtcu2 = $request->input('cbtcu2');
        $metslsa-> ns3 = $request->input('ns3');
        $metslsa-> hhh3 = $request->input('hhh3');
        $metslsa-> cbtcu3= $request->input('cbtcu3');
        $metslsa-> ns4 = $request->input('ns4');
        $metslsa-> hhh4 = $request->input('hhh4');
        $metslsa-> tt = $request->input('tt');
        $metslsa-> tbh = $request->input('tbh');
        $metslsa-> td = $request->input('td');
        $metslsa-> qfe = $request->input('qfe');
        $metslsa-> qnh = $request->input('qnh');
        $metslsa-> pulg_hg = $request->input('pulg_hg');
        $metslsa-> uuu = $request->input('uuu');
        $metslsa-> notas = $request->input('notas');
        $metslsa->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslsa')->with(compact('notification'));
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslsa $metslsa)
    {
        $deleteName = $metslsa->oaci;
        $deleteid = $metslsa->id;

        $metslsa->delete('/metslsa');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslsa')->with(compact('notification'));
    }
}
