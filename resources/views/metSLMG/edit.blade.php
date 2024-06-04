@extends('layouts.panel')

@section('content')

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col"> 
              <h3 class="mb-0">Editar Registro</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/metslmg')}}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i>
                Regresar</a>
            </div>
          </div>
        </div>

        <div class="card-body">
            @if ($errors->any())
                @foreach ( $errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong></strong>{{$error}}
                    </div>
    
                @endforeach
                
            @endif

            <form action="{{ url('/metslmg/' .$metslmg->id)}}" method="POST">
                @csrf

                @method('PUT')

                <div class="form-group">
                    <label for="fecha" class="form-control-label">FECHA: </label>
                    <input class="form-control form-control-sm" type="date" name="fecha" value="{{old('fecha', $metslmg->fecha)}}" >
                </div>

                <div class="form-group">
                    <label for="gg" class="form-control-label">HORA.: </label>
                    <input class="form-control form-control-sm" type="time" name="gg" value="{{old('gg', $metslmg->gg)}}">
                </div>

                <div class="form-group">
                    <label for="oaci" class="form-control-label">Sigla OACI: </label>
                    <input class="form-control form-control-sm" type="text" maxlength="4" name="oaci" 
                        style="text-transform:uppercase;" oneyup="javascript:this.value=this.value.toUpperCase();" value="{{old('oaci', $metslmg->oaci)}}" required>
                </div>

                <div class="form-group">
                    <label for="dd" class="form-control-label">dd : </label>
                    <input class="form-control form-control-sm" max="999" type="number" name="dd" value="{{old('dd', $metslmg->dd)}}">
                </div>

                <div class="form-group">
                    <label  for="ff" class="form-control-label">ff: </label>
                    <input class="form-control form-control-sm" max="99" type="number" name="ff" value="{{old('ff', $metslmg->ff)}}">         
                </div>

                <div class="form-group">
                    <label for="fmfm" class="form-control-label">fmfm.: </label>
                    <input class="form-control form-control-sm" max="99" type="number" name="fmfm" value="{{old('fmfm', $metslmg->fmfm)}}">         
                </div>

                <div class="form-group">
                    <label for="vvvv" class="form-control-label">VVVV: </label>
                    <input class="form-control form-control-sm" type="number" maxl="9999" name="vvvv" value="{{old('vvvv',  $metslmg->vvvv)}}"> 
                </div>

                <div>
                    <label for="dv" class="form-control-label">DV: </label>
                    <input class="form-control form-control-sm" type="text" maxlength="5" name="dv" value="{{old('dv', $metslmg->dv)}}">    
                </div>
               
                <div class="form-group">
                    <label for="ww" class="form-control-label">WW: </label>
                    <input class="form-control form-control-sm" max="99" type="number" name="ww" value="{{old('ww', $metslmg->ww)}}">
                </div>

                <div class="form-group">
                    <label for="ww1" class="form-control-label">WW1:</label>
                    <input class="form-control form-control-sm" max="99" type="number" name="ww1" value="{{old('ww1', $metslmg->ww1)}}">  
                </div>

                <div class="form-group">
                    <label  for="www" class="form-control-label">WWW:</label>
                    <input class="form-control form-control-sm" type="number" maxl="99" name="www" value="{{old('www',  $metslmg->www)}}">
                </div>
                                
                <div class="form-group">
                    <label for="ns1" class="form-control-label">NS-1: </label>
                    <input class="form-control form-control-sm" max="9" type="number" name="ns1" value="{{old('ns1', $metslmg->ns1)}}">    
                </div>
                
                <div class="form-group">
                    <label for="hhh1" class="form-control-label">HHH-1: </label>
                    <input class="form-control form-control-sm" type="number" max="999" name="hhh1" value="{{old('hhh1', $metslmg->hhh1)}}">
                </div>
                
                <div class="form-group">
                    <label for="cbtcu1" class="form-control-label">CB/TCU-1: </label>
                    <select class="form-control form-control-sm" name="cbtcu1" id="m_15" value="{{old('cbtcu1', $metslmg->cbtcu1)}}">
                        <option value="-"></option>
                        <option value="CB">CB</option>
                        <option value="TCU">TCU</option>
                    </select>
                    
                 {{-- <input class="form-control form-control-sm" maxlength="3" type="text" name="cbtcu1"
                        id="m_15">   --}} 
                </div>
                
                <div class="form-group">
                    <label for="ns2" class="form-control-label">NS-2: </label>
                    <input class="form-control form-control-sm" max="9" type="number" name="ns2" value="{{old('ns2', $metslmg->ns2)}}">     
                </div>
                
                <div class="form-group">
                    <label  for="hhh2" class="form-control-label">HHH-2: </label>
                    <input class="form-control form-control-sm" type="number" max="999" name="hhh2" value="{{old('hhh2', $metslmg->hhh2)}}">    
                </div>
                
                <div class="form-group">
                    <label for="cbtcu2" class="form-control-label">CB/TCU-2: </label>
                    <select class="form-control form-control-sm" name="cbtcu2" id="m_18" value="{{old('cbtcu2', $metslmg->cbtcu2)}}">
                        <option value=""></option>
                        <option value="CB">CB</option>
                        <option value="TCU">TCU</option>
                    </select>

                    {{-- <input class="form-control form-control-sm" maxlength="3" type="text" name="cbtcu2"
                        id="m_18"> --}}
                
                </div>
                
                <div class="form-group">
                    <label for="ns3" class="form-control-label">NS-3: </label>
                    <input class="form-control form-control-sm" max="9" type="number" name="ns3" value="{{old('ns3', $metslmg->oaci)}}">    
                </div>
                
                <div class="form-group">
                    <label for="hhh3" class="form-control-label">HHH-3: </label>
                    <input class="form-control form-control-sm" type="number" max="999" name="hhh3" value="{{old('hhh3',  $metslmg->hhh3)}}">
                </div>
                
                <div class="form-group">
                    <label  for="cbtcu3" class="form-control-label">CB/TCU-3:</label>
                    <select class="form-control form-control-sm" name="cbtcu3" id="m_21" value="{{old('cbtcu3', $metslmg->cbtcu3)}}">
                        <option value=" "></option>
                        <option value="CB">CB</option>
                        <option value="TCU">TCU</option>
                    </select>
                    {{-- <input class="form-control form-control-sm" maxlength="3" type="text" name="cbtcu3"
                        id="m_21"> --}}

                </div>
                
                <div class="form-group">
                    <label for="ns4" class="form-control-label">NS-4: </label>
                    <input class="form-control form-control-sm" max="9" type="number" name="ns4" value="{{old('ns4',  $metslmg->ns4)}}">
                </div>
                
                <div class="form-group">
                    <label for="hhh4" class="form-control-label">HHH-4: </label>
                    <input class="form-control form-control-sm" type="number" max="999" name="hhh4" id="m_23" value="{{old('hhh4',  $metslmg->hhh4)}}">
                </div>
                
                <div class="form-group">
                    <label for="tt" class="form-control-label">TT: </label>
                    <input class="form-control form-control-sm" type="number" max="99" name="tt" id="m_24" step="0.1" value="{{old('tt', $metslmg->tt)}}">
                </div>

                <div class="form-group">
                    <label for="tbh" class="form-control-label">TBH: </label>
                    <input class="form-control form-control-sm" type="number" max="99" name="tbh" id="m_24" step="0.1" value="{{old('tbh', $metslmg->tbh)}}">
                </div>
                
                <div class="form-group">
                    <label for="td" class="form-control-label">TD: </label>
                    <input class="form-control form-control-sm" type="number" max="99" name="td" id="m_25" step="0.1" value="{{old('td',  $metslmg->td)}}">
                </div>
                
                <div class="form-group">
                    <label for="qfe" class="form-control-label">QFE: </label>
                    <input class="form-control form-control-sm" type="number" max="999" name="qfe" step="0.1" value="{{old('qfe', $metslmg->qfe)}}">
                </div>
                
                <div class="form-group">qfe
                    <label for="qnh" class="form-control-label">QNH: </label>
                    <input class="form-control form-control-sm" type="number" max="9999" name="qnh" value="{{old('qnh', $metslmg->qnh)}}">
                </div>
                
                <div class="form-group">
                    <label for="pul_hg" class="form-control-label">Pulg/Hg: </label>
                    <input class="form-control form-control-sm" type="number" max="99" name="pulg_hg"step="0.01" value="{{old('pulg_hg', $metslmg->pulg_hg)}}">
                </div>
                                
                <div class="form-group">
                    <label for="uuu" class="form-control-label">UUU: </label>
                    <input class="form-control form-control-sm" type="number" max="99" name="uuu" value="{{old('uuu', $metslmg->uuu)}}">
                </div>
                
                <div class="form-group">
                    <div class="form-group">
                        <label for="notas" class="form-control-label">Notas: </label>
                        <input class="form-control form-control-sm" type="text" maxlength="150" name="notas" value="{{old('notas', $metslmg->notas)}}"
                            style="text-transform:uppercase;">    
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Guardar registro</button>                
            </form>
                
        </div>

    </div>

@endsection
