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

    <div class="container-fluid body-contain">
        <div class="contenido">
            <p class="play-fair-regular"><?php tokensManager::setText(8) ?></p>
            <h2 class="play-fair-regular">Walk on by</h2>

            <div class="separator"></div>

            <!-- <p class="source-sans-pro font-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed velit elit. Aliquam cursus porta libero vel rutrum.</p>
            <p class="source-sans-pro font-12">Etiam iaculis leo aliquet risus tempor, non ornare lorem semper.</p> -->
            <a href="/shop" class="btn btn-default">Shop now</a>
        </div>
    </div>

<?php get_footer('bemacadamia'); ?>
