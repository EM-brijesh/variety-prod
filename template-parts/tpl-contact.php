<?php
/*
Template Name: Contact Us Page
*/
get_header();
$id = get_the_ID();
$data = get_post_meta($id, "varietycontactus", true);
// echo "<pre>";
// print_r($data);
// exit;
?>
<style>
    .regular{
        font-family: var(--ibm-plex-serif-regular) !important;
    }
    .contact-us-section {
    padding-block: 40px;
}
.page-template-tpl-contact .ads-header{
    display: none;
}
</style>
<section class="contact-us-section">
    <div class="container">
        <div class="row">
            <div class="contact-wrapper">
            <h1 class="sr-only">variety-contact</h1>
                <h2>Contact Us</h2>
                <?php foreach ($data as $v): ?>
                    <div class="contact-cnt">
                        <h3><?php echo $v['contact-title']; ?></h3>
                        <?php echo $v['contact-details']; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

<!-- More Brands Section Start -->
<section class="recommend-section moe-branda-section">
    <div class="container">
    <h2 class="recommed-title">More From Our Brands</h2>
    <div class="recommend-cards-wrapper">
        <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
    </div>
    <h3 class="sr-only">varietyindia</h3>
        <h4 class="sr-only">variety india</h4>
    </div>
</section>
<!-- More Brands Section End -->



<?php

get_footer();