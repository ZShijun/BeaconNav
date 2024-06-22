<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<aside id="sidebar">
    <div class="recently-used bg-black bg-opacity-75 shadow rounded-end">
        <span class="title text-white bg-black bg-opacity-75 shadow rounded-end">
            <?php _e('最近') ?>
        </span>
        <div class="body">
            <p class="text-white flex-fill mt-5 text-center"><?php _e('暂无数据...') ?></p>
        </div>
    </div>
    <div class="favorite-used bg-black bg-opacity-75 shadow rounded-end">
        <span class="title text-white bg-black bg-opacity-75 shadow rounded-end">
            <?php _e('收藏') ?>
        </span>
        <div class="body overflow-auto">
            <p class="text-white flex-fill mt-5 text-center"><?php _e('暂无数据...') ?></p>
        </div>
    </div>
</aside>