<div class="breadcrumb-area ptb-45 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active"><a href="javascript:;">Contact</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Google Map Start -->
<div class="container">
    <?php echo $this->m_general->getSetting('embed_map'); ?>
</div>
<!-- Google Map End -->
<!-- Contact Email Area Start -->
<div class="contact-email-area ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Contact Us</h3>
                <?php if(!empty($this->session->flashdata('success'))): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span> <?php echo $this->session->flashdata('success'); ?> </span>
                    </div>
                  <?php endif ?> 
                <p class="text-capitalize mb-40">to Zuma Corporation - Furniture Fitings.</p>
                <form id="contact-form" class="contact-form" action="<?php echo base_url('contact-us');?>" method="post">
                    <div class="address-wrapper">
                        <div class="row">    
                            <div class="col-md-6">
                                <div class="address-fname">
                                     <input type="text" name="name" class="form-control" id="name" value="<?=set_value('name');?>" placeholder="Name"><?=form_error('name');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="address-email">
                                    <input type="text" name="email" placeholder="Email" class="form-control" id="email" value="<?=set_value('email');?>"><?=form_error('email');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-sm-12">
                                <div class="address-textarea">
                                   <textarea class="form-control" name="message" placeholder="Message" rows="5" id="message"><?=set_value('message');?></textarea><?=form_error('message');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="form-message ml-15"></p>
                    <div class="col-xs-12 footer-content mail-content">
                        <div class="send-email">
                            <input type="submit" value="Submit" class="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact Email Area End -->
