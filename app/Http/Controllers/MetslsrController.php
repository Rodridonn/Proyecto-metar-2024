<?php

namespace App\Http\Controllers;
use App\Models\Metslsr;
use Illuminate\Http\Request;

class MetslsrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslsr = Metslsr::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslsr->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslsr->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslsr->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslsr->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslsr->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslsr->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslsr->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslsr->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslsr->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslsr->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslsr = $metslsr->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslsr = $metslsr->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslsr->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslsr->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslsr->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslsr->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslsr->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslsr->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslsr->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslsr->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslsr->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslsr->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslsr->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslsr = $metslsr->paginate(1000);
    
        return view('metSLSR.index' , compact('metslsr')) ;
        
        
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLSR.create');
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
        

        $metslsr = new Metslsr();

        $metslsr-> fecha = $request->input('fecha');
        $metslsr-> gg = $request->input('gg');
        $metslsr-> oaci = $request->input('oaci');
        $metslsr-> dd = $request->input('dd');
        $metslsr-> ff = $request->input('ff');
        $metslsr-> fmfm = $request->input('fmfm');
        $metslsr-> vvvv = $request->input('vvvv');
        $metslsr-> dv = $request->input('dv');
        $metslsr-> ww = $request->input('ww');
        $metslsr-> ww1 = $request->input('ww1');        
        $metslsr-> www = $request->input('www');
        $metslsr-> ns1 = $request->input('ns1');
        $metslsr-> hhh1 = $request->input('hhh1');
        $metslsr-> cbtcu1 = $request->input('cbtcu1');
        $metslsr-> ns2 = $request->input('ns2');
        $metslsr-> hhh2 = $request->input('hhh2');
        $metslsr-> cbtcu2 = $request->input('cbtcu2');
        $metslsr-> ns3 = $request->input('ns3');
        $metslsr-> hhh3 = $request->input('hhh3');
        $metslsr-> cbtcu3= $request->input('cbtcu3');
        $metslsr-> ns4 = $request->input('ns4');
        $metslsr-> hhh4 = $request->input('hhh4');
        $metslsr-> tt = $request->input('tt');
        $metslsr-> tbh = $request->input('tbh');
        $metslsr-> td = $request->input('td');
        $metslsr-> qfe = $request->input('qfe');
        $metslsr-> qnh = $request->input('qnh');
        $metslsr-> pulg_hg = $request->input('pulg_hg');
        $metslsr-> uuu = $request->input('uuu');
        $metslsr-> notas = $request->input('notas');
        $metslsr->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslsr')->with(compact('notification'));
    }

    public function edit(Metslsr $metslsr)
    {

        return view('metslsr.edit', compact('metslsr'));
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
    public function update(Request $request, Metslsr $metslsr)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslsr-> fecha = $request->input('fecha');
        $metslsr-> gg = $request->input('gg');
        $metslsr-> oaci = $request->input('oaci');
        $metslsr-> dd = $request->input('dd');
        $metslsr-> ff = $request->input('ff');
        $metslsr-> fmfm = $request->input('fmfm');
        $metslsr-> vvvv = $request->input('vvvv');
        $metslsr-> dv = $request->input('dv');
        $metslsr-> ww = $request->input('ww');
        $metslsr-> ww1 = $request->input('ww1');        
        $metslsr-> www = $request->input('www');
        $metslsr-> ns1 = $request->input('ns1');
        $metslsr-> hhh1 = $request->input('hhh1');
        $metslsr-> cbtcu1 = $request->input('cbtcu1');
        $metslsr-> ns2 = $request->input('ns2');
        $metslsr-> hhh2 = $request->input('hhh2');
        $metslsr-> cbtcu2 = $request->input('cbtcu2');
        $metslsr-> ns3 = $request->input('ns3');
        $metslsr-> hhh3 = $request->input('hhh3');
        $metslsr-> cbtcu3= $request->input('cbtcu3');
        $metslsr-> ns4 = $request->input('ns4');
        $metslsr-> hhh4 = $request->input('hhh4');
        $metslsr-> tt = $request->input('tt');
        $metslsr-> tbh = $request->input('tbh');
        $metslsr-> td = $request->input('td');
        $metslsr-> qfe = $request->input('qfe');
        $metslsr-> qnh = $request->input('qnh');
        $metslsr-> pulg_hg = $request->input('pulg_hg');
        $metslsr-> uuu = $request->input('uuu');
        $metslsr-> notas = $request->input('notas');
        $metslsr->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslsr')->with(compact('notification'));
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslsr $metslsr)
    {
        $deleteName = $metslsr->oaci;
        $deleteid = $metslsr->id;

        $metslsr->delete('/metslsr');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslsr')->with(compact('notification'));
    }
}
