<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="lead text-center">Thank you for your interest for our Products! Kindly please Choose our main products below.</h3>
        </div>
    </div>
    <div class="row">
        <?php if ($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-xs-12 col-md-6 col-lg-6 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p><img src="<?php echo base_url('assets/images/' . $product->image); ?>" height="49"></p><hr>
                            <p><a href="#product-description-<?php echo $product->id ?>" class="product-description"><strong><?php echo $product->title ?></strong></a></p>
                            <p style="display: none" class="text-left" id="product-description-<?php echo $product->id ?>"><?php echo $product->description ?></p>
                        </div>
                        <div class="panel-footer">
                            <?php 
                            $this->db->select('*');
                            $this->db->join('vouchers', 'vouchers.pricing_id = pricing.id');
                            $this->db->group_by('service_id');
                            $this->db->where('pricing.product_id', $product->id);
                            $this->db->where('vouchers.transaction_id', 0);
                            $query = $this->db->get('pricing');
                            $pricings = ($query->num_rows() > 0) ? $query->result() : false;
                            ?>
                            <?php if ($pricings): ?>
                                <?php foreach ($pricings as $pricing): ?>
                                    <button class="btn btn-info modal-product" data-service-id="<?php echo $pricing->service_id ?>" data-price="<?php echo $pricing->price ?>" data-product-image="<?php echo base_url('assets/images/' . $product->image) ?>">&#8369; <?php echo $pricing->amount ?></button>
                                <?php endforeach ?>
                            <?php else: ?>
                                <h5>No available voucher at this time. Please try again later.</h5>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="col-xs-12 col-md-6 col-lg-6 text-center">
            <p class="text-center">No Available Products.</p>
            </div>
        <?php endif ?>
    </div>
</div>




<!-- Modal -->
<div id="modal-product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="modal-product-image" class="text-center" ></div><hr>
                <div id="modal-product-information" class="text-center" ></div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('payment/fortumo') ?>" class="btn btn-primary" id="modal-product-buy-now">Buy Now</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>