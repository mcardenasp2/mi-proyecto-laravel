<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <router-link class="navbar-brand" to="/">LaraBlog</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item ">
        <router-link to="/" class="nav-link text-white"> Home</router-link>

      </li>
      <li class="nav-item ">
        <router-link to="/categories" class=" nav-link text-white"> Categorias</router-link>

      </li>
      
    </ul>


    <ul class="navbar-nav">
      
     
      
      <li class="nav-item">
        
        <!-- <a class="nav-link " href="#">Logout<span class="sr-only"></span></a> -->


        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Perfil
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Perfil</a>
          
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
    </ul>
    
  </div>
</nav>