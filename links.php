<?php

/**
 * 友链页面
 *
 * @package custom
 *
 **/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!DOCTYPE html>
<html>
<?php $this->need('head.php'); ?>

<body>
    <div id="loader"></div>
    <div id="content">
        <?php $this->need('header.php'); ?>
        <section>
            <div class="container">
                <div class="links mt-3 bg-light shadow rounded">
                    <h5 class="text-dark p-2 mb-0 border-bottom border-secondary"><?php $this->title() ?></h5>
                    <?php $this->content(); ?>
                </div>
                <?php $this->need('comments.php'); ?>
            </div>
        </section>

        <?php $this->need('footer.php'); ?>
    </div>
</body>

</html>