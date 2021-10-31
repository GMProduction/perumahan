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
                <tr>
                    <th>#</th>
                    <th>No. Pesanan</th>
                    <th>No. Sertifikat</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pembelian</th>
                    <th>Type Rumah</th>
                    <th>Status</th>
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
                        <td>{{$d->perkembanganAkhir ? $d->perkembanganAkhir->status : '-'}}</td>
                        <td style="width: 150px">
                            <a class="btn btn-success btn-sm" id="detailData" data-id="{{$d->id}}">Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data user</td>
                    </tr>
                @endforelse

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->



        </div>

    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        })

        $(document).on('click', '#detailData', function () {
            var id = $(this).data('id');
            var url = window.location.pathname+'/'+id;
            $(this).attr('href',url)
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
