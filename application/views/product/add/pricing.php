<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Add Pricing</h3>
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

	                <form action="<?php echo base_url('product/add/pricing') ?>" method="post" role="form">
	                	<div class="form-group">
	                		<label for="product_id">Product:</label>
	                		<select name="product_id" id="product_id" class="form-control" required>
	                			<option value="">-- Select Product --</option>
	                			<?php foreach ($products as $product): ?>
	                				<option value="<?php echo $product->id ?>"><?php echo $product->title ?></option>
	                			<?php endforeach ?>
	                		</select>
	                	</div>
	                	<div class="form-group">
	                		<label for="amount">Amount:</label>
	                		<input type="number" step="any" name="amount" id="amount" placeholder="amount" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="price">Price:</label>
	                		<input type="number" step="any" name="price" id="price" placeholder="price" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="service_id">Fortumo Service ID:</label>
	                		<input type="text" name="service_id" id="service_id" placeholder="Service ID" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="secret">Fortumo Secret:</label>
	                		<input type="text" name="secret" id="secret" placeholder="Secret" class="form-control" required>
	                	</div>
	                	<input type="submit" value="Create" class="form-control btn btn-primary">
	                </form>
                </div>
            </div>
		</div>
	</div>
</div>