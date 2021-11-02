@extends('admin.base')

@section('title')
    Data Siswa
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Pembelian</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>No. Pesanan</th>
                    <th>No. Sertifikat</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pembelian</th>
                    <th>Type Rumah</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$d->no_pesanan}}</td>
                        <td>{{$d->no_sertifikat}}</td>
                        <td>{{$d->user->nama}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_beli))}}</td>
                        <td>{{$d->tipe_rumah}}</td>
                        <td>{{$d->deskripsi}}</td>
                        <td style="width: 150px">
                            <button type="button" class="btn btn-success btn-sm" id="editData" data-tanggal="{{$d->tanggal_beli}}" data-deskripsi="{{$d->deskripsi}}" data-tipe="{{$d->tipe_rumah}}" data-user="{{$d->user_id}}" data-sertifikat="{{$d->no_sertifikat}}" data-pesanan="{{$d->no_pesanan}}" data-id="{{$d->id}}">Ubah
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data user</td>
                    </tr>
                @endforelse

            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>


        <div>


            <!-- Modal Tambah-->
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
                            <form id="form" onsubmit="return save()">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="mb-3">
                                    <label for="no_sertifikat" class="form-label">No. Sertifikat</label>
                                    <input type="text" required class="form-control" id="no_sertifikat" name="no_sertifikat">
                                </div>

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Pelanggan</label>
                                    <div class="d-flex">
                                        <select class="form-select" aria-label="Default select example" id="user_id" name="user_id">
                                            <option selected disabled>Pilih Pelanggan</option>
                                            @foreach($user as $u)
                                                <option value="{{$u->id}}">{{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type Rumah</label>
                                    <input type="text" required class="form-control" id="type" name="tipe_rumah">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control " name="tanggal_beli" id="tanggal_pembelian"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                                </div>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        $(document).on('click', '#addData, #editData', function () {
            $('#modal #id').val($(this).data('id'));
            $('#modal #user_id').val($(this).data('user'));
            $('#modal #type').val($(this).data('tipe'));
            $('#modal #no_sertifikat').val($(this).data('sertifikat'));
            $('#modal #tanggal_pembelian').val('');

            if ($(this).data('id')){
                var tgl = $(this).data('tanggal');
                var dataTgl = tgl.split(' ');
                $('#modal #tanggal_pembelian').val(dataTgl[0]);
            }


            $('#modal #deskripsi').val($(this).data('deskripsi'));
            $('#modal').modal('show')
        })

        function save() {
            var text = 'Simpan Data';
            if ($('#modal #id').val()){
                text = 'Update Data';
            }
            saveData(text,'form')
            return false;
        }

        function after() {

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
