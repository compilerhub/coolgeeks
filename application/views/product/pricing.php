<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="<?php echo base_url('product/add/pricing') ?>" class="btn btn-primary">Add Pricing</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
    </div>
	<div class="row">
        <div class="col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Service ID</th>
                    <th>Secret</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product->title ?></td>
                            <td><?php echo $product->amount ?></td>
                            <td><?php echo $product->price ?></td>
                            <td><?php echo $product->service_id ?></td>
                            <td><?php echo $product->secret ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs">EDIT</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No added pricing yet.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
        </div>
    </div>
</div>