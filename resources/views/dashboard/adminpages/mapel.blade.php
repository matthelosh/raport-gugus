<div class="card">
    <div class="card-header-danger">
        <h2 class="card-title">
            <i class="material-icons">menu_book</i>
            Data Mapel & Kompetensi
            <div class="ml-auto" style="float:right!important; display: flex;">
                <button class="btn btn-sm btn-outline" style="color: #efefef;" id="btnFileMapel">
                    <i class="material-icons">attach_file</i>
                    Import Mapel
                </button>
                <button class="btn btn-success btn-sm" style="display:none;" type="submit" id="submitMapel">
                    <i class="material-icons">send</i>
                </button>
                <form action="/import/mapels" id="formImportMapel" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="file" name="fileMapel" id="fileMapel" style="display:none">
                </form>
                <button class="btn btn-outline btn-sm" id="btnFileKd" style="color: #efefef;">
                    <i class="material-icons">attachment</i>
                    Import KD
                </button>
                <button class="btn btn-success btn-sm" style="display:none;" type="submit" id="submitKd">
                    <i class="material-icons">send</i>
                </button>
                <form action="/import/kd" method="POST" enctype="multipart/form-data" id="formImportKd">
                    @csrf
                    <input type="file" name="fileKd" id="fileKd" style="display:none">
                    
                    
                </form>

                {{-- <i class="material-icons">info</i> --}}

                <a href="/unduh/mapels" class="btn btn-sm btn-outline">
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
            <table class="table" id="dashadmin-table-mapel" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
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

<div class="modal" id="modalKd" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom modal-full">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-info">
                    <button class="close" data-dismiss="modal" >&times;</button>
                    <h3 class="modal-title">Kompetensi Dasar <span id="teksMapel"></span></h3>
                    <span style="display:none" id="kodeMapel"></span>
                    <div class="ml-auto" style="float:right!important; display: flex;">
                        
                        {{-- <div class="nav-form form-group" style="float:right"> --}}
                            {{-- <label for="kelas" class="bmd-label-floating">Kelas</label> --}}
                            <div class="form-group">
                                <select name="kelas" id="kelas" class="form-control" style="color: #efefef">
                                    <option value="0">Pilih Kelas</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                    <option value="5">Kelas 5</option>
                                    <option value="6">Kelas 6</option>
                                </select>
                            </div>
                        {{-- </div> --}}
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" role="document" width="100%" id="table-kd">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode KD</th>
                                        <th>Teks KD</th>
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
</div>