function check_login()
{
    var rule1 = /^\d+$/;
    if(reg.email.value == "") 
    {
        alert("You forget to fill account!");
    }
    else if(reg.password.value == "")
    {
        alert("You forget to fill password!");
    }
    else if(reg.input_v_num.value == "")
    {
        alert("You forget to fill verification code!");
    }
    else if( !rule1.test(reg.input_v_num.value) )
    {
        alert("You are not filling in arabic numbers for verification code!");
    }
    else if (reg.input_v_num.value.length != 4)
    {
        alert("The verification code is four digits!");
    }
    else reg.submit();
}

function check_create_account() {
    var rule = /^\w+$/;
    var rule2 = /^\w+(\d)+$/;
    var rule3 = /^[A-Za-z]+[0-9]+((\d+)|(\w+))+$/;
    var rule1 = /^\d+$/;
    if(reg.A_name.value == "") 
    {
        alert("You forget to type account!");
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

function check_create_product() {
    var rule = /^\w+$/;
    var rule2 = /^\w+(\d)+$/;
    var rule3 = /^[A-Za-z]+[0-9]+((\d+)|(\w+))+$/;
    var rule1 = /^\d+$/;
    if(reg.P_name.value == "") 
    {
        alert("You forget to type product name!");
    }
    else if(reg.P_name.value.length > 127)
    {
        alert("The product name is too long to submit!");
    }
    else if(reg.P_description.value == "")
    {
        alert("You forget to type product description!");
    }
    else if(reg.P_description.value.length > 1249)
    {
        alert("The product description is too long to submit!");
    }
    else if(reg.P_amount.value == "")
    {
        alert("You forget to type the quantity of product!");
    }
    else if( !rule1.test(reg.P_amount.value) )
    {
        alert("The quantity of product that you typed is not arabic numbers!");
    }
    else if(reg.P_amount.value <= 0)
    {
        alert("The quantity of product cannot be filled as 0 or less than 0.");
    }
    else if(reg.P_in_price.value == "")
    {
        alert("You forget to type the cost of product!");
    }
    else if( !rule1.test(reg.P_in_price.value) )
    {
        alert("The cost of product that you typed is incorrect!");
    }
    else if(reg.P_in_price.value <= 0 )
    {
        alert("The cost of product cannot be filled as 0 or less than 0!");
    }
    else if(reg.P_out_price.value == "")
    {
        alert("You forget to type the price of product!");
    }
    else if( !rule1.test(reg.P_out_price.value) )
    {
        alert("The format of price is incorrect!");
    }
    else if(reg.P_out_price.value <= 0)
    {
        alert("The price of product cannot be filled as 0 or less than 0!");
    }
    // reg.P_out_price.value is string, you have to convert it as number.
    else if( Number(reg.P_out_price.value) < Number(reg.P_in_price.value) )
    {
        alert("The price is less than cost!");
    }
    else if(reg.P_comment.value.length > 1249)
    {
        alert("The comment is too long to submit!");
    }
    else reg.submit();
}

function check_update_pro_info()
{
    var rule1 = /^\d+$/;
    if (reg.ticket.value == "")
    {
        alert("You forget to type Ticket number!!");
    }
    else if( !rule1.test(reg.ticket.value) )
    {
        alert("The format of Ticket number is incorrect!");
    }
    else if (reg.ticket.value == 0)
    {
        alert("The Ticket number that you typed is 0, please confirm it again!");
    }
    else reg.submit();
}

function check_update_pro_info_action()
{
    var rule = /^\w+$/;
    var rule2 = /^\w+(\d)+$/;
    var rule3 = /^[A-Za-z]+[0-9]+((\d+)|(\w+))+$/;
    var rule1 = /^\d+$/;
    if (reg.P_name.value == "")
    {
        alert("You forget to type product name!");
    }
    else if(reg.P_name.value.length > 127)
    {
        alert("The product name is too long to submit!");
    }
    else if(reg.P_description.value == "")
    {
        alert("You forget to type product description!");
    }
    else if(reg.P_description.value.length > 1249)
    {
        alert("The product description is too long to submit!");
    }
    else if(reg.P_amount.value == "")
    {
        alert("You forget to type the quantity of product!");
    }
    else if( !rule1.test(reg.P_amount.value) )
    {
        alert("The quantity of product that you typed is not arabic numbers!");
    }
    else if(reg.P_amount.value <= 0)
    {
        alert("The quantity of product cannot be filled as 0 or less than 0!");
    }
    else if(reg.P_in_price.value == "")
    {
        alert("You forget to type the cost of product!");
    }
    else if( !rule1.test(reg.P_in_price.value) )
    {
        alert("The cost of product that you typed is incorrect!");
    }
    else if(reg.P_in_price.value <= 0 )
    {
        alert("The cost of product cannot be filled as 0 or less than 0!");
    }
    else if(reg.P_out_price.value == "")
    {
        alert("You forget to type the price of product!");
    }
    else if( !rule1.test(reg.P_out_price.value) )
    {
        alert("The format of price is incorrect!");
    }
    else if(reg.P_out_price.value <= 0)
    {
        alert("The price of product cannot be filled as 0 or less than 0!");
    }
    // reg.P_out_price.value is string, you have to convert it as number.
    else if( Number(reg.P_out_price.value) < Number(reg.P_in_price.value) )
    {
        alert("The price is less than cost!");
    }
    else if(reg.P_comment.value.length > 1249)
    {
        alert("The comment is too long to submit!");
    }
    else reg.submit();
}

function check_handle_order()
{
    var rule1 = /^\d+$/;
    if (reg.P_amount.value == "")
    {
        alert("You forget to type quantity that expect to order!");
    }
    else if( !rule1.test(reg.P_amount.value) )
    {
        alert("The format of quantity of product is incorrect!");
    }
    else if(reg.P_amount.value <= 0)
    {
        alert("The quantity of product cannot be filled as 0 or less than 0!");
    }
    else if (reg.P_total_price.value == "")
    {
        alert("You forget to type the expectation total price!");
    }
    else if( !rule1.test(reg.P_total_price.value) )
    {
        alert("The format of expectation total price is incorrect!");
    }
    else if (reg.P_total_price.value <= 0)
    {
        alert("The expectation total price cannot be filled as 0 or less than 0!");
    }
    else if(reg.P_comment.value.length > 1249)
    {
        alert("The comment is too long to submit!");
    }
    else if(reg.status.value == "")
    {
        alert("You forget to select the status of your order!");
    }
    else reg.submit();
}

function check_product_order()
{
    var rule1 = /^\d+$/;
    if (reg.P_amount.value == "")
    {
        alert("You forget to type the quantity of product!!");
    }
    else if( !rule1.test(reg.P_amount.value) )
    {
        alert("The format of quantity of product is incorrect!");
    }
    else if(reg.P_amount.value <= 0)
    {
        alert("The quantity of product cannot be filled as 0 or less than 0!");
    }
    else if(reg.P_comment.value.length > 1249)
    {
        alert("The comment is too long to submit!");
    }
    else reg.submit();
}