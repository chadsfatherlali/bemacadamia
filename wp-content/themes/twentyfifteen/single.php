<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
$post = postHelper::getPost(get_the_ID());
$images = assetsManager::getGdriveImages($post['custom']['wpcf-gdrive'][0]);
get_header('bemacadamia'); ?>

    <div class="container body-contain no-padding">
        <div class="row product">

            <div class="col-md-4" id="gallery-content">
                <div>
                    <div class="links-header-frame-1">
                        <a href="/shop" class="source-sans-pro">Volver</a>
                    </div>
                    <div class="galery">
                        <div id="img-full" style="background-image: url('<?php echo $images[0]['img'] ?>')"></div>
                        <div id="owl-demo" class="owl-carousel">
                            <?php foreach($images as $key => $img) { ?>
                                <div class="item" data-position="<?php echo $key + 1 ?>" data-img="<?php echo $img['img'] ?>" style="background-image: url('<?php echo $img['img'] ?>')"></div>
                            <?php } ?>
                        </div>

                        <div class="gallery-nav">
                            <a id="gallery-nav-left" class="gallery-nav-icons float-left" href="javascript:void(0)"><?php echo assetsManager::getSvgImages('iconos', 'Arrow_left_black') ?></a>
                            <div id="gallery-count" class="float-left play-fair-regular font-24 txt-center"><span id="position">1</span>/<?php echo count($images) ?></div>
                            <a id="gallery-nav-right" class="gallery-nav-icons float-right" href="javascript:void(0)"><?php echo assetsManager::getSvgImages('iconos', 'Arrow_right_black') ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="col-lg-12 conten-form">
                    <p class="play-fair-regular txt-gris txt-gris">Smart casual collection</p>
                    <h2 class="play-fair-regular">Walk on by</h2>

                    <div class="separator"></div>

                    <p class="source-sans-pro font-12"><?php echo $post['post'][0]['post_content'] ?></p>

                    <form id="form-compra">
                        <div class="form-group col-xs-12" id="sizes">
                            <div class="col-xs-3">
                                <span class="float-left margin-right-1 labels-radios">Tallas</span>
                            </div>

                            <div class="col-xs-4">
                                <?php foreach($post['custom']['wpcf-tallas'][0] as $key => $size) { ?>
                                    <div class="float-left input-content">
                                        <input type="radio" id="radio-<?php echo $key ?>" name="talla" value="<?php echo $size ?>" />
                                        <label for="radio-<?php echo $key ?>"><span><?php echo $size ?></span></label>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-xs-4">
                                <span class="float-left labels-radios margin-left-05">Única</span>
                            </div>
                        </div>

                        <div class="form-group col-xs-12" id="quantities">
                            <div class="col-xs-3">
                                <span class="float-left margin-right-1 labels-radios">Cantidad</span>
                            </div>

                            <div class="col-xs-9">
                                <div class="input-stepper floa-letf">
                                    <a class="button-quantitie" href="javascript:void(0)" data-input-stepper-decrease>-</a>
                                        <input name="cantidad" id="cantidad" class="txt-center" type="text" />
                                    <a class="button-quantitie" href="javascript:void(0)" data-input-stepper-increase>+</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-xs-12" id="colors">
                            <div class="col-xs-3">
                                <span class="float-left margin-right-1 labels-radios">Colores</span>
                            </div>

                            <div class="col-xs-9">
                                <?php foreach($post['custom']['wpcf-colores_producto'] as $key => $color) { ?>
                                    <div class="float-left input-content">
                                        <input type="radio" id="radio-<?php echo $key ?>" name="color" value="<?php echo $color ?>" />
                                        <label for="radio-<?php echo $key ?>"><span style="background-color: <?php echo $color ?>">&nbsp;</span></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="producto" id="producto" value="<?php echo $post['post'][0]['ID'] ?>" />
                        <input type="hidden" name="precio" id="precio" value="<?php echo $post['custom']['wpcf-precio'][0] ?>" />

                        <div class="botonera">
                            <div class="col-sm-6">
                                <input type="submit" id="sentToCart" class="btn btn-default" value="Añadir" />
                            </div>
                            <div class="col-sm-6 col-xs-4 font-24 play-fair-regular"><?php echo $post['custom']['wpcf-precio'][0] ?> €</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Error:</h4>
            </div>
            <div class="modal-body">
               Por favor revisa tu selección.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ok-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body">
                Se añadio correctamento el producto a su cesta.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
                <button id="vermas" type="button" class="btn btn-default" data-dismiss="modal">Ver otros modelos</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer('bemacadamia'); ?>
