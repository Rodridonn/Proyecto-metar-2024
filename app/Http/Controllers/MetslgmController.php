<?php

namespace App\Http\Controllers;

use App\Models\Metslgm;
use Illuminate\Http\Request;

class MetslgmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $metslgm = Metslgm::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslgm->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslgm->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslgm->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $metslgm->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $metslgm->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $metslgm->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslgm->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslgm->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslgm->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslgm->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslgm = $metslgm->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslgm = $metslgm->where('vvvv', $vvvv);
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslgm->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslgm->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
            $metslgm->whereBetween('tt', [$tt_inicio, $tt_fin]);
        } elseif ($request->filled('tt')) {
            $metslgm->where('tt', $request->input('tt'));
        }
    

        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
            $metslgm->whereBetween('tbh', [$tbh_inicio, $tbh_fin]);
        } elseif ($request->filled('tbh')) {
            $metslgm->where('tbh', $request->input('tbh'));
        }

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
            $metslgm->whereBetween('td', [$td_inicio, $td_fin]);
        } elseif ($request->filled('td')) {
            $metslgm->where('td', $request->input('td'));
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslgm->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslgm->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslgm->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslgm = $metslgm->paginate(1000);
    
        return view('metSLGM.index' , compact('metslgm')) ;
        
        
        
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
        return view('metSLGM.create');
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
        

        $metslgm = new Metslgm();

        $metslgm-> fecha = $request->input('fecha');
        $metslgm-> gg = $request->input('gg');
        $metslgm-> oaci = $request->input('oaci');
        $metslgm-> dd = $request->input('dd');
        $metslgm-> ff = $request->input('ff');
        $metslgm-> fmfm = $request->input('fmfm');
        $metslgm-> vvvv = $request->input('vvvv');
        $metslgm-> dv = $request->input('dv');
        $metslgm-> ww = $request->input('ww');
        $metslgm-> ww1 = $request->input('ww1');        
        $metslgm-> www = $request->input('www');
        $metslgm-> ns1 = $request->input('ns1');
        $metslgm-> hhh1 = $request->input('hhh1');
        $metslgm-> cbtcu1 = $request->input('cbtcu1');
        $metslgm-> ns2 = $request->input('ns2');
        $metslgm-> hhh2 = $request->input('hhh2');
        $metslgm-> cbtcu2 = $request->input('cbtcu2');
        $metslgm-> ns3 = $request->input('ns3');
        $metslgm-> hhh3 = $request->input('hhh3');
        $metslgm-> cbtcu3= $request->input('cbtcu3');
        $metslgm-> ns4 = $request->input('ns4');
        $metslgm-> hhh4 = $request->input('hhh4');
        $metslgm-> tt = $request->input('tt');
        $metslgm-> tbh = $request->input('tbh');
        $metslgm-> td = $request->input('td');
        $metslgm-> qfe = $request->input('qfe');
        $metslgm-> qnh = $request->input('qnh');
        $metslgm-> pulg_hg = $request->input('pulg_hg');
        $metslgm-> uuu = $request->input('uuu');
        $metslgm-> notas = $request->input('notas');
        $metslgm->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslgm')->with(compact('notification'));
    }

    public function edit(Metslgm $metslcb)
    {

        return view('metslgm.edit', compact('metslgm'));
    }

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
    public function update(Request $request, Metslgm $metslgm)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslgm-> fecha = $request->input('fecha');
        $metslgm-> gg = $request->input('gg');
        $metslgm-> oaci = $request->input('oaci');
        $metslgm-> dd = $request->input('dd');
        $metslgm-> ff = $request->input('ff');
        $metslgm-> fmfm = $request->input('fmfm');
        $metslgm-> vvvv = $request->input('vvvv');
        $metslgm-> dv = $request->input('dv');
        $metslgm-> ww = $request->input('ww');
        $metslgm-> ww1 = $request->input('ww1');        
        $metslgm-> www = $request->input('www');
        $metslgm-> ns1 = $request->input('ns1');
        $metslgm-> hhh1 = $request->input('hhh1');
        $metslgm-> cbtcu1 = $request->input('cbtcu1');
        $metslgm-> ns2 = $request->input('ns2');
        $metslgm-> hhh2 = $request->input('hhh2');
        $metslgm-> cbtcu2 = $request->input('cbtcu2');
        $metslgm-> ns3 = $request->input('ns3');
        $metslgm-> hhh3 = $request->input('hhh3');
        $metslgm-> cbtcu3= $request->input('cbtcu3');
        $metslgm-> ns4 = $request->input('ns4');
        $metslgm-> hhh4 = $request->input('hhh4');
        $metslgm-> tt = $request->input('tt');
        $metslgm-> tbh = $request->input('tbh');
        $metslgm-> td = $request->input('td');
        $metslgm-> qfe = $request->input('qfe');
        $metslgm-> qnh = $request->input('qnh');
        $metslgm-> pulg_hg = $request->input('pulg_hg');
        $metslgm-> uuu = $request->input('uuu');
        $metslgm-> notas = $request->input('notas');
        $metslgm->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslgm')->with(compact('notification'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metslgm $metslgm)
    {
        $deleteName = $metslgm->oaci;
        $deleteid = $metslgm->id;

        $metslgm->delete('/metslgm');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
    
        return redirect('/metslgm')->with(compact('notification'));
    }
}
