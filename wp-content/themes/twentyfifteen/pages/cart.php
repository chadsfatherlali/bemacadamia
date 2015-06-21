<?php
/*
 * Template Name: Cart
 * Description: A Page Template with a darker design.
 * Author: Creators Name
 */

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 10/6/15
 * Time: 21:53
 */
$cart = cart::getItems($_GET['id']);
//print_r($cart);die;
get_header('bemacadamia');?>

    <div class="container body-contain no-padding">
        <div class="row products">
            <div class="col-md-6 form-user">

                <div class="col-lg-12 no-padding payment-method-1 payment-method-container">
                    <div class="col-lg-12 no-padding txt-left headers">
                        <p class="play-fair-regular">Smart casual collection</p>
                        <h2 class="play-fair-regular">Rellena tus datos</h2>

                        <div class="separator"></div>
                    </div>

                    <form id="form-compra-datos-usuario">
                        <h3>Información del cliente</h3>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Email</label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="example@domain.com" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Direccion</label>
                            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección" />
                        </div>

                        <div class="form-group">
                            <label for="select" class="col-lg-12 control-label no-padding">* Ciudad</label>
                            <div class="col-lg-12 no-padding">
                                <select class="form-control" name="ciudad" id="ciudad">
                                    <option>(Seleccionar)</option>
                                    <option>Álava</option>
                                    <option>Albacete</option>
                                    <option>Alicante/Alacant</option>
                                    <option>Almería</option>
                                    <option>Asturias</option>
                                    <option>Ávila</option>
                                    <option>Badajoz</option>
                                    <option>Barcelona</option>
                                    <option>Burgos</option>
                                    <option>Cáceres</option>
                                    <option>Cádiz</option>
                                    <option>Cantabria</option>
                                    <option>Castellón/Castelló</option>
                                    <option>Ceuta</option>
                                    <option>Ciudad Real</option>
                                    <option>Córdoba</option>
                                    <option>Cuenca</option>
                                    <option>Girona</option>
                                    <option>Las Palmas</option>
                                    <option>Granada</option>
                                    <option>Guadalajara</option>
                                    <option>Guipúzcoa</option>
                                    <option>Huelva</option>
                                    <option>Huesca</option>
                                    <option>Illes Balears</option>
                                    <option>Jaén</option>
                                    <option>A Coruña</option>
                                    <option>La Rioja</option>
                                    <option>León</option>
                                    <option>Lleida</option>
                                    <option>Lugo</option>
                                    <option>Madrid</option>
                                    <option>Málaga</option>
                                    <option>Melilla</option>
                                    <option>Murcia</option>
                                    <option>Navarra</option>
                                    <option>Ourense</option>
                                    <option>Palencia</option>
                                    <option>Pontevedra</option>
                                    <option>Salamanca</option>
                                    <option>Segovia</option>
                                    <option>Sevilla</option>
                                    <option>Soria</option>
                                    <option>Tarragona</option>
                                    <option>Santa Cruz de Tenerife</option>
                                    <option>Teruel</option>
                                    <option>Toledo</option>
                                    <option>Valencia/Valéncia</option>
                                    <option>Valladolid</option>
                                    <option>Vizcaya</option>
                                    <option>Zamora</option>
                                    <option>Zaragoza</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">* Código postal</label>
                            <input class="form-control" type="text" name="cpostal" id="cpostal" placeholder="Código postal" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="disabledInput">Teléfono (optional)</label>
                            <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Teléfono" />
                        </div>

                        <div class="form-group txt-right">
                            <input type="submit" class="btn btn-default" value="Continuar" />
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 payment-method-2 payment-method-container">
                    <div class="col-lg-12 no-padding txt-left headers">
                        <p class="play-fair-regular">beMacadamia</p>
                        <h2 class="play-fair-regular">Orden de compra</h2>

                        <div class="separator"></div>

                        <div class="row no-padding">
                            <div class="col-xs-12 source-sans-pro font-14 txt-negro info-cliente-header">
                                <span>Informacion del cliente</span><span class="float-right txt-gris font-10" id="editar-info">Editar <span class="glyphicon glyphicon-play"></span></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="nombre-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="apellido-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="email-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="direccion-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="cpostal-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="ciudad-edit"></span>
                            </div>
                            <div class="col-xs-12">
                                <span id="telefono-edit"></span>
                            </div>
                        </div>

                        <div class="row no-padding billing-methods">
                            <div class="col-xs-12 source-sans-pro font-14 txt-negro info-cliente-header">
                                <span>MÉTODOS DE PAGO</span>
                            </div>
                            <form id="metodos-pago">
                                <div class="col-xs-12 no-padding">
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="pago" id="pago1" class="pagos" value="Transferencia bancaria">
                                            Tranferencia bancaria
                                        </label>
                                    </div>
                                    <span class="txt-gris font-10 float-right pagos-info" id="pago-info" data-toggle="modal" data-target="#modal-pago1">Info <span class="glyphicon glyphicon-play"></span></span>
                                </div>

                                <div class="col-xs-12 no-padding">
                                    <div class="radio radio-primary">
                                        <label>
                                            <input type="radio" name="pago" id="pago2" class="pagos" value="Contra reembolso">
                                            Pago contra reembolso
                                        </label>
                                    </div>
                                    <span class="txt-gris font-10 float-right pagos-info" id="pago2-info" data-toggle="modal" data-target="#modal-pago2">Info <span class="glyphicon glyphicon-play"></span></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <input type="button" class="btn btn-default float-right" id="doPayment" value="Hacer pedido" />
                </div>
            </div>

            <div class="col-md-6 listado-productos">
                <div class="col-lg-12 no-padding txt-left headers">
                    <p class="play-fair-regular">beMacadamia</p>
                    <h2 class="play-fair-regular">Orden de compra</h2>

                    <div class="separator"></div>
                </div>
                <?php foreach(json_decode($cart['json'], true) as $key => $item) {
                        $total = $item['cantidad'] * $item['precio'];
                    ?>
                    <div class="row producto-info" id="producto-info-<?php echo $key ?>">
                        <div class="col-xs-4">
                            <div class="img-producto" style="background-image: url('<?php postHelper::getImageFromID($item['producto']) ?>')"></div>
                        </div>
                        <div class="col-xs-8">
                            <h4 class="play-fair-regular font-12"><?php postHelper::getName($item['producto']) ?> <span class="txt-right"></span><span class="txt-gris play-fair-regular font-10">x</span><span class="txt-gris play-fair-regular font-12"><?php echo $item['cantidad'] ?></span></span> <span data-trash="<?php echo $key ?>" class="txt-right glyphicon glyphicon-trash toTrash"></span></h4>
                            <div class="row">
                                <div class="col-xs-1">
                                    <div class="circle-color" style="background-color: <?php echo $item['color'] ?>"></div>
                                </div>
                                <div class="col-xs-4">
                                    / <?php echo $item['talla']? : 'U' ?>
                                </div>
                                <div class="col-xs-5 txt-right play-fair-regular">
                                    <p class="precios"><?php postHelper::sum($item['cantidad'], $item['precio']) ?>€</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div id="totales">
                    <div class="col-xs-11 no-padding-left">
                        <span class="font-12 float-left source-sans-pro">Subtotal</span><spa class="font-16 float-right play-fair-regular" id="sub-total">0€</spa>
                    </div>
                    <div class="col-xs-11 no-padding-left">
                        <span class="font-12 float-left source-sans-pro">Gastos Envío</span><spa class="font-16 float-right play-fair-regular">4€</spa>
                    </div>
                    <div class="col-xs-11 no-padding-left">
                        <span class="font-12 float-left source-sans-pro">Total</span><spa class="font-16 float-right play-fair-regular" id="full-total">0€</spa>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pago1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pago por Transferencia Bancaria</h4>
                </div>
                <div class="modal-body">
                    <p>A través de transferencia bancaria al siguiente número de cuenta: xxxx.</p>
                    <p>Una vez nos hagas llegar el justificante de la transferencia,tramitaremos tu pedido y te llegara en un plazo de 24/48horas.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pago2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pago a contrareembolso</h4>
                </div>
                <div class="modal-body">
                    <p>A contra reembolso, lo cual lleva aparejado un gasto extra pues la empresa de transportes tiene que volver a remitirnos el importe del pedido.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pago3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Seleccione una forma de pago</h4>
                </div>
                <div class="modal-body">
                    <p><strong>El método de pago es el siguiente:</strong></p>
                        <ul>
                            <li>
                                <strong>1)</strong> A través de transferencia bancaria al siguiente número de cuenta: 0065-0103-55-0001039330.
                                Una vez nos hagas llegar el justificante de la transferencia, tramitaremos tu pedido y te llegara en un plazo de 24/48horas.
                                En "concepto" debes especificar tu nombre y apellidos.
                                Beneficiario: Marina.
                            </li>
                            <li>
                                2) A contra reembolso, lo cual lleva aparejado un gasto extra pues la empresa de transportes tiene que volver a remitirnos el importe del pedido.
                            </li>
                        </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pago4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <div class="contenido">
                        <p class="play-fair-regular">beMacadamia</p>
                        <h2 class="play-fair-regular">Walk on by</h2>

                        <div class="separator"></div>

                        <p class="source-sans-pro font-12">Muchas gracias por tu compra.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--
Array ( [accion] => save [cantidad] => 2 [color] => #dd9933 [producto] => 18 [precio] => 39,99 [hash] => ewklmfraf819vn29 ) Array ( [accion] => save [cantidad] => 2 [color] => #eeee22 [producto] => 18 [precio] => 39,99 [hash] => ewklmfraf819vn29 ) Array ( [accion] => save [talla] => M [cantidad] => 1 [color] => #eeee22 [producto] => 1 [precio] => 39,99 [hash] => ewklmfraf819vn29 ) -->

<?php get_footer('bemacadamia') ?>