<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CEHTMAR</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/bulma/css/bulma.min.css">
	<link rel="stylesheet"  href="assets/css/style.css">
	<link href="assets/css/loader.css" rel="stylesheet">
	<style>
		.opacity-0 {opacity: 0}	
	</style>
</head>
<body>
	
	<section class="section">
		
		<div class="container is-max-desktop has-background-white">
			<div class="columns">
				
				<div class="column is-half has-background-info has-text-centered">				

					<div class="is-size-4">
						<i class="fa fa-calendar"></i> <span  id="date"></span>
					</div>

					<div class="is-flex is-justify-content-center is-align-items-center">					
						<figure class="image is-256x256 py-5">
						  <img class="is-rounded" src="/assets/images/bg/scan.jpg">
						</figure>
					</div>

					<div class="is-size-2 has-text-weight-bold has-text-white-ter" id="time"></div>

					<span><i class="fa fa-cogs has-text-dark is-size-3 is-clickable my-2" id="show"></i></span>

					<form>
						<div class="field">
						  <div class="control">
						    <input class="input opacity-0" type="text" name="rfid" id="rfid">
						  </div>
						  <p class="help is-danger is-hidden" id="name-err"></p>
						</div>
					</form>

				</div>
				<div class="column is-half">
					<h1 class="title has-text-info"><i class="fa fa-clock-o mr-1">	</i>Recently Timed</h1>
					<div id="recent"></div>
				</div>

			</div>
		</div>
	</section>

	<section>
		<div class="loading is-hidden">
			<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
		</div>
	</section>

	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="assets/js/swal.js"></script>
	<script src="assets/js/index.js"></script>
 
	<script>
		$(document).ready(function() {
			
			(function ($) {
			    $.extend({
			        playSound: function () {
			            return $(
			                   '<audio class="sound-player" autoplay="autoplay" style="display:none;">'
			                     + '<source src="' + arguments[0] + '" />'
			                     + '<embed src="' + arguments[0] + '" hidden="true" autostart="true" loop="false"/>'
			                   + '</audio>'
			                 ).appendTo('body');
			        },
			        stopSound: function () {
			            $(".sound-player").remove();
			        }
			    });
			})(jQuery);

			function get_recents() {
				$(".loading").removeClass("is-hidden");	
				$.ajax({
					url: "/includes/process/get-recent-logs.php",
					type: "GET", 
					dataType: "json",
					success: function(data) {
						let output = "<div class='columns is-multiline is-mobile'>";
						if(data.length > 0) {
							data.forEach( item => {
								output += `
<div class="column my-0 py-0 is-3-fullhd is-3-desktop is-3-tablet is-6-mobile">
	<div class="card" style="height: 200px">
	  <div class="card-image">
	    <figure class="image">
	      <img src="assets/images/employees/${item.emp_image}" alt="${item.name}" style="width: 100%; height: 120px; max-height: 120px">
	    </figure>
	  </div>
	  <div class="card-content py-2 px-1">
	    <h1 class="title is-7 has-text-weight-bold">${item.name}</h1>
	    <p class="subtitle is-size-7">#${item.emp_id}</p>
	  </div>
	 </div>
</div>
								`
							})
						} else {
							output = "<h3 class='is-size-3'>No results yet.</h3>"
						}
						output += "</div>"
						$("#recent").html(output);
					},
					error: function(error) {
						 // window.location.href = "/404.html";
					}, 
					complete: function() {
						$(".loading").addClass("is-hidden");	
					}
				})
			}

			function log_time() {
				let rfid = $("#rfid").val();

				$.ajax({
					url: "/includes/process/time_logging.php",
					type: "POST",
					data: {rfid},  
					dataType: "json",
					success: function(data) {
						let msg = (data.msg == 'time_in') ? "Success! You have timed-in." : "Success! You have timed-out.";
						get_recents();
						$(".loading").addClass("is-hidden");	
						swal({
							text: msg,
							icon: "success",
							timer: 1500,
							button: { visible: false },
							closeModal: false,
						});
					},
					error: function(error) {
						swal({
							text: "Oops! Please try again.",
							icon: "error",
							timer: 1500,
							button: { visible: false },
							closeModal: false,
						});
					},
					complete: function() {
						$(".loading").addClass("is-hidden");	
						$("#rfid").focus();
						$("#rfid").val("");
					}
				})
			}


			$("#show").click( function() {
				$("#rfid").toggleClass("opacity-0");
				$("#rfid").focus();
			})

			$("form").submit(function(e) {
				e.preventDefault();
				$("#rfid").focus();
			})

			setInterval( () => {
				let dontknow = new Date().getHours() >= 12 ? " PM" : " AM";
				let time = new Date().toLocaleTimeString() + dontknow ;
				$("#time").text(time);
			}, 1000);

			$("#date").text( new Date().toDateString());
			$("#rfid").focus();
			$("#rfid").change( function(e) {
					$.playSound('/assets/sounds/bleep.wav')
					$(".loading").removeClass("is-hidden");
					log_time();
			
			})

			get_recents();
		})
	</script>

</body>
</html>