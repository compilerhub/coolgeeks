<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Account Login</h3>
				</div>
                <div class="panel-body">
                	<?php if (validation_errors()): ?>
	                	<div class="alert alert-danger notify">
	                		<ul><?php echo validation_errors() ?></ul>
	                	</div>
                	<?php endif ?>
					<?php if ($errors): ?>
						<div class="alert alert-danger notify">
							<ul>
								<?php foreach ($errors as $error): ?>
		            				<li><?php echo $error ?></li>
		            			<?php endforeach ?>
							</ul>
						</div>
					<?php endif ?>

	                <form action="<?php echo base_url('account/login') ?>" method="post" role="form">
	                	<div class="form-group">
	                		<label for="username">Username:</label>
	                		<input type="text" name="username" id="username" placeholder="username" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="password">Password:</label>
	                		<input type="password" name="password" id="password" placeholder="******" class="form-control" required>
	                	</div>
	                	<input type="submit" value="Login" class="form-control btn btn-primary">
	                </form>
                </div>
            </div>
		</div>
	</div>
</div>