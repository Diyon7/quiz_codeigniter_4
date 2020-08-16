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
                                    <th>aksi</th>
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
                                        <td><?= $nilaib ?></td>
                                        <td><a href="<?= base_url('admin/peserta/lihat/' . $n['id']) ?>" class="btn btn-primary">Detail</a></td>
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

<?= $this->endSection() ?>