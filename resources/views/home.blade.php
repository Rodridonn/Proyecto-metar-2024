@extends('layouts.panel')

@section('content')

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="card-header"></div>
              <h2 >CLAVE DE CIFRADO SINOPTICO FM -12 -X -SYNOP </h2>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h2>TABLA DE CIFRADO - 4677</h2>
            </div>
        </div>
    </div>
  </div>
  <div class="my-scroll-container">
    <div class="col-md-10 mb-4">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Tiempo presente</h3>
            </div>
            
            
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">CLAVE</th>
                <th scope="col">FENÓMENO</th>
                <th scope="col">DESCRIPCIÓN</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=00-49 Sin precipitaciones en la estación en el momento de la observación </h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  00
                  <br>
                  01
                  <br>
                  02
                  <br>
                  03
                </th>
                <td>
                   
                </td>
                <td>
                  Ningún desarrollo nuboso observado u observable.
                  <br>
                  Nubes en general disipandose o haciendose menos desarrolladas.
                  <br>
                  Estado del cielo sin cambios en su conjunto.
                  <br>
                  Nubes en general en formación o desarrolandose
                </td>
              </tr>

              <tr>
                <th scope="row">
                  04
                </th>
                <td>
                  FU 
                </td>
                <td>
                  Visibilidad reducida por humo, por ejemplo
                  <br>
                  fuego de maleza o incendio de bosque, humo 
                  <br>
                  industrial o cenizas volcanicas.
                </td>

              </tr>
              <tr>
                <th scope="row">
                  05
                </th>
                <td>
                  Hz
                </td>
                <td>
                  Bruma
                </td>
              </tr>

              <tr>
                <th scope="row">
                  06
                </th>
                <td>
                  HZ
                </td>
                <td>
                  Polvo en suspensión en el aire, que abarca gran extensión
                  <br>
                  no levantando por el viento en la estación o en sus alrededores,
                  <br>
                  en el momento de la observación.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  07
                </th>
                <td>
                  SA
                  <br>
                  DU
                </td>
                <td>
                  Polvo o arena levantado por el viento en la estación
                  <br>
                  o sus alrededores en el momento de la observación, pero
                  <br>
                  sin torbellino(s) de polvo o de arena bien desarrollado(s) 
                  <br>
                  ni tempestad de polvo o de arena a la vista.
                </td>
              </tr>
              
              <tr>
                <th scope="row">
                  08
                </th>
                <td>
                  PO
                </td>
                <td>
                  Torbellino(s) de polvo o de arena bien desarrollados en la
                  <br>
                  estación o en sus alrededores observados o durante la hora precendente
                  <br>
                  pero sin tempestad de polvo o arena.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  10
                </th>
                <td>
                  BR
                </td>
                <td>
                  Neblina o bruma. 
                </td>
              </tr>

              <tr>
                <th scope="row">
                  11
                  <br>
                  12
                </th>
                <td>
                  MIFG
                  <br>
                  MIFG
                </td>
                <td>
                  En bancos  
                  <br>
                  Mas o menos continuas
                </td>
              </tr>

              <tr>
                <th scope="row">
                  13
                </th>
                <td>
                </td>
                <td>
                  Relámpagos visibles, sin oírse truenos.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  14
                </th>
                <td>

                </td>
                <td>
                  Precipitación a la vista, que no llega al suelo (virga).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  15
                </th>
                <td>
                  VCSH
                </td>
                <td>
                  Precipitación a la vista, que llega al suelo (más de 5 km. de la estación).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  16
                </th>
                <td>
                  VCSH
                </td>
                <td>
                  Precipitación a la vista, que llega al suelo, cerca de la estación, pero
                  no en la estación.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  17
                </th>
                <td>
                  (VC) TS
                </td>
                <td>
                  Tormenta, pero sin precipitación en el momento de la observación.
                </td>
                <td>
              </tr>

              <tr>
                <th scope="row">
                  18
                  <br>
                  19
                </th>
                <td>
                  (CV) SQ
                  <br>
                  (CV) FC
                </td>
                <td>
                  Turbonadas.
                  <br>
                  Nubes en forma de embudo tornado 
                </td>
                <td>
              </tr>
              
              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=20-29 Precipitación, niebla, niebla helada, o tormeta durante la 
                    <br>
                    hora precedente pero no en el momento de la observación. </h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  20
                </th>
                <td>
                  REDZ
                </td>
                <td>
                  Llovizna (no engelante) o cinarra.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  21
                </th>
                <td>
                  RERA
                </td>
                <td>
                  Lluvia (no engelante).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  22
                </th>
                <td>
                  RESN
                </td>
                <td>
                  Llovizna (no engelante) o cinarra.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  23
                </th>
                <td>
                  RERASN
                </td>
                <td>
                  Lluvia y nieve o hielo granulado.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  24
                </th>
                <td>
                  REFZRA
                </td>
                <td>
                  Llovizna engelante o lluvia engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  25
                </th>
                <td>
                  RESH
                </td>
                <td>
                  Chubasco(s) de lluvia.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  26
                </th>
                <td>
                  RESHSN
                </td>
                <td>
                  Chusbasco(s) de nieve o de lluvia y nieve.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  27
                </th>
                <td>
                  REGR
                </td>
                <td>
                  Chubasco(s) de granizo o de lluvia y granizo.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  28
                </th>
                <td>
                  REFG
                </td>
                <td>
                  Niebla o niebla helada.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  29
                </th>
                <td>
                  RETS
                </td>
                <td>
                  Tormenta (con precipitación o sin ella).
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=30-39 Tempestad de polvo o de arena, o venticas, baja o alta</h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  30
                </th>
                <td>
                  -DS (DS)
                  <br>
                  -SS (SS)
                </td>
                <td>
                  Tempestad débil o moderada de polvo ó arena
                  <br>
                  amainando durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  31
                </th>
                <td>
                  -DS (DS)
                  <br>
                  -SS (SS)
                </td>
                <td>
                  Temperatura débil o moderada de polvo o de arena
                  <br>
                  sin cambio apreciable en la hora precendente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  32
                </th>
                <td>
                  -DS (DS)
                  <br>
                  -SS (SS)
                </td>
                <td>
                  Tempestad débil o moderada de polvo o de arena
                  <br>
                  aumentando en la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  33
                </th>
                <td>
                  +DS
                  <br>
                  +SS
                </td>
                <td>
                  Tempestad fuerte de polvo o de arena
                  <br>
                  amainando durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  33
                </th>
                <td>
                  +DS
                  <br>
                  +SS
                </td>
                <td>
                  Tempestad fuerte de polvo o de arena
                  <br>
                  amainando durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  34
                </th>
                <td>
                  +DS
                  <br>
                  +SS
                </td>
                <td>
                  Tempestad fuerte de polvo o de arena
                  <br>
                  sin cambio apreciable en la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  35
                </th>
                <td>
                  +DS
                  <br>
                  +SS
                </td>
                <td>
                  Tempestad fuerte de polvo o de arena
                  <br>
                  aumentando en la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  36
                </th>
                <td>
                  DRSN
                </td>
                <td>
                  Ventisca débil o moderada; baja (por debajo del
                  <br>
                  nivel de la vista del obser).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  37
                </th>
                <td>
                  +DRSN
                </td>
                <td>
                  Ventisca fuerte baja (por debajo del
                  <br>
                  nivel de la vista del observador).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  38
                </th>
                <td>
                  BLSN
                  <br>
                  +SS
                </td>
                <td>
                  Ventisca débil o moderada (por encima del
                  <br>
                  nivel de la vista del observador).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  39
                </th>
                <td>
                  +BLSN
                </td>
                <td>
                  Ventisca, fuerte (por encima del nivel
                  <br>
                  de la vista del observador).
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=40-49 Niebla o niebla helada en el momento 
                    <br>
                    de la observación.</h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  40
                </th>
                <td>
                  BCFG
                </td>
                <td>
                  Niebla a distancia en el momento de la observación,
                  <br>
                  pero no en la estación, durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  41
                </th>
                <td>
                  BCFG
                </td>
                <td>
                  Niebla o niebla helada en bancos.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  42
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada cielo visible,
                  <br>
                  debilitada durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  43
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada, cielo invisible,
                  <br>
                  debilitada durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  44
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada en bancos, cielo visible, sin cambio
                  <br>
                  apreciable, durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  45
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada, cielo invisible, sin
                  <br>
                  cambio apreciable, durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  46
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada, cielo visible 
                  <br>
                  espesandose durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  47
                </th>
                <td>
                  FG
                </td>
                <td>
                  Niebla o niebla helada, cielo invisible,
                  <br>
                  espesándose durante la hora precedente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  48
                </th>
                <td>
                  FZFG
                </td>
                <td>
                  Niebla que deposita cencellada blanca cielo invisible.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  49
                </th>
                <td>
                  FZFG
                </td>
                <td>
                  Niebla que deposita cencella blanca, cielo invisible.
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=50-99 Precipitación en la estación en el momento de la observación</h6>
                  <h6>ww=50-59 Llovisna</h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  50
                </th>
                <td>
                  -DZ
                </td>
                <td>
                  Llovizna débil, intermitente, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  51
                </th>
                <td>
                  -DZ
                </td>
                <td>
                  Llovizna débil, continua no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  52
                </th>
                <td>
                  DZ
                </td>
                <td>
                  Llovizna moderada, intermitente, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  53
                </th>
                <td>
                  DZ
                </td>
                <td>
                  Llovizna moderada, continua no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  54
                </th>
                <td>
                  +DZ
                </td>
                <td>
                  Llovizna fuerte, intermitente no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  55
                </th>
                <td>
                  +DZ
                </td>
                <td>
                  Llovizna fuerte, continua no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  56
                </th>
                <td>
                  -FZDZ
                </td>
                <td>
                  Llovizna débil, engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  57
                </th>
                <td>
                  +FZDZ
                  <br>
                  FZDZ
                </td>
                <td>
                  Llovizna moderada o fuerte (densa), engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  58
                </th>
                <td>
                  -RADZ
                </td>
                <td>
                  Llovizna y lluvia débil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  59
                </th>
                <td>
                  +RADZ
                  <br>
                   RADZ
                </td>
                <td>
                  Llovizna y lluvia, moderada o fuerte.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  58
                </th>
                <td>
                  -RADZ
                </td>
                <td>
                  Llovizna y lluvia débil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  58
                </th>
                <td>
                  -RADZ
                </td>
                <td>
                  Llovizna y lluvia débil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  59
                </th>
                <td>
                  +RADZ
                </td>
                <td>
                  Llovizna y lluvia débil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww=60-69 Llovisna</h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  60
                </th>
                <td>
                  -RA
                </td>
                <td>
                  Lluvia débil, intermitente, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  61
                </th>
                <td>
                  -RA
                </td>
                <td>
                  Lluvia débil, contínua, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  62
                </th>
                <td>
                  RA
                </td>
                <td>
                  Lluvia moderada, intermitente, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  63
                </th>
                <td>
                  RA
                </td>
                <td>
                  Lluvia moderada, contínua, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  64
                </th>
                <td>
                  +RA
                </td>
                <td>
                  Lluvia fuerte, intermitente, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  65
                </th>
                <td>
                  +RA
                </td>
                <td>
                  Lluvia fuerte, contínua, no engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  66
                </th>
                <td>
                  -FZRA
                </td>
                <td>
                  Lluvia débil, engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  67
                </th>
                <td>
                  +FZRA
                  <br>
                  FZRA
                </td>
                <td>
                  Lluvia moderada o fuerte, engelante.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  68
                </th>
                <td>
                  -RASN
                  -DZSN
                </td>
                <td>
                  Lluvia y nieve o llovizna y débil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  69
                </th>
                <td>
                  +RASN
                  <br>
                  RASN
                  <br>
                  +DZSN
                </td>
                <td>
                  Lluvia y nieve o llovizna y nieve, moderada o fuerte.
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww= 70-79 Precipitaciones sólidas, pero no en forma de chubascos</h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  70
                </th>
                <td>
                  -SN
                </td>
                <td>
                  Nevada débil intermitente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  71
                </th>
                <td>
                  -SN
                </td>
                <td>
                  Nevada débil contínua.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  72
                </th>
                <td>
                  SN
                </td>
                <td>
                  Nevada moderada, intermitente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  73
                </th>
                <td>
                  SN
                </td>
                <td>
                  Nevada moderada, contínua.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  74
                </th>
                <td>
                  +SN
                </td>
                <td>
                  Nevada fuerte intermitente.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  75
                </th>
                <td>
                  +SN
                </td>
                <td>
                  Nevada fuerte contínua.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  76
                </th>
                <td>
                  IC
                </td>
                <td>
                  Prismas de hielo, con o sin niebla.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  77
                  <br>
                  78
                </th>
                <td>
                  SG
                </td>
                <td>
                  Nieve en gránulos, con o sin niebla. Cristales de nieve,
                  <br>
                  aislados en forma de estrella (con o sin niebla).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  79
                </th>
                <td>
                  PE
                </td>
                <td>
                  Hielo granulado.
                </td>
              </tr>

              <tr>
                <th scope="row">
                </th>
                <td> 
                </td>
                <td>    
                  <h6>ww= 80-99 Precipitaciones en formas de chubascso o precipitacion con tormenta 
                    <br> 
                    o después de una tormenta </h6>
                </td>
              </tr>

              <tr>
                <th scope="row">
                  80
                </th>
                <td>
                  -RASH
                </td>
                <td>
                  Chubasco(s) de lluvia, débil(es).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  81
                </th>
                <td>
                  +SHRA
                  <br>
                  SHRA
                </td>
                <td>
                  Chubasco(s) de lluvia.
                  <br>
                  Moderado(s) o fuerte(s).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  82
                </th>
                <td>
                  +SHRA
                </td>
                <td>
                  Chubasco(s) de lluvia, violento(s).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  83
                </th>
                <td>
                  -SHRASN
                </td>
                <td>
                  Chubasco(s) de lluvia y nieve dévil(es).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  84
                </th>
                <td>
                  +SHRASN
                  <br>
                  SHRASN
                </td>
                <td>
                  Chubasco(s) de lluvia y nieve
                  <br>
                  moderado(s) o fuerte(s).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  85
                </th>
                <td>
                  -SHSN
                </td>
                <td>
                  Chubasco(s) de nieve débil(es).
                </td>
              </tr>
                            <tr>
                <th scope="row">
                  86
                </th>
                <td>
                  +SHSN
                  <br>
                  SHSN
                </td>
                <td>
                  Chubasco(s) de nieve
                  <br>
                  moderado(s) o fuerte(s).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  87
                </th>
                <td>
                  -SHGS
                  <br>
                  -SHRA
                </td>
                <td>
                  Chubasco(s) de nieve granulado o granizo pequeño
                  <br>
                  con lluvia y nieve débil(es).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  88
                </th>
                <td>
                  +SHGS
                  <br>
                  +SHRA
                  <br>
                  SHGS
                  <br>
                  SHRA
                </td>
                <td>
                  Chubasco(s) de nieve granulado o granizo
                  <br>
                  granizo pequeño, con lluvia o lluvia y nieve,
                  <br>
                  moderado(s) o fuertes(s).
                </td>
              </tr>

              <tr>
                <th scope="row">
                  89
                </th>
                <td>
                  -SHGR
                  <br>
                  -SHRA
                </td>
                <td>
                  Chubasco(s) de granizo, con lluvia
                  <br>
                  o lluvia y nieve, o sin ellas debiles y sin truenos.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  90
                </th>
                <td>
                  +SHGR
                  <br>
                  +SHRA
                  <br>
                  SHGR
                  <br>
                  SHRA
                </td>
                <td>
                  Chubasco(s) de granizo.
                  <br>
                  con lluvia o lluvia y nieve, o sin 
                  <br>
                  ellas moderados o fuertes y sin truenos.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  91
                </th>
                <td>
                  -RA
                </td>
                <td>
                  Lluvia débil.
                </td>
              </tr>
              
              <tr>
                <th scope="row">
                  92
                </th>
                <td>
                  +RA
                </td>
                <td>
                  Lluvia moderada o fuerte.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  93
                </th>
                <td>
                  -GR
                </td>
                <td>
                  Nieve o lluvia y nieve o granizo debil.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  94
                </th>
                <td>
                  +GR
                </td>
                <td>
                  Nieve o lluvia y nieve o granizo moderados o fuertes.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  95
                </th>
                <td>
                  -TSRA
                  <br>
                  TSRA
                </td>
                <td>
                  Tormenta eléctrica débil o moderada
                  <br>
                  sin granizo, pero con lluvia y/o nieve.
                </td>
              </tr>
              
              <tr>
                <th scope="row">
                  96
                </th>
                <td>
                  -TSGR
                  <br>
                  TSGR
                </td>
                <td>
                  Tormenta eléctrica débil
                  <br>
                  o moderada con granizo.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  97
                </th>
                <td>
                  +TSRA
                </td>
                <td>
                  Tormenta eléctrica fuerte
                  <br>
                  con lluvia o nieve. Sin granizo.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  98
                </th>
                <td>
                  TSDS
                  <br>
                  TSSS
                </td>
                <td>
                  Tormenta eléctrica con
                  <br>
                  tempestad de polvo y arena.
                </td>
              </tr>

              <tr>
                <th scope="row">
                  99
                </th>
                <td>
                  +TSGR
                </td>
                <td>
                  Tormenta eléctrica fuerte con granizo.
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    
</div>
@endsection
