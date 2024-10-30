<div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-sm-12">
                <?php echo form_open('belanja/update'); ?>

                <table class="table table-striped" cellpadding="6" cellspacing="1" style="width:100%">
                    <thead>
                        <tr>
                            <th width="85px">Jumlah Barang</th>
                            <th style="text-align:center">Barang</th>
                            <th style="text-align:center">Harga</th>
                            <th style="text-align:center">Sub-Total</th>
                            <th style="text-align:center">Berat</th>
                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>

                    <?php 
                    $total_berat = 0;
                    foreach ($this->cart->contents() as $items) { 
                          $barang = $this->m_home->detail_barang($items['id']);
                          $berat = $items['qty'] * $barang->berat;
                          $total_berat = $total_berat + $berat
                    ?>

                    <tr>
                        <td>
                            <?php
                                echo form_input(array(
                                    'name' => $i.'[qty]',
                                    'value' => $items['qty'],
                                    'maxlength' => '3',
                                    'min' => '0',
                                    'size' => '5',
                                    'type'=>'number',
                                    'class'=>'form-control'
                                ));
                            ?>
                        </td>
                        <td style="text-align:center"><?php echo $items['name']; ?></td>
                        <td style="text-align:center">Rp. <?php echo number_format($items['price'], 0); ?>
                        </td>
                        <td style="text-align:center">Rp. <?php echo number_format($items['subtotal'], 0); ?>
                        </td>
                        <td style="text-align:center"><?= $berat ?>Gr</td>
                        <td style=" text-align:center">
                            <a href="<?= base_url('belanja/delete/'. $items['rowid']) ?>" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php $i++; ?>

                    <?php } ?>

                    <tr>
                        <td class="right">
                            <h3>Total: </h3>
                        </td>
                        <td class="right">
                            <h3>Rp.
                                <?php echo number_format($this->cart->total(), 0); ?></h3>
                        </td>
                        <th>Total Berat : <?= $total_berat ?>Gr</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>

                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"> </i> Update
                    Keranjang</button>
                <a href="<?= base_url('belanja/clear') ?>" class="btn btn-warning btn-flat"><i
                        class="fa fa-recycle "></i>
                    Clear
                    Cart</a>
                <a href="<?= base_url('belanja/cekout') ?>" class="btn btn-success btn-flat float-right"><i
                        class="fa fa-wallet "></i>
                    Check
                    Out</a>

                <?php echo form_close(); ?>
                <br>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>