<?php

namespace App\Http\Controllers;

use App\Models\Metar;
use Illuminate\Http\Request;

class MetarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $metar  = Metar::all();
        return view('metars.index', compact('metar'));
    } 
    
    public function create(){
        return view('metars.create');
    }
    public function sendData (Request $request){   
        $rules =[
            'oaci_metar' => 'required|min:4'
        ];
        $messages =[
            'oaci_metar.required' => 'La sigla OACI es obligatoria',
            'oaci_metar.min' =>'La sigla OACI debe tener 4 caracteres.'
        ];

        $this->validate($request, $rules, $messages);

        
        $metar = new Metar();

        
        $metar -> fecha_metar = $request ->input('fecha_metar'); 
        $metar -> hora  = $request ->input('hora');
        $metar -> metar = $request ->input('metar');
        $metar -> oaci_metar = $request ->input('oaci_metar');
        $metar -> horario = $request ->input('horario');
        $metar -> viento = $request ->input('viento');
        $metar -> visibilidad = $request ->input('visibilidad');
        $metar -> tiempo_presente_1 = $request ->input('tiempo_presente_1');
        $metar -> tiempo_presente_2 = $request ->input('tiempo_presente_2');
        $metar -> tiempo_presente_3 = $request ->input('tiempo_presente_3');
        $metar -> nubosidad_1 = $request ->input('nubosidad_1');
        $metar -> nubosidad_2 = $request ->input('nubosidad_2');
        $metar -> nubosidad_3 = $request ->input('nubosidad_3');
        $metar -> nubosidad_4 = $request ->input('nubosidad_4');
        $metar -> temperatura = $request ->input('temperatura');
        $metar -> qnh_hpa = $request ->input('qnh_hpa');
        $metar -> qnh_pulg_hg = $request ->input('qnh_pulg_hg');
        $metar -> qfe = $request ->input('qfe');
        $metar -> h_relativa = $request ->input('h_relativa');
        $metar -> p_cord = $request ->input('p_cord');
        $metar -> notas_metar = $request ->input('notas_metar');

        $notification = 'El registro se ha creado correctamente';

        $metar->save();

        return redirect('/metar')-> with(compact('notification')) ;
        }

        public function edit(Metar $metar){
            return view('metars.edit', compact('metar'));

        }

        public function update (Request $request, Metar $metar){
        
            $rules =[
                'oaci_metar' => 'required|min:4'
            ];
            $messages =[
                'oaci_metar.required' => 'La sigla OACI es obligatoria',
                'oaci_metar.min' =>'La sigla OACI debe tener 4 caracteres.'
            ];
    
            $this->validate($request, $rules, $messages);
    
            $metar -> fecha_metar = $request ->input('fecha_metar'); 
            $metar -> hora  = $request ->input('hora');
            $metar -> metar = $request ->input('metar');
            $metar -> oaci_metar = $request ->input('oaci_metar');
            $metar -> horario = $request ->input('horario');
            $metar -> viento = $request ->input('viento');
            $metar -> visibilidad = $request ->input('visibilidad');
            $metar -> tiempo_presente_1 = $request ->input('tiempo_presente_1');
            $metar -> tiempo_presente_2 = $request ->input('tiempo_presente_2');
            $metar -> tiempo_presente_3 = $request ->input('tiempo_presente_3');
            $metar -> nubosidad_1 = $request ->input('nubosidad_1');
            $metar -> nubosidad_2 = $request ->input('nubosidad_2');
            $metar -> nubosidad_3 = $request ->input('nubosidad_3');
            $metar -> nubosidad_4 = $request ->input('nubosidad_4');
            $metar -> temperatura = $request ->input('temperatura');
            $metar -> qnh_hpa = $request ->input('qnh_hpa');
            $metar -> qnh_pulg_hg = $request ->input('qnh_pulg_hg');
            $metar -> qfe = $request ->input('qfe');
            $metar -> h_relativa = $request ->input('h_relativa');
            $metar -> p_cord = $request ->input('p_cord');
            $metar -> notas_metar = $request ->input('notas_metar');
            
            $notification = 'Se actualizo el registro';

            $metar->save();
    
            return redirect('/metar')->with(compact('notification'));
            }
            public function destroy(Metar $metar){
                $deleteName = $metar->oaci_metar;

                $metar->delete('/metar');

                $notification = 'El registro se ha eliminado';

                
                return redirect('/metar') ->with(compact('notification')); 
            }

            public function tabla(){
                
            }
}

