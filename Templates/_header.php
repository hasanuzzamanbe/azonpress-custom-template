<?php if ($atts['title'] || $atts['content']) : ?>
<div class="azp_component_header">
    <?php if ($atts['title']) : ?>
    <h3><?php echo $atts['title']; ?></h3>
    <?php endif; ?>
    <?php if ($atts['content']) : ?>
        <div class="azp_component_description">
            <?php echo $atts['content']; ?>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>