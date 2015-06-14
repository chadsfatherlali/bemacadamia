<?php
/*
 * Template Name: Lookbook
 * Description: A Page Template with a darker design.
 * Author: Creators Name
 */

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 6/6/15
 * Time: 17:29
 */

$pic = reset(assetsManager::getGdriveImages(16));
$imagesLink = assetsManager::getGdriveImages(16);
get_header('bemacadamia'); ?>

    <div class="container-fluid body-contain no-padding">
        <div class="hero">
            <img src="<?php echo $pic['img'] ?>" />
        </div>


        <div class="contenido txt-center">
            <p class="play-fair-regular">Smart casual collection</p>
            <h2 class="play-fair-regular">Walk on by</h2>

            <div class="separator"></div>

            <p class="source-sans-pro font-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed velit elit. Aliquam cursus porta libero vel rutrum.</p>
            <p class="source-sans-pro font-12">Etiam iaculis leo aliquet risus tempor, non ornare lorem semper.</p>
            <a href="/shop" class="btn btn-default">Shop now</a>
        </div>

        <div class="Collage">
            <?php foreach($imagesLink as $el) { ?>
                <div class="col-md-6 no-padding">
                    <a href="<?php echo $el['link'] ?>">
                        <img src="<?php echo $el['img'] ?>" />
                    </a>
                </div>
            <?php } ?>
        </div>

    </div>

<?php get_footer('bemacadamia'); ?>