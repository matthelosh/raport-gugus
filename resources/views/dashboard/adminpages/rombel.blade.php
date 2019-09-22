<div class="card">
    <div class="card-header-success">
        <h2 class="card-title">
            <i class="material-icons">class</i>
            Data Rombongan Belajar
            <div class="ml-auto pull-right">
                <button class="btn btn-sm btn-outline" id="btn-modal-rombel" style="color: #efefef;">
                    <i class="material-icons">create</i>
                    Tambah Rombel
                </button>

                {{-- <i class="material-icons">info</i> --}}

                <a href="/dashboard/unduh-rombels" class="btn btn-sm btn-outline">
                    <i class="material-icons">cloud_download</i>
                    Unduh Excel
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
        <div class="table-responsive">
            <table class="table" id="dashadmin-rombel-table" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Rombel</th>
                        <th>Nama Rombel</th>
                        <th>Tingkat / Kelas</th>
                        <th>Guru</th>
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
                <div class="modal-header bg-green">
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

<div class="modal fade" id="modalRombelxxx" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-xl " role="document">
        <form class="form" id="form_rombel" action="{{ route('createrombel') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    
                    <h3 class="modal-title">Buat Rombel Baru</h3>
                    <button class="close" data-dismiss="modal" data-toggle="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- <div class="row"> --}}
                        {{-- <input type="hidden" name="id_user" id="id_user"> --}}
                        <div class="form-group">
                            <label for="kode_rombel" class="bmd-label-floating">Kode Rombel</label>
                            <input type="text" class="form-control" id="kode_rombel" name="kode_rombel" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="nama_rombel" class="bmd-label-floating">Nama Rombel</label>
                            <input type="text" class="form-control" id="nama_rombel" name="nama_rombel" >
                        </div>
                        <div class="form-group">
                            <label for="tingkat" class="bmd-label-floating">Tingkat / Kelas</label>
                            <input type="text" class="form-control" id="tingkat" name="tingkat">
                        </div>
                        <div class="form-group">
                            {{-- <label for="id_guru" class="bmd-label-floating">Nip Guru</label> --}}
                            <select class="select2guru form-control" id="id_guru" name="id_guru">
                            </select>
                        </div>
                        
                        <div class="form-group text-center">
                            <button class="btn btn-danger btn-lg center-block ml-auto mr-auto" data-dismiss="modal">
                                <i class="material-icons">close</i>
                                Batal
                            </button>
                            <button class="btn btn-primary btn-lg center-block ml-auto mr-auto" type="submit" id="btn-submit-create-rombel">
                                <i class="material-icons">save</i>
                                Simpan
                            </button>
                        </div>

                    {{-- </div> --}}
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Manajemen Rombel --}}
<div class="modal" id="modalManajemenRombel" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Manajemen Rombel <span id="namaRombel"></span></h4>
                <button class="close" data-dismiss="modal" >&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6" id="member">
                        <div class="container">
                            <div class="row" id="op-member">
                                <div class="col-sm-4">
                                    {{-- <label for="sel2Rombel">Pindah Ke Rombel:</label> --}}
                                    <select name="sel2Rombel" id="sel2Rombel" class="sel2Rombel">
                                            {{-- <option value="0">Pindah Rombel</option> --}}
                                        </select>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-sm btn-warning" id="pindahkan">Pindah <span data-feather="shuffle"></span></button>
                                    <button class="btn btn-sm btn-danger" id="keluarkan">Keluar <span data-feather="wind"></span></button>
                                </div>
                                <div class="col-sm-2">

                                </div>

                            </div>
                            <div class="row" id="data-member">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" width="100%" id="tmembers" >
                                        {{-- <caption style="caption-side: top;">Anggota Rombel</caption> --}}
                                        <thead>
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                {{-- <th><label for="#selectAllMembers"><input type="checkbox" id="selectAllMembers"> Semua</label></th> --}}
                                                <th>NIS</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-members">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" id="non-member">
                        <div class="container">
                            <div class="row" id="op-non-member">
                                <div class="col-sm-6">
                                    <button class="btn btn-sm btn-primary" id="masukkan">Masukkan <span data-feather="chevrons-left"></span></button>

                                </div>
                            </div>
                            <div class="row" id="data-non-member">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered" width="100%" id="tnonmembers">
                                            <thead>
                                                <tr>
                                                    {{-- <th>No</th> --}}
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-nonmembers">

                                            </tbody>
                                        </table>
                                    </div>
                            {{-- </div> --}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>