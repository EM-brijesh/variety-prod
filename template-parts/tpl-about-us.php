<?php
/*
Template Name: about-us
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

    .about-us .contact-wrapper {
        width: 100%;
        max-width: 55%;
        margin: auto;
    }

    .about-us h2 {
        font-size: 54px;
        text-align: center;
        color: #000;
        font-family: sans-serif;
        font-weight: bold;
        font-weight: bold;
        text-transform: uppercase;
    }

    .about-us .contact-cnt {
        margin-top: 5px;
    }

    .about-us {
        padding-block: 40px;
    }


    @media only screen and (max-width : 991px) {
        .about-us .contact-wrapper {
            max-width: 100%;
        }

        .about-us h2 {
            font-size: 32px;
        }

        .about-us .contact-cnt {
            margin-top: 0px;
        }

        .about-us .contact-cnt p {
            padding-block: 13px;
        }

        .about-us .new-para p {
            padding-block: 0px !important;
        }

    }
</style>

<section class="contact-us-section about-us">
    <div class="container">
        <div class="row">
            <div class="contact-wrapper">
                <h1 class="sr-only">variety-about</h1>
                <h2>About Us</h2>
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
