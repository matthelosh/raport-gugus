<div class="container">
    <div class="card">
        <div class="card-header card-header-primary">
            <h3 class="card-title"><i class="material-icons">menu_book </i>Cetak Raport</h3>
        </div>
        <div class="card-body">
            {{-- <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#cover" class="nav-link active bg-primary" data-toggle="tab">Sampul</a></li>
                    <li class="nav-item"><a href="#biodata" class="nav-link bg-primary" data-toggle="tab">Biodata</a></li>
                    <li class="nav-item"><a href="#rapor-pts" class="nav-link bg-primary" data-toggle="tab">Raport PTS</a></li>
                    <li class="nav-item"><a href="#rapor-pas" class="nav-link bg-primary" data-toggle="tab">Raport PAS</a></li>
                </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cover">
                    
                </div>
                <div class="tab-pane fade" id="biodata">Biodata Siswa</div>
                <div class="tab-pane fade" id="rapor-pts">Raport PTS</div>
                <div class="tab-pane fade" id="rapor-pas">Raport PAS</div>
            </div> --}}
            <div class="container">
            <h3>Data Siswa Kelas: <span id="namaRombel">{{Session::get('rombel')->nama_rombel}}</span><span style="display: none;" id="kodeRombel">{{Session::get('rombel')->kode_rombel}}</span></h3>
            <div class="table-responsive">
                <table class="table-sm table table-striped" id="tsiswaku">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody >
                        {{-- @foreach ($siswas as $siswa)
                            <tr>
                                <td></td>
                                <td>{{$siswa->nis}} / {{$siswa->nisn}}</td>
                                <td>{{$siswa->nama_siswa}}</td>
                                <td></td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>


<div class="modal" id="modalCoverRaport" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom modal-full">
        <div class="modal-content" style="background:rgba(10,10,10,0.3);">
            <div class="container">
                <div class="card">
                    <div class="card-header card-header-primary">
                        
                        <h4>Cover Raport <span id="namaSiswa"></span><button class="close" data-dismiss="modal">&times;</button></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="page-container">
                                        <div class="page cover-page">
                                            <article id="coverSheet">
                                                <h1>RAPOR</h1>
                                                <h2 class="no-margin">SEKOLAH DASAR (SD)</h2>
                                                <h2 class="no-margin" id="namaSekolah">{{Session::get('app_info')->nama_sekolah}}</h2>
                                                <h3 class="no-margin">{{Session::get('app_info')->alamat_jl}} {{Session::get('app_info')->alamat_desa}} {{Session::get('app_info')->alamat_kec}}</h3>
                                                
                                                <img src="{{ asset('img/tutwuri.png') }}" alt="Logo Kab" width="200px" style="margin-top:20%">
                                               
                                                <h4  style="margin-top:35%!important">NAMA PESERTA DIDIK</h4>
                                                <div class="box-nama">
                                                    <span class="coverNamaSiswa"></span>
                                                </div>
                                                <br>
                                                <h4 class="no-margin">NIS / NISN</h4>
                                                <div class="box-nis">
                                                    <span class="coverNis"></span> / <span class="coverNisn"></span>
                                                </div>
                                                
                                                <h3 style='margin-top:35%!important;'><strong> DINAS PENDIDIKAN DAN KEBUDAYAAN</strong></h3>
                                                <h3 class="no-margin"><strong> INDONESIA</strong></h3>
                                            </article>
                                        </div>
                                        <div class="bottom-line"></div>
                                    </div>
                                </div>
                                <div class="col-sm-2 bg-aqua">
                                    <div class="row">
                                        <button class="btn btn-primary" id="btn-cetak-cover">
                                            <i class="material-icons">print</i>
                                            Cetak
                                        </button>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        <a href="#" class="siswa-prev siswa-nav">
                                            <i class="material-icons md-24">skip_previous</i>
                                        </a>
                                        Cari Siswa
                                        <a href="#" class="siswa-next siswa-nav">
                                            <i class="material-icons md-24">skip_next</i>
                                        </a>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        <button class="btn btn-default btnZoomOut">
                                            <i class="material-icons md-24">zoom_out</i>
                                        </button>
                                        <button class="btn btn-default btnZoomIn">
                                            <i class="material-icons md-24">zoom_in</i>
                                        </button>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        <button class="btn btn-info btnresetZoom">
                                            <i class="material-icons md-24">fullscreen_exit</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRaportPts" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom modal-full">
        <div class="modal-content" style="background:rgba(10,10,10,0); border:none!important;box-shadow:none!important;">
            <div class="container">
                <div class="card">
                    <div class="card-header card-header-primary">
                        
                        <h4>Raport PTS <span class="nama-siswa"></span><button class="close" data-dismiss="modal">&times;</button></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="page-container">
                                        <div class="page pts-page">
                                            <article id="ptsSheet">
                                                <div class="container">
                                                    <div class="row kop">
                                                        <table style="border-bottom: 3px double #000;width:100%;font-size:1em;padding-bottom: 10px;">
                                                            <tr>
                                                                <td><img src="{{asset('img/logokab.png') }}" alt="Malangkab" class="logokab" width="75px" style="margin-left: 50px;"></td>
                                                                <td style="text-align:center">
                                                                    <h4 class="no-margin" style="line-height:1em">PEMERINTAH KABUPATEN MALANG</h4>
                                                                    <h4 class="no-margin" style="line-height:1em">DINAS PENDIDIKAN</h4>
                                                                    <h3 class="no-margin" style="font-weight: 900;"><strong>{{Session::get('app_info')->nama_sekolah}}</strong></h3>
                                                                    <h5 class="no-margin" style="line-height:1em"><small style="font-weight:400;">AKREDITASI: B</small></h5>
                                                                    <h5 class="no-margin" style="line-height:1em"><small style="font-weight:600;">NPSN: {{Session::get('app_info')->npsn}}</small></h5>
                                                                    <p class="no-margin" style="line-height:1em">Alamat: {{Session::get('app_info')->alamat_jl}} {{Session::get('app_info')->alamat_desa}} {{Session::get('app_info')->alamat_kec}} - {{Session::get('app_info')->alamat_kab}}</p>
                                                                    <p class="no-margin" style="line-height:1em">Telp. {{Session::get('app_info')->telp}} - Email: {{Session::get('app_info')->email}}</p>
                                                                </td>
                                                                <td><img src="{{asset('img/tutwuri.png') }}" alt="Malangkab" class="logokab" width="75px" style="margin-right: 50px;"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <p class="m-auto" style="font-weight: 600;line-height:2em; font-size: 1em">LAPORAN HASIL PENILAIAN TENGAH SEMESTER I</p>
                                                    </div>
                                                    <div class="row info-pd">
                                                        <table width="100%" cellpadding="0" class="table-info-pd" style="font-size:10pt">
                                                            <tr>
                                                                <td>Nama Peserta Didik</td>
                                                                <td>:</td>
                                                                <td class="nama-siswa"></td>
                                                                <td>Kelas</td>
                                                                <td>:</td>
                                                                <td>{{Session::get('rombel')->nama_rombel}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>NIS/NISN</td>
                                                                <td>:</td>
                                                                <td><span class="nis"></span> / <span class="nisn"></span></td>
                                                                <td>Semester</td>
                                                                <td>:</td>
                                                                <td>I (Ganjil)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nama Sekolah</td>
                                                                <td>:</td>
                                                                <td>{{Session::get('app_info')->nama_sekolah}}</td>
                                                                <td>Tahun Pelajaran</td>
                                                                <td>:</td>
                                                                <td>2019 / 2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alamat Sekolah</td>
                                                                <td>:</td>
                                                                <td>Jl. Raya Sengon No. 239 Dalisodo</td>
                                                                <td>Telp. / Fax</td>
                                                                <td>:</td>
                                                                <td>08568379589</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="row sikap">
                                                        <h4 style="margin-bottom:0!important; text-align:left">A. SIKAP</h4>
                                                        <table width="100%" class="table table-bordered table-sm" border="1" style="border-collapse:collapse;">
                                                            <thead>
                                                                <tr style="background:maroon;color:white;">
                                                                    <th style="width:5%; text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">No.</th>
                                                                    <th style="width:20%; text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">Aspek</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">Deskripsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>Spiritual</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td>Sosial</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row k3">
                                                        <h4 style="margin-bottom:0!important; text-align:left">B. PENGETAHUAN <br />KKM Satuan Pendidikan: 70</h4>
                                                        <table width="100%" class="table table-bordered table-sm" border="1" style="border-collapse:collapse;">
                                                            <thead>
                                                                <tr style="background:maroon;color:white;">
                                                                    <th style="width:5%; text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">No.</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">Muatan Pembelajaran</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">KKM</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">Nilai</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">PRD</th>
                                                                    <th style="text-align: center;font-weight:600;padding:5px!important;background:maroon;color:white;">Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody-rpts">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row saran">
                                                        <h4 style="margin-bottom:0!important; text-align:left">C. SARAN-SARAN</h4>
                                                        <div class="box-saran" style="width: 100%;min-height:50px;max-height:100px;border:2px solid #000;"></div>
                                                    </div>
                                                    <br>
                                                    <div class="row absensi">
                                                        <table class="table-absensi table-sm table-bordered" border="1" style="border-collapse:collapse;">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2" style="background:maroon;color:white;text-align:center;font-weight:600;">Ketidakhadiran</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Sakit</td>
                                                                    <td>..... hari</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Izin</td>
                                                                    <td>..... hari</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tanpa Keterangan</td>
                                                                    <td>..... hari</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="row ttd">
                                                        <table class="table" width="100%">
                                                            <tr>
                                                                <td style="width:10%"></td>
                                                                <td>
                                                                    Mengetahui,
                                                                    <br>
                                                                    Orang Tua / Wali
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    ..........................
                                                                </td>
                                                                <td style="width:40%"></td>
                                                                <td>
                                                                        {{-- {{Carbon::setLocale('id')}} --}}
                                                                        {{Session::get('app_info')->alamat_desa}}, {{ date('d M Y')}}
                                                                        <br>
                                                                        Guru Kelas {{Session::get('rombel')->nama_rombel}}
                                                                        <br>
                                                                        <br>
                                                                        <br>
                                                                        <br>
                                                                        <b><u>{{Auth::user()->fullname}}</u></b><br>
                                                                        NIP. {{Auth::user()->nip}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </article>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row">
                                            <button class="btn btn-primary" id="btn-cetak-rpts">
                                                <i class="material-icons">print</i>
                                                Cetak
                                            </button>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <a href="#" class="siswa-prev siswa-nav">
                                                <i class="material-icons md-24">skip_previous</i>
                                            </a>
                                            Cari Siswa
                                            <a href="#" class="siswa-next siswa-nav">
                                                <i class="material-icons md-24">skip_next</i>
                                            </a>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <button class="btn btn-default btnZoomOut">
                                                <i class="material-icons md-24">zoom_out</i>
                                            </button>
                                            <button class="btn btn-default btnZoomIn">
                                                <i class="material-icons md-24">zoom_in</i>
                                            </button>
                                        </div>
                                        <div class="row" style="text-align: center;">
                                            <button class="btn btn-info btnresetZoom">
                                                <i class="material-icons md-24">fullscreen_exit</i>
                                            </button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>