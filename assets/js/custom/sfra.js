sfra = {

	clickAddCourse: function(){
		$('#addCourseForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#coursestatus').show();
    	$('#courseModalAdd').modal('show'); // show bootstrap modal
    	$('.title').text('Add Course'); // Set title to Bootstrap modal title
	},
	clickEditCourse: function(id){
		$('#addCourseForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#coursestatus').hide();
    	

    	$.ajax({
	        url : "edit/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id"]').val(data.courseid);	            
	            $('[name="coursecode"]').val(data.coursecode);
	            $('[name="coursename"]').val(data.coursename);
	            $('[name="courseclass"]').val(data.courseclass);
	            $('[name="coursedesc"]').val(data.coursedescription);	
	            $('[name="coursestarted"]').val(data.coursestarted);
	            $('[name="regstart"]').val(data.regstart);
	            $('[name="regend"]').val(data.regend);
	            $('[name="army"]').val(data.armyquota);
	            $('[name="navy"]').val(data.navyquota);
	            $('[name="airforce"]').val(data.airforcequota);
	            $('[name="police"]').val(data.policequota);
	            $('[name="sfra"]').val(data.sfraunitquota);
	            $('[name="totalquota"]').val(data.totalquota);	                                
	           
	            $('#courseModalAdd').modal('show'); // show bootstrap modal when complete loaded
	            $('#btnAddCourse').text('Update'); // Set title to Bootstrap modal title
	            $('#btnAddCourse').attr('name','btnUpdateCourse');
	            $('.title').text('Edit Course'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	},
	clickDeleteRecord: function(id){

		
		$.ajax({
	        url : "delete/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	        	
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
		
	},
	clickEnabledDisabled: function(id, cb){

		if (cb.checked) {
        	$.ajax({
		        url : "enabled/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {

		        	
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
	    } else {
	        $.ajax({
		        url : "disabled/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {

		        	
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
	    }

		
		
	},
	clickActiveDeactiveUser: function(id, cb){

		if (cb.checked) {
        	$.ajax({
		        url : "user/activated/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {

		        	
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
	    } else {
	        $.ajax({
		        url : "user/deactivated/" + id,
		        type: "GET",
		        dataType: "JSON",
		        success: function(data)
		        {

		        	
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
	    }

		
		
	},
	formSubmitValidation: function(id,modal){
		$(id).validate({
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
	            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
	        },
	        success: function(element) {
	            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
	            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
	        },
	        errorPlacement : function(error, element) {
	            $(element).append(error);
	        },
	        submitHandler: function(form) {
	            $.ajax({
	                url : form.action,//'login/loginUser',
	                type: form.method,//"POST",
	                data:  $(form).serialize(),                
	                dataType: "JSON",
	                success: function(data)
	                {

	                    if(data.status) //if success close modal and reload ajax table
	                    {                       
	                      $('#'+modal).modal('hide');

	                      $('#'+modal).on('hidden.bs.modal', function () {                         
	                          location.reload(true);                          
	                      });            
	                    }
	                    else
	                    {
	                       
	                        $.toast({
	                            heading: 'Kindly check your errors!!!',
	                            text: data.errors,
	                            icon: 'error',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }   

	                },
	                error: function (jqXHR, textStatus, errorThrown,a,b,c)
	                {
	                    //alert(textStatus);
	                    if(jqXHR.responseText.indexOf('Duplicate')){
	                    	$.toast({
	                           	
	                            text: 'Record already exists!!',
	                            icon: textStatus,                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }else{
	                    	$.toast({	                           	
	                            text: errorThrown,
	                            icon: textStatus,                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }
	                }
	            });
	        }
	    });
	},
	formSubmitValidationNonModal: function(id){
		$(id).validate({
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
	            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
	        },
	        success: function(element) {
	            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
	            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
	        },
	        errorPlacement : function(error, element) {
	            $(element).append(error);
	        },
	        submitHandler: function(form) {
	            $.ajax({
	                url : form.action,//'login/loginUser',
	                type: form.method,//"POST",
	                data:  $(form).serialize(),                
	                dataType: "JSON",
	                success: function(data)
	                {

	                    if(data.status) //if success close modal and reload ajax table
	                    {                       
	                        $.toast({
	                            heading: 'Successfull',
	                            text: 'Records has been updated!!!',
	                            icon: 'success',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });

	                        sfra.userProfileReset();        
	                    }
	                    else
	                    {
	                       
	                        $.toast({
	                            heading: 'Kindly check your errors!!!',
	                            text: data.errors,
	                            icon: 'error',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }   

	                },
	                error: function (jqXHR, textStatus, errorThrown)
	                {
	                    alert('Error adding / update data');
	                }
	            });
	        }
	    });
	},
	formSubmitValidationNoRedirect: function(id,modal){
		$(id).validate({
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
	            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
	        },
	        success: function(element) {
	            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
	            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
	        },
	        errorPlacement : function(error, element) {
	            $(element).append(error);
	        },
	        submitHandler: function(form,event) {
	        	event.preventDefault();
	            $.ajax({
	                url : form.action,//'user/change_password',//'login/loginUser',
	                type: form.method,//"POST",
	                data:  $(form).serialize(),                
	                dataType: "JSON",
	                success: function(data)
	                {

	                    if(data.status) //if success close modal and reload ajax table
	                    {   
	                    	if(modal){                    
	                      		$('#'+modal).modal('hide');
	                      	}
	                     	$.toast({
	                            heading: 'Successfull!!!',
	                            text: data.message,
	                            icon: 'success',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                    	});          
	                    }
	                    else
	                    {
	                       
	                        $.toast({
	                            heading: 'Kindly check your errors!!!',
	                            text: data.errors,
	                            icon: 'error',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }   

	                },
	                error: function (jqXHR, textStatus, errorThrown)
	                {
	                    alert('Error adding / update data');
	                }
	            });

	            return false;
	        }
	    });
	},
	formSubmitValidationNoRedirectWithDOMUpdate: function(id,modal){
		$(id).validate({
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
	            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
	        },
	        success: function(element) {
	            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
	            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
	        },
	        errorPlacement : function(error, element) {
	            $(element).append(error);
	        },
	        submitHandler: function(form,event) {
	        	event.preventDefault();
	            $.ajax({
	                url : form.action,//'user/change_password',//'login/loginUser',
	                type: form.method,//"POST",
	                data:  $(form).serialize(),                
	                dataType: "JSON",
	                success: function(data)
	                {
	                	
	                    if(data.status) //if success close modal and reload ajax table
	                    {                       
	                      	$('#'+modal).modal('hide');
	                      	if(data.elementInput){
	                      		var el = data.elementInput[0];
	                			var val = data.elementInput[1]
	                			$('#'+el).text(val)
	                      	}
	                      	
	                     	$.toast({
	                            heading: 'Successfull!!!',
	                            text: data.message,
	                            icon: 'success',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                    	});          
	                    }
	                    else
	                    {
	                       
	                        $.toast({
	                            heading: 'Kindly check your errors!!!',
	                            text: data.errors,
	                            icon: 'error',                            
	                            stack: false,
	                            showHideTransition: 'fade',
	                            position: 'top-right'
	                        });
	                    }   

	                },
	                error: function (jqXHR, textStatus, errorThrown)
	                {
	                    alert('Error adding / update data');
	                }
	            });

	            return false;
	        }
	    });
	},
	clickEditUserProfile: function(){
		$("#editUserProfile").click(function(event){
		   $('form#userprofileForm .form-control').removeAttr('disabled'); // Element(s) are now end.
		   $("#suffix").removeAttr('disabled');
		   $("#bloodtype").prop("disabled", false);
		   $("#username").prop("disabled", true);
		   $("#btnUpdateProfile").show();
		   $("#btnCancelUpdateProfile").show();
		});

	},
	userProfileEditable: function(){
		//$("#editUserProfile").click(function(event){
		   $('form#userprofileForm .form-control').prop("disabled", false); // Element(s) are now end.
		   $("#btnUpdateProfile").show();
		   $("#btnCancelUpdateProfile").show();
		//});

	},
	userProfileReset: function(){
		//$("#editUserProfile").ready(function(event){
		   $('form#userprofileForm .form-control').prop("disabled", true); // Element(s) are now end.
		   $("#btnUpdateProfile").hide();
		   $("#btnCancelUpdateProfile").hide();
		//});

	},
	clickCancelUpdateProfile: function(){
		$("#btnCancelUpdateProfile").click(function(event){
		   sfra.userProfileReset();
		});

	},
	clickEnrollCourse: function(id){
		//$("#enrollCourse"+id).click(function(event){
			$.ajax({
				url: 'courses/enroll/'+id,
				method: 'POST',
				data: '',
				dataType: "JSON",
	            success: function(data){
	            	if(data.status){
	            		$.toast({
                            heading: 'Successfull!',
                            text: data.message,
                            icon: 'success',                            
                            stack: false,
                            showHideTransition: 'fade',
                            position: 'top-right'
                        });
                        window.location.href = data.pageredirect;
	            	}else{
	            		$.toast({
                            heading: 'Kindly check your errors!!!',
                            text: data.message,
                            icon: 'error',                            
                            stack: false,
                            showHideTransition: 'fade',
                            position: 'top-right'
                        });
                        
                        window.location.href = data.pageredirect;
                        //sfra.userProfileEditable();
	            	}
	            },
	            error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert(textStatus);
                    if(jqXHR.responseText.indexOf('Duplicate') && textStatus == 'error'){
                    	$.toast({                           	
                            text: 'Already Registered',
                            icon: textStatus,                            
                            stack: false,
                            showHideTransition: 'fade',
                            position: 'top-right'
                        });

                    }else{
                    	$.toast({	                           	
                            text: 'Registration not available contact administrator',
                            icon: 'warning',                            
                            stack: false,
                            showHideTransition: 'fade',
                            position: 'top-right'
                        });
                    }
                }

			});	   
		//});

	},
	clickSubmitReq: function(id){
		$.ajax({
			url: 'courses/submit_req/'+id,
			method: 'POST',
			data: '',
			dataType: "JSON",
            success: function(data){
            	if(data.status){
            		$.toast({
                        heading: 'Successfull!',
                        text: data.message,
                        icon: 'success',                            
                        stack: false,
                        showHideTransition: 'fade',
                        position: 'top-right'
                    });
                    //window.location.href = data.pageredirect;
            	}else{
            		$.toast({
                        heading: 'Kindly check your errors!!!',
                        text: data.message,
                        icon: 'error',                            
                        stack: false,
                        showHideTransition: 'fade',
                        position: 'top-right'
                    });
                    
                    //window.location.href = data.pageredirect;
                    //sfra.userProfileEditable();
            	}
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);                
            }

		});	 
	},
	clickShowReqDetails: function(user,cid){
		$.ajax({
			url: 'reports/show_reqdetails/'+user+'/'+cid,
			method: 'POST',
			data: '',
			dataType: "JSON",
            success: function(data){

            	if(data.status){
            		var res = data.results;
            		var user = $('#userFullname');
            		var chiddenF = $('#hiddencourse');
            		var uhiddenF = $('#hiddenuser');
            		var scrhiddenF = $('#hiddenscr');
            		var tableReqDetails = $('#tableDetailsReq tbody');
			     		tableReqDetails.empty();
			      $('#tableDetailsReq').show();
			      var len = res.length;``
			      user.text('Name: '+res[0].first_name+' '+res[0].last_name);
			      uhiddenF.val(res[0].username);
			      chiddenF.val(res[0].courseid);
			      scrhiddenF.val(res[0].studentcoursereqid);
			      for (var i = 0; i < len; i++) {
			      	var screqid = res[i].studentcoursereqid;
			      	var attachment = res[i].attachment;
			        var reqname = res[i].requirementname;
			        var reqstatus = res[i].reqstatus;
			       
			        tableReqDetails.append('<tr><td class="hide_column">' + screqid + '</td><td>' +
			          reqname + '</td><td id="reqstatus'+screqid+'">' + reqstatus + '</td><td class="disabled-sorting text-right"><button type="button" class="btn btn-sm btn-primary" onclick="sfra.clickViewAttachmentModal('+screqid+',\''+attachment+'\')">' + 'View Attachment' + '</button>' + '</td></tr>');
			      }
			    }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);                
            }

		});	 
	},
	clickApproveRegistration: function(form,event){
		event.preventDefault();
		$.ajax({
			url: 'reports/approve_reg',
			method: 'POST',
			data: '',
			dataType: "JSON",
            success: function(data){

            	if(data.status){
            		
			    }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);                
            }

		});	 
	},
	clickViewAttachmentModal: function(creq,attachment){
		
    	$('#studentcoursereq').val(creq);
    	$('#attachment').attr("src", attachment);
    	$('#viewAttachmentReqModal').modal('show'); // show bootstrap modal    	
	},
	clickChangePassword: function(){
		$('#changePasswordForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#changePasswordModal').modal('show'); // show bootstrap modal
	},
	clickAddRequirement: function(){
		$('#addRequirementForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#requirementModalAdd').modal('show'); // show bootstrap modal
	},
	clickEditRequirement: function(id){
		$('#addRequirementForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string    	

    	$.ajax({
	        url : "edit/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id"]').val(data.requirementid);	            
	            $('[name="requirementname"]').val(data.requirementname);
	            $('[name="requirementdesc"]').val(data.requirementdesc);	            	                                
	           
	            $('#requirementModalAdd').modal('show'); // show bootstrap modal when complete loaded
	            $('#btnAddRequirement').text('Update'); // Set title to Bootstrap modal title
	            $('#btnAddRequirement').attr('name','btnUpdateRequirements');
	            $('.title').text('Edit Requirements'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	},
	clickAddCourseRequirement: function(){
		$('#addCourseRequirementForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#courseRequirementModalAdd').modal('show'); // show bootstrap modal
	},

	clickAddForm: function(){
		$('#addForm')[0].reset(); // reset form on modals
    	$('.form-group').removeClass('has-success'); // clear error class
    	$('.form-group').removeClass('has-danger');
    	$('.help-block').empty(); // clear error string
    	$('#addFormModal').modal('show'); // show bootstrap modal
	},

	readNotification: function(id){

		$.ajax({
				url: 'notification/read_message/'+id,
				method: 'POST',
				data: '',
				dataType: "JSON",
	            success: function(data){
	            	window.location.href = data.pageredirect;
	            },
	            error: function (jqXHR, textStatus, errorThrown)
                {
                   alert(textStatus);                  
                }

		});	 

		
	},
	clickReplyLink: function(){
		$("#replyLink").click(function(event){
		   $('form#replyForm .form-control').removeAttr('disabled'); // Element(s) are now end.		  
		   $("#replyMsg").show();
		   $("#btnSendReplyMessage").show();
		   $("#btnCancelReplyMessage").show();
		});

	},

	clickCancelReplyMessage: function(){
		$("#btnCancelReplyMessage").click(function(event){
		   $("#replyMsg").hide();
		   $("#btnSendReplyMessage").hide();
		   $("#btnCancelReplyMessage").hide();
		});

	},

};