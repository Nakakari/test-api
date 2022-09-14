@extends('layouts.mainBE')
@section('css')
    <style type="text/css">
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px soid rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        .simpan {
            display: none;
        }
    </style>
@stop
@section('isi')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">ABC</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <button class="btn btn-success mb-2" onClick="tambahData()" id="tambah-SKIM"><i
                        class="mdi mdi-plus-circle-outline"></i>
                    Tambah Data</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('pesan'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>Success - </strong> {{ session('pesan') }}!
                                </div>
                            @elseif (session('hapus'))
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('hapus') }}</strong>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            @elseif(count($errors) > 0)
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                        @endif
                        <table id="mytable" class="table dt-responsive nowrap scroll-vertical scroll-horizontal">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaksi</th>
                                    <th>Informasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> <!-- end preview-->
                </div> <!-- end preview-->
            </div> <!-- end preview-->
        </div> <!-- end preview-->
    </div> <!-- end preview-->
@stop
@section('modal')
    <div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Tambah Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form id="form-tambah" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="inputCity" class="form-label">Produk</label>
                        <input type="text" class="form-control" id="inputCity" name="name" required>
                        <label for="inputCity" class="form-label">Price</label>
                        <input type="number" class="form-control" id="inputCity" name="price" required>
                        <label for="inputCity" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="inputCity" name="stock" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-header-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Edit Produk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form id="form-edit" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <label for="inputCity" class="form-label">Produk</label>
                        <input type="text" class="form-control" id="inputCity" name="name" required>
                        <label for="inputCity" class="form-label">Price</label>
                        <input type="number" class="form-control" id="inputCity" name="price" required>
                        <label for="inputCity" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="inputCity" name="stock" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('js')
    <script type="text/javascript">
        let list_transaksi = [];
        const table = $("#mytable").DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: "{{ url('list_transaksi') }}",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id",
                "render": function(data, type, row, meta) {
                    list_transaksi[row.id] = row;
                    return meta.row + meta.settings._iDisplayStart + 1;
                    // console.log(list_siswa)
                }
            }, {
                "targets": 1,
                "data": "status",
                "render": function(data, type, row, meta) {
                    return ``;

                }
            }, {
                "targets": 2,
                "data": "price",
                "render": function(data, type, row, meta) {
                    return ``;

                }
            }, {
                "targets": 3,
                "data": "id",
                "render": function(data, type, row, meta) {
                    return `
                              <a class="action-icon" onclick="edit(${row.id})"><i class="mdi mdi-square-edit-outline"></i></a>
                              <a class="action-icon" onclick="hapus(${row.id})"><i class="mdi mdi-trash-can"></i></a>
                                `;
                }
            }]
        });

        function tambahData() {
            $('#tambah-data').modal('show');
        }
        $('#form-tambah').on('submit', function(event) {
            event.preventDefault() //jangan disubmit
            tambahproduk()
        });

        function tambahproduk() {
            let form = $('#form-tambah');
            const url = "{{ url('tambah_produk') }}";
            $.ajax({
                url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response === true) {
                        table.ajax.reload(null, false)
                        alert('Berhasil!')
                    }
                },
                error: function(e) {
                    alert('Something wrong!')
                }
            })
        }

        function edit(id) {
            const produk = list_transaksi[id]
            $('#edit-data').modal('show');
            $("#edit-data [name='id']").val(id)
            $("#edit-data [name='name']").val(produk.name)
            $("#edit-data [name='price']").val(produk.price)
            $("#edit-data [name='stock']").val(produk.stock)
        }
        $('#form-edit').on('submit', function(event) {
            event.preventDefault() //jangan disubmit
            editproduk()
        });

        function editproduk(id) {
            let form = $('#form-edit');
            const url = "{{ url('edit_produk') }}";
            $.ajax({
                url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    if (response === true) {
                        table.ajax.reload(null, false)
                        alert('Berhasil!')
                    }
                },
                error: function(e) {
                    alert('Something wrong!')
                }
            })
        }

        function hapus(id) {
            const c = confirm("Hapus data?")
            if (c === true) {
                $.ajax({
                    url: "{{ url('delete_produk') }}?id=" + id,
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response === true) {
                            table.ajax.reload(null, false)
                            alert('Berhasil Menghapus!')
                        }
                    },
                    error: function(e) {
                        //   console.log(e)
                        alert("Something wrong!")
                    }
                })
            }
        }
    </script>
@stop
