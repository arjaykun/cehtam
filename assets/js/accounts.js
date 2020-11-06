$(document).ready(function() {
  
  $("#table").DataTable({
	  "columnDefs": [
	    { "orderable": false, "targets": [3,4] }
	  ],
	  "lengthChange": false,
	  "searching": false,
	});

	let is_add = true;
	  
  $("#add-btn").click(function() {
  	is_add = true;

  	$("#form-modal").addClass("is-active");
  })

  const fields = ["name", "email", "username", "password"];


  // hide modal
  function close_modal() {
  	$("#form-modal").removeClass("is-active");
  	$("#delete-modal").removeClass("is-active");

  	$("#password-div").removeClass('is-hidden');
		$("#form-title").text('New Account');
		$("#submit").val('Add Account');

		$("#name").val("");
		$("#email").val("");
		$("#username").val("");
		$("#password").val("");

		fields.forEach( field => {
			$("#"+field).removeClass("is-danger")
			$("#"+field+"-err").addClass("is-hidden")
		})
  }

  $(".modal-close").click(close_modal);
	$(".modal-background").click(close_modal);
	$("#cancel").click(close_modal);


	//submit add form
	$("#account-form").submit(function(e) {
		e.preventDefault();

		$(".loading").removeClass("is-hidden")
		$.ajax({
			url: "../../includes/process/" + (is_add ? "add-account" : "update-account") + ".php",
			type: "POST",
			data: $(this).serialize(),  
			dataType: "json",
			success: function(data) {
				 close_modal();
				 window.location.href = "/dashboard/accounts?" + (is_add ? "add=1" : "update=1");
			}, 
			error: function(error) {
				let errors = [];
			
				if (error.responseText)
					 errors = JSON.parse(error.responseText);
				
				console.log(errors);	
				fields.forEach( field => {
					$("#"+field).removeClass("is-danger")
					$("#"+field+"-err").addClass("is-hidden")
				})

				for(let key in errors) {
					$("#"+key).addClass("is-danger")
					$("#"+key+"-err").removeClass("is-hidden")
					$("#"+key+"-err").html(errors[key])
				}

			}, 
			complete: function() {
				$(".loading").addClass("is-hidden")
			}
		})
	})

	// edit account
	$(".edit").click(function() {
		is_add = false;
		const siblings = $(this).parent().siblings();
		$("#name").val(siblings[1].innerText.trim());
		$("#email").val(siblings[2].innerText.trim());
		$("#old_email").val(siblings[2].innerText.trim());
		$("#username").val(siblings[0].innerText.trim());
		$("#old_username").val(siblings[0].innerText.trim());
		$("#password-div").addClass('is-hidden');
		$("#form-title").text('Update Account');
		$("#submit").val('Save Changes');
		$("#form-modal").addClass('is-active');
	})

	// delete accounts
	$(".del").click(function() {
		$('#delete-modal').addClass('is-active')

		$("#confirm-id").val($(this).attr('id'));
	})

	$("#confirm-form").submit(function(e) {
		e.preventDefault();

		$(".loading").removeClass("is-hidden")
		$.ajax({
			url: "../../includes/process/delete-account.php",
			type: "POST",
			data: $(this).serialize(),  
			dataType: "json",
			success: function(data) {
				 close_modal();
				  window.location.href = "/dashboard/accounts?delete=1";
			}, 
			error: function(error) {
				 close_modal();
				 window.location.href = "/dashboard/accounts?delete=0";
			},
			complete: function() {
				$(".loading").addClass("is-hidden")
			}
		})		
	})
});


