<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $this->archiveTitle('', '', ' - '); ?><?php $this->options->title(); ?></title>

<link rel="stylesheet" href="<?php $this->options->themeUrl('static/bootstrap/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/iconfont/iconfont.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/common.css'); ?>">
<!-- 通过自有函数输出HTML头部信息 -->
<?php $this->header(); ?>

<body>
    <div id="content">
        <header class="navbar navbar-expand-lg sticky-top bg-black bg-opacity-50 shadow" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title() ?>">
                    <?php if (!empty($this->options->logoUrl)) : ?>
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
                <?php $this->need('components/calendar.php'); ?>
            </div>
        </header>