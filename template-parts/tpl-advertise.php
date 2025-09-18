<?php
/*
Template Name: advertise
*/
get_header();
$id = get_the_ID();
$data = get_post_meta($id, "varietycontactus", true);
// echo "<pre>";
// print_r($data);
// exit;
?>
<style>
    .italic {
        font-family: var(--owner-bold);
        font-style: italic;
    }

    .itl {
        font-style: italic;
    }

    .new-para {
        padding-top: 15px;
    }

    .new-para p {
        padding-block: 3px;
    }

    .advertising .contact-wrapper {
      width: 100%;
        max-width: 55%;
        margin: auto;
    }
     .advertising{
    padding-block: 40px;
   }
   .advertising .contact-cnt{
    margin-top: 5px;
   }
.page-template-tpl-advertise .ads-header{
    display: none;
}
    @media only screen and (max-width : 991px) {
        .advertising .contact-wrapper {
            max-width: 100%;
        }
    }
</style>

<section class="contact-us-section advertising">
    <div class="container">
        <div class="row">
            <div class="contact-wrapper">
                <h1 class="sr-only">variety-advertise</h1>
                <h2>Advertise</h2>
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
    </div>
</section>
<!-- More Brands Section End -->



<?php

get_footer();