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
                    <h2 class="play-fair-regular"><?php echo $post['post'][0]['post_title'] ?></h2>

                    <div class="separator"></div>

                    <p class="source-sans-pro font-14"><?php echo $post['post'][0]['post_content'] ?></p>

                    <form id="form-compra">
                        <input type="hidden" name="color" id="color" value="<?php echo $color ?>" />
                        <input type="hidden" id="talla" name="talla" value="<?php echo $size ?>" />
                        <input type="hidden" name="producto" id="producto" value="<?php echo $post['post'][0]['ID'] ?>" />
                        <input type="hidden" name="precio" id="precio" value="<?php echo $post['custom']['wpcf-precio'][0] ?>" />
                        <ul class="form-ul">
                            <li>
                                <h4>Tallas</h4>
                                <ul class="form-interactive form-sizes" id="sizes" data-tallas='<?= json_encode($post['custom']['wpcf-tallas'][0]) ?>'>
                                    <li data-size="XS">XS</li>
                                    <li data-size="S">S</li>
                                    <li data-size="M">M</li>
                                    <li data-size="XL">XL</li>
                                    <li data-size="U">U</li>
                                </ul>
                            </li>
                            <li>
                                <h4>Cantidad</h4>
                                <div id="quantity" class="form-interactive form-quantity input-stepper" >
                                    <a class="button-quantitie decrease" href="javascript:void(0)" data-input-stepper-decrease>-</a>
                                    <input name="cantidad" id="cantidad" type="number" value="1" min="1" max="100" />
                                    <a class="button-quantitie increase" href="javascript:void(0)" data-input-stepper-increase>+</a>
                                </div>
                            </li>
                            <li>
                                <h4>Colores</h4>
                                <ul class="form-interactive form-colors" id="colors">
                                    <?php foreach($post['custom']['wpcf-colores_producto'] as $key => $color) { ?>
                                        <li data-color="<?php echo $color ?>" style="background-color: <?php echo $color ?>; box-shadow: 0 0 0 0px <?php echo $color ?>;"></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li>
                                <div class="form-footer">
                                    <button type="submit" id="sentToCart" class="btn btn-default" /><?php tokensManager::setText(13) ?></button>
                                    <div class="price play-fair-regular"><?php echo $post['custom']['wpcf-precio'][0] ?> € <span class="font-12">(IVA incluido)</span></div>
                                </div>
                            </li>
                        </ul>
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
               Por favor revisa tu selección, debes elegir una talla, una cantidad y un color.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
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
                El producto de añadió correctamente al carrito
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Finalizar compra</button>
                <button id="vermas" type="button" class="btn btn-default" data-dismiss="modal">Seguir comprando</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer('bemacadamia'); ?>
