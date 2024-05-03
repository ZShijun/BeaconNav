<div id="loader">
    <?php
    $text = _t('数据加载中');

    for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) : ?>
        <span><?= mb_substr($text, $i, 1, 'UTF-8'); ?></span>
    <?php endfor; ?>
    <span>...</span>
</div>
<script>
    const content = document.querySelector("#content");
    const loader = document.querySelector("#loader");
    const loaderSpans = loader.children;
    for (let i = 0; i < loaderSpans.length; i++) {
        loaderSpans[i].style.animationDelay = i * 0.15 + 's';
    }

    const bgImgs = <?= $this->options->bgImgs; ?>;
    if (bgImgs.length > 0) {
        const bgImgUrl = bgImgs[Math.floor(Math.random() * bgImgs.length)];
        const img = new Image();
        img.src = bgImgUrl;
        img.addEventListener('load', () => {
            content.style.backgroundImage = "url(" + bgImgUrl + ")";
            content.style.display = "block";
            loader.classList.add("hidden");
        });
    } else {
        content.style.display = "block";
        loader.classList.add("hidden");
    }
</script>