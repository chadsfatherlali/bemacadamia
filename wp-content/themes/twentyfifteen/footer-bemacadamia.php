<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 24/5/15
 * Time: 20:37
 */
?>
    <footer class="footer">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p id="logo-footer"><?php echo assetsManager::getSvgImages('logos', 'Logo_white') ?></p>
                        <p class=""><span class="glyphicon glyphicon-copyright-mark"></span> <?php tokensManager::setText(6) ?> | <?php tokensManager::setText(7) ?></p>
                    </div>
                    <div class="col-md-4 social-networks-container-footer txt-center">
                        <a href=""><?php echo assetsManager::getSvgImages('logos', 'Facebook_white') ?></a>
                        <a href=""><?php echo assetsManager::getSvgImages('logos', 'Instagram_white') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
<?php assetsManager::__obEnd() ?>