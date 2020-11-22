var save_method; //for save method string
var table;

$(document).ready(function() {     
    

});

function clickSignUP(){
    $('#registrationForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-success'); // clear error class
    $('.form-group').removeClass('has-danger');
    $('.help-block').empty(); // clear error string
    $('#signUpModal').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Create Header'); // Set Title to Bootstrap modal title
}

function clickLogin(){
    $('#loginForm')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-success');
    $('.form-group').removeClass('has-danger'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#loginModal').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Create Header'); // Set Title to Bootstrap modal title
}

function edit_header(id)
{
    save_method = 'update';
    $('#form_header')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : "header/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.headerid);
            $('[name="headername"]').val(data.headername);
            $('[name="headervalue"]').val(data.headervalue);
            
           
            $('#headerModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function loginUserTest()
{
    
    // ajax adding data to database
    var formData = new FormData($('#loginForm')[0]);
    $.ajax({
        url : 'login/loginUser',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                //$('#signUpModal').modal('hide');
                location.reload(true);                
            }
            else
            {
               
                $.toast({
                    heading: 'Kindly check your errors!!!',
                    text: data.errors,
                    icon: 'error',
                    hideAfter: false,
                    showHideTransition: 'fade',
                    position: 'top-right'
                })
            }   

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function signUpNow()
{
    
    // ajax adding data to database
    var formData = new FormData($('#registrationForm')[0]);
    $.ajax({
        url : 'login/signUp',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                //$('#signUpModal').modal('hide');
                location.reload(true);                
            }
            else
            {
               
                $.toast({
                    heading: 'Kindly check your errors!!!',
                    text: data.errors,
                    icon: 'error',
                    hideAfter: false,
                    showHideTransition: 'fade',
                    position: 'top-right'
                })
            }   

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_header(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "header/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#headerModal').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function bulk_delete()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "header/ajax_bulk_delete",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reload_table();
                    }
                    else
                    {
                        alert('Failed.');
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
