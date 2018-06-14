<form id="moonContactForm"  class="moon-contact-form" action="#" method="post" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>" >
	<div class="form-group">
		<input type="text" placeholder="Your Name" class="form-control moon-form-control" id="moon_name" name="name"  />
		<small class="text-danger form-control-msg pull-left"> Your Name is Required</small>
	</div>
	<div class="form-group">
		<input type="email" placeholder="Your Email" class="form-control moon-form-control" id="moon_email" name="email"  />
		<small class="text-danger form-control-msg pull-left"> Your Email is Required</small>
	</div>
	<div class="form-group">
		<textarea name="message" id="moon_message" class="form-control moon-form-control" cols="30" rows="5"  placeholder="Your Message"></textarea>
		<small class="text-danger form-control-msg pull-left"> Your Message is Required</small>
	</div>

 	<button type="submit" class="btn btn-moon-form btn-lg ">Send</button>
	<p class="text-info form-control-msg js-form-submission text-center"><i class="fas fa-spinner fa-pulse"></i> <b>Submission in proccess Please Wait.. </b></p>
 	<p class="text-success form-control-msg js-form-success text-center"><b>Message Successfully Submitted Thank You </b></p>
 	<p class="text-danger form-control-msg js-form-error text-center"><b>There Was a Problem With the Contact Form, Please Try Again</b></p>
</form>