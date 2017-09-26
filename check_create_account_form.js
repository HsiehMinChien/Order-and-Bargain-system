$(function() {

	var emailString;

	$('#email-check').click(function () {
		emailString = $('.form-control').val();

		$.ajax({
			url: '/check_account.php', // Send to this page to handle
			type: 'GET', // Similar to method='GET', you can use 'POST'.
			dataType: 'html', // Data send back format
			data: {
				email: emailString
			},
		})
		.done(function (data) {
			console.log(data);
			
			if (data == 'valid') {
                //$('#email-check').removeClass().addClass('btn btn-success').text('The account can be created');
                $('#email-check').text('The account can be created');
			} else if (data == 'invalid') {
                //$('#email-check').removeClass().addClass('btn btn-danger').text('The account already exists');
                $('#email-check').text('The account already exists');
			} else if (data == 'ServerFail') {
                //$('#email-check').removeClass().addClass('btn btn-danger').text('ServerFail');
                $('#email-check').text('Cannot Connect to Server');
            } else if (data == 'Empty') {
                //$('#email-check').removeClass().addClass('btn btn-danger').text('Forget to type account');
                $('#email-check').text('Forget to type account');
            }
		})
		.fail(function (data) {
			console.log("error");
		});
		
	});
});

function check_create_account() {
    var rule = /^\w+$/;
    var rule2 = /^\w+(\d)+$/;
    var rule3 = /^[A-Za-z]+[0-9]+((\d+)|(\w+))+$/;
    var rule1 = /^\d+$/;
    var ButtonText = $("#email-check").text();
    if(reg.A_name.value == "") 
    {
        alert("You forget to type account!");
    }
    else if ( ButtonText == "Check This Account" || ButtonText == "Forget to type account" || ButtonText == "The account already exists" || ButtonText == "Cannot Connect to Server" ) 
    {
        alert("Current status is "+ ButtonText);    
	}
    else if(reg.A_password.value == "")
    {
        alert("You forget to type password!");
    }
    else if(reg.A_password_confirm.value == "")
    {
        alert("You forget to type the confirm password!");
    }
    else if(reg.A_password_confirm.value != reg.A_password.value)
    {
        alert("The password and confirm password are different!");
    }
    else if(reg.A_password.value == reg.A_name.value)
    {
        alert("The accout is the same as password, please modify it.");
    }
    else if( !rule3.test(reg.A_password.value) )
    {
        alert("This password doesn't match password rule!");
    }
    else if(reg.A_password.value.length < 6)
    {
        alert("At least mix six digits of arabic numbers and letter to set your password!");
    }
    else if(reg.identity.value == "")
    {
        alert("You forget to select your identity!");
    }
    else if(reg.input_v_num.value == "")
    {
        alert("You forget to fill verification code!");
    }
    else if( !rule1.test(reg.input_v_num.value) )
    {
        alert("You are not typing in arabic numbers for verification code!");
    }
    else if (reg.input_v_num.value.length != 4)
    {
        alert("The verification code is four digits!");
    }
    else reg.submit();
}