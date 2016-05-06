<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Add Product</h3>
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

	                <form action="<?php echo base_url('product/add/product') ?>" method="post" role="form">
	                	<div class="form-group">
	                		<label for="title">Title:</label>
	                		<input type="text" name="title" id="title" placeholder="title" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="image">Image:</label>
	                		<input type="text" name="image" id="image" placeholder="image" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="description">Description:</label>
	                		<textarea name="description" id="description" class="form-control"></textarea>
	                	</div>
	                	<input type="submit" value="Create" class="form-control btn btn-primary">
	                </form>
                </div>
            </div>
		</div>
	</div>
</div>