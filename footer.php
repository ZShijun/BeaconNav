<footer id="footer" class="position-absolute bottom-0 w-100 text-secondary text-center small">
    <p>
        &copy; <?php echo date('Y'); ?> All rights reserved.
        <?php if ($this->options->beian) : ?>
            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="http://beian.miit.gov.cn" target="_blank"><?php $this->options->beian() ?></a>
        <?php endif; ?>
        Powered by <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="http://typecho.org" target="_blank">Typecho</a>.
        Theme by <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="https://ilaozhu.com/archives/2067/" target="_blank">BeaconNav</a>.
    </p>
</footer><!-- end #footer -->
</div>

<div id="loader">
    <?php
    $text = _t('数据加载中');

    for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) : ?>
        <span><?= mb_substr($text, $i, 1, 'UTF-8'); ?></span>
    <?php endfor; ?>
    <span>...</span>
</div>
<script src="<?php $this->options->themeUrl('static/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('static/js/pjax.min.js'); ?>"></script>
<?php if ($this->options->particles == 'Show') : ?>
    <script src="<?php $this->options->themeUrl('static/js/particles.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('static/js/particles.config.js'); ?>"></script>
<?php endif; ?>
<?php $this->footer(); ?>
<?php
if ($this->options->footerJs) {
    $this->options->footerJs();
}
?>
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
            <?php if ($this->options->particles == 'Show') : ?>
                particlesJS('particles-js', particlesConfig);
            <?php endif; ?>
        });
    } else {
        content.style.display = "block";
        loader.classList.add("hidden");
    }

    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );

    const pjax = new Pjax({
        elements: "header a,main .nav-tabs a,main .nav-list a",
        selectors: ["title",
            "meta[charset]",
            "#content>header",
            "#content>main",
            "#content>footer"
        ],
    });

    document.addEventListener("pjax:send", () => {
        loader.classList.remove("hidden");
    });
    document.addEventListener("pjax:complete", (e) => {
        loader.classList.add("hidden");
    });

    window.addEventListener('click', function(e) {
        const emojiBox = document.querySelector('#emoji-box');
        const emojiBtn = document.querySelector('#emoji-btn');
        const emojiList = document.querySelector('#emoji-list');
        const textarea = document.querySelector('#textarea');
        if (emojiBtn && emojiBtn.contains(e.target)) {
            emojiList.classList.toggle('d-none');
        }

        if (emojiBox && !emojiBox.contains(e.target)) {
            emojiList.classList.add('d-none');
        }

        if (emojiList && emojiList.contains(e.target)) {
            const emoji = e.target.dataset.emoji;
            if (emoji) {
                textarea.value += emoji;
                emojiList.classList.add('d-none');
            }
        }
    });
</script>
</body>

</html>