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
            <p class="play-fair-regular transition-txt transition-txt-1 hidden-xs"><?php tokensManager::setText(8) ?></p>
            <h2 class="play-fair-regular transition-txt transition-txt-2 Øhidden-xs">Walk on by</h2>
            <!-- <div class="separator"></div> -->
            <a href="/shop" class="btn btn-default home-btn transition-txt transition-txt-3">Comprar</a>
        </div>
    </div>

<?php get_footer('bemacadamia'); ?>
