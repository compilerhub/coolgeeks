<div class="container">
	<div class="row">
        <div class="col-md-12">
            <h3 class="lead text-center">Transaction Page</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Sender</th>
                    <th>Code</th>
                    <?php if ($is_admin): ?>
                    	<th>Username</th>
                    	<th>Status</th>
                    	<th>Test?</th>
                    <?php endif ?>
                    <th>Date Purchased</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($transactions): ?>
                    <?php foreach ($transactions as $txn): ?>
                        <tr>
                            <td><?php echo $txn->title ?></td>
                            <td><?php echo $txn->amount ?></td>
                            <td><?php echo $txn->price ?></td>
                            <td><?php echo $txn->sender ?></td>
                            <td><?php echo $txn->code ?></td>
                            <?php if ($is_admin): ?>
                            	<td><?php echo $txn->username ?></td>
                            	<td><?php echo $txn->status ?></td>
                            	<td><?php echo ($txn->test) ? 'Yes' : 'No' ?></td>
                            <?php endif ?>
                            <td><?php echo $txn->creation_date ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td colspan="<?php echo ($is_admin) ? '9': '6'?>" class="text-center">No transaction(s).</td></tr>
                <?php endif ?>
            </tbody>
        </table>
        </div>
    </div>
</div>