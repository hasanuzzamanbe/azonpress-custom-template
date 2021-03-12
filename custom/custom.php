<div class="azp-product-area azp-widget-style <?php echo $wrapper_class; ?>">
    <?php include '_header.php'; ?>
    <?php $i = 0; ?>
    <?php foreach ($products as $product) : ?>
        <?php $i++;?>
        <!-- azp-each-product -->
        <div class="azp-each-product">
            <h1>Hello from custom</h1>
            <!-- azp--product-content -->
           <div class="azp-product-content">

                <!-- azp-visual-part -->
                <div class="azp-visual-part">
                    <div class="azp-img-wrapper">
                       <?php echo $product->getImageHtml(); ?>
                    </div>
                </div>
                <!-- /.azp-visual-part -->

                <div class="azp-title">
                    <?php echo $product->titleHtml(); ?>
                </div>

               <?php echo $product->ratingStarsHtml(); ?>
                <?php if (!$hide_price) : ?>
                <div style="text-align: center; display: block" class="azp-price">
                        <?php echo $product->priceHTML('minimal'); ?>
                </div>
                <?php endif; ?>


                <div class="azp-buy-button">
                <?php echo $product->buyButton(); ?>
                </div>

             </div>
            <!-- /.azp-product-content -->

         </div>
        <!-- /.azp-each--product -->
    <?php endforeach;?>
    <?php do_action('azonpress_after_product_content', $last_updated_at); ?>
</div>
<!-- /.azp-product-area -->