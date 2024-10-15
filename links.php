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
<main>
    <div class="container">
        <section class="position-relative">
            <article class="links p-3 mt-3 bg-white shadow rounded">
                <h4 class="text-dark pb-3 border-bottom"><?php $this->title() ?></h4>
                <?php $this->content(); ?>
            </article>
            <?php if ($this->allow('comment')) {
                $this->need('comments.php');
            } ?>
        </section>
    </div>
</main>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>