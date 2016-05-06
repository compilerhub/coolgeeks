<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Add Voucher</h3>
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

	                <form action="<?php echo base_url('product/add/voucher') ?>" method="post" role="form">
	                	<div class="form-group">
	                		<label for="code">Code:</label>
	                		<input type="text" name="code" id="code" placeholder="code" class="form-control" required>
	                	</div>
	                	<div class="form-group">
	                		<label for="pricing_id">Price:</label>
	                		<select name="pricing_id" id="pricing_id" class="form-control" required>
	                			<option value="">-- Select Price --</option>
	                			<?php foreach ($pricings as $pricing): ?>
	                				<option value="<?php echo $pricing->id ?>">
	                					<?php echo $pricing->title ?> : &#8369; <?php echo $pricing->amount ?> for &#8369; <?php echo $pricing->price ?> load
	                				</option>
	                			<?php endforeach ?>
	                		</select>
	                	</div>
	                	<input type="submit" value="Create" class="form-control btn btn-primary">
	                </form>
                </div>
            </div>
		</div>
	</div>
</div>