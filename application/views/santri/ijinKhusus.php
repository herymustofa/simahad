<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <?php

    ?>
    <form autocomplete="off" method="post" action="<?= base_url('santri/inputIjinKhusus') ?>">
        <div class=" form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm">Nim</label>
            <div class="col-sm-5">
                <input type="email" class="form-control form-control-sm" id="inputEmail3" value="<?= $user['nim'] ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control form-control-sm" id="inputEmail3" value="<?= $user['name']  ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="keperluan" class="col-sm-2 col-form-label col-form-label-sm">Keperluan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-sm" id="keperluan" name="keperluan" value="<?= set_value('keperluan'); ?>">
                <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="hp" class="col-sm-2 col-form-label col-form-label-sm">No. HP</label>
            <div class="col-sm-5">
                <input type="text" class="form-control form-control-sm" id="hp" name="hp" value="<?= set_value('hp'); ?>">
                <?= form_error('hp', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="hp" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Kembali</label>
            <div class="col-sm-3">            
                <div class="input-group date">
                    <input type="text" class="form-control form-control-sm"  id="p_pulang" name="p_pulang" value="<?= set_value('p_pulang'); ?>"></<input>
                </div>        
                <?= form_error('p_pulang', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

</div>
</div>
<!--End Begin Page Content -->