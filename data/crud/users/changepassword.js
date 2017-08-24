// testing
    $('#crudexecute').click(function(){
        console.log(this);
		npwd = $('#newpassword').val();
		cpwd = $('#confirmpassword').val();
		if (npwd!==cpwd){
			msg = 'Password baru dan Konfirmasi Password tidak sama.';
			alert(msg);
			throw msg;
		}
		//alert(username);
        //inputid = $(this).attr('data-inputid');
        //Manggu.Crud.checkBoxAll(inputid, 'all');
		//newpass
		//throw "Test percobaan Error";
    });
