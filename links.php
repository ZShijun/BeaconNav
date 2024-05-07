<?php

/**
 * 友链页面
 *
 * @package custom
 *
 **/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/links.css'); ?>">
<section>
    <div class="container">
        <article class="links mt-3 bg-light shadow rounded">
            <h4 class="text-dark px-3 pt-3"><?php $this->title() ?></h4>
            <?php $this->content(); ?>
        </article>
        <?php $this->need('comments.php'); ?>
    </div>
</section>

<?php $this->need('footer.php'); ?>