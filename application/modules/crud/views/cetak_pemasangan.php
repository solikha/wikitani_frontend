
<div class="row">
    <div class="col-xs-12">
        <h1>Pemasangan Perangkat</h1>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-xs-6">
        <div class="row">
            <h6 class="col-xs-3">ID Pelanggan</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['cust_id'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Nama Pelanggan</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['nama_pelanggan'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Nomor Kontrak</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['nomor_kontrak'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Tanggal Kontrak</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['tanggal_kontrak'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Tanggal Pemasangan</h6><div class="col-lg-1">: *</div>
            <input class="col-xs-8" type="text" placeholder="dd/mm/yyyy"/>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Petugas Pemasangan</h6><div class="col-lg-1">: *</div>
            <input class="col-xs-8" type="text" value=""/>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="row">
            <h6 class="col-xs-3">Nama Lokasi</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['nama_lokasi'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Alamat</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['alamat'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">RT/RW</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['rt_rw'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Kelurahan</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['kelurahan'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Kecamatan</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['kecamatan'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Kota</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['kota'] ?></h6>
        </div>
        <div class="row">
            <h6 class="col-xs-3">Provinsi</h6><div class="col-lg-1">:</div>
            <h6 class="col-xs-8"><?php echo $jobsite['provinsi'] ?></h6>
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <div class="col-xs-6">
                <label>Nama Paket Layanan</label>
            </div>
            <div class="col-xs-6">
                <input class="form-control" type="text" disabled="" value="<?php echo $paket['nama'];?>"/>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <h6>Layanan Tambahan</h6>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-6">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Item</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($item != NULL) {
                    $coun = 1;
                    $count = 1;
                    for ($i = 0; $i < count($item); $i++) {
                        ?>
                        <tr data-index="<?php echo $coun++; ?>">
                            <td width="100px"><?php echo $count++; ?></td>
                            <td><?php echo $item[$i]['nama']; ?></td>
                            <td><?php echo $item[$i]['jumlah']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6 ">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Item</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($layanan != NULL) {
                    $coun = 1;
                    $count = 1;
                    for ($i = 0; $i < count($layanan); $i++) {
                        ?>
                        <tr data-index="<?php echo $coun++; ?>">
                            <td width="100px"><?php echo $count++; ?></td>
                            <td><?php echo $layanan[$i]['nama']; ?></td>
                            <td><?php echo $layanan[$i]['jumlah']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-xs-6">
        <h6>Zona Alamat</h6>
    </div>
    <div class="col-xs-6">
        <h6>CCTV</h6>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-xs-6">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Zona</td>
                    <td>Terminal ID</td>
                    <td>Hardware ID</td>
                </tr>
            </thead>
            <tbody>
                <?php
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
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6 ">
        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama CCTV</td>
                    <td>Terminal ID</td>
                    <td>Hardware ID</td>
                </tr>
            </thead>
            <tbody>
                <?php
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
                        </tr>
                        <?php
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
        <h6>Catatan Hasil Pemasangan</h6>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <textarea class="form-control" placeholder="diisi oleh petugas pemasangan"></textarea>
    </div>
</div>
