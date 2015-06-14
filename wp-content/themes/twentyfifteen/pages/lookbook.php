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
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/11.jpg'),
    array('img' => 'http://googledrive.com/host/0B6cc8HdeC7MqfmJ5WEF0c2JsYnVXTGxwazlqcG9ETDVBNlg4YmlZSDUxZmlScGFhWndIQ3c/12.jpg'),

);

get_header('bemacadamia'); ?>

    <div class="container-fluid body-contain no-padding">
        <div class="hero">
            <img src="https://91ef1e9c9a36732319c01a3759607760e0fc2656.googledrive.com/host/0B6cc8HdeC7MqfnkydHlhSFZlbWxzX3hWSk1WdGtjTkFYZ1dEc1BmVmJOVlhvb0VxNkF2ZTQ/MACADAMIA_PREVIEW.jpg" />
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
                <div class="collage-row">
                    <div class="col2">
                        <li><img src="<?php echo $imagesLink[0]['img'] ?>"></li>
                        <li><img src="<?php echo $imagesLink[1]['img'] ?>"></li>
                    </div>
                    <div class="col1">
                        <li><img src="<?php echo $imagesLink[2]['img'] ?>"></li>
                    </div>
                </div>
                <div class="collage-row">
                    <div class="col1">
                        <li><img src="<?php echo $imagesLink[3]['img'] ?>"></li>
                    </div>
                    <div class="col2">
                        <li><img src="<?php echo $imagesLink[4]['img'] ?>"></li>
                        <li><img src="<?php echo $imagesLink[5]['img'] ?>"></li>
                    </div>
                </div>
                <div class="collage-row">
                    <div class="col2">
                        <li><img src="<?php echo $imagesLink[6]['img'] ?>"></li>
                        <li><img src="<?php echo $imagesLink[7]['img'] ?>"></li>
                    </div>
                    <div class="col1">
                        <li><img src="<?php echo $imagesLink[8]['img'] ?>"></li>
                    </div>
                </div>
                <div class="collage-row">
                    <div class="col1">
                        <li><img src="<?php echo $imagesLink[9]['img'] ?>"></li>
                    </div>
                    <div class="col2">
                        <li><img src="<?php echo $imagesLink[10]['img'] ?>"></li>
                        <li><img src="<?php echo $imagesLink[11]['img'] ?>"></li>
                    </div>
                </div>
            </ul>
        </div>

    </div>

<?php get_footer('bemacadamia'); ?>