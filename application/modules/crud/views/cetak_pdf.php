<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/aceadmin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>themes/aceadmin/css/font-awesome.min.css" />
    </head>
    <body>
        <div class="row">
            <div class="col-xs-12">
                <h1>Pemasangan Perangkat</h1>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <h5><div class="col-xs-4">ID Pelanggan</div><div class="col-xs-6">: <?php echo $jobsite['cust_id']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Nama Pelanggan</div><div class="col-xs-6">: <?php echo $jobsite['nama_pelanggan']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Nomor Kontrak</div><div class="col-xs-6">: <?php echo $jobsite['nomor_kontrak']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Tanggal Kontrak</div><div class="col-xs-6">: <?php echo $jobsite['tanggal_kontrak']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Tanggal Pemasangan</div><div class="col-xs-6">: *</div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Petugas Pemasangan</div><div class="col-xs-6">: *</div></h5>
                </div>
            </div>
            <div class="col-xs-5">
                <div class="row">
                    <h5><div class="col-xs-4">Nama Lokasi</div><div class="col-xs-6">: <?php echo $jobsite['nama_lokasi']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Alamat</div><div class="col-xs-6">: <?php echo $jobsite['alamat']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">RT/RW</div><div class="col-xs-6">: <?php echo $jobsite['rt_rw']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Kelurahan</div><div class="col-xs-6">: <?php echo $jobsite['kelurahan']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Kecamatan</div><div class="col-xs-6">: <?php echo $jobsite['kecamatan']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Kota</div><div class="col-xs-6">: <?php echo $jobsite['kota']; ?></div></h5>
                </div>
                <div class="row">
                    <h5><div class="col-xs-4">Provinsi</div><div class="col-xs-6">: <?php echo $jobsite['provinsi']; ?></div></h5>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xs-5">
                <div class="form-group">
                    <div class="col-xs-5">
                        <label>Nama Paket Layanan</label>
                    </div>
                    <div class="col-xs-5">
                        <?php echo $paket['nama']; ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-5">
                <p>Layanan Tambahan</p>
            </div>
            <br/>
            <div class="col-xs-5">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Item</td>
                            <td>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody><?php
                        if ($item != NULL) {
                            $coun = 1;
                            $count = 1;
                            for ($i = 0; $i < count($item); $i++) {
                                ?>
                                <tr data-index="<?php echo $coun++; ?>">
                                    <td width="100px"><?php echo $count++; ?></td>
                                    <td><?php echo $item[$i]['nama']; ?></td>
                                    <td><?php echo $item[$i]['jumlah']; ?></td>
                                </tr><?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-5 ">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Item</td>
                            <td>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody><?php
                        if ($layanan != NULL) {
                            $coun = 1;
                            $count = 1;
                            for ($i = 0; $i < count($layanan); $i++) {
                                ?>
                                <tr data-index="<?php echo $coun++; ?>">
                                    <td width="100px"><?php echo $count++; ?></td>
                                    <td><?php echo $layanan[$i]['nama']; ?></td>
                                    <td><?php echo $layanan[$i]['jumlah']; ?></td>
                                </tr><?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xs-5">
                <p>Zona Alamat</p>
            </div>
            <div class="col-xs-5">
                <p>CCTV</p>
            </div>
            <br/>
            <div class="col-xs-5">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Zona</td>
                            <td>Terminal ID</td>
                            <td>Hardware ID</td>
                        </tr>
                    </thead>
                    <tbody><?php
                        if ($zona != NULL) {
                            $coun = 1;
                            $count = 1;
                            for ($i = 0; $i < count($zona); $i++) {
                                ?>
                                <tr data-index="<?php echo $coun++; ?>">
                                    <td width="100px"><?php echo $count++; ?></td>
                                    <td><?php echo $zona[$i]['nama']; ?></td>
                                    <td><?php echo $zona[$i]['terminal_id']; ?></td>
                                    <td><?php echo $zona[$i]['hardware_id']; ?></td>
                                </tr><?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-5 ">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama CCTV</td>
                            <td>Terminal ID</td>
                            <td>Hardware ID</td>
                        </tr>
                    </thead>
                    <tbody><?php
                        if ($cctv != NULL) {
                            $coun = 1;
                            $count = 1;
                            for ($i = 0; $i < count($cctv); $i++) {
                                ?>
                                <tr data-index="<?php echo $coun++; ?>">
                                    <td width="100px"><?php echo $count++; ?></td>
                                    <td><?php echo $cctv[$i]['nama']; ?></td>
                                    <td><?php echo $cctv[$i]['terminal_id']; ?></td>
                                    <td><?php echo $cctv[$i]['hardware_id']; ?></td>
                                </tr><?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-xs-12">
                <p>Catatan Hasil Pemasangan</p>
            </div>
            <div class="col-xs-12">
            </div>
        </div>
    </body>
</html>