<div class="card">
    <div class="card-header card-header-primary">
        <h2 class="card-title">
            <i class="material-icons">people</i>
            Data Siswa
            <div class="ml-auto pull-right">
                <button class="btn btn-sm btn-outline" data-toggle="modal" data-target="#modalImportSiswas" style="color: #efefef;">
                    <i class="material-icons">attach_file</i>
                    Import Siswa
                </button>

                {{-- <i class="material-icons">info</i> --}}

                <a href="/unduh/allsiswas" class="btn btn-sm btn-outline">
                    <i class="material-icons">cloud_download</i>
                    Export XLSX
                </a>
                <button class="btn btn-sm btn-outline" data-toggle="modal" data-target="#modalImportOrtu" style="color: #efefef;">
                    <i class="material-icons">face</i>
                    Import Ortu
                </button>
            </div>
        </h2>
    </div>
    <div class="card-body">
        @if( null !== Session::get('sukses'))
            <div class="alert alert-success">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <span>{{ Session::get('sukses') }}</span>
            </div>
        @elseif(Session::get('error'))
            <div class="alert alert-danger">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <span>{{ Session::get('error') }}</span>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table" id="dashadmin-siswa-table" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>JK</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Asal Sekolah</th>
                        <th>Rombel</th>
                        <th>Ortu / Wali</th>
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

<div class="modal fade" id="modalCreateOrtu" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width:600px;">
        <form id="form_create_ortu" action="/ajax/create-ortu" method="POST" class="form-inline">
            @csrf
            <div class="modal-content">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <button class="close" data-dismiss="modal">&times</button>        
                        <h4 class="card-title">Orang Tua <span id="namaSiswa"></span></h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <input type="hidden" name="nisn" id="nisn">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama_ayah" class="bmd-label-floating">Nama Ayah:</label>
                                    <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_ibu" class="bmd-label-floating">Nama Ibu:</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="job_ayah" class="bmd-label-floating">Pekerjaan Ayah:</label>
                                    <input type="text" name="job_ayah" id="job_ayah" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="job_ibu" class="bmd-label-floating">Pekerjaan Ibu:</label>
                                    <input type="text" name="job_ibu" id="job_ibu" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="hp_ortu" class="bmd-label-floating">HP Ortu</label>
                                    <input type="text" name="hp_ortu" id="hp_ortu" class="form-control">
                                </div>

                            </div>
                            {{-- <br> --}}
                            <h4>Alamat Ortu</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="alamat_jl" class="bmd-label-floating">Jalan:</label>
                                    <input type="text" name="alamat_jl" id="alamat_jl" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="alamat_desa" class="bmd-label-floating">Desa:</label>
                                    <input type="text" name="alamat_desa" id="alamat_desa" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="alamat_kec" class="bmd-label-floating">Kecamatan:</label>
                                    <input type="text" name="alamat_kec" id="alamat_kec" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="alamat_kab" class="bmd-label-floating">Kabupaten / Kota:</label>
                                    <input type="text" name="alamat_kab" id="alamat_kab" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="alamat_prov" class="bmd-label-floating">Provinsi:</label>
                                    <input type="text" name="alamat_prov" id="alamat_prov" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_wali" class="bmd-label-floating">Nama Wali:</label>
                                    <input type="text" name="nama_wali" id="nama_wali" class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="alamat_wali" class="bmd-label-floating">Alamat Wali:</label>
                                    <textarea name="alamat_wali" id="alamat_wali" class="form-control" cols="60" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="job_wali" class="bmd-label-floating">Pekerjaan Wali:</label>
                                    <input type="text" name="job_wali" id="job_wali" class="form-control" >
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="hp_wali" class="bmd-label-floating">HP Wali:</label>
                                    <input type="text" name="hp_wali" id="hp_wali" class="form-control" >
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="card-footer text-center">
                        <div class="form-group" style="margin: auto!important">
                            <button class="btn btn-danger" data-target=".modal" data-dismiss="modal" >Batal</button>
                            <button class="btn btn-info" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalImportSiswas"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="/dashboard/import-siswas" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Siswa</h5>
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

<div class="modal fade" id="modalImportOrtu"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width: 600px;">
        <form action="/dashboard/import-ortu" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="card">  
                    <div class="card-header card-header-warning">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="card-title">Import Data Ortu</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <label for="fileOrtu">Pilih File</label>
                        <input type="file" name="fileOrtu" id="fileOrtu" class="form-control" required>
                    </div>
                    <div class="card-actions">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEditSiswa" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width: 600px;">
        <form class="form form-inline" id="form_update_siswa" action="{{ route('updateonesiswa') }}" method="put" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <button class="close" data-dismiss="modal" data-toggle="modal">&times;</button>
                        <h3 class="card-title text-white">Edit Data <span id="siswaFullName"></span></h3>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row"> --}}
                            <input type="hidden" name="id_siswa" id="id_siswa">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="nis" class="bmd-label-floating">NIS</label>
                                    <input type="text" class="form-control" id="update_nis" name="nis" autofocus>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="nisn" class="bmd-label-floating">NISN</label>
                                    <input type="text" class="form-control" id="update_nisn" name="nisn" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="nama_siswa" class="bmd-label-floating">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="jk" class="bmd-label-floating">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jk" name="jk">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="agama" class="bmd-label-floating">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="alamat" class="bmd-label-floating">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="asal_sekolah" class="bmd-label-floating">Asal Sekolah</label>
                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="rombel" class="bmd-label-floating">Rombel</label>
                                    <input type="text" class="form-control" id="rombel" name="rombel" disabled title="Ubah melalui menu rombel.">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="ortu" class="bmd-label-floating">Ortu / Wali</label>
                                    <input type="text" class="form-control" id="ortu" name="ortu" title="Ubah melalui menu ortu.">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-danger btn-lg center-block ml-auto mr-auto" data-dismiss="modal">
                                    <i class="material-icons">close</i>
                                    Batal
                                </button>
                                <button class="btn btn-primary btn-lg center-block ml-auto mr-auto" type="submit" id="btn-submit-update-siswa">
                                    <i class="material-icons">update</i>
                                    Perbarui
                                </button>
                            </div>

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>