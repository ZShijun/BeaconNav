<?php
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
                <article class="mt-3 bg-light shadow rounded" itemscope itemtype="http://schema.org/BlogPosting">
                    <h5 class="text-dark p-2 mb-0 border-bottom border-secondary"><?php $this->title() ?></h5>
                    <div class="post-content p-2" itemprop="articleBody">
                        <?php $this->content(); ?>
                    </div>
                </article>
                <?php $this->need('comments.php'); ?>
            </div>
        </section>
        <?php $this->need('footer.php'); ?>
    </div>
</body>

</html>