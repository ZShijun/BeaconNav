# BeaconNav

## 主题介绍

**BeaconNav**是基于`typecho`开发的一款导航主题，**Beacon**是灯塔的意思，希望使用者在知识的海洋里能够如同有**灯塔**指引一样目标明确，永远不会迷失方向。

![](https://cdn.jsdelivr.net/gh/ZShijun/BeaconNav/screenshot.jpg)

## 主题特点

- 响应式设计，适配手机、平板、电脑等设备；
- 支持自定义 LOGO、背景图片；
- 支持日历、时钟组件；
- 支持友情链接模板页；
- 支持点赞数、访问量统计，并支持按时间、点赞数、访问量、权重(约定为 100\*点赞数+访问量)自定义排序方式；
- 评论支持`emoji`表情等...

## 预览

预览站点：<https://nav.ilaozhu.com>

### 1. 列表页

![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240512/480230687f269145be4863c3b17b31ad.png)

### 2. 详情页

![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240512/f8cdef78767a7b52d64fc98fda5738d3.png)

## 主题安装

1. 下载主题压缩包，解压后放到`/usr/themes/`目录下，将文件夹命名为 `BeaconNav`，确保`index.php`文件直接在`BeaconNav`文件夹下；
2. 登录博客后台，进入`控制台`->`外观`，选择`BeaconNav`主题；
3. `启用`主题即可。

## 主题使用

### 1. 导航编辑

主题中主要包含`导航菜单`和`导航项`两个部分，其中，`导航菜单`是通过一级`分类`实现的，而`导航项`是通过`文章`实现的。因此，编辑时，只需要创建一级`分类`，并将`文章`分配到该分类下即可。
![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240505/27e6675718a2ea274265538d74d3ebe2.png)

值得注意的是，编辑`文章`时，会有`跳转链接`和`站点图标`两个设置项，其中`跳转链接`必须指定，而`站点图标`则为可选项，如果不填，则会自动获取目标站点根路径下的`favicon.ico`作为`站点图标`。
![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240505/34d76c7d4f3470041bc7b697de5a30ad.png)

### 2. 导航列表

为了保证界面的美观，主题去掉了翻页的按钮，因此，为了确保数据能够显示完整，需要到博客后台的`设置`->`阅读`下面，将`每页文章数目`设置大一些（如`50`或`100`等），然后保证每个`分类`下的`导航项`数量不超过这个值，后续可能会考虑实现滚动加载。
![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240505/e2a6413980c607ae911e435e2b77fca1.png)

### 3. 友情链接

主题中实现了一个友情链接模板页，可在添加友情链接`独立页面`时，在`自定义模板`中选择`友链页面`。
然后通过如下 `markdown` 语法来添加友情链接：

```
- ![站点名称1](站点图标1) [站点名称1](跳转链接1)
- ![站点名称2](站点图标2) [站点名称2](跳转链接2)
```

![](https://cdn.jsdelivr.net/gh/ZShijun/image-repo/20240505/f603994c51e2d64bf4f20a74174c8252.png)

### 4. 插件依赖

- [LZStat](https://github.com/ZShijun/LZStat)：主题中的点赞数、访问量统计，以及自定义排序是通过 `LZStat` 插件实现的，如果不需要这些功能，也可以不使用该插件。

## 发布协议

本主题采用 `GPL` 协议开源，您可以自由的修改、使用和传播，但请保留底部版权信息，以表示对作者的支持与尊重，谢谢！

## 关于作者

- 博客：<https://ilaozhu.com>
- 公众号：老朱独立开发

  ![老朱独立开发](https://cdn.jsdelivr.net/gh/ZShijun/BeaconNav/static/images/gzh.jpg)
