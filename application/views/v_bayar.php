<div class="row">
    <div class="col-sm-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Rekening Toko</h3>
            </div>
            <div class="card-body">


                <b>Silahkan Transfer Ke Rekening Di Bawah Sebesar: <h1 class="text-primary">Rp.
                        <?= number_format($pesanan->total_bayar,0) ?>.-</h1>
                </b><br>

                <table class="table">
                    <tr>
                        <th>Bank</th>
                        <th>Rekening</th>
                        <th>Atas Nama</th>
                    </tr>

                    <?php foreach ($rekening as $key => $value) { ?>
                    <tr>
                        <td><?= $value->nama_bank ?></td>
                        <td><?= $value->no_rek ?></td>
                        <td><?= $value->atas_nama ?></td>
                    </tr>
                    <?php } ?>

                </table>


            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php 
            echo form_open_multipart('pesanan_saya/bayar/'. $pesanan->id_transaksi);
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Rekening</label>
                    <input name="atas_nama" class="form-control" placeholder="Nama Rekening" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Bank</label>
                    <input name="nama_bank" class="form-control" placeholder="Nama Bank" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Rekening</label>
                    <input name="no_rek" class="form-control" placeholder="No Rekening" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Bukti Transfer</label>
                    <input type="file" name="bukti_bayar" class="form-control" required>

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <?php 
            echo form_close()
            ?>
        </div>
        <!-- /.card -->
    </div>
</div>