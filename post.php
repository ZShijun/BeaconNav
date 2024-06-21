<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>
<main>
    <div class="container">
        <section class="position-relative">
            <article class="mt-3 p-3 bg-white shadow rounded" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="site-info">
                    <div class="site-ico">
                        <img class="bg" src="<?= websiteIcon($this); ?>">
                        <img class="icon" src="<?= websiteIcon($this); ?>" alt="<?php $this->title(); ?>">
                        <?php if (\Typecho\Plugin::exists('LZStat')) : ?>
                            <div class="stat">
                                <p><i class="set-likes iconfont icon-zan" data-cid="<?php $this->cid(); ?>"></i><span class="get-likes" data-cid="<?php $this->cid(); ?>"><?php $this->likesNum(); ?></span></p>
                                <p><i class="iconfont icon-yanjing"></i><span><?php $this->viewsNum(); ?></span></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="site-desc">
                        <h2><?php $this->title(); ?></h2>
                        <p><?php _e('分类'); ?>: <?php $this->category(' '); ?></p>
                        <p><?php _e('标签'); ?>: <?php $this->tags(' ', true, ''); ?></p>
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
        </section>
    </div>
    <script>
        (function() {
            if (typeof Storage !== "undefined") {
                const cid = "<?php $this->cid(); ?>";
                const key = "recently-used";
                const value = {
                    cid: cid,
                    title: "<?php $this->title(); ?>",
                    url: "<?php $this->fields->url(); ?>",
                    icon: "<?= websiteIcon($this); ?>"
                };
                const item = localStorage.getItem(key);
                if (item) {
                    const items = JSON.parse(item);
                    const index = items.findIndex(item => item.cid === cid);
                    if (index !== -1) {
                        items.splice(index, 1);
                    }
                    items.unshift(value);
                    if (items.length > 20) {
                        items.pop();
                    }
                    localStorage.setItem(key, JSON.stringify(items));
                } else {
                    localStorage.setItem(key, JSON.stringify([value]));
                }
            }

            new QRCode(document.querySelector('#qrcode'), {
                text: "<?php $this->fields->url(); ?>",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            })
        })();
    </script>
</main>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>