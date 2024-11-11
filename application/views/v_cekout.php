 <!-- Main content -->
 <div class="invoice p-3 mb-3">
     <!-- title row -->
     <div class="row">
         <div class="col-12">
             <h4>
                 <i class="fas fa-store"></i> TOKO ONLINE.
                 <small class="float-right">Date: <?= date('d-m-Y') ?></small>
             </h4>
         </div>
         <!-- /.col -->
     </div>
     <!-- info row -->

     <!-- /.row -->

     <!-- Table row -->
     <div class="row">
         <div class="col-12 table-responsive">
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th width="85px">Jumlah Barang</th>
                         <th style="text-align:center">Barang</th>
                         <th style="text-align:center">Harga</th>
                         <th style="text-align:center">Total Harga</th>
                         <th style="text-align:center">Berat</th>
                     </tr>
                 </thead>
                 <tbody>

                     <?php $i = 1; ?>

                     <?php 
                            $total_berat = 0;
                            foreach ($this->cart->contents() as $items) { 
                                $barang = $this->m_home->detail_barang($items['id']);
                                $berat = $items['qty'] * $barang->berat;
                                $total_berat = $total_berat + $berat
                            ?>

                     <tr>
                         <td style="text-align:center"><?php echo $items['qty']; ?></td>
                         <td style="text-align:center"><?php echo $items['name']; ?></td>
                         <td style="text-align:center">Rp. <?php echo number_format($items['price'], 0); ?>
                         </td>
                         <td style="text-align:center">Rp. <?php echo number_format($items['subtotal'], 0); ?>
                         </td>
                         <td style="text-align:center"><?= $berat ?>Gr</td>
                     </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
         <!-- /.col -->
     </div>
     <!-- /.row -->
     <?php
         echo validation_errors('<div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         ',' </div>');
          ?>
     <?php 
     echo form_open('belanja/cekout');
     $no_order = date('Ymd').strtoupper(random_string('alnum',8));
     ?>
     <div class="row">
         <!-- accepted payments column -->
         <div class="col-sm-8 invoice-col">
             Tujuan:
             <div class="row">
                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>Provinsi</label>
                         <select name="provinsi" class="form-control"> </select>
                     </div>
                 </div>

                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>Kota/Kabupaten</label>
                         <select name="kota" class="form-control"> </select>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>Ekspedisi</label>
                         <select name="ekspedisi" class="form-control"> </select>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>Paket</label>
                         <select name="paket" class="form-control"> </select>
                     </div>
                 </div>
                 <div class="col-sm-8">
                     <div class="form-group">
                         <label>Alamat Lengkap</label>
                         <input name="alamat" class="form-control" required>
                     </div>
                 </div>
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label>Kode POS</label>
                         <input name="kode_pos" class="form-control" required>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>Nama Penerima</label>
                         <input name="nama_penerima" class="form-control" required>
                     </div>
                 </div>
                 <div class="col-sm-6">
                     <div class="form-group">
                         <label>No Telpon</label>
                         <input name="no_telp" class="form-control" required>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
         </div>
         <!-- /.col -->
         <div class="col-4">

             <div class="table-responsive">
                 <table class="table">
                     <tr>
                         <th style="width:50%">Total Harga:</th>
                         <th>
                             Rp. <?php echo number_format($this->cart->total(), 0); ?>
                         </th>
                     </tr>
                     <tr>
                         <th>Total Berat:</th>
                         <th><?= $total_berat ?>Gr</th>
                     </tr>
                     <tr>
                         <th>Total Ongkos Kirim:</th>
                         <th><label id="ongkir"></label></th>
                     </tr>
                     <tr>
                         <th>Total Pembayaran:</th>
                         <th><label id="total_bayar"></label></th>
                     </tr>
                 </table>
             </div>
         </div>
         <!-- /.col -->
     </div>
     <!-- /.row -->

     <!-- simpan transaksi -->
     <input name="no_order" value="<?= $no_order ?>" hidden>
     <input name="estimasi" hidden>
     <input name="ongkir" hidden>
     <input name="berat" value="<?= $total_berat ?>" hidden><br>
     <input name="total_harga" value="<?= $this->cart->total() ?>" hidden>
     <input name="total_bayar" hidden>
     <!-- end simpan transaksi -->
     <!-- simpan rinci transaksi -->
     <?php 
     $i = 1;
     foreach ($this->cart->contents() as $items) {
       echo form_hidden('qty'.$i++,$items['qty']);
     }
     ?>
     <!-- end simpan rinci transaksi -->

     <div class=" row no-print">
         <div class="col-12">
             <a href="<?= base_url('belanja') ?>" class="btn btn-default">
                 Kembali Ke Keranjang</a>
             <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                 Payment
             </button>
         </div>
     </div>
     <?php echo form_close() ?>
 </div>
 <!-- /.invoice -->

 <script>
$(document).ready(function() {
    //provinsi
    $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/provinsi')?>",
        success: function(hasil_provinsi) {
            $("select[name=provinsi]").html(hasil_provinsi);
        }
    });

    //kota
    $("select[name=provinsi]").on("change", function() {
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/kota')?>",
            data: 'id_provinsi=' + id_provinsi_terpilih,
            success: function(hasil_kota) {
                $("select[name=kota]").html(hasil_kota);
            }
        });
    });

    $("select[name=kota]").on("change", function() {
        //ekspedisi
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/ekspedisi')?>",
            success: function(hasil_ekspedisi) {
                $("select[name=ekspedisi]").html(hasil_ekspedisi);
            }
        });
    });

    //paket
    $("select[name=ekspedisi]").on("change", function() {
        //mendapatkan ekspedisi terpilih
        var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
        //mendapatkan id kota tujuan
        var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr("id_kota");
        //mendapatkan data ongkos kirim
        var total_berat = <?= $total_berat ?>;
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/paket')?>",
            data: 'ekspedisi=' + ekspedisi_terpilih + '&id_kota=' +
                id_kota_tujuan_terpilih +
                '&berat=' + total_berat,
            success: function(hasil_paket) {
                $("select[name=paket]").html(hasil_paket);
            }
        });
    });

    //
    $("select[name=paket]").on("change", function() {
        //menampilkan ongkir
        var dataongkir = $("option:selected", this).attr("ongkir");
        var reverse = dataongkir.toString().split('').reverse().join(''),
            ribuan_ongkir = reverse.match(/\d{1,3}/g);
        ribuan_ongkir = ribuan_ongkir.join(',').split('').reverse().join('');

        $("#ongkir").html("Rp. " + ribuan_ongkir)
        //menampilkan total pembayaran
        var ongkir = $("option:selected", this).attr("ongkir");
        var data_total_bayar = parseInt(ongkir) + parseInt(<?= $this->cart->total() ?>);
        var reverse2 = data_total_bayar.toString().split('').reverse().join(''),
            ribuan_total = reverse2.match(/\d{1,3}/g);
        ribuan_total = ribuan_total.join(',').split('').reverse().join('');
        $("#total_bayar").html("Rp. " + ribuan_total);

        //estimasi dan ongkir
        var estimasi = $("option:selected", this).attr('estimasi');
        $("input[name=estimasi]").val(estimasi);
        $("input[name=ongkir]").val(dataongkir);
        $("input[name=total_bayar]").val(data_total_bayar);
    });



});
 </script>