<?php

namespace App\Http\Controllers;

use App\Models\Metsltr;
use Illuminate\Http\Request;

class MetsltrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index(Request $request){
        $metsltr = Metsltr::query();   

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metsltr->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metsltr->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metsltr->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        }     


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metsltr->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metsltr->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metsltr->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metsltr->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metsltr->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metsltr->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metsltr->where('fmfm', $request->input('fmfm'));
        }

        
        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metsltr = $metsltr->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metsltr = $metsltr->where('vvvv', $vvvv);
        }
        

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metsltr->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metsltr->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
        
            $metsltr->where('tt', '>=', min($tt_inicio, $tt_fin))
                         ->where('tt', '<=', max($tt_inicio, $tt_fin));
        } elseif ($request->filled('tt')) {
            $tt = $request->input('tt');
            $metsltr->where('tt', $tt);
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
        
            $metsltr->where('tbh', '>=', min($tbh_inicio, $tbh_fin))
                         ->where('tbh', '<=', max($tbh_inicio, $tbh_fin));
        } elseif ($request->filled('tbh')) {
            $tbh = $request->input('tbh');
            $metsltr->where('tbh', $tbh);
        }



        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
        
            $metsltr->where('td', '>=', min($td_inicio, $td_fin))
                         ->where('td', '<=', max($td_inicio, $td_fin));
        } elseif ($request->filled('td')) {
            $td = $request->input('td');
            $metsltr->where('td', $td);
        }


        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metsltr->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metsltr->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metsltr->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metsltr = $metsltr->paginate(1000);
    
        return view('metsltr.index' , compact('metsltr')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('metsltr.create');
    }

    public function sendData(Request $request){

        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
            'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        

        $metsltr = new Metsltr();

        $metsltr-> fecha = $request->input('fecha');
        $metsltr-> gg = $request->input('gg');
        $metsltr-> oaci = $request->input('oaci');
        $metsltr-> dd = $request->input('dd');
        $metsltr-> ff = $request->input('ff');
        $metsltr-> fmfm = $request->input('fmfm');
        $metsltr-> vvvv = $request->input('vvvv');
        $metsltr-> dv = $request->input('dv');
        $metsltr-> ww = $request->input('ww');
        $metsltr-> ww1 = $request->input('ww1');        
        $metsltr-> www = $request->input('www');
        $metsltr-> ns1 = $request->input('ns1');
        $metsltr-> hhh1 = $request->input('hhh1');
        $metsltr-> cbtcu1 = $request->input('cbtcu1');
        $metsltr-> ns2 = $request->input('ns2');
        $metsltr-> hhh2 = $request->input('hhh2');
        $metsltr-> cbtcu2 = $request->input('cbtcu2');
        $metsltr-> ns3 = $request->input('ns3');
        $metsltr-> hhh3 = $request->input('hhh3');
        $metsltr-> cbtcu3= $request->input('cbtcu3');
        $metsltr-> ns4 = $request->input('ns4');
        $metsltr-> hhh4 = $request->input('hhh4');
        $metsltr-> tt = $request->input('tt');
        $metsltr-> tbh = $request->input('tbh');
        $metsltr-> td = $request->input('td');
        $metsltr-> qfe = $request->input('qfe');
        $metsltr-> qnh = $request->input('qnh');
        $metsltr-> pulg_hg = $request->input('pulg_hg');
        $metsltr-> p_cord = $request->input('p_cord');
        $metsltr-> uuu = $request->input('uuu');
        $metsltr-> notas = $request->input('notas');
        $metsltr->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metsltr')->with(compact('notification'));
    }

    public function edit(Metsltr $metsltr)
    {

        return view('metsltr.edit', compact('metsltr'));
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
    public function update(Request $request, Metsltr $metsltr)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metsltr-> fecha = $request->input('fecha');
        $metsltr-> gg = $request->input('gg');
        $metsltr-> oaci = $request->input('oaci');
        $metsltr-> dd = $request->input('dd');
        $metsltr-> ff = $request->input('ff');
        $metsltr-> fmfm = $request->input('fmfm');
        $metsltr-> vvvv = $request->input('vvvv');
        $metsltr-> dv = $request->input('dv');
        $metsltr-> ww = $request->input('ww');
        $metsltr-> ww1 = $request->input('ww1');        
        $metsltr-> www = $request->input('www');
        $metsltr-> ns1 = $request->input('ns1');
        $metsltr-> hhh1 = $request->input('hhh1');
        $metsltr-> cbtcu1 = $request->input('cbtcu1');
        $metsltr-> ns2 = $request->input('ns2');
        $metsltr-> hhh2 = $request->input('hhh2');
        $metsltr-> cbtcu2 = $request->input('cbtcu2');
        $metsltr-> ns3 = $request->input('ns3');
        $metsltr-> hhh3 = $request->input('hhh3');
        $metsltr-> cbtcu3= $request->input('cbtcu3');
        $metsltr-> ns4 = $request->input('ns4');
        $metsltr-> hhh4 = $request->input('hhh4');
        $metsltr-> tt = $request->input('tt');
        $metsltr-> tbh = $request->input('tbh');
        $metsltr-> td = $request->input('td');
        $metsltr-> qfe = $request->input('qfe');
        $metsltr-> qnh = $request->input('qnh');
        $metsltr-> pulg_hg = $request->input('pulg_hg');
        $metsltr-> uuu = $request->input('uuu');
        $metsltr-> notas = $request->input('notas');
        $metsltr->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metsltr')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metsltr $metsltr)
    {
        $deleteName = $metsltr->oaci;
        $deleteid = $metsltr->id;

        $metsltr->delete('/metsltr');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metsltr')->with(compact('notification'));
    }
}
