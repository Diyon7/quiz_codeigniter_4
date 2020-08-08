<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('isi') ?>

<div class="align-item-center">
    <div class="row">
        <div class="col">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Soal</h4>
                    </div>
                    <div class="col-lg-5">
                        <a href="<?= base_url('admin/soal/add') ?>" class="btn btn-primary mt-3">Tambah</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="detail_hasil" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Sekolah</th>
                                    <th>Email</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($hasil as $n) :
                                ?>
                                    <tr>
                                        <a href=""></a>
                                        <td><?= $n['id'] ?></td>
                                        <td><?= $n['name'] ?></td>
                                        <td><?= $n['school_name'] ?></td>
                                        <td><?= $n['email'] ?></td>
                                        <td><a href="<?= base_url('admin/' . $n['id']) ?>" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Sekolah</th>
                                    <th>Email</th>
                                    <th>Nilai</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    var table;

    $(document).ready(function() {

        ajaxcsrf();

        table = $("#detail_hasil").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#detail_hasil_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": base_url + "hasilujian/NilaiMhs/" + id,
                "type": "POST",
            },
            columns: [{
                    "data": "id",
                    "orderable": false,
                    "searchable": false
                },
                {
                    "data": 'nama'
                },
                {
                    "data": 'nama_kelas'
                },
                {
                    "data": 'nama_jurusan'
                },
                {
                    "data": 'jml_benar'
                },
                {
                    "data": 'nilai'
                },
            ],
            order: [
                [1, 'asc']
            ],
            rowId: function(a) {
                return a;
            },
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>

<?= $this->endSection() ?>