<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>
<?php $this->need('head.php'); ?>

<body>
    <div id="loader"></div>
    <div id="content">
        <?php $this->need('header.php'); ?>
        <section>
            <h2>404 - <?php _e('页面没找到'); ?></h2>
            <p><?php _e('抱歉，没有找到你要的内容...'); ?></p>
            <div>
                <a class="btn btn-danger" href="/"><?php _e('返回首页'); ?></a>
            </div>
        </section>
        <?php $this->need('footer.php'); ?>
    </div>
</body>

</html>