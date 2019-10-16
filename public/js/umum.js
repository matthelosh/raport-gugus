
$(document).ready(function(){
    // Disable autofocus select2
    $('select').on('select2:open', function(e) {
        $('.select2-search input').prop('focus',false);
    });
    // will remove the searchbox and focus initially
// $(".select2-search, .select2-focusser").remove();
// // will remove the searchbox and focus on selection/close
// $('select').on('select2:closing', function (e) {
//   $(".select2-search, .select2-focusser").remove();
// });

    var os = navigator.platform;
    console.log(os);
    
    $('#table-tes').DataTable();

    var path = window.location.pathname; 

    // Menentukan url yang targetnya sama dengan pathname
    // var hashTarget = $('.sidebar .nav a[href="#"]');
    var target = $('.sidebar .nav a[href="'+path+'"]');

    var regx = new RegExp("\/settings\/", "i");
    // console.log(regx.test(path));
    if (regx.test(path)) {
        target.closest('.collapse').addClass('show');
    }
    // Menambahkan class active pada li parent dari url yang sesuai dengan pathname
    target.parent('li').addClass('active');
   // hashTarget.parent('li').addClass('active');
    $('.modal').on('hide.bs.modal', function(e) {
        // alert($(this).find('table').prop('id'));
        $('body').css('position', '');
        // $(this).find('select').val('0');
        $(this).find('form').trigger('reset');
        // $(this).find('table').DataTable().destroy();
    });

    $('.modal').on('show.bs.modal', function(e) {
        // alert($(this).find('table').prop('id'));
        $('body').css({'position': 'fixed!important', 'overflow': 'hidden!important', height: '100vh!important'});
        // $(this).find('select').val('0');
        // $(this).find('form').trigger('reset');
        // $(this).find('table').DataTable().destroy();
    });

});

    function logout(e){
        e.preventDefault();
        swal({
            title: 'Peringatan',
            text: "Yakin Keluar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Keluar!',
            cancelButtonText: 'Batal',
            }).then((result) => {
            if (result.value) {
                window.location.href = '/logout';
            }
        });
    }

    $(document).on('click', '.btn-logout', function(e){
        logout(e);
    });

    

    // Autoselect Mapel
    function sel2Mapel(el, kelas) {
        $(el).select2({
            ajax: {
                url: '/ajax/mapels/'+kelas,
                dataType: 'json',
                
                processResults: function(data)  {
                    // console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            // this.console.log(item);
                            return {
                                text: item.nama_mapel,
                                id: item.kode_mapel
                            };
                            // console.log(item.fullname + '-' +item.nip);
                        })
                    };
                    
                },
                cache: false
            },
            placeholder: 'Pilih Mapel',
            // minimumInputLength: 1,
            minimumResultsForSearch: -1,
            width: '100%'
            // theme: "material"
        });
    }
    function sel2Kd(el, kelas, mapel) {
        $(el).select2({
            ajax: {
                url: '/ajax/kds/'+kelas+'/'+mapel,
                dataType: 'json',
                
                processResults: function(data)  {
                    // console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.teks,
                                id: item.kode_kd
                            };
                            // console.log(item.fullname + '-' +item.nip);
                        })
                    };
                    
                },
                cache: false
            },
            placeholder: 'Pilih Kompetensi Dasar!',
            // minimumInputLength: 1,
            width: '100%',
            // theme: "material"
            minimumResultsForSearch: -1
        });
    }
    function sel2KdByTema(el,mapel, subtema, aspek, nama_mapel=null){
        var opt = [];

        $.ajax({
            url: '/ajax/kdsbytema/'+mapel+'/'+subtema+'?mapel='+nama_mapel,
            type: 'get',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                var data = res.filter(item => {
                    if (aspek == '12'){
                        return /^[1]|^[2]/g.test(item.kode_kd);
                        // return item.ki_id == '1' || item.ki_id == '2';
                    } else {
                        // return item.ki_id == aspek;
                        return item.kode_kd.match(`\\b^${aspek}\\b`, 'gi');
                    }
                    // return item;
                });
                console.log(data);
                // return data;data
                // opt.push({text: 'Pilih Kompetensi Dasar', id: '0'});
                opt += '<option value="0">Pilih Kompetensi Dasar</option>';
                data.forEach(d => {
                    // opt.push({text: d.teks, id: d.kode_kd});
                    opt += `<option value="${d.kode_kd}">${d.teks}</option>`;
                    
                });
                $(el).html(opt).show();

                // console.log(opt);
                // // $(el).html('');
                // $(el).select2({
                //     // ajax: {
                //     //     url: '/ajax/kdsbytema/'+mapel+'/'+subtema,
                //     //     dataType: 'json',
                        
                //     //     processResults: function(data)  {
                //     //         // console.log(data);
                //     //         return {
                //     //             results: $.map(data, function(item) {
                //     //                 return {
                //     //                     text: item.teks,
                //     //                     id: item.kode_kd
                //     //                 };
                //     //                 // console.log(item.fullname + '-' +item.nip);
                //     //             })
                //     //         };
                            
                //     //     },
                //     //     cache: false
                //     // },
                //     data: opt,
                //     placeholder: 'Pilih Kompetensi Dasar!',
                //     // minimumInputLength: 1,
                //     minimumResultsForSearch: -1,
                //     width: '100%'
                //     // theme: "material"
                // }).trigger('change');
            }
        })
        
    }
    function sel2Tema(el, kelas) {
        $(el).select2({
            ajax: {
                url: '/ajax/temas/'+kelas,
                dataType: 'json',
                
                processResults: function(data)  {
                    // console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            
                            return {
                                text: item.teks_tema,
                                id: item.kode_tema
                            };
                            // console.log(item.fullname + '-' +item.nip);
                        })
                    };
                    
                },
                cache: false
            },
            placeholder: 'Cari Tema',
            // minimumInputLength: 1,
            minimumResultsForSearch: -1,
            width: '100%'
            // theme: "material"
        });
    }
    function sel2Subtema(el, tema, aspek) {
        
        $(el).select2({
            ajax: {
                url: '/ajax/subtema/'+tema,
                dataType: 'json',
                
                processResults: function(data)  {
                    // console.log(data);
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.teks_subtema,
                                id: item.kode_subtema
                            };
                            // console.log(item.fullname + '-' +item.nip);
                        })
                    };
                    
                },
                cache: false
            },
            data: data,
            placeholder: 'Pilih Sub Tema',
            // minimumInputLength: 1,
            width: '100%',
            minimumResultsForSearch: -1
            // theme: "material"
        });
    }

    // Fungsi mencetak
    function cetak(el){
        var content = $(el).html();
        var win = window.open('', 'Cetak', 'height=600, width=800');

        win.document.write('<html><head><title>Cetak</title>');
        win.document.write(`<style>
                        @media print and (width: 8.5in) and (height: 13in) {
                            .page-border {page-break-after:always; page-break-inside:avoid}
                            table thead tr {
                                background: maroon!important;
                                color: #efefef!important;
                            }
                        }
                        @page { size:8.5in 13in; margin: 1cm 1cm 1cm 2.5cm}
                        body {color: #000000; background: #ffffff; font-family: 'Times New Roman';text-align:center;}
                        .no-margin {margin:0!important;}
                        .page-border{border:5px double #000; padding: 20px; box-sizing:border-box; height: 100%}
                        .box-nama, .box-nis {border: 1px solid #000; width: auto; padding: 5px; margin: auto; max-width: 60%;}
                        
                    </style>`);
        win.document.write('</head><body><div class="page-border">');
        win.document.write(content);
        win.document.close();
        win.focus();
        setTimeout(function(){
            win.print();
            // win.close();
            // return true;
        }, 500);

    }
    
    // $('#selAspek').select2({
    //     width: '100%'
    // }).trigger('change');

    var tekniks = [
        {id: 'obs', text: 'Observasi', tipe: '12'},
        {id: 'pd', text: 'Penilaian Diri', tipe: '12'},
        {id: 'at', text: 'Antar Teman', tipe: '12'},
        {id: 'jur', text: 'Jurnal', tipe: '12'},
        {id: 'ul', text: 'Ulangan', tipe: '3'},
        {id: 'tgs', text: 'Tugas', tipe: '3'},
        {id: 'prk', text: 'Praktek', tipe: '4'},
        {id: 'por', text: 'Portofolio', tipe: '4'},
        {id: 'por', text: 'Proyek', tipe: '4'},
    ];
    function selTeknikP(data){
        
        // $('#selTeknikPenilaian').select2({
        //     data: data,
        //     width: '100%',
        //     placeholder: 'Pilih Teknik Penilaian',
        //     minimumResultsForSearch: -1
        // }).trigger('change');
        var opts = ''
        data.forEach(opt => {
            opts += `<option val="${opt.id}"> ${opt.text} </option>`;
        })
        $('#selTeknikPenilaian').show().html(opts);
    }
    // $(document).on('change', '#selAspek', function(){
    //     selTipeNilai();
    //     sel2KdByTema('#selKd', null, )
    // });
    function selTipeNilai(){
       
        $('#selTeknikPenilaian').html(`<option val="0">Pilih Teknik Penilaian</option>`);
        var data = tekniks.filter(item => {
            if ( item.tipe == $('#selAspek').val()) {
                return item;
            }
        });
        selTeknikP(data);

       
    }

    

    