<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="/dashboard">{{ Request::path() }}</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form action="" class="navbar-form"></form>
            <ul class="navbar-nav">
              <li class="nav-item">
                    {{-- <form action="/logout" method="post">
                        @csrf
                        <button type="submit" style="background:none!important; border: none!important; color:red;" title="Keluar" class="text-red">
                            <i class="material-icons">power_settings_new</i>
                            
                        </button>

                    </form> --}}
                <p class="text-center" style="text-transform: uppercase; font-weight: 600;"><img id="avatar" src="{{(Auth::user()->foto != '0')? '/img/faces/'.Auth::user()->foto: ((Auth::user()->jk == 'l') ? '/img/faces/default-l.jpg' : '/img/faces/default-p.jpg')}}" alt="Avatar" class="img img-circle" style="width: 50px;border-radius:50%;margin: auto;left: 30%;border:2px solid white;box-shadow:0 0 15px rgba(255,255,255,0.6);"> {{Auth::user()->fullname}}</p>
              </li>
            </ul>
          </div>
        </div>
      </nav>