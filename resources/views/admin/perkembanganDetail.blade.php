@extends('admin.base')

@section('title')
    Data Siswa
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
            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>

                </thead>
                @forelse($data->perkembangan as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->tanggal}}</td>
                        <td>{{$d->keterangan}}</td>
                        <td style="width: 150px">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#tambahsiswa">Ubah
                            </button>
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
                    <form>

                        <div class="mb-3">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control " name="tanggal_pembelian"
                                   id="tanggal_pembelian" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Keterangan</label>
                            <textarea class="form-control" id="alamat" rows="3"></textarea>
                        </div>


                        <div class="mt-3 mb-2">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto">
                        </div>

                        <hr>


                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="d-flex">
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option selected>Pilih Status</option>
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
@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        $(document).on('click', '#detailData', function () {
            $('#detail').modal('show')
        })

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
