<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<aside id="sidebar">
    <div class="recently-used bg-black bg-opacity-75 shadow rounded-end">
        <span class="title text-white bg-black bg-opacity-75 shadow rounded-end">
            <?php _e('最近') ?>
        </span>
        <div class="body">
            <p class="text-white flex-fill mt-5 text-center"><?php _e('暂无数据...') ?></p>
        </div>
        <span class="tips" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php _e("该功能基于浏览器的LocalStorage实现，服务器不记录相关数据，不支持跨设备或浏览器共享!") ?>">?</span>
    </div>
    <div class="favorite-used bg-black bg-opacity-75 shadow rounded-end">
        <span class="title text-white bg-black bg-opacity-75 shadow rounded-end">
            <?php _e('收藏') ?>
        </span>
        <div class="body overflow-auto">
            <p class="text-white flex-fill mt-5 text-center"><?php _e('暂无数据...') ?></p>
        </div>
        <span class="tips" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php _e("该功能基于浏览器的LocalStorage实现，服务器不记录相关数据，不支持跨设备或浏览器共享!") ?>">?</span>
    </div>
</aside>