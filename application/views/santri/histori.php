<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add Role Menu</a> -->
            <div class="table-responsive-sm">
                <table class="table table-hover table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Keperluan</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Waktu Keluar</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Batas Ijin</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <caption>
                        Keterangan : [IK] Ijin Keluar [IP] Ijin Pulang 
                    </caption>
                        <?php foreach ($ijin as $r) : ?>
                            <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td><?= $r['id']?></td>
                                <td><?= $r['jenis']?></td>
                                <td><?= $r['keperluan'] ?></td>
                                <td><?= $r['no_hp'] ?></td>
                                <td><?= date('d F Y h:i:sa', $r['jam_keluar']) ?></td>
                                <td>
                                    <?php 
                                        if ($r['jam_masuk']!= 0)  echo date('d F Y h:i:sa', $r['jam_masuk']);
                                            else echo "0" 
                                    ?>
                                
                                </td>
                                <td>
                                    <?php 
                                        if ($r['p_jam_masuk']!= 0)  echo date('d F Y', $r['p_jam_masuk']);
                                            else echo "IK" 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    if ($r['jam_masuk'] == 0) {
                                        ?>
                                        <a href="<?= base_url('santri/pulang/') . $r['id'] ?>" class="btn btn-warning btn-sm">Pulang</a>
                                    <?php
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </td>                            

                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>