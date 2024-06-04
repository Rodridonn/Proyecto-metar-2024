<?php

namespace App\Http\Controllers;

use App\Models\Metslvr;
use Illuminate\Http\Request;

class MetslvrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index(Request $request)
    {
        $metslvr = Metslvr::query();
        

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $metslvr->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
        } elseif ($request->filled('fecha')) {
            $metslvr->where('fecha', $request->input('fecha'));
        }

        if ($request->filled('fecha_mes')) {
            $fecha_mes = $request->input('fecha_mes');
            $mes = date('m', strtotime($fecha_mes));
            $ano = date('Y', strtotime($fecha_mes));
            $metslvr->whereYear('fecha', $ano)->whereMonth('fecha', $mes);
        } 


        if ($request->filled('dd_inicio') && $request->filled('dd_final')) {
            $dd_inicio = $request->input('dd_inicio');
            $dd_fin = $request->input('dd_final');
            $metslvr->whereBetween('dd', [$dd_inicio, $dd_fin]);
        } elseif ($request->filled('dd')) {
            $metslvr->where('dd', $request->input('dd'));
        }
    
        if ($request->filled('ff_inicio') && $request->filled('ff_final')) {
            $ff_inicio = $request->input('ff_inicio');
            $ff_fin = $request->input('ff_final');
            $metslvr->whereBetween('ff', [$ff_inicio, $ff_fin]);
        } elseif ($request->filled('ff')) {
            $metslvr->where('ff', $request->input('ff'));
        }

        if ($request->filled('fmfm_inicio') && $request->filled('fmfm_final')) {
            $fmfm_inicio = $request->input('fmfm_inicio');
            $fmfm_fin = $request->input('fmfm_final');
            $metslvr->whereBetween('fmfm', [$fmfm_inicio, $fmfm_fin]);
        } elseif ($request->filled('fmfm')) {
            $metslvr->where('fmfm', $request->input('fmfm'));
        }


        if ($request->filled('vvvv_inicio') && $request->filled('vvvv_final')) {
            $vvvv_inicio = $request->input('vvvv_inicio');
            $vvvv_fin = $request->input('vvvv_final');
            $metslvr->whereBetween('vvvv', [$vvvv_inicio, $vvvv_fin]);
        } elseif ($request->filled('vvvv')) {
            $vvvv = $request->input('vvvv');
            $metslvr->where('vvvv', $request->input('vvvv'));
        }

        if ($request->filled('ww_inicio') && $request->filled('ww_final')) {
            $ww_inicio = $request->input('ww_inicio');
            $ww_fin = $request->input('ww_final');
            $metslvr->where(function ($query) use ($ww_inicio, $ww_fin) {
                $query->whereBetween('ww', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('ww1', [$ww_inicio, $ww_fin])
                    ->orWhereBetween('www', [$ww_inicio, $ww_fin]);
            });
        }
         
        if ($request->filled('cbtcu')) {
            $cbtcu = $request->input('cbtcu');
            $metslvr->where(function ($query) use ($cbtcu) {
                $query->where('cbtcu1', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu2', 'LIKE', '%'.$cbtcu.'%')
                    ->orWhere('cbtcu3', 'LIKE', '%'.$cbtcu.'%');
            });
        }

        if ($request->filled('tt_inicio') && $request->filled('tt_final')) {
            $tt_inicio = $request->input('tt_inicio');
            $tt_fin = $request->input('tt_final');
        
            $metslvr->where('tt', '>=', min($tt_inicio, $tt_fin))
                         ->where('tt', '<=', max($tt_inicio, $tt_fin));
        } elseif ($request->filled('tt')) {
            $tt = $request->input('tt');
            $metslvr->where('tt', $tt);
        }
         
        
        if ($request->filled('tbh_inicio') && $request->filled('tbh_final')) {
            $tbh_inicio = $request->input('tbh_inicio');
            $tbh_fin = $request->input('tbh_final');
        
            $metslvr->where('tbh', '>=', min($tbh_inicio, $tbh_fin))
                         ->where('tbh', '<=', max($tbh_inicio, $tbh_fin));
        } elseif ($request->filled('tbh')) {
            $tbh = $request->input('tbh');
            $metslvr->where('tbh', $tbh);
        }
        

        if ($request->filled('td_inicio') && $request->filled('td_final')) {
            $td_inicio = $request->input('td_inicio');
            $td_fin = $request->input('td_final');
        
            $metslvr->where('td', '>=', min($td_inicio, $td_fin))
                         ->where('td', '<=', max($td_inicio, $td_fin));
        } elseif ($request->filled('td')) {
            $td = $request->input('td');
            $metslvr->where('td', $td);
        }

        if ($request->filled('qfe')) {
            $qfe = $request->input('qfe');
            $metslvr->where('qfe', 'LIKE', '%'.$qfe.'%');
        }
        

        if ($request->filled('qnh')) {
            $qnh = $request->input('qnh');
            $metslvr->where('qnh', 'LIKE', '%'.$qnh.'%');
        }
    

        if ($request->filled('notas')) {
            $metslvr->where('notas', 'like', '%'.$request->input('notas').'%');
        }
    
        $metslvr = $metslvr->paginate(1000);
    
        return view('metslvr.index' , compact('metslvr')) ;
    
    }

    public function create()
    {
        return view('metSLVR.create');
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
        

        $metslvr = new Metslvr();

        $metslvr-> fecha = $request->input('fecha');
        $metslvr-> gg = $request->input('gg');
        $metslvr-> oaci = $request->input('oaci');
        $metslvr-> dd = $request->input('dd');
        $metslvr-> ff = $request->input('ff');
        $metslvr-> fmfm = $request->input('fmfm');
        $metslvr-> vvvv = $request->input('vvvv');
        $metslvr-> dv = $request->input('dv');
        $metslvr-> ww = $request->input('ww');
        $metslvr-> ww1 = $request->input('ww1');        
        $metslvr-> www = $request->input('www');
        $metslvr-> ns1 = $request->input('ns1');
        $metslvr-> hhh1 = $request->input('hhh1');
        $metslvr-> cbtcu1 = $request->input('cbtcu1');
        $metslvr-> ns2 = $request->input('ns2');
        $metslvr-> hhh2 = $request->input('hhh2');
        $metslvr-> cbtcu2 = $request->input('cbtcu2');
        $metslvr-> ns3 = $request->input('ns3');
        $metslvr-> hhh3 = $request->input('hhh3');
        $metslvr-> cbtcu3= $request->input('cbtcu3');
        $metslvr-> ns4 = $request->input('ns4');
        $metslvr-> hhh4 = $request->input('hhh4');
        $metslvr-> tt = $request->input('tt');
        $metslvr-> tbh = $request->input('tbh');
        $metslvr-> td = $request->input('td');
        $metslvr-> qfe = $request->input('qfe');
        $metslvr-> qnh = $request->input('qnh');
        $metslvr-> pulg_hg = $request->input('pulg_hg');
        $metslvr-> uuu = $request->input('uuu');
        $metslvr-> notas = $request->input('notas');
        $metslvr->save();

        $notification = 'El registro se ha creado correctamente.';

        return redirect('/metslvr')->with(compact('notification'));

        
    }

    public function edit(Metslvr $metslvr)
    {
        return view('metslvr.edit', compact('metslvr'));
    }

    public function update(Request $request, Metslvr $metslvr)
    {
        $rules =[
            'oaci' => 'required|min:4'
        ];
        $messages =[
            'oaci.required' => 'La sigla OACI es obligatoria',
             'oaci.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        $metslvr-> fecha = $request->input('fecha');
        $metslvr-> gg = $request->input('gg');
        $metslvr-> oaci = $request->input('oaci');
        $metslvr-> dd = $request->input('dd');
        $metslvr-> ff = $request->input('ff');
        $metslvr-> fmfm = $request->input('fmfm');
        $metslvr-> vvvv = $request->input('vvvv');
        $metslvr-> dv = $request->input('dv');
        $metslvr-> ww = $request->input('ww');
        $metslvr-> ww1 = $request->input('ww1');        
        $metslvr-> www = $request->input('www');
        $metslvr-> ns1 = $request->input('ns1');
        $metslvr-> hhh1 = $request->input('hhh1');
        $metslvr-> cbtcu1 = $request->input('cbtcu1');
        $metslvr-> ns2 = $request->input('ns2');
        $metslvr-> hhh2 = $request->input('hhh2');
        $metslvr-> cbtcu2 = $request->input('cbtcu2');
        $metslvr-> ns3 = $request->input('ns3');
        $metslvr-> hhh3 = $request->input('hhh3');
        $metslvr-> cbtcu3= $request->input('cbtcu3');
        $metslvr-> ns4 = $request->input('ns4');
        $metslvr-> hhh4 = $request->input('hhh4');
        $metslvr-> tt = $request->input('tt');
        $metslvr-> tbh = $request->input('tbh');
        $metslvr-> td = $request->input('td');
        $metslvr-> qfe = $request->input('qfe');
        $metslvr-> qnh = $request->input('qnh');
        $metslvr-> pulg_hg = $request->input('pulg_hg');
        $metslvr-> uuu = $request->input('uuu');
        $metslvr-> notas = $request->input('notas');
        $metslvr->save();

        $notification = 'El registro se ha actualizado correctamente.';

        return redirect('/metslvr')->with(compact('notification'));
    

    }

    public function destroy(Metslvr $metslvr)
    {
        {
            $deleteName = $metslvr->oaci;
    
            $metslvr->delete('/metslvr');
    
            $notification = 'El registro '. $deleteName .' se ha eliminado';
            
            return redirect('/metslvr')->with(compact('notification'));
        }
    }
}
