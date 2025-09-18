<?php
/*
Template Name: news-tips
*/
get_header();
$id = get_the_ID();
$data = get_post_meta($id, "varietycontactus", true);
// echo "<pre>";
// print_r($data);
// exit;
?>
<style>
    .page-template-tpl-newstips .ads-header{
    display: none;
}
    .media-tips {
        padding-block: 70px;
    }

    .tips-wrapper {
        width: 100%;
        max-width: 55%;
        margin: auto;
    }

    .media-tips h2 {
        font-size: 54px;
        text-align: center;
        color: #000;
        font-family: Arial, sans-serif;
        font-weight: bold;
    }

    .tips-cnt {
        margin-top: 5px;
    }

    .tips-cnt h3 {
        font-size: 27px;
        font-family: var(--owner-bold);
        padding: 0;
        color: #000;
        margin: 0;
    }

    .tips-cnt p {
        font-size: 18px;
        color: #000;
        padding: 0;
        margin: 0;
        padding-block: 32px 0;
        font-family: var(--ibm-plex-serif-regular);
    }

    .tips-cnt p label {
        font-size: 12px;
        color: #243842;
        font-family: var(--owner-regular);
        font-weight: bold;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .contact-cnt h3 {
        font-size: 18px;
        font-family: var(--owner-bold);
        padding: 0;
        color: #000;
        margin: 0;
    }

    span.wpcf7-form-control-wrap input {
        padding: 5px 0;
        width: 100%;
    }

    .wpcf7-submit {
        width: 100%;
        background-color: #1a282f;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        border: none;
        font-size: 14px;
        font-family: var(--owner-bold);
        letter-spacing: 1px;
        padding: 5px;
    }

    .tips-cnt p a {
        text-decoration: none;
    }

    .tips-cnt p a:hover {
        text-decoration: underline;
    }

    ul.tip-list p {
        padding-block: 1px;
    }

    ul.tip-list {
        padding-top: 15px;
    }

    .tip-list li {
        font-size: 18px;
        color: #000;
        padding: 0;
        margin: 0;
        font-family: var(--ibm-plex-serif-regular);
    }
    .tips-cnt p label span {
    font-weight: normal;
    text-transform: uppercase;
    font-size: 10px;
}
span.wpcf7-form-control-wrap {
    resize: none;
}
textarea {
    resize: none;
}
.contact-cnt ul li {
    font-family: var(--ibm-plex-serif-regular);
    font-size: 18px;
    line-height: 27px
}

    @media only screen and (max-width : 991px) {
        .media-tips h2 {
            font-size: 32px;
        }

        .tips-wrapper {
            max-width: 100%;
        }

        span.wpcf7-form-control-wrap input {
            width: 100%;
        }

        .wpcf7-textarea {
            width: 100%;
        }

        .tips-cnt h3 {
            font-size: 18px;
        }

        .tips-cnt p {
            padding-block: 15px 0;
        }
        .tips-cnt h3 {
        font-size: 27px;
    }
    }
</style>
<section class="media-tips">
    <h2>Got a Confidential Tip for Variety?</h2>
    <div class="container">
        <div class="row">
            <div class="tips-wrapper">
                <div class="tips-cnt">
                    <p>
                        Do you have the next big story? Want to share it with Variety? We want to hear it.
                    </p>
                    <p>
                        Our submission form is completely confidential. Your name and email are not required to submit,
                        but the strongest news tips include suggestions on how to obtain documentation or evidence that
                        would substantiate the story.
                    </p>
                    <p>
                        Messages are reviewed regularly, but we cannot promise an individual response. DO NOT submit
                        press releases or production announcements to this email, this is only for original story tips.
                    </p>
                </div>

                <div class="tips-cnt mt-5">
                    <h3>Ways to Provide News Tips</h3>
                    <p><b>Tipline Form</b></p>
                    <?php echo do_shortcode('[contact-form-7 id="36c2ca2" title="Tipline Form"]'); ?>
                </div>

                <div class="tips-cnt">
                    <?php foreach ($data as $v): ?>
                        <div class="contact-cnt">
                            <h3><?php echo $v['contact-title']; ?></h3>
                            <?php echo $v['contact-details']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
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
