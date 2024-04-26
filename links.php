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
            <h5 class="text-dark p-2 mb-0 border-bottom border-secondary"><?php $this->title() ?></h5>
            <?php $this->content(); ?>
        </article>
        <?php $this->need('comments.php'); ?>
    </div>
</section>

<?php $this->need('footer.php'); ?>