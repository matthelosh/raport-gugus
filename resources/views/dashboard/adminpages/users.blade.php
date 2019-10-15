<div class="card">
    <div class="card-header-danger">
        <h2 class="card-title">
            <i class="material-icons">people</i>
            Data Pengguna
            <div class="ml-auto pull-right">
                <button class="btn btn-sm btn-outline" data-toggle="modal" data-target="#modalImportUsers" style="color: #efefef;">
                    <i class="material-icons">attach_file</i>
                    Import XLSX
                </button>

                {{-- <i class="material-icons">info</i> --}}

                <a href="/dashboard/unduh-users" class="btn btn-sm btn-outline">
                    <i class="material-icons">cloud_download</i>
                    Export XLSX
                </a>
            </div>
        </h2>
    </div>
    <div class="card-body">
        @if( null !== Session::get('sukses'))
            <div class="alert alert-success">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <span>{{ Session::get('sukses') }}</span>
            </div>
        @endif
        <div class="table-responsive" style="height: 500px!important;">
            <table class="table" id="dashadmin-user-table" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>HP</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aktif</th>
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

<div class="modal fade" id="modalImportUsers"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="/dashboard/import-users" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Pengguna</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <label for="fileExcel">Pilih File</label>
                    <input type="file" name="file" id="fileExcel" required>
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