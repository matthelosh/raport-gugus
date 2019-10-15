<div class="row">
    <div class="card">
        <div class="card-header card-header-success">
            <h3 class="card-title">Daftar Mapel {{$rombel->nama_rombel}} <span id="tingkat" style="display:none;">{{$rombel->tingkat}}</span>
            
            </h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="d-flex justify-content-center flex-wrap">
                    @php ($colors = ['danger', 'info', 'primary', 'success'])
                    @foreach($nontemas as $nontema)
                        
                        <button class="btn btn-sm btn-success btn-modal-nontema" >{{$loop->index+1}}. {{$nontema}}</button>
                        {{-- {{$nontema->kode_mapel}}     --}}
                            
                    @endforeach 
                    {{-- @php (print_r($nontemas)) --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header card-header-danger">
            <h3 class="card-title">Daftar Tema {{$rombel->nama_rombel}} <span id="tingkat" style="display:none;">{{$rombel->tingkat}}</span></h3>
        </div>
        <div class="card-body">
            <div class="container">
                
                <div class="d-flex justify-content-start flex-wrap">
                    @foreach($temas as $tema)
                        <div class="col-sm-4">
                            <div class="card bg-dark">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-header-text">{{$loop->index+1}}. {{$tema->teks_tema}}</h4>
                                </div>
                                <div class="card-body  text-white">
                                    @php ($colors = ['danger', 'info', 'primary', 'success'])
                                    @foreach ($tema->subtemas as $subtema)
                                        <button class="btn btn-sm btn-{{$colors[$loop->index]}} btn-modal-mapel" data-tema="{{$tema->kode_tema}}" data-tekstema="{{$tema->teks_tema}}" data-subtema="{{$subtema->kode_subtema}}" style="white-space: normal;">{{$loop->index+1}}. {{$subtema->teks_subtema}}</button>
                                    
                                    @endforeach
                                    {{-- {{$tema}} --}}
                                </div>
                                
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-mapel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-danger">
                    <h3 class="card-title">Tema <span id="tema" style="text-transform: capitalize!important;"></span> <button class="close" data-dismiss="modal">&times;</button></h3>
                </div>
                <div class="card-body">
                    <ul class="nav" id="list-mapel">
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEntriNharian" tabindex="-1" role="dialog" style="overflow:scroll;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            
                            <h4>Entri Nilai Harian <span class="nama-mapel"></span><button class="close" data-dismiss="modal">&times;</button></h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="container">
                                {{-- <div class="row">   
                                    <h3>Pilih Aspek, Teknik dan Kpompetensi Dasar Terkait!</h3>
                                </div> --}}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select name="selAspek" id="selAspek">
                                            <option value="0">Pilih Aspek Penilaian</option>
                                            <option value="12">Sikap</option>
                                            <option value="3">Pengetahuan</option>
                                            <option value="4">Keterampilan</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="selTeknikPenilaian" id="selTeknikPenilaian" style="display:none;">
                                            <option value="0">Pilih Teknik Penilaian</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="selKd" id="selKd" class="selKd" style="display:none;"></select>
                                    </div>
                                    
                                </div>
                                <hr>
                                <form action="" id="form-nharian" method="post">
                                    <div class="row">
                                        
                                            <div class="col-sm-10">
                                                <div class="d-flex justify-content-center"><h4>DATA SISWA</h4></div>
                                                <div class="d-flex justify-content-center">
                                                    <table class="table table-striped table-sm" id="tbl-entri-nh" style="margin:auto!important; width: 100%; height: 500px; overflow-y:scroll;">

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-info btn-simpan-nilai" type="submit">
                                                    <i class="material-icons">save</i>
                                                    Simpan
                                                </button>
                                            </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
