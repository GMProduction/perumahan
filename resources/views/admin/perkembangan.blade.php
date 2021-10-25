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
                <h5>Data Perkembangan</h5>

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
                        Status
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
                        Proses Pembangunan
                    </td>

                    <td style="width: 150px">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#detail">Detail</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>

            <!-- Detail-->
            <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detail1">Tambah Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-6">
                                    <table>
                                        <tr>
                                            <th>
                                                Nama Pelanggan
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">Ayu</span>
                                            </td>
                                        </tr>
                                        <tr class="mb-3">
                                            <th>
                                                No. Hp
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">087987984</span>
                                            </td>
                                        </tr>

                                        <tr class="mb-3">
                                            <th>
                                                Alamat
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">Jl. jl men</span>
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                                <div class="col-6">
                                    <table>
                                        <tr>
                                            <th>
                                                No. Sertifikat
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">087987984</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                Type Rumah
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">20/50</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Tanggal Beli
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">12 September 2021</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Keterangan
                                            </th>
                                            <td>
                                                <span class="ms-1"> :</span>
                                            </td>
                                            <td>
                                                <span class="ms-3">Rumah seluar 20m </span>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>

                            <hr>
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Tanggal
                                    </th>

                                    <th>
                                        Keterangan
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
                                        12 September 2019
                                    </td>
                                

                                    <td>
                                        Proses Pembangunan
                                    </td>

                                    <td style="width: 150px">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#tambahsiswa">Ubah</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="hapus('id', 'nama') ">hapus</button>
                                    </td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

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
