<?php

use Typecho\Common;
use Typecho\Widget\Helper\Form\Element\Checkbox;
use Typecho\Widget\Helper\Form\Element\Radio;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Textarea;

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form)
{
    $faviconUrl = new Text(
        'faviconUrl',
        null,
        null,
        _t('站点图标'),
        _t('请填写站点图标地址, 如果不填则默认获取站点根路径的favicon.ico')
    );
    $form->addInput($faviconUrl);

    $logoUrl = new Text(
        'logoUrl',
        null,
        null,
        _t('网站LOGO'),
        _t('请填写网站 LOGO 地址, 如果填写则显示图片 LOGO ，不填则显示文本标题')
    );
    $form->addInput($logoUrl);

    $calendar = new Radio(
        'calendar',
        [
            'Show'    => _t('显示'),
            'Hide'    => _t('隐藏')
        ],
        'Show',
        _t('日历')
    );
    $form->addInput($calendar);

    $clock = new Radio(
        'clock',
        [
            'Show'    => _t('显示'),
            'Hide'    => _t('隐藏')
        ],
        'Show',
        _t('时钟')
    );
    $form->addInput($clock);

    $particles = new Radio(
        'particles',
        [
            'Show'    => _t('显示'),
            'Hide'    => _t('隐藏')
        ],
        'Show',
        _t('粒子特效')
    );
    $form->addInput($particles);

    $redirect = new Radio(
        'redirect',
        [
            0    => _t('禁用'),
            1    => _t('启用')
        ],
        0,
        _t('过渡页面'),
        _t('启用外链跳转过渡页面，主要用于安全声明，过渡页面设置了一个广告位，弥补了一下广告位太少的问题')
    );
    $form->addInput($redirect);

    $searchEngines = getAllSearchEngines();
    $searchEngineTitles = [];

    foreach ($searchEngines as $key => $value) {
        $searchEngineTitles[$key] = $value['title'];
    }

    $search = new Checkbox(
        'searchEngines',
        $searchEngineTitles,
        ['self'],
        _t('搜索框'),
        _t('如果不需要显示搜索框，则全部不勾选即可')
    );
    $form->addInput($search);

    $bgImgs = new Textarea(
        'bgImgs',
        null,
        '[
    "/usr/themes/BeaconNav/static/images/bg1.jpg",
    "/usr/themes/BeaconNav/static/images/bg2.jpg",
    "/usr/themes/BeaconNav/static/images/bg3.jpg",
    "/usr/themes/BeaconNav/static/images/bg4.jpg"
]',
        _t('背景图片'),
        _t('可访问的图片地址，也可以是网络图片的全路径，[]表示不需要背景图片')
    );
    $form->addInput($bgImgs);

    $beian = new Text(
        'beian',
        null,
        null,
        _t('备案号'),
        _t('请填入形如"粤ICP备xxx号-1"的备案号')
    );
    $form->addInput($beian);

    $googleAd = new Textarea(
        'googleAd',
        null,
        null,
        _t('谷歌广告'),
        _t('主题预设了Google AdSense广告位，不填则不显示广告，格式：{"publisher":"pub-xxx", "slot":"xxx", "redirect":"xxx"}，注意：由于SPA与Google Ads的兼容性存在问题，所以当使用Google Ads时，会禁用打开文章详情页的PJAX功能，需要牺牲一定的性能，请自行权衡')
    );
    $form->addInput($googleAd);

    $footerJs = new Textarea(
        'footerJs',
        null,
        null,
        _t('底部JS'),
        _t('请填入包括script标签JS代码，主要是统计、广告等相关的代码')
    );
    $form->addInput($footerJs);
}

/**
 * 显示广告
 * 
 * @param string $position 广告位置
 * slot: 文章页广告位
 * redirect:过渡页广告位
 * @param string $classes 广告容器类名
 */
function showGoogleAd($position, $classes = '')
{
    $googleAd = getGoogleAd();
    if ($googleAd['showAd'] && !empty($googleAd[$position])) {
        echo  <<<EOF
        <section class="rounded overflow-hidden {$classes}">
            <ins class="adsbygoogle" style="display:block;text-align:center;" data-ad-client="ca-{$googleAd['publisher']}" data-ad-slot="{$googleAd[$position]}" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </section>
        EOF;
    }
}

function getGoogleAd()
{
    static $settings = [];
    if (!empty($settings)) {
        return $settings;
    }

    $options = Typecho\Widget::widget(Widget\Options::class);
    if (empty($options->googleAd)) {
        $settings = [
            'showAd' => false
        ];
        return $settings;
    }

    $googleAd = json_decode($options->googleAd, true);
    if (!empty($googleAd) && !empty($googleAd['publisher']) && strpos($googleAd['publisher'], 'pub-') === 0) {
        $settings = [
            'showAd' => true,
            'publisher' => $googleAd['publisher'],
            'slot' => isset($googleAd['slot']) ? $googleAd['slot'] : '',
            'redirect' => isset($googleAd['redirect']) ? $googleAd['redirect'] : ''
        ];
    } else {
        $settings = [
            'showAd' => false
        ];
    }
    return $settings;
}

function themeFields($layout)
{
    if (preg_match("/write-post.php/", $_SERVER['REQUEST_URI'])) {
        $url = new Text(
            'url',
            null,
            null,
            _t('跳转链接'),
            _t('跳转链接URL，必填')
        );

        $icon = new Text(
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
        '😊',
        '😃',
        '😄',
        '😁',
        '😆',
        '😅',
        '😂',
        '🤣',
        '🙂',
        '🙃',
        '😉',
        '😇',
        '😏',
        '😌',
        '😍',
        '😘',
        '😗',
        '😙',
        '😚',
        '😋',
        '😛',
        '😜',
        '😝',
        '😒',
        '😔',
        '😖',
        '😞',
        '😟',
        '😠',
        '😡',
        '😳',
        '😨',
        '😰',
        '😥',
        '😢',
        '😭',
        '😱',
        '😲',
        '😵',
        '😷',
        '🤒',
        '🤕',
        '🤢',
        '😴',
        '🤤',
        '😪',
        '😫',
        '😬',
        '😮',
        '🤲',
        '🤜',
        '🤛',
        '🤚',
        '🤝',
        '🙏',
        '🤞',
        '🤟',
        '🤘',
        '🤙',
        '👌',
        '👍',
        '👎',
        '✊',
        '👊',
        '🤛',
        '🤜',
        '👏',
        '🙌',
        '👐',
        '🤲',
        '🤝',
        '🙏',
        '💪'
    ];
}

function getRedirectUrl($url)
{
    if (!$url) {
        return [
            'hasUrl' => false,
            'url' => ''
        ];
    }

    $options = Typecho\Widget::widget(Widget\Options::class);
    if (str_starts_with($url, $options->siteUrl) || $options->redirect != '1') {
        return [
            'hasUrl' => true,
            'url' => $url
        ];
    } else {
        return [
            'hasUrl' => true,
            'url' => $options->siteUrl . '?target=' . urlencode($url)
        ];
    }
}
