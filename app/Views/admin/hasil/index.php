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
                        <table id="example1" class="table table-bordered table-striped">
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
                                foreach ($nilai as $n) :
                                    var_dump($n);
                                    foreach ($hasil as $h) :
                                        if ($n->team_id == $h['id']) : ?>
                                            <tr>
                                                <td><?= $h['id'] ?></td>
                                                <td><?= $h['name'] ?></td>
                                                <td><?= $h['school_name'] ?></td>
                                                <td><?= $h['email'] ?></td>
                                                <td><?= $n->team_id ?></td>
                                            </tr>
                                <?php
                                        endif;
                                    endforeach;
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