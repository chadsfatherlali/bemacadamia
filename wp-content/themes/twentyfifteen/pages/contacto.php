<?php
/*
 * Template Name: Contacto
 * Description: A Page Template with a darker design.
 * Author: Creators Name
 */

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 5/6/15
 * Time: 19:28
 */
get_header('bemacadamia');
$pic = reset(assetsManager::getGdriveImages(12));
?>

    <div class="container-fluid body-contain no-padding">
        <div class="col-md-4 img-contacto-left visible-md-block visible-lg-block no-padding">
            <img src="<?php echo $pic['img'] ?>" />
        </div>

        <div class="col-md-6" id="contenedor-formulario">
            <div class="col-lg-12 no-padding">
                <p class="play-fair-regular font-gris">be Macadamia</p>
                <h1 class="play-fair-regular">Contacta con nosotros</h1>
                <div class="separador-h1"></div>
                <p class="font-10 source-sans-pro"><?php tokensManager::setText(9) ?></p>
            </div>

            <form id="form-contact">
                <div class="col-lg-12 no-padding">
                    <div class="alert alert-success" id="success" role="alert">
                        Se ha enviado la información correctamente
                    </div>

                    <div class="alert alert-danger" id="error" role="alert">
                        Se ha producido un error intentelo más tarde
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Nombre</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Estamos encantados de conocerte" />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="disabledInput">Teléfono</label>
                            <input class="form-control" type="tel" name="tel" maxlength="9" id="tel" placeholder="Hablemos" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="disabledInput">* Email</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="Estémos en contacto" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="disabledInput">Mensaje</label>
                    <textarea class="form-control" rows="3" name="tell" id="tell" placeholder="Cuentanos"></textarea>
                </div>

                <div class="form-group">
                    <input type="hidden" name="template" id="template" value="contact" />
                    <input type="submit" class="btn btn-default" id="send" value="Enviar" />
                </div>

            </form>
        </div>
    </div>

<?php get_footer('bemacadamia'); ?>
