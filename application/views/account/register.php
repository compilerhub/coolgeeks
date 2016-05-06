<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Account Registration Form</h3>
				</div>
                <div class="panel-body">
                	<?php if (validation_errors()): ?>
                	<div class="alert alert-danger notify">
                		<ul>
                			<?php echo validation_errors() ?>
                		</ul>
                	</div>	
                	<?php endif ?>
                	
	                <form action="<?php echo base_url('account/register') ?>" method="post" role="form">
	                	<div class="form-group">
	                		<label for="full_name">Full Name:</label>
	                		<input type="text" name="full_name" id="full_name" placeholder="John Doe" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="username">Username:</label>
	                		<input type="text" name="username" id="username" placeholder="username" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="email">Email Address:</label>
	                		<input type="text" name="email" id="email" placeholder="john@doe.com" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="password">Password:</label>
	                		<input type="password" name="password" id="password" placeholder="******" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="password_confirm">Confirm Password:</label>
	                		<input type="password" name="password_confirm" id="password_confirm" placeholder="******" class="form-control" required>
	                	</div>
	                	<input type="submit" value="Register" class="form-control btn btn-primary">
	                </form>
                </div>
            </div>
		</div>
	</div>
</div>