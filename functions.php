<?php

use Typecho\Common;

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
    );

    $form->addInput($logoUrl->addRule('url', _t('请填写一个合法的URL地址')));

    $calendar = new \Typecho\Widget\Helper\Form\Element\Radio(
        'calendar',
        [
            'Show'    => _t('显示'),
            'Hide'    => _t('隐藏')
        ],
        'Show',
        _t('日历')
    );
    $form->addInput($calendar);

    $clock = new \Typecho\Widget\Helper\Form\Element\Radio(
        'clock',
        [
            'Show'    => _t('显示'),
            'Hide'    => _t('隐藏')
        ],
        'Show',
        _t('时钟')
    );
    $form->addInput($clock);
    $searchEngines = getAllSearchEngines();
    $searchEngineTitles = [];

    foreach ($searchEngines as $key => $value) {
        $searchEngineTitles[$key] = $value['title'];
    }

    $search = new \Typecho\Widget\Helper\Form\Element\Checkbox(
        'searchEngines',
        $searchEngineTitles,
        ['self'],
        _t('搜索框'),
        _t('如果不需要显示搜索框，则全部不勾选即可')
    );
    $form->addInput($search);

    $bgImgs = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'bgImgs',
        null,
        '[
    "/usr/themes/BeaconNav/static/images/bg1.jpg",
    "/usr/themes/BeaconNav/static/images/bg2.jpg",
    "/usr/themes/BeaconNav/static/images/bg3.jpg",
    "/usr/themes/BeaconNav/static/images/bg4.jpg",
    "/usr/themes/BeaconNav/static/images/bg5.jpg"
]',
        _t('背景图片'),
        _t('可访问的图片地址，也可以是网络图片的全路径，[]表示不需要背景图片')
    );
    $form->addInput($bgImgs);

    $beian = new \Typecho\Widget\Helper\Form\Element\Text(
        'beian',
        null,
        null,
        _t('备案号'),
        _t('请填入形如"粤ICP备xxx号-1"的备案号')
    );
    $form->addInput($beian);
    $footerJs = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'footerJs',
        null,
        null,
        _t('底部JS'),
        _t('请填入包括script标签JS代码，主要是统计、广告等相关的代码')
    );
    $form->addInput($footerJs);
}

function themeFields($layout)
{
    if (preg_match("/write-post.php/", $_SERVER['REQUEST_URI'])) {
        $url = new \Typecho\Widget\Helper\Form\Element\Text(
            'url',
            null,
            null,
            _t('跳转链接'),
            _t('跳转链接URL，必填')
        );

        $icon = new \Typecho\Widget\Helper\Form\Element\Text(
            'icon',
            null,
            null,
            _t('站点图标'),
            _t('完整网络地址、本站附件地址或不填，如果不填，则获取目标站点根目录下的favicon.ico')
        );
        $layout->addItem($url);
        $layout->addItem($icon);
    }
}

function getAllSearchEngines()
{
    return [
        'self' => [
            'title' => _t('站内'),
            'url' => '/search/'
        ],
        'baidu' => [
            'title' => _t('百度'),
            'url' => 'https://www.baidu.com/s?ie=UTF-8&wd='
        ],
        'google' => [
            'title' => 'Google',
            'url' => 'https://www.google.com/search?q='

        ],
        'bing' => [
            'title' => _t('必应'),
            'url' => 'https://cn.bing.com/search?q='
        ],
        '360' => [
            'title' => '360',
            'url' => 'https://www.so.com/s?q='
        ],
        'weibo' => [
            'title' => _t('微博'),
            'url' => 'https://s.weibo.com/weibo?Refer=top&q='

        ],
        'github' => [
            'title' => 'GitHub',
            'url' => 'https://github.com/search?type=repositories&q='
        ]
    ];
}

function websiteIcon(Widget\Archive $archive)
{
    if (!($archive->fields->url)) {
        return '';
    } elseif ($archive->fields->icon) {
        return $archive->fields->icon;
    } else {
        return Common::url('/favicon.ico', $archive->fields->url);
    }
}

//获取Gravatar头像 QQ邮箱取用qq头像
function getGravatar($email, $s = 96, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
    preg_match_all('/((\d)*)@qq.com/', $email, $vai);
    if (empty($vai['1']['0'])) {
        $url = 'https://cdn.sep.cc/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
    } else {
        $url = 'https://q2.qlogo.cn/headimg_dl?dst_uin=' . $vai['1']['0'] . '&spec=100';
    }
    return $url;
}

function getEmojis()
{
    return [
        '😊', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '🙂', '🙃',
        '😉', '😇', '😏', '😌', '😍', '😘', '😗', '😙', '😚', '😋',
        '😛', '😜', '😝', '😒', '😔', '😖', '😞', '😟', '😠', '😡',
        '😳', '😨', '😰', '😥', '😢', '😭', '😱', '😲', '😵', '😷',
        '🤒', '🤕', '🤢', '😴', '🤤', '😪', '😫', '😬', '😮', '🤲',
        '🤜', '🤛', '🤚', '🤝', '🙏', '🤞', '🤟', '🤘', '🤙', '👌',
        '👍', '👎', '✊', '👊', '🤛', '🤜', '👏', '🙌', '👐', '🤲',
        '🤝', '🙏', '💪'
    ];
}
