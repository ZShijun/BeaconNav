<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<section>
    <div class="container">
        <article class="mt-3 bg-light shadow rounded" itemscope itemtype="http://schema.org/BlogPosting">
            <h4 class="text-dark px-3 pt-3 d-flex justify-content-between">
                <span>
                    <?php $this->title() ?>
                </span>
                <?php if (\Typecho\Plugin::exists('LZStat')) : ?>
                    <div class="d-flex text-secondary ps-3 fs-6 fw-lighter align-items-center">
                        <p class="mb-0"><i class="iconfont icon-yanjing"></i><span class="ms-2"><?php $this->viewsNum(); ?></span></p>
                        <p class="mb-0 mx-3"><i class="set-likes iconfont icon-zan" data-cid="<?php $this->cid(); ?>"></i><span class="get-likes ms-2" data-cid="<?php $this->cid(); ?>"><?php $this->likesNum(); ?></span></p>
                        <p class="mb-0"><i class="iconfont icon-rili"></i><span class="ms-2"><?= date($this->options->postDateFormat, $this->created); ?></span></p>
                    </div>
                <?php endif; ?>
            </h4>

            <div class="article-content p-3" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        </article>
        <?php $this->need('comments.php'); ?>
    </div>
</section>
<?php $this->need('footer.php'); ?>