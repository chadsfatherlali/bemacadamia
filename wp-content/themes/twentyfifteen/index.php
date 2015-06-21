<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header('bemacadamia'); ?>

    <div class="container-fluid">
        <div class="principal-message">
            <p class="play-fair-regular"><?php tokensManager::setText(8) ?></p>
            <h2 class="play-fair-regular">Walk on by</h2>
            <!-- <div class="separator"></div> -->
            <a href="/shop" class="btn btn-default">Comprar</a>
        </div>
    </div>

<?php get_footer('bemacadamia'); ?>
