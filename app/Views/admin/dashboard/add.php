<?= $this->extend('layouts/master_admin'); ?>

<?= $this->section('isi'); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="col-lg-6 center">
                        <?= form_open_multipart('admin/soal/add') ?>
                        <?= csrf_field() ?>
                        <!-- <form role="form" action="" method="POST"> -->
                        <div class="card-body">
                            <!-- <div class="form-group">
                                        <input type="number" class="form-control col-2" name="no" placeholder="No">
                                    </div> -->
                            <?php

                            ?>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control <?= ($validation->hasError('question')) ? "is-invalid" : "" ?>" rows="3" name="question" placeholder="Pertanyaan"><?= set_value('question', '', true); ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= ($validation->hasError('choice_1')) ? "is-invalid" : "" ?>" name="choice_1" value="<?= set_value('choice_1', '', true); ?>" placeholder="Pilihan 1">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= ($validation->hasError('choice_2')) ? "is-invalid" : "" ?>" name="choice_2" value="<?= set_value('choice_2', '', true); ?>" placeholder="Pilihan 2">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= ($validation->hasError('choice_3')) ? "is-invalid" : "" ?>" name="choice_3" value="<?= set_value('choice_4', '', true); ?>" placeholder="Pilihan 3">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= ($validation->hasError('choice_4')) ? "is-invalid" : "" ?>" name="choice_4" value="<?= set_value('choice_5', '', true); ?>" placeholder="Pilihan 4">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= ($validation->hasError('choice_5')) ? "is-invalid" : "" ?>" name="choice_5" value="<?= set_value('choice_6', '', true); ?>" placeholder="Pilihan 5">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control <?= ($validation->hasError('answer')) ? "is-invalid" : "" ?>" rows="3" name="answer" value="<?= set_value('answer', '', true); ?>" placeholder="Kode Jawaban"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- </form> -->
                        <?= form_close(); ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
</div>

<?= $this->endSection(); ?>