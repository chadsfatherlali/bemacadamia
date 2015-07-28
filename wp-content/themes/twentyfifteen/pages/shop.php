<?php
/*
 * Template Name: Shop
 * Description: A Page Template with a darker design.
 * Author: Creators Name
 */

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 7/6/15
 * Time: 15:03
 */
$posts = postHelper::getAllPosts();
$pic = reset(assetsManager::getGdriveImages(19));

get_header('bemacadamia'); ?>

    <div class="container body-contain no-padding">
        <div class="contenido txt-center">
            <p class="play-fair-regular">Smart casual collection</p>
            <h1 class="play-fair-regular">Walk on by</h1>

            <div class="separator"></div>
        </div>

        <div class="row products">
            <?php foreach($posts as $post) {
                $dispo = $post['custom']['wpcf-disponibilidad'][0];
                ?>
                <div class="col-sm-4 product">
                    <a href="<?php echo ($dispo === '1' || !isset($dispo))? '/' . $post['post']['post_name'] : 'javascript:void(0)' ?>">
                        <div class="img lazy" data-original="<?php echo $post['custom']['wpcf-imagen'][0] ?>" style="background-image: url('')"></div>
                        <div class="velo">
                            <div class="white-bg">
                                <p class="font-negro source-sans-pro font-14"><?php assetsManager::bypedText($post['post']['post_title']) ?></p>
                                <p class="font-negro play-fair-regular font-18"><?php assetsManager::bypedText($post['post']['post_title'], 1) ?></p>

                                <?php if($dispo === '1' || !isset($dispo)) { ?>
                                    <button class="btn btn-default"><?php tokensManager::setText(15) ?></button>
                                <?php } else { ?>
                                    <p class="font-negro source-sans-pro font-24">Agotado</p>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                    <p class="source-sans-pro font-12"><?php echo $post['post']['post_title'] ?> <span class="play-fair-regular font-14"><strong><?php echo $post['custom']['wpcf-precio'][0] ?> €</strong></span></p>
                </div>
            <?php } ?>
        </div>

        <div class="contenido txt-center">
            <p class="play-fair-regular">Follow us on</p>
            <h2 class="play-fair-regular">Instagram</h2>

            <div class="separator"></div>
        </div>
    </div>

    <div class="col-lg-12 footer-shop" style="background-image: url('<?php echo $pic['img'] ?>');">
        <div class="velo-footer"></div>
        <div class="container txt-center">
            <div><a href=""><?php echo assetsManager::getSvgImages('logos', 'Instagram_white') ?></a></div>
            <p class="play-fair-regular font-blanco font-24">_bemacadamia</p>
        </div>
    </div>

<?php get_footer('bemacadamia'); ?>