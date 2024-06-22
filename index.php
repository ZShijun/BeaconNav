<?php

/**
 * 一款简洁的导航主题，你可以前往 <a href="https://nav.ilaozhu.com">老朱工具箱</a> 查看效果。
 *
 * @package BeaconNav
 * @author laozhu
 * @version 1.3.0
 * @link https://ilaozhu.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need('header.php'); ?>
<main>
    <div class="container">
        <?php if ($this->options->clock == 'Show') : ?>
            <section>
                <div class="clock d-flex justify-content-center text-white">
                    <span id="hour">00</span>
                    <span class="fw-bold px-2" style="font-size: 60px;">:</span>
                    <span id="minutes">00</span>
                    <span id="seconds" class="align-self-end mb-3 ms-2" style="font-size: 32px;">00</span>
                </div>
            </section>
            <script>
                (function updateClock() {
                    const now = new Date();
                    const h = now.getHours().toString().padStart(2, "0");
                    const m = now.getMinutes().toString().padStart(2, "0");
                    const s = now.getSeconds().toString().padStart(2, "0");
                    const hourEl = document.querySelector("#hour");
                    const minuteEl = document.querySelector("#minutes");
                    const secondEl = document.querySelector("#seconds");
                    if (hourEl) {
                        hourEl.innerText = h;
                    }
                    if (minuteEl) {
                        minuteEl.innerText = m;
                    }
                    if (secondEl) {
                        secondEl.innerText = s;
                    }
                    setTimeout(updateClock, 1000);
                })();
            </script>
        <?php endif; ?>
        <?php if (!empty($this->options->searchEngines)) :
            $allEngines = getAllSearchEngines();
        ?>
            <section>
                <div class="row justify-content-center mt-3">
                    <div class="col col-lg-10">
                        <div class="input-group input-group shadow">
                            <select id="search_engine" class="input-group-text text-start" style="outline: none;appearance: none;">
                                <?php foreach ($this->options->searchEngines as $engine) : ?>
                                    <option value="<?= $engine; ?>" <?php if ($engine === 'self') echo 'selected'; ?>>
                                        <?php echo $allEngines[$engine]['title']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input id="search_kw" type="search" class="form-control border-start-0" placeholder="<?php _e('输入搜索关键词...') ?>">
                            <button class="btn btn-dark" type="button" onclick="search()"><?php _e('搜索') ?></button>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                function search() {
                    const allEngines = <?= json_encode($allEngines); ?>;

                    var kw = document.querySelector("#search_kw").value;
                    var engine = document.querySelector("#search_engine").value;
                    if (!kw && engine == 'self') {
                        return;
                    }

                    var url = allEngines[engine].url + kw;
                    if (engine == 'self') {
                        location.href = url;
                    } else {
                        window.open(url);
                    }
                }
            </script>
        <?php endif; ?>
        <section>
            <ul class="position-relative nav nav-tabs mt-4 bg-opacity-50">
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
                        <a class="nav-link<?php if ($this->is('index')) : ?> active" aria-current="page" <?php else : ?>" <?php endif; ?> href="/">
                            <?php
                            if (\Typecho\Plugin::exists('LZStat') && $this->options->plugin('LZStat')->orderBy !== 'created') {
                                _e('热门');
                            } else {
                                _e('最新');
                            } ?>
                        </a>
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
            <div class="nav-list row">
                <?php if ($this->have()) : ?>
                    <?php while ($this->next()) : ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2 mt-3">
                            <div class="card shadow-sm">
                                <span class="position-absolute end-0 me-2">
                                    <i class="iconfont icon-favorite" style="font-size: 0.9rem;" title="<?php _e('本地收藏') ?>" data-cid="<?php $this->cid(); ?>" data-title="<?php $this->title() ?>" data-url="<?= $this->fields->url ?>" data-icon="<?= websiteIcon($this) ?>"></i>
                                </span>
                                <div data-href="<?= $this->fields->url ?>" onclick="window.open(this.dataset.href, '_blank');" class="card-body p-2 d-flex align-items-center">
                                    <img src="<?= websiteIcon($this) ?>" title="<?php $this->title() ?>" onerror="this.onerror=null; this.src='/usr/themes/BeaconNav/static/images/default-site-icon.png'" alt="<?php $this->title() ?>">
                                    <div class="ms-3 flex-grow-1 overflow-hidden d-flex flex-column align-items-start">
                                        <h5 class="card-title mb-0 mw-100 text-truncate align-self-start" title="<?php $this->title() ?>"><?php $this->title() ?></h5>
                                        <?php if (\Typecho\Plugin::exists('LZStat')) : ?>
                                            <div class="d-flex mt-1" style="font-size: 12px;">
                                                <p class="mb-0 me-2 d-flex align-items-center"><i class="set-likes iconfont icon-zan" title="<?php _e('赞一个') ?>" data-cid="<?php $this->cid(); ?>"></i><span class="get-likes ms-1" data-cid="<?php $this->cid(); ?>"><?php $this->likesNum(); ?></span></p>
                                                <p class="mb-0 d-flex align-items-center"><i class="iconfont icon-yanjing" title="<?php _e('浏览') ?>"></i><span class="ms-1"><?php $this->viewsNum(); ?></span></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php $this->permalink() ?>" onclick="event.stopPropagation();" class="card-link link-dark text-decoration-none" title="<?php _e('详情') ?>"><i class="iconfont icon-jinru"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>