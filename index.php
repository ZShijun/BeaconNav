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
<!DOCTYPE html>
<html>
<?php $this->need('head.php'); ?>

<body>
    <div id="loader"></div>
    <div id="content">
        <?php $this->need('header.php'); ?>
        <?php $this->need('components/clock.php'); ?>
        <?php $this->need('components/search.php'); ?>
        <section>
            <div class="container">
                <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
                <ul class="nav nav-tabs mt-4 bg-opacity-50">
                    <li class="nav-item">
                        <a class="nav-link<?php if ($this->is('index')) : ?> active" aria-current="page" <?php else : ?>" <?php endif; ?> href="/"><?php _e('最新'); ?></a>
                    </li>
                    <?php while ($categories->next()) : ?>
                        <?php if ($categories->levels === 0) : ?>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($this->is('category', $categories->slug)) : ?> active" aria-current="page" <?php else : ?>" <?php endif; ?> href=" <?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>

                <div class="row">
                    <?php if ($this->have()) : ?>
                        <?php while ($this->next()) : ?>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 mt-3">
                                <div class="card shadow-sm">
                                    <a href="<?= $this->fields->url ?>" target="_blank" class="card-body d-flex flex-row align-items-center text-decoration-none">
                                        <img src="<?= websiteIcon($this) ?>" alt="<?php $this->title() ?>">
                                        <h5 class="card-title mx-3 mb-0 text-truncate"><?php $this->title() ?></h5>
                                    </a>
                                    <a href="<?php $this->permalink() ?>" class="card-link" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php _e('详情') ?>"><i class="iconfont icon-jinru"></i></a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php $this->need('footer.php'); ?>
    </div>
</body>

</html>