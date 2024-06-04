<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metslmg;

class MetslmgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslmg = Metslmg::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslmg->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslmg->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslmg->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslmg->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslmg->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslmg->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslmg->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslmg->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslmg->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslmg->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslmg = $metslmg->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslmg = $metslmg->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslmg->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslmg->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslmg->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslmg->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslmg->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslmg->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslmg->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslmg->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslmg->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslmg->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslmg->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslmg = $metslmg->paginate(1000);
    
        return view('metSLMG.index' , compact('metslmg')) ;
        
        
        
/*                 // Definir la cantidad de registros a seleccionar en cada iteración
                $limit = 117880;

                // Obtener el número total de registros a importar
                $total = Speciality::count();
        
                // Determinar la cantidad de iteraciones necesarias
                $iterations = ceil($total/$limit);
        
                // Realizar la importación de los datos en pequeños lotes
                for ($i = 0; $i < $iterations; $i++) {
                  // Seleccionar los registros en un lote de $limit
                  $specialities = Speciality::offset($i * $limit)
                          ->limit($limit)
                          ->get();
          
                  // Realizar la importación de los datos
                  foreach ($specialities as $speciality) {
                    // Código para importar los datos
                  }
                }
                
                return view('specialities.index' , compact('specialities')) ; */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metSLMG.create');
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
        

        $metslmg = new Metslmg();

        $metslmg-> fecha = $request->input('fecha');
        $metslmg-> gg = $request->input('gg');
        $metslmg-> oaci = $request->input('oaci');
        $metslmg-> dd = $request->input('dd');
        $metslmg-> ff = $request->input('ff');
        $metslmg-> fmfm = $request->input('fmfm');
        $metslmg-> vvvv = $request->input('vvvv');
        $metslmg-> dv = $request->input('dv');
        $metslmg-> ww = $request->input('ww');
        $metslmg-> ww1 = $request->input('ww1');        
        $metslmg-> www = $request->input('www');
        $metslmg-> ns1 = $request->input('ns1');
        $metslmg-> hhh1 = $request->input('hhh1');
        $metslmg-> cbtcu1 = $request->input('cbtcu1');
        $metslmg-> ns2 = $request->input('ns2');
        $metslmg-> hhh2 = $request->input('hhh2');
        $metslmg-> cbtcu2 = $request->input('cbtcu2');
        $metslmg-> ns3 = $request->input('ns3');
        $metslmg-> hhh3 = $request->input('hhh3');
        $metslmg-> cbtcu3= $request->input('cbtcu3');
        $metslmg-> ns4 = $request->input('ns4');
        $metslmg-> hhh4 = $request->input('hhh4');
        $metslmg-> tt = $request->input('tt');
        $metslmg-> tbh = $request->input('tbh');
        $metslmg-> td = $request->input('td');
        $metslmg-> qfe = $request->input('qfe');
        $metslmg-> qnh = $request->input('qnh');
        $metslmg-> pulg_hg = $request->input('pulg_hg');
        $metslmg-> uuu = $request->input('uuu');
        $metslmg-> notas = $request->input('notas');
        $metslmg->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslmg')->with(compact('notification'));
    }

    public function edit(Metslmg $metslmg)
    {

        return view('metslmg.edit', compact('metslmg'));
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
    public function update(Request $request, Metslmg $metslmg)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslmg-> fecha = $request->input('fecha');
        $metslmg-> gg = $request->input('gg');
        $metslmg-> oaci = $request->input('oaci');
        $metslmg-> dd = $request->input('dd');
        $metslmg-> ff = $request->input('ff');
        $metslmg-> fmfm = $request->input('fmfm');
        $metslmg-> vvvv = $request->input('vvvv');
        $metslmg-> dv = $request->input('dv');
        $metslmg-> ww = $request->input('ww');
        $metslmg-> ww1 = $request->input('ww1');        
        $metslmg-> www = $request->input('www');
        $metslmg-> ns1 = $request->input('ns1');
        $metslmg-> hhh1 = $request->input('hhh1');
        $metslmg-> cbtcu1 = $request->input('cbtcu1');
        $metslmg-> ns2 = $request->input('ns2');
        $metslmg-> hhh2 = $request->input('hhh2');
        $metslmg-> cbtcu2 = $request->input('cbtcu2');
        $metslmg-> ns3 = $request->input('ns3');
        $metslmg-> hhh3 = $request->input('hhh3');
        $metslmg-> cbtcu3= $request->input('cbtcu3');
        $metslmg-> ns4 = $request->input('ns4');
        $metslmg-> hhh4 = $request->input('hhh4');
        $metslmg-> tt = $request->input('tt');
        $metslmg-> tbh = $request->input('tbh');
        $metslmg-> td = $request->input('td');
        $metslmg-> qfe = $request->input('qfe');
        $metslmg-> qnh = $request->input('qnh');
        $metslmg-> pulg_hg = $request->input('pulg_hg');
        $metslmg-> uuu = $request->input('uuu');
        $metslmg-> notas = $request->input('notas');
        $metslmg->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslmg')->with(compact('notification'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslmg $metslmg)
    {
        $deleteName = $metslmg->oaci;
        $deleteid = $metslmg->id;

        $metslmg->delete('/metslmg');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslmg')->with(compact('notification'));
    }
}
