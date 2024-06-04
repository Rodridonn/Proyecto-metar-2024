@extends('layouts.panel')

  @section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
  @endsection

@section('content')
    
    {{-- criterios de busqueda  --}}
    <div class="content">
      <div class="container-fluid">
        ROW PARA BUSQUEDA AVANZADA
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"> BUSQUEDA AVANZADA</h3>
                  <div class="card-tools">

                    <button type="button" class="btn btn-warning" data-card-widget="collapse" ></button >
                      <i class="fas fa minus"></i>

                    <button type="button" class="btn btn-warning" data-card-widget="collapse" id="btnLimpiarBusqueda"></button>
                      <i class="fas fa times"></i>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 d-lg-flex"> 
                          
                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="date" id="idFecha" class="form-control" placeholder="Fecha" data-index="2">
                          </div>
                          
                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="time" id="gg" class="form-control" placeholder="hora" data-index="2">
                          </div>

                          <div style="width: 10%" class="form-floating  mx-1">
                            <input type="text" id="idMetar" class="form-control" placeholder="METAR/SPECI" data-index="4"
                            style="text-transform:uppercase;" maxlength="5">
                          </div>

                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="text" id="idOaci" class="form-control" placeholder="Aeródromo" data-index="5"
                            style="text-transform:uppercase;" maxlength="4">
                          </div>

                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="text" id="idViento" class="form-control" placeholder="Viento" data-index="7"
                            style="text-transform:uppercase;" maxlength="3">
                          </div>

                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="text" id="idRafagas" class="form-control" placeholder="Rafagas" data-index="7"
                            style="text-transform:uppercase;" maxlength="1">
                          </div>

                          <div style="width: 10%" class="form-floating  mx-1">
                            <input type="text" id="idVisDesde" class="form-control" placeholder="Vis. Desde" data-index="8">
                          </div>
                          
                          <div style="width: 10%" class="form-floating mx-1">
                            <input type="text" id="idNotas" class="form-control" placeholder="Notas" data-index="22"
                            style="text-transform:uppercase;" maxlength="4">
                          </div>

                        </div>
                      </div>
                    </div>
                    
                  </div>
                    
            </div>
        </div>
      </div>
    </div>
            
    
    <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">METAR </h3>
              </div>
              <div class="col text-right">
                <a href="{{ url('/metar/create')}}" class="btn btn-sm btn-primary">Nuevo registro</a>
              </div>
              <div class="col text-right">
                <a href="{{ url('/metar/create')}}" class="btn btn-sm btn-primary">Nuevo registro</a>
              </div>
            </div>
          </div>
  
          <div class="card-body">   {{-- barra de notificacion que informa que fue creado o borrado un nuevo registro --}} 
              @if (session('notification'))
                <div class="alert alert-success" role="alert"> 
                  {{session('notification')}}
                </div>
              @endif
          </div>
          
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tablamet" class="table align-items-center table-flush" >
              <thead class="bg-info">
                  <tr>
                    
                      <th scope="col">fecha</th>
                      <th scope="col">hora</th>
                      <th scope="col">metar</th>
                      <th scope="col">oaci</th>
                      <th scope="col">horario</th>
                      <th scope="col">viento</th>
                      <th scope="col">visibilidad</th>
                      <th scope="col">tiempo_presente_1</th>
                      <th scope="col">tiempo_presente_2</th>
                      <th scope="col">tiempo_presente_3</th>
                      <th scope="col">nubosidad_1</th>
                      <th scope="col">nubosidad_2</th>
                      <th scope="col">nubosidad_3</th>
                      <th scope="col">nubosidad_4</th>
                      <th scope="col">temperatura</th>
                      <th scope="col">qnh_hpa</th>
                      <th scope="col">qnh_pulg_hg</th>
                      <th scope="col">qfe</th>
                      <th scope="col">h_relativa</th>
                      <th scope="col">p_cord</th>
                      <th scope="col">notas</th>
                      <th scope="col">Acciones</th>
                    </tr>
      
              </thead>
              <tbody>
                @foreach ($metar as $met )
                <tr>


                  <th scope="row">
                    {{$met->fecha_metar}}
                  </th>
    
                  <td>
                    {{$met->hora}}
                  </td>
                  
                  <td>
                    {{$met->metar}}
                  </td>
    
                    <td>
                      {{$met->oaci_metar}}
                    </td>
    
                    <td>
                      {{$met->horario}}
                    </td>

                    <td>
                      {{$met->viento}}
                    </td>
                    
                    <td>
                      {{$met->visibilidad}}
                    </td>
                    
                    <td>
                      {{$met->tiempo_presente_1}}
                    </td>
                    
                    <td>
                      {{$met->tiempo_presente_2}}
                    </td>
                    
                    <td>
                      {{$met->tiempo_presente_3}}
                    </td>
                    
                    <td>
                      {{$met->nubosidad_1}}
                    </td>
                    
                    <td>
                      {{$met->nubosidad_2}}
                    </td>
    
                    <td>
                      {{$met->nubosidad_3}}
                    </td>
                    
                    <td>
                      {{$met->nubosidad_4}}
                    </td>
                    
                    <td>
                      {{$met->temperatura}}
                    </td>
                    
                    <td>
                      {{$met->qnh_hpa}}
                    </td>
                    
                    <td>
                      {{$met->qnh_pulg_hg}}
                    </td>
                    
                    <td>
                      {{$met->qfe}}
                    </td>
                    
                    <td>
                      {{$met->h_relativa}}
                    </td>

                    <td>
                      {{$met->p_cord}}
                    </td>

                    <td>
                      {{$met->notas_metar}}
                    </td>
                
                    <td>
    
                      <form action="{{url('/metar/'.$met->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
    
                        <a href="{{url('/metar/'.$met->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                      </form>
    
                    </td>
                </tr>
                @endforeach   
                 
              </tbody>
  
            </table>

            @section('js')

              <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
              <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
              <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

              <script>                  
                $(document).ready(function () {
                  
                  var table;  
                $.ajax({
                  type: 'POST',
                  url: '/ajax-request',
                  data: {
                  data: $('input[name=data]').val()
                },
                success: function(data){
                  
                }
              });

                $('#tablamet').DataTable({
                      language: {
                        url: 'dataTables.german.json'
                      }
                    });
                });
              </script>
            @endsection

          </div>
        </div>
  
@endsection