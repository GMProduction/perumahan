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
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahsiswa">Tambah Data</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        No. Sertifikat
                    </th>

                    <th>
                        Nama Pelanggan
                    </th>

                    <th>
                        Tanggal Pembelian
                    </th>
                    <th>
                        Type Rumah
                    </th>

                    <th>
                        Deskripsi
                    </th>

                    <th>
                        Action
                    </th>

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        081257182
                    </td>
                    <td>
                        Ayu
                    </td>
                    <td>
                        12 September 2019
                    </td>
                    <td>
                        23/50
                    </td>

                    <td>
                        Rumah dengan luas bangunan 23 meter, di bayar lunas
                    </td>

                    <td style="width: 150px">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahsiswa">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahsiswa" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <label for="no" class="form-label">No. Sertifikat</label>
                                    <input type="text" required class="form-control" id="no">
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Pelanggan</label>
                                    <div class="d-flex">
                                        <select class="form-select" aria-label="Default select example" name="idguru">
                                            <option selected>Pilih Pelanggan</option>
                                            <option value="1">Erfin</option>
                                            <option value="2">Joko A</option>
                                            <option value="3">Joko B</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type Rumah</label>
                                    <input type="text" required class="form-control" id="type">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control " name="tanggal_pembelian" id="tanggal_pembelian"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Deskripsi</label>
                                    <textarea class="form-control" id="alamat" rows="3"></textarea>
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
        $(document).ready(function() {

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
