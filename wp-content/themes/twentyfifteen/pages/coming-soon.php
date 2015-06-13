<?php
/*
 * Template Name: Coming soon
 * Description: A Page Template with a darker design.
 * Author: Creators Name
 */

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 24/5/15
 * Time: 19:56
 */
assetsManager::addJsVar('bgFullImage', assetsManager::getPathImages('page-coming-soon', 'MACADAMIA_PREVIEW.jpg'));
get_header('bemacadamia');
?>
    <div class="fill">
        <div id="texto">
            <h1 class="titulo">Coming soon</h1>
            <img class="img-bg" src="<?php echo assetsManager::getPathImages('logos', 'Logo_white.svg') ?>" />
        </div>
    </div>
<?php
get_footer('bemacadamia'); ?>