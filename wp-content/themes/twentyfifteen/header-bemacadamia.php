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
    <?php wp_head(); ?>
    <script>
        var host = "<?php $_SERVER['SERVER_NAME'] ?>";
    </script>
    <?php $pics = assetsManager::getGdriveImages(5); ?>
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
                            <div class="fill" style="background-image:url('<?php echo $v['img'] ?>');"></div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="icon-next"></span>
                </a>

            </header>
        <?php } ?>

        <nav id="main-nav-bar" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid no-padding">
                <div class="row">
                    <div class="col-xs-5">
                        <button href="#" id="menu-responsive-link" class="btn btn-lg visible-xs-block visible-sm-block"><span class="glyphicon glyphicon-menu-hamburger"></span></button>

                        <ul class="nav navbar-nav visible-md-block visible-lg-block">
                            <li><a href="/"><?php tokensManager::setText(1) ?></a></li>
                            <li><a href="/shop"><?php tokensManager::setText(2) ?></a></li>
                            <li><a href="/lookbook"><?php tokensManager::setText(3) ?></a></li>
                            <li><a href="/faqs">Faq's</a></li>
                            <li><a href="/contacto">Contacto</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-3 txt-center logo-bemacadamia-header visible-md-block visible-lg-block">
                        <!-- <a href="#"><img class="w-200" src="<?php echo assetsManager::getPathImages('logos', 'Logo_black.svg') ?>" /></a> -->
                        <a href="#"><?php echo assetsManager::getSvgImages('logos', 'Logo_black') ?></a>
                    </div>

                    <div class="col-ms-5 f-right txt-right">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="javascript:void(0)" class="cesta-compra-header" id="ir-a-cesta"><span id="total-cesta-prodcutos"><?php cart::getTotalItems() ?></span> Items <?php echo assetsManager::getSvgImages('logos', 'CestaCompra') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
