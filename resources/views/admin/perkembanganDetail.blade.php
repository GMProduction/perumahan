@extends('admin.base')

@section('title')
    Data Siswa
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dropzone/css/dropzone.min.css') }} " type="text/css">

@endsection

@section('content')
    <section class="m-2">

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Perkembangan</h5>
            </div>

            <div class="row">
                <div class="col-6">
                    <table>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->user->nama}}</span></td>
                        </tr>
                        <tr class="mb-3">
                            <th>No. Hp</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->user->pelanggan->no_hp}}</span></td>
                        </tr>
                        <tr class="mb-3">
                            <th>Alamat</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->user->pelanggan->alamat}}</span></td>
                        </tr>
                    </table>
                </div>

                <div class="col-6">
                    <table>
                        <tr>
                            <th>No. Pesanan</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->no_pesanan}}</span></td>
                        </tr>
                        <tr>
                            <th>No. Sertifikat</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->no_sertifikat}}</span></td>
                        </tr>
                        <tr>
                            <th>Type Rumah</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->tipe_rumah}}</span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Beli</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{date('d F Y', strtotime($data->tanggal_beli))}}</span></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><span class="ms-1"> :</span></td>
                            <td><span class="ms-3">{{$data->deskripsi}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>
            <button type="button" class="btn btn-success btn-sm" id="addData">Tambah Data
            </button>
            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                </thead>
                @forelse($data->perkembangan as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal))}}</td>
                        <td>{{$d->keterangan}}</td>
                        <td>{{$d->status == '1' ? 'Belum Diproses' : ($d->status == '2' ? 'Dalam Proses Pembangunan' : 'Selesai')}}</td>
                        <td style="width: 200px">
                            <button type="button" class="btn btn-success btn-sm" data-status="{{$d->status}}" data-id="{{$d->id}}" data-tanggal="{{$d->tanggal}}" data-keterangan="{{$d->keterangan}}"
                                    id="editData">Ubah
                            </button>
                            <button type="button" class="btn btn-info btn-sm" style="color: white" id="dataFoto" data-id="{{$d->id}}">Foto</button>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="hapus('id', 'nama') ">hapus
                            </button>
                        </td>
                    </tr>
                @empty
                @endforelse
            </table>
        </div>
    </section>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" onsubmit="return Save()">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control " name="tanggal"
                                   id="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="d-flex">
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option selected disabled>Pilih Status</option>
                                    <option value="1">Belum Di Proses</option>
                                    <option value="2">Dalam Proses Pembangunan</option>
                                    <option value="3">Selesai</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4"></div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Perkembangan <span id="txtKet"></span></h5>

                </div>
                <div class="modal-body">
                    <div class="row overflow-auto" id="rowImg" style="max-height: 400px">
                    </div>
                    <form id="dropzone" action="" class="dropzone" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="id" name="id" hidden>
                        <input id="type" name="type" hidden>
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImgShow" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" id="modalShowImg" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/browser-image-compression@latest/dist/browser-image-compression.js"></script>
    <script src="{{ asset('js/handler_image.js') }}"></script>
    <script type="text/javascript" src="{{ asset('css/dropzone/js/dropzone.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/compressor.js') }} "></script>
    <script>
        $(document).ready(function () {
            $('#dropzone').attr('action', window.location.pathname + '/detail/1/image');

            drop()

        })
        var myDropzone, idperkembangan;

        $(document).on('click', '#editData, #addData', function () {
            $('#modal #id').val($(this).data('id'));
            $('#modal #keterangan').val($(this).data('keterangan'));
            $('#modal #tanggal').val('');
            $('#modal #status').val($(this).data('status'));

            if ($(this).data('id')) {
                var tgl = $(this).data('tanggal');
                var dataTgl = tgl.split(' ');
                $('#modal #tanggal').val(dataTgl[0]);
            }
            $('#modal').modal('show')
        })

        $(document).on('click', '#dataFoto', function () {
            Dropzone.autoDiscover = false;
            idperkembangan = $(this).data('id');
            $('#dropzone').removeClass('dz-started').attr('action', window.location.pathname + '/detail/' + $(this).data('id') + '/image')
            $('.dz-preview').remove()
            getImg($(this).data('id'))
            $('#modalImg #id').val($(this).data('id'));
            $('#modalImg').modal('show');

        })

        $(document).on('click', '.dz-details', function (ev) {
            var split = $(this)[0].outerText.split('\n');
            $('#modalImgShow #modalShowImg').attr('src', split[1])
            $('#modalImgShow').modal('show')
        })

        function Save() {
            saveData('Simpan Data','form')
            return false;
        }


        function getImg(idper) {
            var url = window.location.pathname + '/detail/' + idper + '/image';
            console.log(url)
            var data = {
                'detail': idper
            }
            $.get(url, data, function (data) {
                $('#rowImg').empty();
                if (data) {
                    $.each(data, function (k, v) {
                        var img = v["image"]
                        var id = v['id'];
                        $('#rowImg').append('<div class="col-md-3 mb-2" id="img' + v['id'] + '" style="position: relative">\n' +
                            '                            <a class="btn" onclick="delImg(' + idper + ',' + id + ')" id="deleteImg" style="position: absolute; right: 5px;"><i class=\'bx bxs-x-square\'></i></a>' +
                            '                            <a href="#!" onclick="openImg(this)" data-img="' + img + '">\n' +
                            '                                <img src="' + v['image'] + '" style="object-fit: cover; width: 100%">\n' +
                            '                            </a>\n' +
                            '                        </div>')
                    })
                }
            })
        }

        function delImg(idper, id) {
            var url = window.location.pathname + '/detail/' + idper + '/image';
            var data = {
                'action': 'del',
                'id': id
            }
            $.get(url, data, function (data) {
                if (data === 'success') {
                    $('#img' + id).remove()
                }
            })
        }

        function openImg(a) {
            var img = $(a).data('img');
            console.log(img)
            $('#modalImgShow #modalShowImg').attr('src', img)
            $('#modalImgShow').modal('show')
        }

        Dropzone.autoDiscover = false;

        function drop() {
            try {
                myDropzone = new Dropzone("#dropzone", {
                    paramName: "file", // The name that will be used to transfer the file
                    addRemoveLinks: true,
                    acceptedFiles: ".jpeg,.jpg,.png",
                    transformFile: function (file, done) {
                        // const imageCompressor = new ImageCompressor();
                        new Compressor(file, {
                            quality: 0.6,
                            success(result) {
                                console.log(result);
                                done(result)
                            },
                            error(err) {
                                console.log(err.message);
                            },
                        });

                    },
                    sending: function (file, xhr, formData) {
                        file.myCustomName = "my-new-name" + file.name;
                        // formData.append("filesize", file.size);
                        formData.append("fileName", file.myCustomName);
                    },
                    success: function (file, response) {

                        console.log(file);
                        console.log(response);
                        file.previewElement.querySelector("img").src = response['image'];
                        file.previewElement.children[1].children[1].children[0].innerHTML = response['image'];
                        file.previewElement.children[1].children[0].children[0].innerHTML = response['size'];
                        $('.dz-image img').attr('height', '120')

                    },
                    accept: function (file, done) {
                        this.options.resizeWidth = 650;
                        this.options.resizeQuality = 0.75;
                        console.log(this.options);
                        done();
                        return;
                    },
                    removedfile: function (file) {
                        var idImg, name;
                        console.log(file)
                        if (file.xhr) {
                            idImg = JSON.parse(file.xhr.response)['id'];
                            name = JSON.parse(file.xhr.response)['image'];
                        } else {
                            idImg = file['idImg'];
                            name = file['name'];
                        }
                        console.log(idImg);
                        delImg(idperkembangan, idImg)
                            {{--var name = JSON.parse(file.xhr.response)['payload']['image'];--}}
                            {{--var idImg = JSON.parse(file.xhr.response)['payload']['id'];--}}
                            {{--console.log('delete')--}}

                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
                            void 0;
                    },
                    {{--init: async function () {--}}
                    {{--    let myDropzone = this;--}}
                    {{--    var existing_files = $('[name="image[]"]').val();--}}
                    {{--    var url = '{{route('dsaddimg',['id' =>'asdas'])}}'--}}
                    {{--    console.log(url)--}}
                    {{--    $.get('/admin/produk/image', {'id': '{{request('id')}}'}, function (data) {--}}
                    {{--        if (data.length > 0) {--}}
                    {{--            $.each(data, function (key, value) {--}}
                    {{--                console.log(myDropzone)--}}
                    {{--                var mockFile = {name: value['image'], size: value['size'], idImg: value['id']};--}}
                    {{--                myDropzone.displayExistingFile(mockFile, value['image']);--}}
                    {{--            })--}}

                    {{--        }--}}
                    {{--    })--}}
                    {{--    $('.dz-image img').attr('height', '120');--}}
                    {{--}--}}
                    //change the previewTemplate to use Bootstrap progress bars

                });
            } catch (e) {
                console.log(e)
            }
        }

        function hapus(id, name) {
            swal({
                title: "Menghapus data?",
                text: "Apa kamu yakin, ingin menghapus data ?!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Berhasil Menghapus data!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

@endsection
