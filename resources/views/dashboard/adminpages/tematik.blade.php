<div class="card">
    <div class="card-header-danger">
        <h2 class="card-title">
            <i class="material-icons">chrome_reader_mode</i>
            Data Tematik
            <div class="ml-auto" style="float:right!important; display: flex;">
                <button class="btn btn-sm btn-outline" data-toggle="modal" data-target="#modalImportTema" style="color: #efefef;">
                    <i class="material-icons">attach_file</i>
                    Import Tema
                </button>
                <button class="btn btn-outline btn-sm" id="btnFileSubtema" style="color: #efefef;">
                    <i class="material-icons">attachment</i>
                    Import Subtema
                </button>
                <button class="btn btn-success btn-sm" style="display:none;" type="submit" id="submitSubtema">
                    <i class="material-icons">send</i>
                </button>
                <form action="/import/subtema" method="POST" enctype="multipart/form-data" id="formImportSubtema">
                    @csrf
                    <input type="file" name="fileSubtema" id="fileSubtema" style="display:none">
                    
                    
                </form>

                {{-- <i class="material-icons">info</i> --}}

                <a href="/unduh/tematik" class="btn btn-sm btn-outline">
                    <i class="material-icons">cloud_download</i>
                    Export XLSX
                </a>
            </div>
        </h2>
    </div>
    <div class="card-body">
        @if( session('message'))
            <div class="alert alert-success">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <span>{{ session('message') }}</span>
            </div>
        
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table" id="dashadmin-user-tema" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tingkat / Kelas</th>
                        <th>Kode Tema</th>
                        <th>Teks Tema</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->index +1}}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->hp }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level }}</td>
                            <td>{{ $user->isActive }}</td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>        
    </div>
</div>

<div class="modal fade" id="modalImportTema"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width:40%;">
        <form action="{{ route('importtema') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Tema</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <label for="fileTema">Pilih File</label>
                    <input type="file" name="fileTema" id="fileTema" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-xl " role="document">
        <form class="form" id="form_update_user" action="{{ route('updateoneuser') }}" method="put" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h3 class="modal-title">Edit Data <span id="userFullName"></span></h3>
                    <button class="close" data-dismiss="modal" data-toggle="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- <div class="row"> --}}
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="form-group">
                            <label for="nip" class="bmd-label-floating">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="username" class="bmd-label-floating">Username</label>
                            <input type="text" class="form-control" id="username" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="bmd-label-floating">Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="form-group">
                            <label for="hp" class="bmd-label-floating">No. HP / Whatsapp</label>
                            <input type="text" class="form-control" id="hp" name="hp">
                        </div>
                        <div class="form-group">
                            <label for="level" class="bmd-label-floating">Level Pengguna</label>
                            <input type="text" class="form-control" id="level" name="level">
                        </div>
                        <div class="form-group">
                            <label for="isActive" class="bmd-label-floating">Keaktifan</label>
                            <input type="text" class="form-control" id="isActive" name="isActive">
                        </div>
                        <div class="form-group">
                            <label for="email" class="bmd-label-floating">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="reset_password" class="bmd-label-floating">
                                <input type="checkbox" id="reset_password" name="reset_password">
                                Reset Password?
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-secondary btn-lg center-block ml-auto mr-auto" data-dismiss="modal">
                                <i class="material-icons">close</i>
                                Batal
                            </button>
                            <button class="btn btn-primary btn-lg center-block ml-auto mr-auto" type="submit" id="btn-submit-update-user">
                                <i class="material-icons">update</i>
                                Perbarui
                            </button>
                        </div>

                    {{-- </div> --}}
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="modalSubtema" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Subtema <span id="teksTema"></span></h4>
                <button class="close" data-dismiss="modal" >&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" role="document" width="100%" id="table-subtema">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Semester</th>
                                    <th>Kelas / Tingkat</th>
                                    <th>Kode Tema</th>
                                    <th>Kode Subtema</th>
                                    <th>Teks Subtema</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>