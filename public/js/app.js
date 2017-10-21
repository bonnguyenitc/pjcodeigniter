 $(document).ready(function(){
    $('#name').on('blur', function() {
    	var name = $(this).val();
    	if (name.length > 50) {
    		$('#errname').html('Tên có độ dài không quá 50 ký tự');
    	}
    	if(name.length < 5){
    		$('#errname').html('Tên có độ dài lớn hơn 5 ký tự');
    	}
    });
    $('#username').on('blur', function() {
    	var name = $(this).val();
    	if (name.length > 50) {
    		$('#errname').html('Tên đăng nhập có độ dài không quá 50 ký tự');
    	}
    	if(name.length < 5){
    		$('#errname').html('Tên đăng nhập có độ dài lớn hơn 5 ký tự');
    	}
    });
    $('#address').on('blur', function() {
    	var add = $(this).val();
    	if (add.length > 50) {
    		$('#erradd').html('Địa chỉ có độ dài không quá 50 ký tự');
    	}
    	if(add.length < 5){
    		$('#erradd').html('Địa chỉ có độ dài lớn hơn 5 ký tự');
    	}
    });
    $('#phone').on('blur', function() {
    	var phone = $(this).val();
    	if (phone.length > 11 || phone.length < 10) {
    		$('#errphone').html('Số điện thoại có độ dài 10 - 11 ký tự');
    	}   	
    });
    $('#email').on('blur', function() {
    	var email = $(this).val();
    	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     
    	if (re.test(email) == false) {
    		$('#erremail').html('Định dạng email không hợp lệ');
    	}   	
    });
    $('#password').on('blur', function() {
    	var add = $(this).val();
    	if (add.length > 50) {
    		$('#errpass').html('Mật khẩu có độ dài không quá 50 ký tự');
    	}
    	if(add.length < 5){
    		$('#errpass').html('Mật khẩu có độ dài lớn hơn 5 ký tự');
    	}
    });
});
