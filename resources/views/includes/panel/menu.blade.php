<h6 class="navbar-heading text-muted ">BASE DE DATOS MET</h6>

<ul class="navbar-nav ">
    <li class="nav-item  active ">
        <a class="nav-link  active " href="{{'/home'}}">
            <i class="ni ni-tv-2 text-danger"></i> Dashboard
        </a>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-database text-blue"></i> Registros REGIONAL SLLP
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ url('/especialidades') }}">Registros MET-004 SLLP</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLCO</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLRQ</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLOR</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLUY</a>
    </div>
    </li>
    
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-database text-blue"></i> Registros REGIONAL SLVR
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ url('/metslvr') }}">Registros MET-004 SLVR</a>
    </div>
    </li>
  
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-database text-blue"></i> Registros REGIONAL SLCB
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ url('/metslcb') }}">Registros MET-004 SLCB</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLAL</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLTJ</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLYA</a>
    </div>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-database text-blue"></i> Registros REGIONAL SLTR
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ url('/metsltr') }}">Registros MET-004 SLTR</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLGM</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLJO</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLMG</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLRA</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLRI</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLSA</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLSM</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLSR</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLRY</a>
        <a class="dropdown-item" href="#">Registros MET-004 SLSB</a>
    </div>
    </li>

    
    
        <a class="nav-link" href="{{route ('logout')}}" 
            onclick="event.preventDefault(); document.getElementById('form-logout').submit()">
            <i class="fas fa-sign-in-alt"></i> Cerrar Sesión 
        </a>

      <form action="{{route('logout')}}" method="POST" style="display: none;" id="form-logout">
        @csrf
      </form>
    </li>
  </ul>
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Reportes</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        @if(auth()->user() && auth()->user()->id === 23)
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="ni ni-books text-default"></i> Administrador de usuarios
          </a>
        @endif
    </li>

    

  </ul>
  