<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo ($nav == 'product') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('/'); ?>">Products</a></li>
                <?php if ($user): ?>
                    <?php if ($is_admin): ?>
                        <li <?php echo ($nav == 'pricing') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('product/pricing'); ?>">Pricing</a></li>
                        <li <?php echo ($nav == 'voucher') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('product/voucher'); ?>">Vouchers</a></li>
                    <?php endif ?>
                    <li <?php echo ($nav == 'transaction') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('account/transaction'); ?>">Transactions</a></li>
                <?php endif ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($user): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $user->username ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('account/logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li <?php echo ($nav == 'login') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('account/login'); ?>">Login</a></li>
                    <li <?php echo ($nav == 'register') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('account/register'); ?>">Register</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
<?php if ($this->session->flashdata('alert_success')): ?>
    <div class="container"><div class="alert alert-success notify"><?php echo $this->session->flashdata('alert_success') ?></div></div>
<?php endif ?>
<?php if ($this->session->flashdata('alert_info')): ?>
    <div class="container"><div class="alert alert-info notify"><?php echo $this->session->flashdata('alert_info') ?></div></div>
<?php endif ?>
<?php if ($this->session->flashdata('alert_warning')): ?>
    <div class="container"><div class="alert alert-warning notify"><?php echo $this->session->flashdata('alert_warning') ?></div></div>
<?php endif ?>
<?php if ($this->session->flashdata('alert_danger')): ?>
    <div class="container"><div class="alert alert-danger notify"><?php echo $this->session->flashdata('alert_danger') ?></div></div>
<?php endif ?>