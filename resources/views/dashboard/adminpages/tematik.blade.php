<div class="card">
    <div class="card-header-danger">
        <h2 class="card-title">
            <i class="material-icons">chrome_reader_mode</i>
            Pemetaan tema dan KD
            <div class="ml-auto" style="float:right!important; display: flex;">
                
                <button class="btn btn-outline btn-sm" id="btnFileTematik" style="color: #efefef;">
                    <i class="material-icons">attachment</i>
                    Import Pemetaan
                </button>
                <button class="btn btn-success btn-sm" style="display:none;" type="submit" id="submitTematik">
                    <i class="material-icons">send</i>
                </button>
                <form action="/import/tematik" method="POST" enctype="multipart/form-data" id="formImportTematik">
                    @csrf
                    <input type="file" name="fileTematik" id="fileTematik" style="display:none">
                    
                    
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
        <div class="container-fluid">   
            <div class="row">
                <h4>Pemataan Tema dan KD
                    <form action="/dashboard/settings/tematik" method="get" class="form form-inline">
                        <div class="form-group">
                            <select name="kelasTema" id="kelasTema" class="form-control">
                                <option value="0">Pilih Kelas / Tingkat</option>
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                                <option value="4">Kelas 4</option>
                                <option value="5">Kelas 5</option>
                                <option value="6">Kelas 6</option>
                                
                            </select>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-group">    
                            <select name="mapelTema" id="mapelTema" class="form-control">
                                <option value="0">Pilih mapel</option>
                            </select>
                        </div>
                    &nbsp;
                    <button type="submit" class="btn btn-sm btn-danger btn-petakan">Proses</button>
                    <button class="btn btn-sm btn-primary btn-add-mapping" style="display:none; opacity:0;transition: all .3s linear;">Tambah Baru</button>
                    {{-- <select name="sel2Mapel" id="mapelll" class="sel2Mapel"></select> --}}
                    </form>
                    
                </h4>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-custom table-bordered table-sm" id="dashadmin-tematik" width="100%" border="1" style="border-collapse:collapse;">
                        <thead>
                            {{-- <tr>
                                <th rowspan="3">No</th>
                                <th rowspan="3">Mupel</th>
                                <th rowspan="3">Kompetensi Dasar</th>
                                <th colspan="20">Semester Ganjil</th>
                                <th colspan="16">Semester Genap</th>
                            </tr>
                            <tr>
                                <th colspan="4">Tema 1</th>
                                <th colspan="4">Tema 2</th>
                                <th colspan="4">Tema 3</th>
                                <th colspan="4">Tema 4</th>
                                <th colspan="4">Tema 5</th>
                                <th colspan="4">Tema 6</th>
                                <th colspan="4">Tema 7</th>
                                <th colspan="4">Tema 8</th>
                                <th colspan="4">Tema 9</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                            </tr>
                            <tr class="cols-helper">
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th>
                                <th>32</th>
                                <th>33</th>
                                <th>34</th>
                                <th>35</th>
                                <th>36</th>
                                <th>37</th>
                                <th>38</th>
                                <th>39</th>
                            </tr> --}}
                        </thead>
                        <tbody id="dashadmin-tematik-tbody"></tbody>
                    </table>
                </div>     
            </div> 
        
        </div>
    </div>
</div>


<div class="modal fade" id="modalEntriTematik" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom" role="document" style="width:40%">
        <form class="form" id="form_add_tematik" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="card">
                    <div class="card-header card-header-info">
                        <button class="close" data-dismiss="modal" data-toggle="modal">&times;</button>
                        <h3 class="card-header-text">Buat Peta Tematik Kelas <span id="namaKelas"></span></h3>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row"> --}}
                            {{-- <input type="hidden" name="id_user" id="id_user"> --}}
                            <div class="form-group">
                                <label for="sel2mapel" class="bmd-label-floating">Mapel</label>
                                <select name="sel2Mapel" id="sel2Mapel" class="sel2Mapel"></select>
                            </div>
                            <div class="form-group">
                                <label for="sel2Tema" class="bmd-label-floating">Tema</label>
                                <select name="sel2Tema" id="sel2Tema" class="sel2Tema"></select>
                            </div>
                            <div class="form-group">
                                <label for="sel2Subema" class="bmd-label-floating">Subtema</label>
                                <select name="sel2Subtema" id="sel2Subtema" class="sel2Subtema"></select>
                            </div>
                            <div class="form-group">
                                <label for="sel2Kd" class="bmd-label-floating">Kompetensi Dasar</label>
                                <select name="sel2Kd" id="sel2Kd" class="sel2Kd"></select>
                            </div>
                            
                            <div class="form-group text-center">
                                <button class="btn btn-danger btn-lg center-block ml-auto mr-auto" data-dismiss="modal">
                                    <i class="material-icons">close</i>
                                    Batal
                                </button>
                                <button class="btn btn-primary btn-lg center-block ml-auto mr-auto" type="submit" id="btn-submit-update-user">
                                    <i class="material-icons">update</i>
                                    Simpan
                                </button>
                            </div>

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
