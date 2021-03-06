<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 24/5/15
 * Time: 20:37
 */
?>
</div>

<footer>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p id="logo-footer"><?php echo assetsManager::getSvgImages('logos', 'Logo_white') ?></p>
                    <p class=""><span class="glyphicon glyphicon-copyright-mark"></span> <?php tokensManager::setText(6) ?> | <?php tokensManager::setText(7) ?></p>
                </div>
                <div class="col-md-4 social-networks-container-footer txt-center">
                    <a href="https://www.facebook.com/pages/Be_Macadamia/2046853612120269" target="blank"><?php echo assetsManager::getSvgImages('logos', 'facebook') ?></a>
                    <a href=""><?php echo assetsManager::getSvgImages('logos', 'Instagram') ?></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="/wp-content/themes/twentyfifteen/customAssets/js/plugins.js"></script>
<script src="/wp-content/themes/twentyfifteen/customAssets/js/bootstrap.js"></script>
<script src="/wp-content/themes/twentyfifteen/customAssets/js/common.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>
<?php assetsManager::__obEnd() ?>