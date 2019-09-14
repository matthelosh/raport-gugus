@extends('umum.layout')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 hidden-xs">
                    <div class="container text-center" style="padding-top: 125px;">
                        <article>
                            <img src="{{ asset('img/logokab.png') }}" alt="Logo kab. Malang" height="200px">
                            <h1>Selamat Datang!</h1>
                            <p style="font-size: 1.5em;">Anda berada di sistem informasi penilaian siswa pada Gugus 1 Desa Dalisodo Kec. Wagir. Silahkan mengisi nama pengguna dan kata sandi, untuk mengoperasikan sistem ini.</p>
                        </article>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;margin-top:100px;margin-left: auto; margin-right: auto;">
                        <img class="card-img-top" src="{{ asset('img/lock.jpg') }}" alt="Card image cap" height="150px">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-lock"></i> Login</h5>
                            <form action="/login" class="form form-horizontal" id="loginForm" method="POST">
                                @csrf
                                <div class="form-group">
                                    {{-- <label for="username">Pengguna:</label> --}}
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    {{-- <label for="password">Sandi:</label> --}}
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                                </div>
                                <div class="form-group text-center">
                                    <button id="btnLogin" class="btn btn-primary block-center">
                                        <i class="fa fa-lock"></i>
                                        Masuk
                                    </button>
                                </div>
                            </form>
                            @if(null !== session()->get('err_msg'))
                            {{-- <div class="card-footer text-center" style="color: red;"> --}}
                                <span class="text-center" style="color: red;text-align:center;"><i class="fa fa-exclamation-triangle"></i> {{ session()->get('err_msg') }}</span>
                            {{-- </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
