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
    $beian = new \Typecho\Widget\Helper\Form\Element\Text(
        'beian',
        null,
        null,
        _t('备案号'),
        _t('请填入形如"粤ICP备xxx号-1"的备案号')
    );
    $form->addInput($beian);

    $statJs = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'statJs',
        null,
        null,
        _t('网站统计'),
        _t('请填入包括script标签的统计代码')
    );
    $form->addInput($statJs);

    $adJs = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'adJs',
        null,
        null,
        _t('广告'),
        _t('请填入包括script标签的广告代码')
    );
    $form->addInput($adJs);
}

function postMeta(
    Widget\Archive $archive,
    string $metaType = 'archive'
) {
    $titleTag = $metaType == 'archive' ? 'h2' : 'h1';
?>
    <<?php echo $titleTag ?> class="post-title" itemprop="name headline">
        <a itemprop="url" href="<?php $archive->permalink() ?>"><?php $archive->title() ?></a>
    </<?php echo $titleTag ?>>
    <?php if ($metaType != 'page') : ?>
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person">
                <?php _e('作者'); ?>: <a itemprop="name" href="<?php $archive->author->permalink(); ?>" rel="author"><?php $archive->author(); ?></a>
            </li>
            <li><?php _e('时间'); ?>:
                <time datetime="<?php $archive->date('c'); ?>" itemprop="datePublished"><?php $archive->date(); ?></time>
            </li>
            <li><?php _e('分类'); ?>: <?php $archive->category(','); ?></li>
            <?php if ($metaType == 'archive') : ?>
                <li itemprop="interactionCount">
                    <a itemprop="discussionUrl" href="<?php $archive->permalink() ?>#comments"><?php $archive->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
<?php
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
            _t('完整网络地址、本站附件地址或不填，如果不填，则获取源站点根目录下的favicon.ico')
        );
        $layout->addItem($url);
        $layout->addItem($icon);
    }
}

function randomBgImage($themeUrl)
{
    $imageDir =  __DIR__ . DIRECTORY_SEPARATOR . 'static/images';
    $allImages = scandir($imageDir);
    $bgPattern = '/^bg\d{1,2}\./i';
    $bgs = preg_grep($bgPattern, $allImages);
    if (empty($bgs)) {
        return '';
    } else {
        return Typecho\Common::url('./static/images/' . $bgs[array_rand($bgs)], $themeUrl);
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
