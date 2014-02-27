$(document).ready(function(){
	$('.datepicker').datepicker({
		format: "dd/mm/yyyy",
		language: "th",
    	autoclose: true
	});
	
	// seach friend
	$('#line-form select').change(function(){
		$('#line-form').submit();
	});
	
	// ฟอร์มเพิ่มไอดีไลน์
	$("#form_friend").validate({
	rules: 
	{
		line_id: 
		{ 
			required: true
		},
		name: 
		{ 
			required: true
		},
		age: 
		{
			required: true
		},
		sex_id:
		{
			required: true
		},
		province_id:
		{
			required: true
		},
		detail:
		{
			required: true
		},
		captcha:
		{
			required: true,
			remote: "users/check_captcha"
		}
	},
	messages:
	{
		line_id: 
		{ 
			required: "กรุณากรอกไอดีไลน์"
		},
		name: 
		{ 
			required: "กรุณากรอกชื่อเล่น"
		},
		age: 
		{
			required: "กรุณากรอกอายุ"
		},
		sex_id: 
		{
			required: "กรุณาระบุเพศ"
		},
		province_id:
		{
			required: "กรุณากรอกจังหวัด"
		},
		detail:
		{
			required: "กรุณากรอกตัวข้อมูลแนะนำตัว"
		},
		captcha:
		{
			required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพ",
			remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพ"
		}
	}
	});
	
	//ฟอร์มสมัครสมาชิก
	$("#regisform").validate({
	rules: 
	{
		email: 
		{ 
			required: true,
			email: true,
			remote: "users/check_email"
		},
		password: 
		{ 
			required: true,
			minlength: 4
		},
		_password: 
		{
			equalTo: "#password"
		},
		captcha:
		{
			required: true,
			remote: "users/check_captcha"
		}
	},
	messages:
	{
		email: 
		{ 
			required: "กรุณากรอกอีเมล์",
			email: "กรุณากรอกอีเมล์ให้ถูกต้อง",
			remote: "อีเมล์นี้ไม่สามารถใช้งานได้"
		},
		password: 
		{ 
			required: "กรุณากรอกรหัสผ่าน",
			minlength: "กรุณากรอกรหัสผ่านอย่างน้อย 4 ตัวอักษร"
		},
		_password: 
		{
			equalTo: "กรุณากรอกรหัสผ่านให้ตรงกันทั้ง 2 ช่อง"
		},
		captcha:
		{
			required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพ",
			remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพ"
		}
	}
	});
	
	//ฟอร์มย้อมูลส่วนตัว profile
	$("#profile").validate({
	rules: 
	{
		captcha:
		{
			required: true,
			remote: "users/check_captcha"
		}
	},
	messages:
	{
		captcha:
		{
			required: "กรุณากรอกตัวอักษรตัวที่เห็นในภาพ",
			remote: "กรุณากรอกตัวอักษรให้ตรงกับภาพ"
		}
	}
	});
	
	$(window).scroll(function() {
    if($(this).scrollTop() != 0) {
            $('#footer-back-to-top').removeClass('offscreen');
        } else {
            $('#footer-back-to-top').addClass('offscreen');
        }
    });
    
    $('#footer-back-to-top').click(function() {
        $('body,html').animate({scrollTop:0},800);
    }); 
});
