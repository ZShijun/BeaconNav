<?php

/**
 * 一款简洁的导航主题，由老朱拼凑而成，你可以前往<a href="https://nav.ilaozhu.com">独立开发者导航</a>查看效果。
 *
 * @package BeaconNav
 * @author laozhu
 * @version 1.0
 * @link https://ilaozhu.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/index.css'); ?>">
<?php $this->need('components/clock.php'); ?>
<?php $this->need('components/search.php'); ?>
<section>
    <div class="container">
        <ul class="nav nav-tabs mt-4 bg-opacity-50">
            <?php if ($this->is('search') or $this->is('tag')) : ?>
                <li class="nav-item">
                    <span class="bg-white bg-opacity-25 d-inline-block rounded-top p-2 border border-bottom-0">
                        <?php $this->archiveTitle([
                            'search'   => _t('包含关键字 <strong>%s</strong> 的导航'),
                            'tag'      => _t('标签 <strong>%s</strong> 下的导航')
                        ], '', ''); ?>
                    </span>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link<?php if ($this->is('index')) : ?> active" aria-current="page" <?php else : ?>" <?php endif; ?> href="/"><?php _e('全部'); ?></a>
                </li>
                <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
                <?php while ($categories->next()) : ?>
                    <?php if ($categories->levels === 0) : ?>
                        <li class="nav-item">
                            <a class="nav-link<?php if ($this->is('category', $categories->slug)) : ?> active" aria-current="page" <?php else : ?>" <?php endif; ?> href=" <?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
        <div class="row">
            <?php if ($this->have()) : ?>
                <?php while ($this->next()) : ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 mt-3">
                        <div class="card shadow-sm">
                            <div data-href="<?= $this->fields->url ?>" onclick="window.open(this.dataset.href, '_blank');" class="set-views card-body p-2 d-flex align-items-center" data-cid="<?php $this->cid() ?>">
                                <img src="<?= websiteIcon($this) ?>" alt="<?php $this->title() ?>">
                                <div class="ms-3 flex-grow-1">
                                    <h5 class="card-title mb-0 text-truncate" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php $this->title() ?>"><?php $this->title() ?></h5>
                                    <?php if (isset($this->options->plugins['activated']['LZStat'])) : ?>
                                        <div class="d-flex mt-1" style="font-size: 12px;">
                                            <p class="mb-0 me-2 d-flex align-items-center"><i class="set-likes iconfont icon-zan" data-cid="<?php $this->cid(); ?>"></i><span class="get-likes ms-1" data-cid="<?php $this->cid(); ?>"><?php $this->likesNum(); ?></span></p>
                                            <p class="mb-0 d-flex align-items-center"><i class="iconfont icon-yanjing"></i><span class="ms-1"><?php $this->viewsNum(); ?></span></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php $this->permalink() ?>" onclick="event.stopPropagation();" class="card-link link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php _e('详情') ?>"><i class="iconfont icon-jinru"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $this->need('footer.php'); ?>