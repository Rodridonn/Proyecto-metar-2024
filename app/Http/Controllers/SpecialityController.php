<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index(Request $request)
    {
        $specialities = Speciality::query();   

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $specialities->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $specialities->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $specialities->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        }     


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            if ($dd_inicio < $dd_fin) {
                // Rango de búsqueda que no cruza el límite de 360°
                $specialities->whereBetween('dd', [$dd_inicio, $dd_fin]);
            } else {
                // Rango de búsqueda que cruza el límite de 360°
                $specialities->where(function($query) use ($dd_inicio, $dd_fin) {
                    $query->whereBetween('dd', [$dd_inicio, 360])
                          ->orWhereBetween('dd', [0, $dd_fin]);
                });
            }
        } elseif ($request->filled('dd')) {
            $specialities->where('dd', $request->input('dd'));
        }
    

        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $specialities->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $specialities->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $specialities->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $specialities->where('fmfm', $request->input('fmfm'));
        }

        
        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $specialities = $specialities->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $specialities = $specialities->where('vvvv', $vvvv);
        }
        

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $specialities->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $specialities->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }


        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
        
            $specialities->where('tt', '>=', min($tt_inicio, $tt_fin))
                         ->where('tt', '<=', max($tt_inicio, $tt_fin));
        } elseif ($request->filled('tt')) {
            $tt = $request->input('tt');
            $specialities->where('tt', $tt);
        }
         
        
        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
        
            $specialities->where('tbh', '>=', min($tbh_inicio, $tbh_fin))
                         ->where('tbh', '<=', max($tbh_inicio, $tbh_fin));
        } elseif ($request->filled('tbh')) {
            $tbh = $request->input('tbh');
            $specialities->where('tbh', $tbh);
        }
        

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
        
            $specialities->where('td', '>=', min($td_inicio, $td_fin))
                         ->where('td', '<=', max($td_inicio, $td_fin));
        } elseif ($request->filled('td')) {
            $td = $request->input('td');
            $specialities->where('td', $td);
        }

        
        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $specialities->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $specialities->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $specialities->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $specialities = $specialities->paginate(1000);
    
        return view('specialities.index' , compact('specialities')) ;
    }
    public function create(){
        return view('specialities.create');
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
        

        $speciality = new Speciality();

        $speciality-> fecha = $request->input('fecha');
        $speciality-> gg = $request->input('gg');
        $speciality-> oaci = $request->input('oaci');
        $speciality-> dd = $request->input('dd');
        $speciality-> ff = $request->input('ff');
        $speciality-> fmfm = $request->input('fmfm');
        $speciality-> vvvv = $request->input('vvvv');
        $speciality-> dv = $request->input('dv');
        $speciality-> ww = $request->input('ww');
        $speciality-> ww1 = $request->input('ww1');        
        $speciality-> www = $request->input('www');
        $speciality-> ns1 = $request->input('ns1');
        $speciality-> hhh1 = $request->input('hhh1');
        $speciality-> cbtcu1 = $request->input('cbtcu1');
        $speciality-> ns2 = $request->input('ns2');
        $speciality-> hhh2 = $request->input('hhh2');
        $speciality-> cbtcu2 = $request->input('cbtcu2');
        $speciality-> ns3 = $request->input('ns3');
        $speciality-> hhh3 = $request->input('hhh3');
        $speciality-> cbtcu3= $request->input('cbtcu3');
        $speciality-> ns4 = $request->input('ns4');
        $speciality-> hhh4 = $request->input('hhh4');
        $speciality-> tt = $request->input('tt');
        $speciality-> tbh = $request->input('tbh');
        $speciality-> td = $request->input('td');
        $speciality-> qfe = $request->input('qfe');
        $speciality-> qnh = $request->input('qnh');
        $speciality-> pulg_hg = $request->input('pulg_hg');
        $speciality-> p_cord = $request->input('p_cord');
        $speciality-> uuu = $request->input('uuu');
        $speciality-> notas = $request->input('notas');

        $speciality->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function edit(Speciality $speciality){
        return view('specialities.edit', compact('speciality'));
    }

        public function update(Request $request, Speciality $speciality ){

        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $speciality-> fecha = $request->input('fecha');
        $speciality-> gg = $request->input('gg');
        $speciality-> oaci = $request->input('oaci');
        $speciality-> dd = $request->input('dd');
        $speciality-> ff = $request->input('ff');
        $speciality-> fmfm = $request->input('fmfm');
        $speciality-> vvvv = $request->input('vvvv');
        $speciality-> dv = $request->input('dv');
        $speciality-> ww = $request->input('ww');
        $speciality-> ww1 = $request->input('ww1');        
        $speciality-> www = $request->input('www');
        $speciality-> ns1 = $request->input('ns1');
        $speciality-> hhh1 = $request->input('hhh1');
        $speciality-> cbtcu1 = $request->input('cbtcu1');
        $speciality-> ns2 = $request->input('ns2');
        $speciality-> hhh2 = $request->input('hhh2');
        $speciality-> cbtcu2 = $request->input('cbtcu2');
        $speciality-> ns3 = $request->input('ns3');
        $speciality-> hhh3 = $request->input('hhh3');
        $speciality-> cbtcu3= $request->input('cbtcu3');
        $speciality-> ns4 = $request->input('ns4');
        $speciality-> hhh4 = $request->input('hhh4');
        $speciality-> tt = $request->input('tt');
        $speciality-> tbh = $request->input('tbh');
        $speciality-> td = $request->input('td');
        $speciality-> qfe = $request->input('qfe');
        $speciality-> qnh = $request->input('qnh');
        $speciality-> pulg_hg = $request->input('pulg_hg');
        $speciality-> p_cord = $request->input('p_cord');
        $speciality-> uuu = $request->input('uuu');
        $speciality-> notas = $request->input('notas');

        $speciality->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy (Speciality $speciality){
        $deleteName = $speciality->oaci;
        $deleteid = $speciality->id;

        $speciality->delete('/especialidades');

        $notification = 'El registro '. $deleteid .' '. $deleteName .' se ha eliminado';
        
        return redirect('/especialidades')->with(compact('notification'));
    } 

}
    
    
    


