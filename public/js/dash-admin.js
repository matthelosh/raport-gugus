
// import Axios from "axios";

   

$(document).ready(function(){
    /**
     *  mengambil pathname dari url
     * Contoh url http://localhost/example
     * pathname = /example
     */
    // var path = window.location.pathname; 

    // // Menentukan url yang targetnya sama dengan pathname
    // // var hashTarget = $('.sidebar .nav a[href="#"]');
    // var target = $('.sidebar .nav a[href="'+path+'"]');

    // var settingsRegX = /^settings$/i;
    // var regx = new RegExp("\/settings\/", "i");
    // console.log(regx.test(path));
    // if (regx.test(path)) {
    //     target.closest('.collapse').addClass('show');
    // }
    // // Menambahkan class active pada li parent dari url yang sesuai dengan pathname
    // target.parent('li').addClass('active');
    // // hashTarget.parent('li').addClass('active');


     /**
     * Get All Users With DataTables
     */
    var tusers = $('#dashadmin-user-table').DataTable({
        dom: 'Bftip',
        processing: true,
        serverSide: true,
		responsive: true,
        ajax: {
            url: 'http://localhost:8000/ajax/allusers',
            type: 'get',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
        },
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        'order': [[1, 'asc']],
        columns: [
            { data: 'DT_RowIndex', 'orderable': false},
            { data: 'nip', 'name': 'nip'},
            { data: 'username', name: 'username'},
            { data: 'fullname', name: 'fullname'},
            { data: 'hp', name: 'hp'},
            { data: 'email', name: 'email'},
            { data: 'level', name: 'level'},
            { data: 'isActive', name: 'isActive'},
            { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-warning btn-edit-user"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-user"><i class="material-icons">delete</i></button> ', 'targets': -1},
        ],
        buttons: [
            {
                extend: 'print',
                title: 'Data Pengguna'
            }
        ]
    });

    // Add number column
    // tusers.on('order.dt search.dt', function() {
    //     tusers.column(0, {search: 'applied', order: 'applied'}).nodes().each( function(cell, i) {
    //         cell.innerHTML = i+1;
    //     });
    // }).draw();

    $(document).on('click', '.btn-edit-user', function(){
                //    tusers.row($(this).parents('tr')).data();
        var data = tusers.row($(this).parents('tr')).data();
        console.log(data);
    });

    $(document).on('click', '.btn-delete-user', function(){
                //    tusers.row($(this).parents('tr')).data();
        var data = tusers.row($(this).parents('tr')).data();
        // console.log(data);
        swal({
            title: 'Yakin Hapus?',
            text: 'Anda Akan Menghapus Pengguna: '+data.fullname,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
            confirmButtonColor: 'red',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,

            preConfirm: function(){
                return new Promise(function(resolve) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'delete',
                        url: '/delete/user?id='+data.id,
                        dataType: 'json'
                   }).done(function(res) {
                       swal('Dihapus!', res.msg, 'info');
                       tusers.draw();
                   }).fail(function(res) {
                        swal('Maaf!', res.msg, 'warning');
                   });
                });
            },
            allowOutsideClick: false
        });
    });

    $(document).on('click', '.btn-edit-user', function(){
        var data = tusers.row($(this).parents('tr')).data();
        
        $('#id_user').val(data.id);
        $('#userFullName').text(data.fullname);
        $('#nip').val(data.nip);
        $('#username').val(data.username);
        $('#fullname').val(data.fullname);
        $('#hp').val(data.hp);
        $('#level').val(data.level);
        $('#isActive').val(data.isActive);
        $('#email').val(data.email);

        $('#modalEditUser').modal();
    });

    // Submit Update user form
    $(document).on('submit', '#form_update_user', function(e) {
        e.preventDefault();
        var data = {
            id_user     : $('#id_user').val(),
            nip         : $('#nip').val(),
            username    : $('#username').val(),
            fullname    : $('#fullname').val(),
            email       : $('#email').val(),
            hp          : $('#hp').val(),
            level       : $('#level').val(),
            isActive    : $('#isActive').val(),
            reset_password  : $('#reset_password').prop('checked')
        }

        // if ($('#reset_password').prop('checked') == true){
        //     data.reset_password = true;
        // }

        // console.log(data);
        // alert($('#reset_password').prop('checked'));
        $.ajax({
            type: 'put',
            url: '/ajax/updateuser',
            data: data,
            dataType: 'json'
        })
        .done(function(res) {
            swal('Sukses', res.msg, 'info');
            $('#modalEditUser').modal('hide');
            tusers.draw();
        })
        .fail(function(res) {
            swal('Galat', res.msg, 'error');
        });

        
        
    });
    // DataTable Siswa
        var tsiswas = $('#dashadmin-siswa-table').DataTable({
            dom: 'Blftip',
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: {
                url: 'http://localhost:8000/ajax/allsiswas',
                type: 'get'
            },
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            'order': [[1, 'asc']],
            columns: [
                { data: 'DT_RowIndex', 'orderable': false},
                { data: 'nis', 'name': 'nis'},
                { data: 'nisn', 'name': 'nisn'},
                { data: 'nama_siswa', name: 'nama_siswa'},
                { data: 'jk', name: 'jk'},
                { data: 'tempat_lahir', name: 'tempat_lahir'},
                { data: 'tanggal_lahir', name: 'tanggal_lahir'},
                { data: 'agama', name: 'agama'},
                { data: 'alamat', name: 'alamat'},
                { data: 'asal_sekolah', name: 'asal_sekolah'},
                { data: 'id_rombel', name: 'id_rombel', 'defaultContent': '<small style="color: red;">KOSONG</small>'},
                { data: 'nama_ayah', name: 'nama_ayah',  'defaultContent': '<small style="color: red;">KOSONG</small>'},
                { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-primary btn-ortu"><i class="material-icons">face</i></button> <button class="btn btn-sm btn-outline-warning btn-edit-siswa"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-siswa"><i class="material-icons">delete</i></button> ', 'targets': -1, 'orderable': false},
            ],
            buttons: [
                {
                    extend: 'print',
                    title: 'Data Siswa'
                }
            ]
        });

        $(document).on('click', '.btn-delete-siswa', function() {
            var data = tsiswas.row($(this).parents('tr')).data();
            swal({
                title: 'Yakin Hapus?',
                text: 'Anda Akan Menghapus Siswa: '+data.nama_siswa+' dan mengubah tabel ortu.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                confirmButtonColor: 'red',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
    
                preConfirm: function(){
                    return new Promise(function(resolve) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'delete',
                            url: '/delete/siswa?nisn='+data.nisn,
                            dataType: 'json'
                       }).done(function(res) {
                           swal('Dihapus!', res.msg, 'info');
                           tsiswas.draw();
                       }).fail(function(res) {
                            swal('Maaf!', res.msg, 'warning');
                       });
                    });
                },
                allowOutsideClick: false
            });
            
        });

        $(document).on('click', '.btn-edit-siswa', function() {
            var data = tsiswas.row($(this).parents('tr')).data();
            console.log(data);
            $('#siswaFullName').text(data.nama_siswa);
            $('#update_nis').val(data.nis);
            $('#update_nisn').val(data.nisn);
            $('#nama_siswa').val(data.nama_siswa);
            $('#jk').val(data.jk);
            $('#agama').val(data.agama);
            $('#alamat').val(data.alamat);
            $('#asal_sekolah').val(data.asal_sekolah);
            $('#rombel').val(data.id_rombel);
            $('#ortu').val(data.nama_ayah);
            $('#form_update_siswa').prepend('<input type="hidden" name="id_siswa" value="'+data.id+'" id="id_siswa">');
            $('#modalEditSiswa').modal();
            $('#nama_siswa').focus();
        });

        $(document).on('submit', '#form_update_siswa', function(e) {
            e.preventDefault();
            // console.log($(this).serialize());
            var data = {
                id_siswa    : $('#id_siswa').val(),
                nis         : $('#update_nis').val(),
                nisn        : $('#update_nisn').val(),
                nama_siswa  : $('#nama_siswa').val(),
                jk          : $('#jk').val(),
                agama       : $('#agama').val(),
                alamat      : $('#alamat').val(),
                asal_sekolah: $('#asal_sekolah').val(),
                id_ortu     : $('#ortu').val()
            };
            console.log(data);
        });

        $(document).on('click', '.btn-ortu', function(e){
            var data = tsiswas.row($(this).parents('tr')).data();
            // alert(data.nama_siswa);
            console.log(data);
            $('#namaSiswa').text(data.nama_siswa);
            if(data.id_ortu === null || data.id_ortu === '') {
                $('#form_create_ortu button[type="submit"').text('Simpan');
                $('#nisn').val(data.nisn);
                $('#form_create_ortu').prop({'action': '/ajax/create-ortu', 'method': 'post'});
                $('#modalCreateOrtu').modal();
                // var label = $('label')
                // label.text(label.closest('input.form-control').val())
                
            } else {
                $('#nisn').val(data.nisn);
                $('#nama_ayah').val(data.nama_ayah);
                $('#nama_ibu').val(data.nama_ibu);
                $('#job_ayah').val(data.job_ayah);
                $('#job_ibu').val(data.job_ibu);
                $('#hp_ortu').val(data.hp_ortu);
                $('#alamat_jl').val(data.alamat_jl);
                $('#alamat_desa').val(data.alamat_desa);
                $('#alamat_kec').val(data.alamat_kec);
                $('#alamat_kab').val(data.alamat_kab);
                $('#alamat_prov').val(data.alamat_prov);
                $('#nama_wali').val(data.nama_wali);
                $('#job_wali').val(data.job_wali);
                $('#alamat_wali').val(data.alamat_wali);
                $('#hp_wali').val(data.hp_wali);
                $('#form_create_ortu button[type="submit"').text('Perbarui');
                $('#form_create_ortu').prop({'action': '/ajax/update-ortu', 'method': 'put'}).prepend('<input type="hidden" name="id_ortu" value="'+data.idOrtu+'" id="idOrtu">');
                // $('#form')
                $('#modalCreateOrtu').modal();
                $('#nama_ayah').focus();
            }
           
        });

        $(document).on('submit', '#form_create_ortu', function(e) {
            e.preventDefault();
            var dataOrtu = {
                'nisn' : $('#nisn').val(),
                'id_ortu' : $('#id_ortu').val(),
                'nama_ayah' : $('#nama_ayah').val(),
                'nama_ibu' :$('#nama_ibu').val(),
                'job_ayah' : $('#job_ayah').val(),
                'job_ibu' : $('#job_ibu').val(),
                'hp_ortu' : $('#hp_ortu').val(),
                'alamat_jl': $('#alamat_jl').val(),
                'alamat_desa': $('#alamat_desa').val(),
                'alamat_kec': $('#alamat_kec').val(),
                'alamat_kab': $('#alamat_kab').val(),
                'alamat_prov': $('#alamat_prov').val(),
                'nama_wali': $('#nama_wali').val(),
                'job_wali': $('#job_wali').val(),
                'alamat_wali': $('#alamat_wali').val(),
                'hp_wali': $('#hp_wali').val(),
            };

            $.ajax({
                type: $(this).prop('method'),
                url: $(this).prop('action'),
                data: dataOrtu,
                dataType: 'json'
            }).done(function(res) {
                swal('Sukses', res.msg, 'info');
                $('#modalCreateOrtu').modal('hide');
                tsiswas.draw();
            }).fail(function(res) {
                swal('Galat', res.msg, 'error');
                console.log(res);
            });
        });
    /**
     * Manajemen Rombel Untuk admin
     */
    // DataTable Rrombel
    var trombels = $('#dashadmin-rombel-table').DataTable({
        dom: 'Blftip',
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        ajax: {
            url: 'http://localhost:8000/ajax/allrombels',
            type: 'get'
        },
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        'order': [[1, 'asc']],
        columns: [
            { data: 'DT_RowIndex', 'orderable': false},
            { data: 'kode_rombel', 'name': 'kode_rombel'},
            { data: 'nama_rombel', 'name': 'nama_rombel'},
            { data: 'tingkat', name: 'tingkat'},
            { data: 'nama_guru', name: 'nama_guru'},
            
            { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-primary btn-rombel"><i class="material-icons">people</i></button> <button class="btn btn-sm btn-outline-info btn-mapel" title="Mapel" data-toggle="modal" data-target="#modalMapel"><i class="material-icons">book</i></button> <button class="btn btn-sm btn-outline-warning btn-edit-rombel"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-rombel"><i class="material-icons">delete</i></button> ', 'targets': -1, 'orderable': false},
        ],
        buttons: [
            {
                extend: 'print',
                title: 'Data Siswa'
            }
        ]
    });
    $('.select2guru').select2({
        ajax: {
            url: '/ajax/gurus',
            dataType: 'json',
            
            processResults: function(data)  {
                // console.log(data);
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.fullname,
                            id: item.nip
                        };
                        // console.log(item.fullname + '-' +item.nip);
                    })
                };
                
            },
            cache: false
        },
        placeholder: 'Wali Kelas',
        minimumResultsForSearch: Infinity,
        width: '100%'
        // theme: "material"
    });
    
    // Select 2 Rombel
    $('.sel2Rombel').select2({
        ajax: {
            url: '/ajax/selrombel',
            dataType: 'json',
            
            processResults: function(data)  {
                // console.log(data);
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nama_rombel,
                            id: item.kode_rombel
                        };
                        // console.log(item.fullname + '-' +item.nip);
                    })
                };
                
            },
            cache: false
        },
        placeholder: 'Pilih Rombel',
        // minimumInputLength: 1,
        minimumResultsForSearch: Infinity,
        width: '100%'
        // theme: "material"
    });

    $('#btn-modal-rombel').on('click',  function(e) {
        // e.preventDefault();
        // selectguru();
        $('#modalRombelxxx').modal();
        
        
    });

    


    $(document).on('submit', '#form_rombel', function(e) {
        e.preventDefault();
        var data = {
            id : ($('#id').val() != 'undefined') ? $('#id').val() : '',
            kode_rombel : $('#kode_rombel').val(),
            nama_rombel: $('#nama_rombel').val(),
            tingkat     : $('#tingkat').val(),
            id_guru     : $('#id_guru').val()
        };
        // console.log($(this).prop('method'));
        $.ajax({
            type: ($('#act').val() == 'update') ? 'put' : 'post',
            url: $(this).prop('action'),
            // url: '/tes',
            data: data,
            dataType: 'json'
        })
        .done(function(res) {
            if (res.status == 'sukses' ) {
                swal('Berhasil', res.msg, 'info');
                
                trombels.draw();
                $('.modal').modal('hide');
            } else {
                swal('Gagal', res.msg, 'warning');
                return false;
            }
            
        });
        
    });

    // Tombol Hapus ROmbel
    $(document).on('click', '.btn-delete-rombel', function() {
        var data = trombels.row($(this).parents('tr')).data();
        swal({
            title: 'Yakin Hapus?',
            text: 'Anda Akan Menghapus Rombel: '+data.nama_rombel,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
            confirmButtonColor: 'red',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,

            preConfirm: function(){
                return new Promise(function(resolve) {
                    $.ajax({
                        type: 'delete',
                        url: '/ajax/del/rombel?id='+data.id,
                        dataType: 'json'
                   }).done(function(res) {
                       swal('Dihapus!', res.msg, 'info');
                       trombels.draw();
                   }).fail(function(res) {
                        console.log(res.data);
                        swal('Maaf!', res.msg, 'warning');
                   });
                });
            },
            allowOutsideClick: false
        });
    });
    
    // Tombol Edit Rombel
    $(document).on('click', '.btn-edit-rombel', function() {
        // alert('halo');
        var data = trombels.row($(this).parents('tr')).data();
        $('#form_rombel').prop('action', '/ajax/update/rombel').prop('method', 'PUT');
        $('#form_rombel').prepend('<input type="hidden" name="id" value="update" id="act"><input type="hidden" name="id" value="'+data.id+'" id="id">');
        $('#form_rombel').find('.modal-title').text('Perbarui Data Rombel ' + data.nama_rombel);
        $('#form_rombel').find('#kode_rombel').val(data.kode_rombel);
        $('#form_rombel').find('#nama_rombel').val(data.nama_rombel);
        $('#form_rombel').find('#tingkat').val(data.tingkat);
        // alert(data.id_guru);
        // selectguru(data.id_guru);
        var guruSelect = $('.select2guru');
        $.ajax({
            type: 'GET',
            url: '/ajax/gurus?nip=' + data.id_guru
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.fullname, data.nip, true, true);
            guruSelect.append(option).trigger('change');
        
            // manually trigger the `select2:select` event
            guruSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                },
                minimumResultsForSearch: Infinity
            });
        });
        $('#form_rombel button[type="submit"]').html('<i class="material-icons">update</i>Perbarui');

        $('#modalRombelxxx').modal();
    });
    // Mapel ke rombel
    $(document).on('click', '.btn-mapel', function() {
        var data = trombels.row($(this).parents('tr')).data();
        $('#namaKelas').text(data.nama_rombel);
        var tmapelrombel = $('#dashadmin-table-mapelrombel').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: {
                url: 'http://localhost:8000/ajax/mapel/rombel/'+data.id,
                type: 'get'
            },
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            'order': [[1, 'asc']],
            columns: [
                { data: 'DT_RowIndex', 'orderable': false},
                { data: 'kode_mapel', 'name': 'kode_mapel'},
                { data: 'nama_mapel', 'name': 'nama_mapel'},
                { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-danger btn-detach-mapel" title="Hapus Mapel dari Rombel"><i class="material-icons">delete</i></button> ', 'targets': -1, 'orderable': false},
            ],
            buttons: [
                {
                    extend: 'print',
                    title: 'Data Siswa'
                }
            ]
        });
        $('#modalMapel').modal();

        $('#modalMapel').on('hide.bs.modal', function(){
            tmapelrombel.destroy();
        });
    });

    $(document).on('click', '.btn-rombel', function() {
        var data = trombels.row($(this).parents('tr')).data();
        // Select2 Guru preselect

        $('#namaRombel').text(data.nama_rombel);
        var rombelSelect = $('#sel2Rombel');
        // console.log(rombelSelect).val();
        $.ajax({
            type: 'GET',
            url: '/ajax/selrombel?kode=' + data.kode_rombel
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.nama_rombel, data.kode_rombel, true, true);
            rombelSelect.append(option).trigger('change');
        
            // manually trigger the `select2:select` event
            rombelSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });
        });

        // DataTable Members
        var tmembers = $('#tmembers').DataTable({
            dom: 'ftip',
            processing: true,
            serverSide: true,
            select: true,
            deferRender: true,
            // scrollY: '350px',
            // scrollCollapse: true,
            // paging: false,
            ajax: '/ajax/getmembers?kode='+data.kode_rombel,
            columns: [
                {data: 'DT_RowIndex', orderable: false},
                {data: 'nisn', name: 'nisn'},
                {data: 'nama_siswa', name: 'nama_siswa'}
            ]
        });

        // DataTable Non Members
        var tnonmembers = $('#tnonmembers').DataTable({
            dom: 'ftip',
            processing: true,
            serverSide: true,
            select: true,
            // "deferLoading": 50,
            // scrollY: '350px',
            // scrollCollapse: true,
            // paging: false,
            deferRender: true,
            ajax: '/ajax/getnonmembers',
            columns: [
                {data: 'DT_RowIndex', orderable: false},
                {data: 'nisn', 'name': 'nisn'},
                {data: 'nama_siswa', name: 'nama_siswa'}
            ]
        });

        // Pindah Rombel
        $(document).on('click','#pindahkan', function() {
            var newRombel = $('#sel2Rombel').val();
            if ( newRombel == data.kode_rombel) {
                swal('Peringatan', 'Rombel tujuan tidak boleh sama dengan rombel saat ini', 'warning');
                $('#sel2Rombel').focus();
            } else {
                var rawDataSelMembers = tmembers.rows($('#tmembers tr.selected')).data().to$();
                var selMembers = rawDataSelMembers.toArray();
                if( selMembers.length < 1 ) {
                    swal('Peringatan', 'Ctrl + Klik baris untuk memilih satu atau lebih siswa.', 'warning');
                } else {
                    var r = '';
                    nisns = [];
                    selMembers.forEach(function(m) {
                        r += m.nama_siswa+',';
                        nisns.push(m.nisn);
                    });
                    swal({
                        title: 'Pindah Rombel',
                        text: 'Anda akan memindahkan siswa: '+r,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        cancelButtonColor: 'red',
                        confirmButtonColor: 'green',
                        confirmButtonText: 'Siap', 
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                    type: 'put',
                                    url: '/ajax/pindahrombel',
                                    data: {nisns: nisns, tujuan: newRombel},
                                    dataType: 'json'
                               }).done(function(res) {
                                   swal('Berhasil!', res.msg, 'info');
                                   tmembers.draw();
                               }).fail(function(res) {
                                    // console.log(res.data);
                                    swal('Maaf!', res.msg, 'warning');
                               });
                            });
                        }
                    });
                }
            }
        });

        // Kelluarkan Siswa
        $(document).on('click','#keluarkan', function() {
                var rawDataSelMembers = tmembers.rows($('#tmembers tr.selected')).data().to$();
                var selMembers = rawDataSelMembers.toArray();
                if( selMembers.length < 1 ) {
                    swal('Peringatan', 'Ctrl + Klik baris untuk memilih satu atau lebih siswa.', 'warning');
                } else {
                    var r = '';
                    nisns = [];
                    selMembers.forEach(function(m) {
                        r += m.nama_siswa+',';
                        nisns.push(m.nisn);
                    });
                    swal({
                        title: 'Keluarkan Siswa',
                        text: 'Anda akan mengeluarkan siswa: '+r+' dari rombel '+data.nama_rombel,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        cancelButtonColor: 'red',
                        confirmButtonColor: 'green',
                        confirmButtonText: 'Siap', 
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                    type: 'put',
                                    url: '/ajax/keluarkansiswa',
                                    data: {nisns: nisns},
                                    dataType: 'json', 
                                    success: function(res) {
                                        if (res.status == 'sukses'){
                                            swal('Berhasil!', res.msg, 'info');
                                            tmembers.draw();
                                            tnonmembers.draw();
                                        } else {
                                            swal('Maaf, gagal!', res.msg, 'error');
                                        }
                                    }
                               });
                            });
                        }
                    });
                }
            // }
        });

        // Masukkan siswa ke rombel
        $(document).on('click','#masukkan', function() {
            var newRombel = data.kode_rombel;
            // if ( newRombel == data.kode_rombel) {
            //     swal('Peringatan', 'Rombel tujuan tidak boleh sama dengan rombel saat ini', 'warning');
            //     $('#sel2Rombel').focus();
            // } else {
                var rawDataSelNonMembers = tnonmembers.rows($('#tnonmembers tr.selected')).data().to$();
                var selNonMembers = rawDataSelNonMembers.toArray();
                if( selNonMembers.length < 1 ) {
                    swal('Peringatan', 'Ctrl + Klik baris untuk memilih satu atau lebih siswa.', 'warning');
                } else {
                    var r = '';
                    nisns = [];
                    selNonMembers.forEach(function(m) {
                        r += m.nama_siswa+',';
                        nisns.push(m.nisn);
                    });
                    swal({
                        title: 'Masukkan Siswa',
                        text: 'Anda akan memasukkan siswa: '+r+' ke rombel '+data.nama_rombel,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        cancelButtonColor: 'red',
                        confirmButtonColor: 'green',
                        confirmButtonText: 'Siap', 
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                    type: 'put',
                                    url: '/ajax/masukkansiswa',
                                    data: {nisns: nisns, tujuan: newRombel},
                                    dataType: 'json', 
                                    success: function(res) {
                                        if (res.status == 'sukses'){
                                            swal('Berhasil!', res.msg, 'info');
                                            tmembers.draw();
                                            tnonmembers.draw();
                                        } else {
                                            swal('Maaf, gagal!', res.msg, 'error');
                                        }
                                    }
                               });
                            });
                        }
                    });
                }
            // }
        });

        $('#modalManajemenRombel').on('hidden.bs.modal', function(){
            tmembers.clear().destroy();
            tnonmembers.clear().destroy();
        });
        $('#modalManajemenRombel').modal();
        // alert('halo');
    });

    // Modal Data Sekolah
    $('#btnModalSekolah').on('click', function(){
        $.ajax({
            type: 'get', 
            url: '/ajax/datasekolah',
            dataType: 'json',
            success: function(res) {
                if (res.status ==  'sukses') {
                    var data = res.data;
                    $('#nss').val(data.nss);
                    $('#npsn').val(data.npsn);
                    $('#nama_sekolah').val(data.nama_sekolah);
                    $('#kepsek').val(data.kepsek);
                    $('#nipks').val(data.nipks);
                    $('#alamat_jl').val(data.alamat_jl);
                    $('#alamat_desa').val(data.alamat_desa);
                    $('#alamat_kec').val(data.alamat_kec);
                    $('#alamat_kab').val(data.alamat_kab);
                    $('#alamat_prov').val(data.alamat_prov);
                    $('#telp').val(data.telp);
                    $('#email').val(data.email);
                    $('#website').val(data.website);
                    $('#modalSekolah').modal();
                    
                } else {
                    swal('Gagal', res.data, 'error');
                }
            }
        })
        
    });

    $('#formSekolah').on('submit', function(e) {
        e.preventDefault();
        // swal('Update', 'Update data sekolah', 'info');
        var data = {
                nss: $('#nss').val(),
                npsn:  $('#npsn').val(),
                nama_sekolah:    $('#nama_sekolah').val(),
                alamat_jl:    $('#alamat_jl').val(),
                alamat_desa:    $('#alamat_desa').val(),
                alamat_kec:    $('#alamat_kec').val(),
                alamat_kab:    $('#alamat_kab').val(),
                alamat_prov:     $('#alamat_prov').val(),
                telp:     $('#telp').val(),
                email:     $('#email').val(),
                website:     $('#website').val()
        }

        $.ajax({
            type: 'put',
            url: '/ajax/updatesekolah',
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.status == 'sukses') {
                    swal('Berhasil', res.msg, 'info');
                    window.location.reload();
                } else {
                    swal('Gagal', res.msg, 'error');
                }
            }
        })
    });

    // Tematik
    var ttemas = $('#dashadmin-user-tema').DataTable({
        dom: 'Bftlip',
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        ajax: {
            url: 'http://localhost:8000/ajax/alltemas',
            type: 'get'
        },
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        'order': [[1, 'asc']],
        columns: [
            { data: 'DT_RowIndex', 'orderable': false},
            { data: 'id_semester', 'name': 'id_semester'},
            { data: 'id_tingkat', 'name': 'id_tingkat'},
            { data: 'kode_tema', name: 'kode_tema'},
            { data: 'teks_tema', name: 'teks_tema'},
            
            { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-warning btn-edit-tema" title="Edit"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-tema" title="Hapus"><i class="material-icons">delete</i></button> <button class="btn btn-sm btn-outline-primary btn-modal-subtema" title="Atur Subtema"><i class="material-icons">account_tree</i></button>', 'targets': -1, 'orderable': false},
        ],
        buttons: [
            {
                extend: 'print',
                title: 'Data Siswa'
            }
        ]
    });

    // Imprt SUbtema
    $('#btnFileSubtema').on('click', function(e) {
        e.preventDefault();
        $('#fileSubtema').trigger('click');
    });
    $('#fileSubtema').on('change', function(e){
        var fileName = e.target.files[0].name;
        $('#submitSubtema').html(fileName+' <i class="material-icons">send</i>').show();
    });
    var tsubtema = $('#table-subtema');
    $(document).on('click','.btn-modal-subtema', function(){
        var data = ttemas.row($(this).parents('tr')).data();
        console.log(data);
        tsubtema.DataTable({
            dom: 'Bftlip',
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: {
                url: 'http://localhost:8000/ajax/subtema?id_tema='+data.kode_tema,
                type: 'get'
            },
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            'order': [[1, 'asc']],
            columns: [
                { data: 'DT_RowIndex', 'orderable': false},
                { data: 'id_semester', 'name': 'id_semester'},
                { data: 'id_tingkat', 'name': 'id_tingkat'},
                { data: 'id_tema', name: 'id_tema'},
                { data: 'kode_subtema', name: 'kode_subtema'},
                { data: 'teks_subtema', name: 'teks_subtema'},
                
                { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-warning btn-edit-tema" title="Edit"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-tema" title="Hapus"><i class="material-icons">delete</i></button>', 'targets': -1, 'orderable': false},
            ],
            buttons: [
                {
                    extend: 'print',
                    title: 'Data Siswa'
                }
            ]
        });

        $('#modalSubtema').modal();

    });
    $('#modalSubtema').on('hide.bs.modal', function() {
        tsubtema.DataTable().destroy();
    });

    $(document).on('click', '#submitSubtema', function(e) {
        e.preventDefault();
        $('#formImportSubtema').trigger('submit');
    });


    // Mapels
        // DataTables Mapel
    var tmapel = $('#dashadmin-table-mapel').DataTable({
        dom: 'Bftlip',
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        ajax: {
            url: '/ajax/mapels',
            type: 'get'
        },
        "columnDefs": [ {
            "searcable" : false,
            "orderable" : false,
            "targets"   : 0
        } ],
        'order' : [[1, 'asc']],
        columns: [
            { data: 'DT_RowIndex', 'orderable': false },
            { data: 'kode_mapel', name: 'kode_mapel' },
            { data: 'nama_mapel', name: 'nama_mapel' },
            { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-warning btn-edit-mapel" title="Edit"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-mapel" title="Hapus"><i class="material-icons">delete</i></button> <button class="btn btn-sm btn-outline-primary btn-modal-kd" title="Kompetensi Dasar"><i class="material-icons">list</i></button>', 'targets': -1, 'orderable': false},
        ],
        buttons: [
            {
                extend : 'print',
                title: 'Data Mapel'
            }
        ]
    });

    // Import Mapel
    $('#btnFileMapel').on('click', function(){
        $('#fileMapel').trigger('click');
    });

    $('#fileMapel').on('change', function(e) {
        var namaFile = e.target.files[0].name;
        $('#submitMapel').html('<i class="material-icons">send</i> '+namaFile).show();
    });
    $('#submitMapel').on('click', function() {
        $('#formImportMapel').trigger('submit');
    });

    
    // Mnjmn KD
    var tkdmapel = $('#table-kd');
    
    $(document).on('click', '.btn-modal-kd', function(){
        var dataMapel = tmapel.row($(this).parents('tr')).data();
        $('#teksMapel').text(dataMapel.nama_mapel);
        $("#kodeMapel").text(dataMapel.kode_mapel);
        

        // function getTkdMapel(){

        // }
        tkdmapel.DataTable().clear().destroy().draw();
        $('#modalKd').find('select').val('0');

        $('#modalKd').modal();
        
    });
    $(document).on('change', '#kelas', function(){
        // alert($(this).val());
       var kodeMapel = $('#kodeMapel').text();
        // tkdmapel.DataTable().destroy();
        tkdmapel.DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: {
                url: '/ajax/kds?kelas='+$('#kelas').val()+'&mapel='+kodeMapel,
                type: 'get'
            },
            "columnDefs": [ {
                "searcable" : false,
                "orderable" : false,
                "targets"   : 0
            } ],
            'order' : [[1, 'asc']],
            columns: [
                { data: 'DT_RowIndex', 'orderable': false, "width": "25px" },
                { data: 'kode_kd', name: 'kode_kd', "width": "50px" },
                { data: 'teks_kd', name: 'teks_kd' },
                { "width": "75px", data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-warning btn-edit-kd" title="Edit"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-kd" title="Hapus"><i class="material-icons">delete</i></button>', 'targets': -1, 'orderable': false},
            ],
            buttons: [
                {
                    extend : 'print',
                    title: 'Data Mapel'
                }
            ]
        });
       
    });
    
    // Pemetaan Tema
    $('#kelasTema').on('change', function(){
        // alert('hi');
        var jmlCols = ($(this).val() <= 3 ) ? 35 : 39;
        var jmlTema = ($(this).val() <= 3) ? 8 : 9;
        var sem1 = ($(this).val() <= 3 ) ? 4 : 5;
        var sem2 = jmlTema - sem1;
        var jmlSubtema = jmlTema * 4;
        var thead = '';
        var theadr1 = '<tr><th rowspan="3">No</th><th rowspan="3">Mupel</th><th rowspan="3">Kompetensi Dasar</th><th colspan="'+(sem1*4)+'">Semester 1</th><th colspan="'+(sem2*4)+'">Semester</tr>';
        var temaSem1 = '';
        var temaSem2 = '';
        
        for(var i = 0; i < sem1; i++){
            temaSem1 += '<th colspan="4">Tema '+(i+1)+'</th>';
        }
        for(var i = sem1; i < jmlTema; i++){
            temaSem1 += '<th colspan="4">Tema '+(i+1)+'</th>';
        }
        var theadr2 = '<tr>'+temaSem1+temaSem2+'</tr>';
        
        var subtema1 = '';
        var subtema2 = '';
        for(var st = 0; st < jmlSubtema; st++) {
            subtema1 += '<th>'+(st+1)+'</th>';
        }

        var theadr3 = '<tr>'+subtema1+'</tr>';
        var colsHelper = '';
        for (var c = 0; c < jmlCols; c++) {
            colsHelper += '<th>'+ (c+1) +'</th>';
        }

        var theadr4 = '<tr class="cols-helper">'+colsHelper+'</tr>';
        $('.btn-add-mapping').css({
            display: 'block',
            opacity: '1'
        });
        // sel2Mapel($('.sel2Mapel'), kelas);
        // $('#dashadmin-tematik thead').html(theadr1+theadr2+theadr3+theadr4);
        $.ajax({
            type: 'get', 
            url: '/ajax/getmapelsby/'+$(this).val(),
            // dataType: 'json', 
            success: function(res){
                var data = res;
                var no = 1;

                // group By
                const groupBy = (array, key) => {
                    // Return the end result
                    return array.reduce((result, currentValue, i) => {
                    // If an array already present for key, push it to the array. Else create an array and push the object
                    (result[currentValue[key]] = result[currentValue[key]] || []).push(
                        [currentValue.mapel_id, currentValue.nama_mapel, currentValue.subtema_id, currentValue.kd_id]
                        // currentValue
                    );
                    // Return the current iteration `result` value, this will be taken as next iteration `result` value and accumulate
                    return result;
                    }, {}); // empty object is the initial value for result object
                };

                
                // function removeDuplicates( arr, prop ) {
                //     let obj = {};
                //     return arr.reduce((prev, next) => {
                //       if(!obj[next]) obj[next] = {text: next.nama_mapel, val: next.mapel_id}; 
                //     //   console.log(obj);
                //       return obj;
                //     }, obj);
                //   }
                
                var mapelsRaw = [];
                data.forEach((item, i)=> {
                    mapelsRaw.push({text: item.nama_mapel, val: item.mapel_id});
                });

                // console.log(mapelsRaw);
                var uniq = {}
                var arr  = [{"id":"1"},{"id":"1"},{"id":"2"}]
                var mapels = mapelsRaw.filter(obj => !uniq[obj.val] && (uniq[obj.val] = true));
                var opts = '<option value="0">Pilih Mapel</option>';
                mapels.forEach(item => {
                    opts += `<option value="${item.val}">${item.text}</option>`;
                });

                $('#mapelTema').html(opts);

                var byMapel = groupBy(data, 'mapel_id');
                var bySubTema = groupBy(data, 'subtema_id');
                function getPivotArray(dataArr, rowIndex, colIndex, dataIndex) {
                    //Code from https://techbrij.com
                    var result = {}, ret = [];
                    var newCols = [];
                    for (var i = 0; i < dataArr.length; i++) {
                        // console.log(result[isi[i][rowIndex]]);
                        if (!result[dataArr[i][rowIndex]]) {
                            result[dataArr[i][rowIndex]] = {};
                        }
                        result[dataArr[i][rowIndex]][dataArr[i][colIndex]] = dataArr[i][dataIndex];
                        // result[isi[i][rowIndex]][isi[i][colIndex]] = isi[i][dataIndex];
                        // console.log(result);
                        //To get column names
                        if (newCols.indexOf(dataArr[i][colIndex]) == -1) {
                            newCols.push(dataArr[i][colIndex]);
                        }
                    }
             
                    newCols.sort();
                    // console.log(newCols);
                    var item = [];
             
                    //Add Header Row
                    item.push( 'KD');
                    item.push.apply(item, newCols);
                    ret.push(item);
                    // console.log(result);
                    //Add content 
                    for (var key in result) {
                        item = [];
                        // item.push(mapel);
                        item.push(key);
                        for (var i = 0; i < newCols.length; i++) {
                            item.push(result[key][newCols[i]] || "-");
                        }
                        ret.push(item);
                    
                    }
                    // console.log(ret);
                    return ret;
                    
                }
                // var pkn3out = getPivotArray(byMapel.pkn, 3,2,3, "PKN");
                // var bidout = getPivotArray(byMapel.bid, 3,2,3,"BID");
                function arrayToHTMLTable(myArray) {
                    
                    var result = `<table border='1' cellspacing='0' width='100%'>`;
                    // result += '<tr><td>Mapel</td><td colspan="'+myArray.length+'">Sub Tema</td>';
                    for (var i = 0; i < myArray.length; i++) {
                        
                        result += "<tr>";
                        for (var j = 0; j < myArray[i].length; j++) {
                           if (i == 0 ) {
                               if(j == 0) {
                                result += `<th style="background: #333;color: white; text-align:center;">K.D. / Tema </th>`
                               } else {
                                result += `<th style="background: #333;color: white; text-align:center;" data-toggle="tooltip" data-html="true" title="Tema: <b>${myArray[i][j].substr(4,1)}</b>, Sub Tema: <b>${myArray[i][j].substr(6,1)}</b>">${myArray[i][j].substr(4,3)} </th>`
                               }
                           } else {
                               if (j == 0) {
                                result += `<td style="background:#c14c4b;padding:5px 10px!important;color: #fff;text-align:center;">${myArray[i][j]} </td>`;
                               } else {
                                result += `<td class="${(myArray[i][j] != '-')? 'text-light bg-secondary': ''}" style="text-align:center;"}>${myArray[i][j]} </td>`;
                               }
                           
                           }
                           
                        }
                        result += "</tr>";
                    }
                    result += "</tbody></table>";
                    
                    return result;
                }       
                // $('.table-responsive').html(arrayToHTMLTable(pkn3out)+arrayToHTMLTable(bidout));
                $(document).on('click', '.btn-petakan', function(e){
                    e.preventDefault();
                    var mapel = $('#mapelTema').val();
                    if ( mapel == "0" ) {
                        swal('peringatan', 'Mohon memilih Mapel', 'error');
                    }
                    var out = getPivotArray(byMapel[mapel], 3,2,3);
                    $('.table-responsive').html(arrayToHTMLTable(out));
                    $('[data-toggle="tooltip"]').tooltip();
                    
                    // var tds = $('.table-responsive table tr:nth-child(1) td');
                    // $('.table-responsive table tbody tr:nth-child(0)').prop({'style': 'background: #efefef; text-align:center; font-weight: 600; color: #333;'})
                    // $('.th').prop({'colspan':tds.length, style: 'text-align:center; text-transform: uppercase; background: #cecece;'});
                    
                });

                

                

                
            }
        });
    });


    // $('.modal').on('hide.bs.modal', function(e) {
    //     // alert($(this).find('table').prop('id'));
        
    //     // $(this).find('select').val('0');
    //     $(this).find('form').trigger('reset');
    //     // $(this).find('table').DataTable().destroy();
    // });
    
    $(document).on('click', '.btn-add-mapping', function(e) {
        e.preventDefault();
        var labelKelas = $('#kelasTema option:selected').text();
        var labelMapel = $('#mapelTema option:selected').text();
        var kelas = $('#kelasTema').val();
        // console.log(labelKelas, labelMapel);
        $('#namaKelas').text(labelKelas);
        $('#namaMapel').text(labelMapel);
        sel2Mapel($('.sel2Mapel'), kelas);
        $('#modalEntriTematik').modal();
    });
    $(document).on('change', '.sel2Mapel', function(){
        // var mapel_id = $(this).val();
        var kelas = $('#kelasTema').val();
        sel2Tema($('.sel2Tema'), kelas);
    });
    $(document).on('change', '.sel2Tema', function(){
        // var mapel_id = $(this).val();
        var tema = $('#sel2Tema').val();
        sel2Subtema($('.sel2Subtema'), tema);
    });
    $(document).on('change', '.sel2Subtema', function(){
        // var mapel_id = $(this).val();
        var kelas = $('#kelasTema').val();
        var mapel = $('#sel2Mapel').val();
        sel2Kd($('.sel2Kd'), kelas, mapel);
    });

    // SUbmit new themes map
    $(document).on('submit', '#form_add_tematik', function(e){
        e.preventDefault();
        var data = {
            kelas : $('#kelasTema').val(),
            mapel: $('.sel2Mapel').val(),
            tema: $('.sel2Tema').val(),
            subtema: $('.sel2Subtema').val()
        };
        console.log(data);
    });

});

// function sel2Mapel(el, kelas) {
//     $(el).select2({
//         ajax: {
//             url: '/ajax/mapels/'+kelas,
//             dataType: 'json',
            
//             processResults: function(data)  {
//                 // console.log(data);
//                 return {
//                     results: $.map(data, function(item) {
//                         this.console.log(item);
//                         return {
//                             text: item.nama_mapel,
//                             id: item.kode_mapel
//                         };
//                         // console.log(item.fullname + '-' +item.nip);
//                     })
//                 };
                
//             },
//             cache: false
//         },
//         placeholder: 'Mapel',
//         minimumInputLength: 1,
//         width: '100%'
//         // theme: "material"
//     });
// }
