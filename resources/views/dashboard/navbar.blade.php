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
                {{Auth::user()->fullname}}
              </li>
            </ul>
          </div>
        </div>
      </nav>