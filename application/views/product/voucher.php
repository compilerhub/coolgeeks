<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a href="<?php echo base_url('product/add/voucher') ?>" class="btn btn-primary">Add Voucher</a>
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
                    <th>Voucher</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($vouchers): ?>
                    <?php foreach ($vouchers as $voucher): ?>
                        <tr>
                            <td><?php echo $voucher->code ?></td>
                            <td><?php echo $voucher->title ?></td>
                            <td><?php echo $voucher->amount ?></td>
                            <td><?php echo $voucher->price ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs">EDIT</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">No added voucher(s) yet.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
        </div>
    </div>
</div>