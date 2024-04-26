<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/post.css'); ?>">
<section>
    <div class="container">
        <article class="mt-3 p-3 bg-light shadow rounded" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="site-info">
                <div class="site-ico">
                    <img class="bg" src="<?= websiteIcon($this); ?>">
                    <img class="icon" src="<?= websiteIcon($this); ?>" alt="<?php $this->title(); ?>">
                    <div class="stat">
                        <p><i class="iconfont icon-zan"></i><span>1</span></p>
                        <p><i class="iconfont icon-yanjing"></i><span>4.9K</span></p>
                    </div>
                </div>
                <div class="site-desc">
                    <h2><?php $this->title(); ?></h2>
                    <p><?php _e('分类'); ?>: <?php $this->category(','); ?></p>
                    <p><?php _e('标签'); ?>: <?php $this->tags(', ', true, ''); ?></p>
                    <p><?php _e('时间'); ?>: <?php $this->date(); ?></p>
                    <div>
                        <a class="btn" href="<?php $this->fields->url(); ?>" title="<?php $this->title(); ?>" target="_blank"><?php _e('链接直达'); ?> <i class="iconfont icon-arrow-r-m"></i></a>
                        <span class="btn">
                            <?php _e('手机查看'); ?>
                            <i class="iconfont icon-qr-sweep"></i>
                            <div id="qrcode" class="qrcode"></div>
                        </span>

                    </div>
                </div>
            </div>
            <div class="article-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        </article>

        <?php $this->need('comments.php'); ?>
    </div>
</section>
<?php $this->need('footer.php'); ?>
<script src="<?php $this->options->themeUrl('static/js/qrcode.min.js'); ?>"></script>
<script>
    new QRCode(document.querySelector('#qrcode'), {
        text: "<?php $this->fields->url(); ?>",
        width: 128,
        height: 128,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    })
</script>