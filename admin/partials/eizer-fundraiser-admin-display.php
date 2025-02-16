<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Eizer_Fundraiser
 * @subpackage Eizer_Fundraiser/admin/partials
 */
$img_url = plugin_dir_url(__FILE__) . '../images/';
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!-- Hero Section -->
<section id="hero" class="hero section">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                <h1>Elegant and creative solutions</h1>
                <p>We are team of talented designers making websites with Bootstrap</p>
                <div class="d-flex">
                    <a href="#" class="btn-get-started">Get Started</a>
                    <a href="#" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                <img src="<?php echo $img_url; ?>hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>
<!-- /Hero Section -->