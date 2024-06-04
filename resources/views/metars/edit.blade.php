@extends('layouts.panel')

@section('content')

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar Regristro </h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/metar')}}" class="btn btn-sm btn-success">Regresar
                <i class="fas fa-chevron-left"></i>
            </a>
            </div>
          </div>
        </div>

        <div class="card-body">   {{-- barra de notificacion que informa que fue creado o borrado un nuevo registro --}} 
           
            @if ($errors->any())
                @foreach ( $errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong></strong>{{$error}}
                    </div>

                @endforeach
            
            @endif

        <div class="card-body">
            <form action="{{url ('/metar/'.$metar->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="fecha_metar" class="form-control-label">FECHA: </label>
                    <input class="form-control form-control-sm" type="date" name="fecha_metar" value="{{old('fecha_metar', $metar->fecha_metar)}}" required >
                </div>
    
                <div class="form-group">
                  <label for="hora" class="form-control-label">HORA.: </label>
                  <input class="form-control form-control-sm" type="time" name="hora" value="{{old('hora', $metar->hora)}}" required>
                </div>
    
                <div class="form-group">
                  <label for="metar" class="form-control-label">METAR/SPECI</label>
                  <select class="form-control form-control-sm" name="metar" value="{{old('metar', $metar->metar)}}" required>
                      <option value="-"></option>
                      <option value="METAR">METAR</option>
                      <option value="SPECI">SPECI</option>
                  </select>
                  
                </div>
    
                <div class="form-group">
                  <label for="oaci_metar" class="form-control-label">Sigla OACI </label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="oaci_metar" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('oaci_metar', $metar->oaci_metar)}}" required>
                </div>

                <div class="form-group">
                  <label for="horario" class="form-control-label">Horario </label>
                  <input class="form-control form-control-sm" type="text" maxlength="7" name="horario" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('horario', $metar->horario)}}" required>
                </div>

                <div class="form-group">
                  <label for="viento" class="form-control-label">VIENTO</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="viento" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('viento', $metar->viento)}}" >
                </div>
    
                <div class="form-group">
                  <label for="visibilidad" class="form-control-label">VISIBILIDAD</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="visibilidad" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('visibilidad', $metar->visibilidad)}}" >
                </div>
    
                <div class="form-group">
                  <label for="tiempo_presente_1" class="form-control-label">TIEMPO PRESENTE 1</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4"name="tiempo_presente_1" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('tiempo_presente_1', $metar->tiempo_presente_1)}}" >
                </div>
    
                <div class="form-group">
                  <label for="tiempo_presente_2" class="form-control-label">TIEMPO PRESENTE 2</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="tiempo_presente_2" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('tiempo_presente_2', $metar->tiempo_presente_2)}}" >
                </div>
    
                <div class="form-group">
                  <label for="tiempo_presente_3" class="form-control-label">TIEMPO PRESENTE 3</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="tiempo_presente_3" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('tiempo_presente_3', $metar->tiempo_presente_3)}}" >
                </div>
    
                <div class="form-group">
                  <label for="nubosidad_1" class="form-control-label">NUBOSIDAD 1</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="nubosidad_1" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nubosidad_1', $metar->nubosidad_1)}}" >
                </div>
    
                <div class="form-group">
                  <label for="nubosidad_2" class="form-control-label">NUBOSIDAD 2</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="nubosidad_2" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nubosidad_2', $metar->nubosidad_2)}}" >
                </div>
    
                <div class="form-group">
                  <label for="nubosidad_3" class="form-control-label">NUBOSIDAD 3</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="nubosidad_3" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nubosidad_3', $metar->nubosidad_3)}}" >
                </div>
    
                <div class="form-group">
                  <label for="nubosidad_4" class="form-control-label">NUBOSIDAD 4</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="nubosidad_4" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('nubosidad_4', $metar->nubosidad_4)}}" >
                </div>
    
                <div class="form-group">
                  <label for="temperatura" class="form-control-label">TEMPERATURA</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="temperatura" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('temperatura', $metar->temperatura)}}" >
                </div>
    
                <div class="form-group">
                  <label for="qnh_hpa" class="form-control-label">QNH hpa</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="qnh_hpa" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('qnh_hpa', $metar->qnh_hpa)}}" >
                </div>
    
                <div class="form-group">
                  <label for="qnh_pulg_hg" class="form-control-label">QNH pulg_hg</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="qnh_pulg_hg" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('qnh_pulg_hg', $metar->qnh_pulg_hg )}}" >
                </div>
    
                <div class="form-group">
                  <label for="qfe" class="form-control-label">QFE</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="qfe" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('qfe', $metar->qfe)}}" >
                </div>

                <div class="form-group">
                  <label for="h_relativa" class="form-control-label">HUMEDAD RELATIVA</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="h_relativa" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('h_relativa', $metar->h_relativa)}}" >
                </div>

                <div class="form-group">
                  <label for="p_cord" class="form-control-label">P. CORDILLERA</label>
                  <input class="form-control form-control-sm" type="text" maxlength="4" name="p_cord" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('p_cord', $metar->p_cord)}}" >
                </div>

                <div class="form-group">
                  <label for="notas_metar" class="form-control-label">NOTAS</label>
                  <input class="form-control form-control-sm" type="text" maxlength="200" name="notas_metar" 
                      style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{old('notas', $metar->notas)}}" >
                </div> 
                
                <button type="submit" class="btn btn-sm btn-primary"> Guardar registro</button>


            </form>

        </div>
        

      </div>

@endsection
