$(function() {
    
        var ProductString;
    
        $('#product-check').click(function () {
            ProductString = $('.form-control').val();
    
            $.ajax({
                url: '/check_product.php', // Send to this page to handle
                type: 'GET', // Similar to method='GET', you can use 'POST'.
                dataType: 'html', // Data send back format
                data: {
                    Product: ProductString
                },
            })
            .done(function (data) {
                console.log(data);
                
                if (data == 'valid') {
                    //$('#product-check').removeClass().addClass('btn btn-success').text('產品沒重複');
                    $('#product-check').text('The product can be created');
                } else if (data == 'ServerFail') {
                    //$('#product-check').removeClass().addClass('btn btn-danger').text('伺服器連不上');
                    $('#product-check').text('Cannot Connect to Server');
                } else if (data == 'Empty') {
                    //$('#product-check').removeClass().addClass('btn btn-danger').text('沒填產品');
                    $('#product-check').text('Forget to type product name');
                } else {
                    //$('#product-check').removeClass().addClass('btn btn-danger').text('產品重複');
                    $('#product-check').text('The product already exists, please confirm Ticket: '+data);
                }
            })
            .fail(function (data) {
                console.log("error");
            });
            
        });
    });

    function check_create_product() {
        var rule = /^\w+$/;
        var rule2 = /^\w+(\d)+$/;
        var rule3 = /^[A-Za-z]+[0-9]+((\d+)|(\w+))+$/;
        var rule1 = /^\d+$/;
        var ButtonText = $("#product-check").text();

        if(reg.P_name.value == "") 
        {
            alert("You forget to type product name!");
        }
        else if ( ButtonText != "The product can be created" ) 
        {
            alert("Current status is "+ ButtonText);    
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