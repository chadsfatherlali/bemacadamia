<?php
assetsManager::__obStart();
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 24/5/15
 * Time: 20:25
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600|Playfair+Display' rel='stylesheet' type='text/css'>

    <link href="/wp-content/themes/twentyfifteen/customAssets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/wp-content/themes/twentyfifteen/customAssets/css/common.css" rel="stylesheet" type="text/css">

    <?php wp_head(); ?>
    <script>
        var host = "<?php echo $_SERVER['SERVER_NAME'] ?>";
    </script>

    <?php
        if(is_home()) {
            $pics = assetsManager::getGdriveImages(5);
            $picjs = array();

            foreach($pics as $pic) {
                $picjs[] = '"' . $pic['img'] . '"';
            }
        }
    ?>
    <script>var picsjs = [<?php echo join(',', $picjs) ?>]</script>
</head>
<body <?php body_class(); ?>>


    <div class="container-fluid no-padding">
        <?php if(is_home()) { ?>
            <!-- Full Page Image Background Carousel Header -->
            <header id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    <?php foreach($pics as $k => $v) { ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $k ?>" class="<?php echo $k === 0? 'active' : '' ?>"></li>
                    <?php } ?>
                </ol>

                <!-- Wrapper for Slides -->
                <div class="carousel-inner" role="listbox">
                    <?php foreach($pics as $k => $v) { ?>
                        <div class="item <?php echo $k === 0? 'active' : '' ?>">
                            <div class="fill lazy"
                                 <?php if($k === 0) { ?>
                                     data-original="<?php echo $v['img'] ?>"
                                    style="background-image:url('');"
                                 <?php } else { ?>
                                    style="background-image:url('<?php echo $v['img'] ?>');"
                                 <?php } ?>
                                >
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="icon-prev"><?php echo assetsManager::getSvgImages('iconos', 'Arrow_circle_left_hover') ?></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="icon-next"><?php echo assetsManager::getSvgImages('iconos', 'Arrow_circle_right_hover') ?></span>
                </a>

            </header>
        <?php } ?>

        <nav id="main-nav-bar" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid no-padding">
                <div class="row">
                    <div class="col-xs-5">
                        <button href="/" id="menu-responsive-link" class="btn btn-lg visible-xs-block visible-sm-block"><span class="glyphicon glyphicon-menu-hamburger"></span></button>

                        <ul class="nav navbar-nav visible-md-block visible-lg-block">
                            <li><a href="/"><?php tokensManager::setText(1) ?></a></li>
                            <li><a href="/shop"><?php tokensManager::setText(2) ?></a></li>
                            <li><a href="/lookbook"><?php tokensManager::setText(3) ?></a></li>
                            <li><a href="/preguntas-frecuentes"><?php tokensManager::setText(4) ?></a></li>
                            <li><a href="/contacto"><?php tokensManager::setText(5) ?></a></li>
                        </ul>
                    </div>

                    <div class="logo-bemacadamia-header">
                        <!-- <a href="#"><img class="w-200" src="<?php echo assetsManager::getPathImages('logos', 'Logo_black.svg') ?>" /></a> -->
                        <a href="/"><?php echo assetsManager::getSvgImages('logos', 'Logo_black') ?></a>
                    </div>

                    <div class="col-xs-5 f-right txt-right">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="javascript:void(0)" class="cesta-compra-header" id="ir-a-cesta"><span id="total-cesta-prodcutos"><?php cart::getTotalItems() ?></span> Items <?php echo assetsManager::getSvgImages('logos', 'CestaCompra') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
