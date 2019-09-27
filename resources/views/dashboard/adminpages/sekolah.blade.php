<div class="card">
    <div class="card-header">
        <h2 class="card-title">Data Sekolah</h2>
        <button type="button" id="btnModalSekolah" class='btn btn-warning'>
            <i class="material-icons">edit</i>
            Edit Data Sekolah
        </button>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="table-responsive">
                        @if($data)
                            <table class="table-bordered table-sm">
                                <tr>
                                    <td>NSS</td>
                                    <td>:</td>
                                    <td>{{ $data->nss }}</td>
                                </tr>
                                <tr>
                                    <td>NPSN</td>
                                    <td>:</td>
                                    <td>{{ $data->npsn }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA SEKOLAH</td>
                                    <td>:</td>
                                    <td>{{ $data->nama_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Alamat:</td>
                                </tr>
                                <tr>
                                    <td>Jalan</td>
                                    <td>:</td>
                                    <td>{{$data->alamat_jl}}</td>
                                </tr>
                                <tr>
                                    <td>Desa</td>
                                    <td>:</td>
                                    <td>{{$data->alamat_desa}}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>:</td>
                                    <td>{{$data->alamat_kec}}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten</td>
                                    <td>:</td>
                                    <td>{{$data->alamat_kab}}</td>
                                </tr>
                                <tr>
                                    <td>Propinsi</td>
                                    <td>:</td>
                                    <td>{{$data->alamat_prov}}</td>
                                </tr>
                                <tr>
                                        <td>telepon</td>
                                        <td>:</td>
                                        <td>{{$data->telp}}</td>
                                    </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>:</td>
                                    <td>{{$data->website}}</td>
                                </tr>
                            </table>
                        @endif
                    
                    </div>
                </div>
                <div class="col-sm-8">
                    <img src="{{ asset('img/bg.jpg') }}" alt="Foto Sekolah" class="image img-responsive img-thumbnail img-circle mx-auto" width="500px">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSekolah" role="dialog">
    <div class="modal-dialog modal-sm" role="document" style="width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit Data Sekolah</h4>
                <button class="close" data-toggle="modal" data-target=".modal">&times;</button>
            </div>
            <form action="" class="form form-inline" id="formSekolah">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nss" class="bmd-label-floating">NSS</label>
                                    <input type="text" class="form-control" id="nss" with="250px" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="npsn" class="bmd-label-floating">NPSN</label>
                                    <input type="text" class="form-control" id="npsn">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_sekolah" class="bmd-label-floating">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="nama_sekolah">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_jl" class="bmd-label-floating">Jalan</label>
                                    <input type="text" class="form-control" id="alamat_jl">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alamat_desa" class="bmd-label-floating">Desa</label>
                                        <input type="text" class="form-control" id="alamat_desa">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alamat_kec" class="bmd-label-floating">Kecamatan</label>
                                        <input type="text" class="form-control" id="alamat_kec">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_kab" class="bmd-label-floating">Kabupaten</label>
                                    <input type="text" class="form-control" id="alamat_kab">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_prov" class="bmd-label-floating">Propinsi</label>
                                    <input type="text" class="form-control" id="alamat_prov">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="telp" class="bmd-label-floating">Telp. /HP</label>
                                    <input type="text" class="form-control" id="telp">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="bmd-label-floating">Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="website" class="bmd-label-floating">Website</label>
                                    <input type="text" class="form-control" id="website">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>