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
                                    <th>No</th>
                                    <th>Question</th>
                                    <th>Images</th>
                                    <th>Choice 1</th>
                                    <th>Choice 2</th>
                                    <th>Choice 3</th>
                                    <th>Choice 4</th>
                                    <th>Choice 5</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($soal as $s) : ?>
                                    <tr>
                                        <td><?= $s['id'] ?></td>
                                        <td><?= $s['question'] ?></td>
                                        <td><img src="/assets/image/<?= $s['image']; ?>" width="200" alt=""></td>
                                        <td><?= $s['multiple_choice_1'] ?></td>
                                        <td><?= $s['multiple_choice_2'] ?></td>
                                        <td><?= $s['multiple_choice_3'] ?></td>
                                        <td><?= $s['multiple_choice_4'] ?></td>
                                        <td><?= $s['multiple_choice_5'] ?></td>
                                        <td><?= $s['answer_key'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/soal/edit/' . $s['id']) ?>" class="btn btn-block btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('admin/soal/delete/' . $s['id']) ?>" class="btn btn-block btn-danger btn-sm" onclick="return confirm('yakin ?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Question</th>
                                    <th>Images</th>
                                    <th>Choice 1</th>
                                    <th>Choice 2</th>
                                    <th>Choice 3</th>
                                    <th>Choice 4</th>
                                    <th>Choice 5</th>
                                    <th>Answer</th>
                                    <th>Action</th>
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