<?php

namespace App\Http\Controllers;

use App\Models\Metslri;
use Illuminate\Http\Request;

class MetslriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslri = Metslri::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslri->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslri->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslri->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslri->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslri->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslri->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslri->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslri->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslri->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslri->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslri = $metslri->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslri = $metslri->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslri->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslri->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslri->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslri->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslri->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslri->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslri->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslri->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslri->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslri->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslri->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslri = $metslri->paginate(1000);
    
        return view('metSLRI.index' , compact('metslri')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLRI.create');
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
        

        $metslri = new Metslri();

        $metslri-> fecha = $request->input('fecha');
        $metslri-> gg = $request->input('gg');
        $metslri-> oaci = $request->input('oaci');
        $metslri-> dd = $request->input('dd');
        $metslri-> ff = $request->input('ff');
        $metslri-> fmfm = $request->input('fmfm');
        $metslri-> vvvv = $request->input('vvvv');
        $metslri-> dv = $request->input('dv');
        $metslri-> ww = $request->input('ww');
        $metslri-> ww1 = $request->input('ww1');        
        $metslri-> www = $request->input('www');
        $metslri-> ns1 = $request->input('ns1');
        $metslri-> hhh1 = $request->input('hhh1');
        $metslri-> cbtcu1 = $request->input('cbtcu1');
        $metslri-> ns2 = $request->input('ns2');
        $metslri-> hhh2 = $request->input('hhh2');
        $metslri-> cbtcu2 = $request->input('cbtcu2');
        $metslri-> ns3 = $request->input('ns3');
        $metslri-> hhh3 = $request->input('hhh3');
        $metslri-> cbtcu3= $request->input('cbtcu3');
        $metslri-> ns4 = $request->input('ns4');
        $metslri-> hhh4 = $request->input('hhh4');
        $metslri-> tt = $request->input('tt');
        $metslri-> tbh = $request->input('tbh');
        $metslri-> td = $request->input('td');
        $metslri-> qfe = $request->input('qfe');
        $metslri-> qnh = $request->input('qnh');
        $metslri-> pulg_hg = $request->input('pulg_hg');
        $metslri-> uuu = $request->input('uuu');
        $metslri-> notas = $request->input('notas');
        $metslri->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslri')->with(compact('notification'));
    }

    public function edit(metslri $metslri)
    {

        return view('metslri.edit', compact('metslri'));
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
    public function update(Request $request, Metslri $metslri)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslri-> fecha = $request->input('fecha');
        $metslri-> gg = $request->input('gg');
        $metslri-> oaci = $request->input('oaci');
        $metslri-> dd = $request->input('dd');
        $metslri-> ff = $request->input('ff');
        $metslri-> fmfm = $request->input('fmfm');
        $metslri-> vvvv = $request->input('vvvv');
        $metslri-> dv = $request->input('dv');
        $metslri-> ww = $request->input('ww');
        $metslri-> ww1 = $request->input('ww1');        
        $metslri-> www = $request->input('www');
        $metslri-> ns1 = $request->input('ns1');
        $metslri-> hhh1 = $request->input('hhh1');
        $metslri-> cbtcu1 = $request->input('cbtcu1');
        $metslri-> ns2 = $request->input('ns2');
        $metslri-> hhh2 = $request->input('hhh2');
        $metslri-> cbtcu2 = $request->input('cbtcu2');
        $metslri-> ns3 = $request->input('ns3');
        $metslri-> hhh3 = $request->input('hhh3');
        $metslri-> cbtcu3= $request->input('cbtcu3');
        $metslri-> ns4 = $request->input('ns4');
        $metslri-> hhh4 = $request->input('hhh4');
        $metslri-> tt = $request->input('tt');
        $metslri-> tbh = $request->input('tbh');
        $metslri-> td = $request->input('td');
        $metslri-> qfe = $request->input('qfe');
        $metslri-> qnh = $request->input('qnh');
        $metslri-> pulg_hg = $request->input('pulg_hg');
        $metslri-> uuu = $request->input('uuu');
        $metslri-> notas = $request->input('notas');
        $metslri->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslri')->with(compact('notification'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslri $metslri)
    {
        $deleteName = $metslri->oaci;
        $deleteid = $metslri->id;

        $metslri->delete('/metslri');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslri')->with(compact('notification'));
    }
    
}