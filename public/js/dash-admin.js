// import Axios from "axios";

   

$(document).ready(function(){
    /**
     *  mengambil pathname dari url
     * Contoh url http://localhost/example
     * pathname = /example
     */
    var path = window.location.pathname; 

    // Menentukan url yang targetnya sama dengan pathname
    // var hashTarget = $('.sidebar .nav a[href="#"]');
    var target = $('.sidebar .nav a[href="'+path+'"]');

    // Menambahkan class active pada li parent dari url yang sesuai dengan pathname
    target.parent('li').addClass('active');
    // hashTarget.parent('li').addClass('active');


     /**
     * Get All Users With DataTables
     */
    var tusers = $('#dashadmin-user-table').DataTable({
        dom: 'Bftip',
        processing: true,
        serverSide: true,
        ajax: {
            url: 'http://localhost:8000/ajax/allusers',
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
            },
            {
                extend: 'excel',
                title: 'Data pengguna'
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
            
            { data: null, name: 'opsi', 'defaultContent': '<button class="btn btn-sm btn-outline-primary btn-rombel"><i class="material-icons">people</i></button> <button class="btn btn-sm btn-outline-warning btn-edit-rombel"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-rombel"><i class="material-icons">delete</i></button> ', 'targets': -1, 'orderable': false},
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
        minimumInputLength: 1,
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
        minimumInputLength: 1,
        width: '100%'
        // theme: "material"
    });

    $('#btn-modal-rombel').on('click',  function(e) {
        // e.preventDefault();
        // selectguru();
        $('#modalRombelxxx').modal();
        
        
    });

    // function selectguru(selected){
    //    $('.select2guru').select2({
    //         // width: '100%',
    //         ajax: {
    //             url: '/ajax/gurus',
    //             dataType: 'json',
                
    //             processResults: function(data)  {
    //                 return {
    //                     results: $.map(data, function(item) {
    //                         return {
    //                             text: item.nama_guru,
    //                             id: item.nip
    //                         };
    //                     })
    //                 };
    //             },
    //             cache: true
    //         },
    //         placeholder: 'cari Guru',
    //         minimumInputLength: 1,
    //         // theme: "material"
    //     });
    // }

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
                }
            });
        });
        $('#form_rombel button[type="submit"]').html('<i class="material-icons">update</i>Perbarui');

        $('#modalRombelxxx').modal();
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
            // scrollY: '350px',
            // scrollCollapse: true,
            // paging: false,
            ajax: '/ajax/getmembers?kode='+data.kode_rombel,
            columns: [
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
            // scrollY: '350px',
            // scrollCollapse: true,
            // paging: false,
            ajax: '/ajax/getnonmembers',
            columns: [
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
            // var newRombel = $('#sel2Rombel').val();
            // if ( newRombel == data.kode_rombel) {
            //     swal('Peringatan', 'Rombel tujuan tidak boleh sama dengan rombel saat ini', 'warning');
            //     $('#sel2Rombel').focus();
            // } else {
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

    
    $('.modal').on('hide.bs.modal', function(e) {
        // alert('bye.');
        $(this).find('form').trigger('reset');
    });


});

