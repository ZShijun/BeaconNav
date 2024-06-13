<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $this->archiveTitle('', '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->options->faviconUrl) : ?>
    <link rel="icon" href="<?php $this->options->faviconUrl(); ?>" />
<?php endif; ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/bootstrap/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/iconfont/iconfont.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/common.css'); ?>">
<script src="<?php $this->options->themeUrl('static/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('static/js/qrcode.min.js'); ?>"></script>
<!-- 通过自有函数输出HTML头部信息 -->
<?php $this->header(); ?>

<body style="min-width: 360px;">
    <div id="content">
        <?php if ($this->options->particles == 'Show') : ?>
            <div id="particles-js" class="position-absolute top-0 start-0 end-0" style="bottom: 0.5rem;"></div>
        <?php endif; ?>
        <header class="navbar navbar-expand-lg sticky-top bg-black bg-opacity-50 shadow" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title() ?>">
                    <?php if ($this->options->logoUrl) : ?>
                        <img height="32" src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
                    <?php else : ?>
                        <?php $this->options->title() ?>
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="topNavBar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
                        <?php while ($pages->next()) : ?>
                            <li class="nav-item">
                                <?php if ($this->is('page', $pages->slug)) : ?>
                                    <a class="nav-link active" aria-current="page" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                                <?php else : ?>
                                    <a class="nav-link" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php if ($this->options->calendar == 'Show') : ?>
                    <div id='calendar' class="d-none d-lg-block">
                        <a id="solarDate" class="text-decoration-none" href="https://www.baidu.com/s?wd=%C8%D5%C0%FA" target="_blank" title="<?php _e('点击查看日历') ?>"></a>
                        <div class="card bg-black bg-opacity-50 shadow">
                            <div class="card-body">
                                <div id="lunarDate" class="fs-3 text-center fw-bold"></div>
                                <div class="row mt-2">
                                    <div class="col-3 fw-bold"><?php _e('干支') ?></div>
                                    <div id="ganzhi" class="col-9"></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 fw-bold"><?php _e('生肖') ?></div>
                                    <div id="animal" class="col-9"></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 fw-bold"><?php _e('星座') ?></div>
                                    <div id="astro" class="col-9"></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 fw-bold"><?php _e('节日') ?></div>
                                    <div id="festival" class="col-9"></div>
                                </div>
                                <div class="row">
                                    <div class="col-3 fw-bold"><?php _e('节气') ?></div>
                                    <div id="term" class="col-9"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="<?php $this->options->themeUrl('static/js/js-calendar-converter.js'); ?>"></script>
                    <script>
                        showCalendar();

                        function showCalendar() {
                            const lunar = calendar.solar2lunar();
                            document.querySelector('#solarDate').textContent = `${lunar.cYear}年${lunar.cMonth}月${lunar.cDay}日 ${lunar.ncWeek}`;
                            document.querySelector('#lunarDate').textContent = `${lunar.IMonthCn}${lunar.IDayCn}`;
                            document.querySelector('#ganzhi').textContent = `${lunar.gzYear}年${lunar.gzMonth}月${lunar.gzDay}日`;
                            document.querySelector('#animal').textContent = lunar.Animal;
                            document.querySelector('#astro').textContent = lunar.astro;
                            if (lunar.festival) {
                                document.querySelector('#festival').textContent = lunar.festival;
                            } else if (lunar.lunarFestival) {
                                document.querySelector('#festival').textContent = lunar.lunarFestival;
                            }

                            if (lunar.isTerm) {
                                document.querySelector('#term').textContent = lunar.Term;
                            }
                        }
                    </script>
                <?php endif; ?>
            </div>
        </header>