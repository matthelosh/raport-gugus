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

                <a href="/unduh/tema" class="btn btn-sm btn-outline">
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

<div class="modal fade" id="modalSubtema" tabindex="-1" role="dialog">
    <div class="modal-dialog animate-bottom" style="width:75%">
        <div class="modal-content">
            <div class="card">
                <div class="card-header card-header-rose">
                    <button class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="card-header-text">Subtema <span id="teksTema"></span></h4>
                    
                </div>
                <div class="card-body">
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
</div>