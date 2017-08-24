<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/* Manggu Framework
* Simple PHP Application Development
* Kusnassriyanto S. Bahri
* kusnassriyanto@gmail.com
* 
*/
if (!isset($cancel_target)){
    $cancel_target = 'menu/persetujuan_perizinan';
}

?>
<form id="edit-form" action="
<?php echo $form_action;?>
" method="post">
  <?php echo $control_fields; ?>
  <!------ -->
  <input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
  
  <div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
      <div class="row" style="">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
          <h3 class="header lighter blue">
            Proses Perizinan PLB Banjir
            <small>
              Proses Oleh Staff
            </small>
          </h3>
          <h4>
            Data Pemohon :
          </h4>
          <div class="edit-group" style="">
            <label for="customername">
              Tanggal Permohonan
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            id="tanggal_permohonan" name="tanggal_permohonan" 
            style="" value="" disabled="disabled"/>
          </div>
          <div class="edit-group" style="">
            <label for="customername">
              Nama Lengkap
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="customername" id="customername"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="alamat_pemohon">
              Alamat
            </label>
            <textarea class="form-control crud-edit valid" id="alamat_pemohon" 
            name="alamat_pemohon" style="height: 94px" aria-invalid="false"  disabled="disabled">
            </textarea>
          </div>
          
          
          <div class="edit-group" style="">
            <label for="notelepon_pemohon">
              Nomor Telepon
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="notelepon_pemohon" id="notelepon_pemohon"
            style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)" disabled="disabled"/>
          </div>
          
        </div>
      </div>
      
      <div class="row" style="">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
          <h4>
            Data Perusahaan :
          </h4>
          
          <div class="edit-group" style="">
            <label for="nama_perusahaan">
              Nama Perusahaan
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="nama_perusahaan" id="nama_perusahaan"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="alamat">
              Alamat Perusahaan
            </label>
            <textarea class="form-control crud-edit valid" id="alamat_perusahaan" 
            name="alamat_perusahaan" style="height: 94px" aria-invalid="false" disabled="disabled" >
            </textarea>
          </div>
          
          
          <div class="edit-group" style="">
            <label for="notelepon_perusahaan">
              Nomor Telepon
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="notelepon_perusahaan" id="notelepon_perusahaan"
            style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)"/ disabled="disabled">
          </div>
        </div>
      </div>
      
      <div class="row" style="">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
          
          <h4>
            Lokasi yang dimintakan izin :
          </h4>
          
          <div class="edit-group" style="">
            <label for="jalan">
              Jalan / RT / RW
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="jalan" id="jalan"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="kelurahan">
              Kelurahan
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="kelurahan" id="kelurahan"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="kecamatan">
              Kecamatan
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="kecamatan" id="kecamatan"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="kota">
              Kota Administrasi
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="kota" id="kota"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="penggunaan">
              Penggunaan Bangunan
            </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
            name="penggunaan" id="penggunaan"
            style="" value="" disabled="disabled"/>
          </div>
          
          <div class="edit-group" style="">
            <label for="luas_tanah">
              Luas Tanah
            </label>
            <div class="input-group">
              <input type="text" class="form-control crud-edit" placeholder="" 
              name="luas_tanah" id="luas_tanah"
              style="" value="" disabled="disabled"/>
              <span class="input-group-addon">
                m
                <sup>
                  2
                </sup>
              </span>
            </div>
          </div>
          
		</div>
        
      </div>
    </div>
    </div>

    <!----jangan ditimpa------>
    <div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
      <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
            <div class="edit-group" style="">
                <label for="alamat">
                Catatan
                </label>
                <textarea class="form-control crud-edit valid" id="catatan_staf" 
                name="catatan_staf" style="height: 94px" aria-invalid="false" >
                </textarea>
            </div>
            <div class="edit-group" style="">
              
                <h4>
                    Kegiatan
                </h4>
              <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>
                      Kegiatan
                    </th>
                    <th>
                      Tanggal Mulai
                    </th>
                    <th class="hidden-480">
                      Tanggal selesai
                    </th>
                    <th>
                      Ketentuan
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!--tr>
                    <td>
                        Menghubungi Pemohon
                    </td>
                    <td>
                      01-12-2014
                    </td>
                    <td class="hidden-480">
                      01-12-2014
                    </td>
                    <td>
                      
                    </td>
                    <td width="120px">
                        <button class="rowactionbutton btn btn-minier btn-info" data-action="edit" data-modalwidth="960">
                            <i class="icon fa fa-edit"></i>
                        </button>
                        <button class="rowactionbutton btn btn-minier btn-danger" data-action="delete" data-modalwidth="960">
                            <i class="icon fa fa-trash-o"></i>
                        </button>
                    </td>
                  </tr-->
                  
                </tbody>
              </table>
              <h4 class="pink">
                
                <a href="#my-modal-form" role="button" class="blue" data-toggle="modal">
                  <button class="btn btn-default btn-sm">
                    Tambah
                  </button>
                </a>
                
              </h4>
            </div>
            <div id="my-modal-form" class="modal" tabindex="-1">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 class="blue bigger">
                    Formulir Kegiatan
                  </h4> 
                  <h4 class="modal-title">
                    Tanggal Mulai
                  </h4>
                  <div class="edit-group" style="">
						
						<div class="input-group">
							<input class="form-control date-picker" id="tanggal_mulai" name="tanggal_mulai" data-date-format="dd-mm-yyyy" type="text" >
							<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<script>
					OnReadyArray.push(function(){
							//datepicker plugin
							//link
							$('.date-picker').datepicker({
								autoclose: true,
								todayHighlight: true
							})
							//show datepicker when clicking on the icon
							.next().on(ace.click_event, function(){
								$(this).prev().focus();
							});
					});
					</script>   
                  <h4 class="modal-title">
                    Tanggal selesai
                  </h4>
				  <div class="edit-group" style="">
					
						<div class="input-group">
							<input class="form-control date-picker" id="tanggal_selesai" name="tanggal_selesai" data-date-format="dd-mm-yyyy" type="text" >
							<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<script>
					OnReadyArray.push(function(){
							//datepicker plugin
							//link
							$('.date-picker').datepicker({
								autoclose: true,
								todayHighlight: true
							})
							//show datepicker when clicking on the icon
							.next().on(ace.click_event, function(){
								$(this).prev().focus();
							});
					});
					</script>   
                  <div class="edit-group" style="">
                    <h4>
                      Keterangan
                    </h4>
                    <textarea class="form-control crud-edit valid" id="keterangan_kegiatan" 
                    name="keterangan_kegiatan" style="height: 94px" aria-invalid="false">
                    </textarea>
                  </div>
                  <div class="edit-group" style="">
                    
                  </div>
                  <div class="modal-footer">
                    <button data-bb-handler="cancel" type="button" class="btn btn-default">
                      Cancel
                    </button>
                    <button data-bb-handler="confirm" type="button" class="btn btn-primary">
                      OK
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--step2---->
            <script>
              OnReadyArray.push
                (
                  function()
                  {
                    $("#tambah_data_gridx").click(function() 
                                                  {
                                                    bootbox.dialog({
                                                      message: "<span class='bigger-110'>I am a custom dialog with smaller buttons</span>",
                                                      buttons: 			
                                                      {
                                                        "success" :
                                                        {
                                                          "label" : "<i class='ace-icon fa fa-check'></i> Success!",
                                                          "className" : "btn-sm btn-success",
                                                          "callback": function() 
                                                          {
                                                            //Example.show("great success");
                                                          }
                                                        }
                                                        ,
                                                        "danger" :
                                                        {
                                                          "label" : "Danger!",
                                                          "className" : "btn-sm btn-danger",
                                                          "callback": 
                                                          function() 
                                                          {
                                                            //Example.show("uh oh, look out!");
                                                          }
                                                        }
                                                        , 
                                                        "click" :
                                                        {
                                                          "label" : "Click ME!",
                                                          "className" : "btn-sm btn-primary",
                                                          "callback": function() 
                                                          {
                                                            //Example.show("Primary button");
                                                          }
                                                        }
                                                        , 
                                                        "button" :
                                                        {
                                                          "label" : "Just a button...",
                                                          "className" : "btn-sm"
                                                        }
                                                      }
                                                    }
                                                                  );
                                                  }
                                                 );
                  }
                );
            </script>
          </div>
        </div>
        
        <div class="row" style="">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
            <div class="checkbox" style="padding-top:0px; padding-left:0px">
              <label>
                <input name="data_ok" id="data_ok" type="checkbox" class="ace" />
                <span class="lbl">
                  Data sudah benar
                </span>
              </label>
            </div>
            
          </div>
          
        </div>
        
      </div>
    </div>
    
    <div class="row" style="">
      <div class="pull-left command-container" >
        <a href="<?php echo base_url().index_page().'/'.$cancel_target;?>" data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</a>
        <input type="submit" value="previous" name="action" class="btn btn-info btn-sm" style="margin-top:20px;"/>
        <input type="submit" value="Next" name="action" class="btn btn-info btn-sm" style="margin-top:20px;"/>
      </div>
      
    </div>
  </form>
  
  <script>
    function numbersonly(myfield, e, dec)
    {
      var key;
      var keychar;
      
      if (window.event)
        key = window.event.keyCode;
      else if (e)
        key = e.which;
      else
        return true;
      keychar = String.fromCharCode(key);
      
      // control keys
      if ((key==null) || (key==0) || (key==8) || 
          (key==9) || (key==13) || (key==27) )
        return true;
      
      // numbers
      else if ((("0123456789").indexOf(keychar) > -1))
        return true;
      
      // decimal point jump
      else if (dec && (keychar == "."))
      {
        myfield.form.elements[dec].focus();
        return false;
      }
      else
        return false;
    }
    
    //-->
  </script>
  
  