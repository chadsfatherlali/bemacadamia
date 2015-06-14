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
//$imagesLink = assetsManager::getGdriveImages(16);

$imagesLink = array(
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/1.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/2.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/3.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/4.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/5.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/6.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/7.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/8.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/9.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/10.jpg'),

);

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

        <div class="collage">
            <ul>
                <?php
                    $imagesLength = count($imagesLink);
                ?>
                <?php foreach($imagesLink as $key => $el) { ?>
                    <? if($key%3 == 0 && $key != 0){ ?>
                    </div>
                    <? } ?>
                    <? if($key%3 == 0 && ($key != $imagesLength)) { ?>
                    <div class="collage-row">
                    <? } ?>
                        <li>
                            <a href="<?php echo $el['link'] ?>">
                                <img src="<?php echo $el['img'] ?>" />
                            </a>
                        </li>

                <?php } ?>
            </ul>
        </div>

    </div>

<?php get_footer('bemacadamia'); ?>