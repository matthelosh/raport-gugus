$(document).ready(function () {

    var path = window.location.pathname;

    // Menentukan url yang targetnya sama dengan pathname
    // var hashTarget = $('.sidebar .nav a[href="#"]');
    var target = $('.sidebar .nav a[href="' + path + '"]');
    // console.log(path);

    var regx = new RegExp("\/penilaian\/", "i");
    // console.log(regx.test(path));
    if (regx.test(path)) {
        target.closest('.collapse').addClass('show');
    }
    // Menambahkan class active pada li parent dari url yang sesuai dengan pathname
    target.parent('li').addClass('active');
    // hashTarget.parent('li').addClass('active');
    $('.modal').on('hide.bs.modal', function (e) {
        // alert($(this).find('table').prop('id'));

        // $(this).find('select').val('0');
        $(this).find('form').trigger('reset');
        // $(this).find('table').DataTable().destroy();
    });
    // Ambil File Foto
    $(document).on('click', '.edit-foto', function () {
        $('#fileFoto').trigger('click');
    });

    $(document).on('change', '#fileFoto', function (e) {
        var fd = new FormData();
        var foto = $(this)[0].files[0];
        $('#avatar').addClass('rotate');
        if (foto.type.match('image.*')) {
            fd.append('fileFoto', foto);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Headers': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajax/edit-foto',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.status == 'sukses') {
                        // $('#avatar').prop("src", "/img/faces"+res.data);
                        swal('Sukses', 'Foto Profil berhasil disimpan. :)', 'info');
                        $('#avatar').prop('src', '/img/faces/' + res.data);
                        setTimeout(function () {
                            $('#avatar').removeClass('rotate');
                        }, 300);

                    } else {
                        swal('Error', res.data, 'error');
                        $('#avatar').removeClass('rotate');
                    }
                }
            })
        } else {
            swal('Error', 'Foto harus file jpeg, jpg atau png', 'error');
        }
    });


    var os = navigator.userAgent;

    var tsiswas = $('#dashadmin-siswa-table');

    function datatablesiswaku() {
        // alert(os);
        if (/windows phone/i.test(os) || /Android/i.test(os) || /iPad|iPhone|iPod/.test(os)) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Headers': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajax/allsiswas?ua=mobile',
                type: 'get',
                success: function (res) {
                    var tr = '';
                    res.forEach((item, index) => {
                        tr += `<tr>
                        <td>${index+1}</td>
                        <td>${item.nis}</td>
                        <td>${item.nisn}</td>
                        <td>${item.nama_siswa}</td>
                        <td>${item.jk}</td>
                        <td>${item.tempat_lahir}</td>
                        <td>${item.tanggal_lahir}</td>
                        <td>${item.agama}</td>
                        <td>${item.alamat}</td>
                        <td>${item.asal_sekolah}</td>
                        <td>${item.nama_ayah}</td>
                        <td>'<button class="btn btn-sm btn-outline-primary btn-ortu d-print-none"><i class="material-icons">face</i></button> <button class="btn btn-sm btn-outline-warning btn-edit-siswa"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-siswa"><i class="material-icons">delete</i></button> '</td>
                        </tr>`;
                    });
                    var tbody = '<tbody>' + tr + '</tbody>';
                    tsiswas.append(tbody).DataTable({
                        dom: 'ftip'
                    });
                }
            });
        } else if (/Windows/i.test(os) || /Linux/i.test(os) && window.screen.width >= 1024) {
            // alert(window.screen.width);

            tsiswas.DataTable({
                dom: 'ftp',
                processing: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Access-Control-Allow-Headers': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/ajax/allsiswas',
                    type: 'get'
                },
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                'order': [
                    [1, 'asc']
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false
                    },
                    {
                        data: 'nis',
                        'name': 'nis'
                    },
                    {
                        data: 'nisn',
                        'name': 'nisn'
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa'
                    },
                    {
                        data: 'jk',
                        name: 'jk'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'agama',
                        name: 'agama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'asal_sekolah',
                        name: 'asal_sekolah'
                    },
                    {
                        data: 'nama_ayah',
                        name: 'nama_ayah',
                        'defaultContent': '<small style="color: red;">KOSONG</small>'
                    },
                    {
                        data: null,
                        name: 'opsi',
                        'defaultContent': '<button class="btn btn-sm btn-outline-primary btn-ortu d-print-none"><i class="material-icons">face</i></button> <button class="btn btn-sm btn-outline-warning btn-edit-siswa"><i class="material-icons">edit</i></button> <button class="btn btn-sm btn-outline-danger btn-delete-siswa"><i class="material-icons">delete</i></button> ',
                        'targets': -1,
                        'orderable': false
                    },
                ],
                buttons: [{
                        extend: 'print',
                        title: 'Data Siswa'
                    },
                    // 'colvis'
                ]
            });
        }
    }
    datatablesiswaku();
    $(document).on('click', '.btn-delete-siswa', function () {
        var data = tsiswas.row($(this).parents('tr')).data();
        swal({
            title: 'Yakin Hapus?',
            text: 'Anda Akan Menghapus Siswa: ' + data.nama_siswa + ' dan mengubah tabel ortu.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
            confirmButtonColor: 'red',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'delete',
                        url: '/delete/siswa?nisn=' + data.nisn,
                        dataType: 'json'
                    }).done(function (res) {
                        swal('Dihapus!', res.msg, 'info');
                        tsiswas.draw();
                    }).fail(function (res) {
                        swal('Maaf!', res.msg, 'warning');
                    });
                });
            },
            allowOutsideClick: false
        });

    });

    $(document).on('click', '.btn-edit-siswa', function () {
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
        $('#form_update_siswa').prepend('<input type="hidden" name="id_siswa" value="' + data.id + '" id="id_siswa">');
        $('#modalEditSiswa').modal();
        $('#nama_siswa').focus();
    });

    $(document).on('submit', '#form_update_siswa', function (e) {
        e.preventDefault();
        // console.log($(this).serialize());
        var data = {
            id_siswa: $('#id_siswa').val(),
            nis: $('#update_nis').val(),
            nisn: $('#update_nisn').val(),
            nama_siswa: $('#nama_siswa').val(),
            jk: $('#jk').val(),
            agama: $('#agama').val(),
            alamat: $('#alamat').val(),
            asal_sekolah: $('#asal_sekolah').val(),
            id_ortu: $('#ortu').val()
        };
        // console.log(data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'put',
            url: '/ajax/update-siswa',
            data: data,
            success: function (res) {
                if (res.status == 'sukses') {
                    swal('Info', 'Data ' + data.nama_siswa + ' diperbarui', 'info');
                    $('#modalEditSiswa').modal('hide');
                    tsiswas.draw();
                } else {
                    swal('Error', 'Galat:' + res.msg, 'error');
                }
            }
        });
    });

    $(document).on('click', '.btn-ortu', function (e) {
        var data = tsiswas.row($(this).parents('tr')).data();
        // alert(data.nama_siswa);
        console.log(data);
        $('#namaSiswa').text(data.nama_siswa);
        if (data.id_ortu === null || data.id_ortu === '') {
            $('#form_create_ortu button[type="submit"').text('Simpan');
            $('#nisn').val(data.nisn);
            $('#form_create_ortu').prop({
                'action': '/ajax/create-ortu',
                'method': 'post'
            });
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
            $('#form_create_ortu').prop({
                'action': '/ajax/update-ortu',
                'method': 'put'
            }).prepend('<input type="hidden" name="id_ortu" value="' + data.idOrtu + '" id="idOrtu">');
            // $('#form')
            $('#modalCreateOrtu').modal();
            $('#nama_ayah').focus();
        }

    });

    $(document).on('submit', '#form_create_ortu', function (e) {
        e.preventDefault();
        var dataOrtu = {
            'nisn': $('#nisn').val(),
            'id_ortu': $('#id_ortu').val(),
            'nama_ayah': $('#nama_ayah').val(),
            'nama_ibu': $('#nama_ibu').val(),
            'job_ayah': $('#job_ayah').val(),
            'job_ibu': $('#job_ibu').val(),
            'hp_ortu': $('#hp_ortu').val(),
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
        }).done(function (res) {
            swal('Sukses', res.msg, 'info');
            $('#modalCreateOrtu').modal('hide');
            tsiswas.draw();
        }).fail(function (res) {
            swal('Galat', res.msg, 'error');
            console.log(res);
        });
    });

    var tsiswaku = $('#tsiswaku').DataTable({
        dom: 'ftip',
        processing: true,
        serverSide: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'http://localhost:8000/ajax/getsiswaku',
            type: 'get'
        },
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        'order': [
            [1, 'asc']
        ],
        columns: [{
                data: 'DT_RowIndex',
                'orderable': false
            },
            {
                data: 'nis',
                'name': 'nis'
            },
            {
                data: 'nisn',
                'name': 'nisn'
            },
            {
                data: 'nama_siswa',
                name: 'nama_siswa'
            },
            {
                data: null,
                name: 'opsi',
                'defaultContent': '<button class="btn btn-sm btn-outline-primary btn-rcover d-print-none">Cover</button> <button class="btn btn-sm btn-outline-success btn-rbio d-print-none">Biodata</button> <button class="btn btn-sm btn-outline-warning btn-rpts">Rapor PTS</button> <button class="btn btn-sm btn-outline-danger btn-rpas">Rapor PAS</button> ',
                'targets': -1,
                'orderable': false
            },
        ],
        buttons: [{
                extend: 'print',
                title: 'Data Siswa'
            },
            // 'colvis'
        ]
    });

    // Buka cove rraport
    $(document).on('click', '.btn-rcover', function () {
        // var data = tsiswaku.row($(this).parents('tr')).data();
        var totalData = tsiswaku.page.info().recordsTotal;

        // Get Current RowIndex
        var curItemIndex = tsiswaku.row($(this).parents('tr')).index();
        // Get All Table Indexes
        var trows = tsiswaku.rows().data();
        var tableIndexes = tsiswaku.rows().indexes(curItemIndex).data();
        var data = tableIndexes[curItemIndex];
        // Get Curren Item Array Index
        // var curIndexArrayKey = tsiswaku.indexOf(curItemIndex);
        // var prevItemIndex = tableIndexes[curIndexArrayKey - 1];
        // var nextItemIndex = tableIndexes[curIndexArrayKey + 1];

        // var nextData = $(tsiswaku.rows(nextItemIndex).nodes());

        // var next = tsiswaku.row($(this).parents('tr').next('tr')).data();
        // console.log(data);
        // alert(curItemIndex);
        function togglePrevNextBtn() {
            // disable prev btn on fisrt record
            if (curItemIndex == 0) {
                // alert(curItemIndex);
                $('.siswa-prev').addClass('disabled-a');
            } else {
                $('.siswa-prev').removeClass('disabled-a');
            }
            // disable next btn on last record
            if (curItemIndex >= (trows.length - 1)) {
                $('.siswa-next').addClass('disabled-a');
            } else {
                $('.siswa-next').removeClass('disabled-a');
            }
        }
        togglePrevNextBtn();
        setCover(data);

        $('#modalCoverRaport').modal();
        $(document).on('click', '.siswa-prev', function (e) {
            e.preventDefault();

            if (curItemIndex < 1) {
                return false;
            } else {
                curItemIndex--;
                data = tableIndexes[curItemIndex];
                togglePrevNextBtn();
                setCover(data);
            }
            console.log(curItemIndex);
            // alert(trows.length);

        });

        $(document).on('click', '.siswa-next', function (e) {
            e.preventDefault();
            // alert(trows.length);
            if (curItemIndex == (trows.length - 1)) {
                return false;
            } else {
                curItemIndex++;
                data = tableIndexes[curItemIndex];
                togglePrevNextBtn();
                setCover(data);
            }
            console.log(curItemIndex);
        });
    });

    function setCover(data) {

        $('#namaSiswa').html('<b>' + data.nama_siswa + '</b>');
        $('.coverNamaSiswa').text(data.nama_siswa);
        // var nis = '...........';
        if (data.nis == null) {
            $('.coverNis').text('.......');
        } else {
            $('.coverNis').text(data.nis);
        }

        $('.coverNisn').text(data.nisn);
    }

    $(document).on('click', '#btn-cetak-cover', function (e) {
        e.preventDefault();
        cetak('#coverSheet');
    });

    $(document).on('click', '#btn-cetak-rpts', function (e) {
        e.preventDefault();
        cetak('#ptsSheet');
    })

    // Raport PTS
    $(document).on('click', '.btn-rpts', function () {
        // Contoh sementara untuk layouting saja
        var data = tsiswaku.row($(this).parents('tr')).data();
        $('.nama-siswa').text(data.nama_siswa);
        $('.nis').text(data.nis);
        $('.nisn').text(data.nisn);
        var tapel = $('#tapel').val();
        var semester = $('#semester').val();
        var kode_rombel = $('#kodeRombel').text();

        getNilaiPts(data.nisn, tapel, semester, kode_rombel);
        $('#modalRaportPts').modal();
    });

    function getNilaiPts(nisn, tapel, semester, rombel) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/ajax/rpts/nisn/' + nisn + '/tapel/' + tapel + '/semester/' + semester + '/rombel/' + rombel,
            dataType: 'json',
            success: function (res) {
                var tbody = '';
                var no = 0;
                var nilais = res.nrpts;

                var count = 0;
                var jmlNh = 0;
                var jmlPts = 0;
                var jmlRt = 0;

                // console.log(res);
                Object.entries(nilais).forEach(item => {
                    // console.log(item);
                    count++;
                    var rata2 = (item[1].nh + item[1].pts) / 2;
                    var pred = (rata2 <= 55) ? 'D' : (rata2 <= 75) ? 'C' : (rata2 <= 89) ? 'B' : 'A';
                    var desc = (rata2 <= 55) ? 'Kurang' : (rata2 <= 75) ? 'Cukup' : (rata2 <= 89) ? 'Baik' : 'Sangat Baik';
                    jmlNh += item[1].nh;
                    jmlPts += item[1].pts;
                    jmlRt += rata2;
                    // nilais.forEach(item => {
                    no++;
                    tbody += `<tr><td>${no}</td><td>${item[1].nama_mapel}</td><td>${Math.ceil((item[1].nh))}</td><td>${item[1].pts}</td><td>${rata2.toFixed(2)}</td><td>${pred}</td><td>${desc}</td></tr>`;
                });
                var rtNh = jmlNh / count;
                var rtPts = jmlPts / count;
                var rtRt = jmlRt / count;
                tbody += `<tr><td colspan="2">Jumlah Nilai</td><td>${jmlNh.toFixed(2)}</td><td>${jmlPts.toFixed(2)}</td><td>${jmlRt.toFixed(2)}</td><td></td><td></td></tr>
                         <tr><td colspan="2">rata-rata</td><td>${rtNh.toFixed(2)}</td><td>${rtPts.toFixed(2)}</td><td>${rtRt.toFixed(2)}</td><td></td><td></td></tr>
                         <tr><td colspan="2">Ranking</td><td>${res.rank[0]+1}</td><td colspan="5">Dari ${res.rank[1]} siswa</td></tr>`;
                $('#tbody-rpts').html(tbody);
                var tbodyEkskul = '';
                res.ekskuls.forEach(item => {
                    tbodyEkskul += `<tr><td>Pramuka</td>${item.nx_prm}</td><td>${(item.nx_prm <= 60) ? 'D': (item.nx_prm <= 60) ? 'C': (item.nx_prm <= 60) ? 'B': 'A'}</td><td>${(item.nx_prm <= 60) ? 'Kurang': (item.nx_prm <= 60) ? 'Cukup': (item.nx_prm <= 60) ? 'Baik': 'Sangat Baik'}</td></tr>`;
                })
                $(document).on('change', '#saran', function () {
                    $('#box-saran').text($(this).val());
                })
            }
        });
    }

    var currentState = 1;
    $(document).on('click', '.btnZoomOut', function () {
        if (currentState <= 0.3) {
            swal('Stop', 'Sudah sampai minimal yg ditentukan', 'warning');
            return false;
        }
        currentState -= 0.1;
        var page = $(this).parents('.card-body').find('.page');

        page.css({
            'transform': 'scale(' + currentState + ')',
            transition: 'all 0.35s linear'
        });

    });
    $(document).on('click', '.btnZoomIn', function () {
        if (currentState >= 2) {
            swal('Stop', 'Sudah sampai maximal yg ditentukan', 'warning');
            return false;
        }
        currentState += 0.1;
        var page = $(this).parents('.card-body').find('.page');

        page.css({
            'transform': 'scale(' + currentState + ')',
            transition: 'all 0.35s linear'
        });

    });
    $(document).on('click', '.btnresetZoom', function () {
        currentState = 1;
        var page = $(this).parents('.card-body').find('.page');

        page.css({
            'transform': 'scale(1)',
            transition: 'all 0.35s ease-in-out'
        });

    });


    // Entri NIlai Harian

    var nharians = '';
    $(document).on('click', '.btn-modal-mapel', function () {
        var tema = $(this).data('tema');
        var subtema = $(this).data('subtema');
        var teks_tema = $(this).data('tekstema');

        $('#tema').text(teks_tema).css('text-transform', 'capitalize');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/ajax/mapelbytema/' + tema,
            dataType: 'json',
            success: function (res) {
                console.log(res);
                result = res.reduce(function (r, a) {
                    r[a.mapel_id] = r[a.mapel_id] || [];
                    r[a.mapel_id].push(a);
                    return r;
                }, Object.create(null));
                console.log(result);
                nharians = result;
                var mapels = [];
                Object.entries(result).forEach(item => {
                    mapels.push({
                        nama_mapel: item[1][0].mapels.nama_mapel,
                        kode_mapel: item[1][0].mapels.kode_mapel
                    });
                    // $('#list-mapel').html('<li class="nav-item">'+item[1][0].mapels.nama_mapel+'</li>');
                    // $('#list-mapel').append('<li class="nav-item">'+item[1][0].mapels.nama_mapel+'</li>');

                });
                // console.log(mapels);

                var warna = ['danger', 'primary', 'warning', 'success', 'info'];
                mapels.forEach((mapel, i) => {
                    $('#list-mapel').append('<a href="#" class="btn btn-' + warna[i] + ' btn-modal-nharian" data-kodemapel="' + mapel.kode_mapel + '" data-subtema="' + subtema + '" data-kelas="">' + mapel.nama_mapel + '</a>');
                });
                $('#modal-mapel').modal();

            }
        });


    });

    // reset mapel list by tema
    $(document).on('hidden.bs.modal', '#modal-mapel', function () {
        $(this).find('#list-mapel').html("");
    });

    $(document).on('click', '.btn-modal-nharian', function (e) {
        e.preventDefault();
        $('.nama-mapel').text($(this).text() + ' Tema: ' + $('#tema').text());
        var kode_mapel = $(this).data('kodemapel');
        var subtema = $(this).data('subtema');
        $(document).on('change', '#selAspek', function () {
            var tipe = $('#selAspek').val();

            sel2KdByTema('#selKd', kode_mapel, subtema, tipe, null);
            selTipeNilai();
        });

        var kds_tema = [];
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajax/kdsbytema/' + kode_mapel + '/' + subtema,
            dataType: 'json',
            success: function (res) {
                // console.log(res);
                res.forEach(item => {
                    kds_tema.push(item.kode_kd);
                });
            }
        });
        $('#mapel_id').text(kode_mapel);
        $('#subtema_id').text(subtema);
        // alert(kode_mapel);
        getSiswaku();

        $('#modalEntriNharian').modal();
    });

    // Toggle card body
    $(document).on('click', '.toggle-body', function () {
        var container = $(this).parents('.card').find('.card-body .container')

        container.slideToggle(500);
    });

    $(document).on('hidden.bs.modal', '#modalEntriNharian', function () {
        $('#selKd').html('').trigger('change');
        $('#selAspek').val('0');
        $('#selTeknikPenilaian').html('').trigger('change');
        $(this).find('.card-body .table').html("");
    });

    // NHarian mapel
    $(document).on('click', '.btn-modal-nontema', function () {
        var mapel = $(this).data('namamapel');
        $(document).on('change', '#selAspek', function () {
            // alert($(this).val());
            var tipe = $('#selAspek').val();

            sel2KdByTema('#selKd', null, null, tipe, mapel);
            selTipeNilai();
        });
        $('#nama_mapel').text(mapel);
        getSiswaku();
        $('#modalEntriNharian').modal();
    });
    // Post New NHarian
    $(document).on('submit', '#form-nharian', function (e) {
        e.preventDefault();
        // var nisns = $('.nisn').val();

        var data = {
            nilai: $(this).serialize(),
            tapel: $('#tapel').val(),
            semester: $('#semester').val(),
            aspek: $('#selAspek').val(),
            tipe: $('#selTeknikPenilaian').val(),
            kd: $('#selKd').val(),
            mapel: ($('#mapel_id').text() != '') ? $('#mapel_id').text() : 'null',
            subtema: ($('#subtema_id').text() != '') ? $('#subtema_id').text() : 'null',
            nama_mapel: ($('#nama_mapel').text() != '') ? $('#nama_mapel').text() : 'null'
        }
        console.log(data);
        $.ajax({
            type: 'post',
            url: `/ajax/nilai?tapel=${data.tapel}&semester=${data.semester}&periode=harian&aspek=${data.aspek}&tipe=${data.tipe}&kd=${data.kd}&mapel=${data.mapel}&subtema=${data.subtema}&nama_mapel=${data.nama_mapel}`,
            data: data.nilai,
            dataType: 'json',
            success: function (res) {
                if (res.status == 'sukses') {
                    swal('info', res.msg, 'info');
                } else {
                    var msg = (/Duplicate/ig.test(res.msg) == true) ? 'Data Penilaian untuk periode ini KD: ' + data.kd + 'sudah pernah dilakukan. Mohon Cek Ulang.' : res.msg;

                    swal('Gagal', msg, 'error');
                }
            }
        });
        // $.each(nisns, (item) => {
        //     console.log(item);
        // });
    });


    // ENtri Nilai PTS
    $(document).on('click', '.btn-modal-npts', function (e) {
        e.preventDefault();
        var kode_mapel = $(this).data('kodemapel');
        var mapel = $(this).data('namamapel');
        $('#mapel_id').text(kode_mapel);
        $('.nama-mapel').text(mapel);
        alert(mapel);
        getSiswaku();
        $('#modalEntriNPts').modal();
    });


    $(document).on('submit', '#form-npts', function (e){
        e.preventDefault();
        var data = {
            nilai: $(this).serialize(),
            tapel: $('#tapel').val(),
            semester: $('#semester').val(),
            aspek: 'null',
            tipe: 'null',
            kd: 'null',
            mapel: ($('#mapel_id').text() != '') ? $('#mapel_id').text() : 'null',
            subtema: 'null',
            nama_mapel: ($('.nama-mapel').text() != '') ? $('.nama-mapel').text() : 'null'
        }
        // console.log(data);
        $.ajax({
            type: 'post',
            url: `/ajax/nilai?tapel=${data.tapel}&semester=${data.semester}&periode=pts&aspek=${data.aspek}&tipe=${data.tipe}&kd=${data.kd}&mapel=${data.mapel}&subtema=${data.subtema}&nama_mapel=${data.nama_mapel}`,
            data: data.nilai,
            dataType: 'json',
            success: function (res) {
                if (res.status == 'sukses') {
                    swal('info', res.msg, 'info');
                } else {
                    var msg = (/Duplicate/ig.test(res.msg) == true) ? 'Data Penilaian untuk periode ini KD: ' + data.kd + 'sudah pernah dilakukan. Mohon Cek Ulang.' : res.msg;

                    swal('Gagal', msg, 'error');
                }
            }
        });

    });
    // alert('hi');
    var eks = new RegExp("\/ekskul\/", "gi");
    // console.log(regx.test(path));
    if (path == '/dashboard/penilaian/ekskul') {
        // alert('halo');
        var tekskul = $('#table-ekskul').DataTable({
            dom: 'Bftip',
            processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'http://localhost:8000/ajax/getnekskul/tapel/'+$('#tapel').val()+'/semester/'+$('#semester').val(),
                type: 'get'
            },
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            'order': [
                [1, 'asc']
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    'orderable': false
                },
                {
                    data: 'kode_nekskul',
                    'name': 'kode_nekskul'
                },
                {
                    data: 'nisn',
                    'name': 'nisn'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'nx_prm',
                    name: 'nx_prm'
                },
                {
                    data: 'nx_drm',
                    name: 'nx_drm'
                },
                {
                    data: 'nx_kom',
                    name: 'nx_kom'
                },
                {
                    data: 'nx_pai',
                    name: 'nx_pai'
                },
                {
                    data: 'nx_uks',
                    name: 'nx_uks'
                },
                {
                    data: 'predikat',
                    name: 'predikat'
                },
                {
                    data: 'ket',
                    name: 'ket'
                },
                {
                    data: null,
                    name: 'opsi',
                    'defaultContent': '<button class="btn btn-sm btn-outline-danger btn-hapus"><i class="material-icons">delete</i></button> ',
                    'targets': -1,
                    'orderable': false
                },
            ],
            buttons: [{
                    extend: 'print',
                    title: 'Data Siswa'
                },
                // 'colvis'
            ]
        });
    }

    $(document).on('click', '.btn-modal-entry-nekskul', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/ajax/getsiswaku?tipe="nonDt',
            dataType: 'json',
            success: function (res) {
                var rows = [];
                res.forEach((item, index) => {
                    rows += `<tr>
                            <td style="padding: 0 8px!important;width:50px;text-align:center;">${index+1}</td>
                            <td style="padding: 0 8px!important">${item.nisn}</td><td style="padding: 0 8px!important">${item.nama_siswa}</td>
                            <td  style="padding: 0 8px!important;width:60px;"><input type="hidden" name="nisn[]" class="nisn" value="${item.nisn}" ><input type="text" class="nx-prm" name="nxprm-${item.nisn}" style="width:40px;text-align:center;padding: 1px; border-radius: 2px; outline: 1px;" maxlength="2" value="${index}"></td>
                            <td><input type="text" class="nx-prm" name="nxdrm-${item.nisn}" style="width:40px;text-align:center;padding: 1px; border-radius: 2px; outline: 1px;" maxlength="2" value="${index}"></td>
                            <td><input type="text" class="nx-drm" name="nxkom-${item.nisn}" style="width:40px;text-align:center;padding: 1px; border-radius: 2px; outline: 1px;" maxlength="2" value="${index}"></td>
                            <td><input type="text" class="nx-pai" name="nxpai-${item.nisn}" style="width:40px;text-align:center;padding: 1px; border-radius: 2px; outline: 1px;" maxlength="2" value="${index}"></td>
                            <td><input type="text" class="nx-uks" name="nxuks-${item.nisn}" style="width:40px;text-align:center;padding: 1px; border-radius: 2px; outline: 1px;" maxlength="2" value="${index}"></td>
                            </tr>`;
                });

                // var tbody = '<tbody>' + rows + '</tbody>';
                $('.tbl-entri-nekskul tbody').html(rows);

            }
        });
        $('#modalEntriEkskul').modal();
    });

    // Post nilai ekskul
    $(document).on('submit', '#frm-entri-nekskul', function(e){
        e.preventDefault();
        
        var nilai = $(this).serialize();
        // console.log(nilai);

        $.ajax({
            type: 'post',
            url: '/ajax/neksul/tapel/'+$('#tapel').val()+'/semester/'+$('#semester').val(),
            data: nilai,
            success: function(res) {
                // console.log(res);
                if(res.status == 'sukses')
                {
                    swal('info', res.msg, 'info')
                }
                else
                {
                    var msg = (/Duplicate/ig.test(res.msg) == true) ? 'Data Penilaian Ekskul kelas ini sudah pernah dilakukan. Mohon Cek Ulang.' : res.msg;

                    swal('Gagal', msg, 'error');
                }
            }
        });
    });

    

});

function getSiswaku() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/ajax/getsiswaku?tipe="nonDt',
        dataType: 'json',
        success: function (res) {
            var thead = `<thead>
                            <tr>
                                <th style="width:50px;text-align:center;">No</th>
                                <th>NIS/NISN</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>`;

            var rows = [];
            // var inputs = '';


            res.forEach((item, index) => {
                rows += `<tr><td style="padding: 0 8px!important;width:50px;text-align:center;">${index+1}</td><td style="padding: 0 8px!important">${item.nisn}</td><td style="padding: 0 8px!important">${item.nama_siswa}</td><td  style="padding: 0 8px!important;width:60px;"><input type="hidden" name="nisn[]" class="nisn" value="${item.nisn}" ><input type="text" class="nilai" name="n-${item.nisn}" style="width:50px;text-align:center;padding: 5px; border-radius: 5px; box-shadow: 0 0 3px rgba(0,0,0,0.3);" maxlength="2" value="${index}"></td></tr>`;
            });

            var tbody = '<tbody>' + rows + '</tbody>';
            $('#tbl-entri-nh').html(thead + tbody).addClass('table-bordered');

        }
    });
}
