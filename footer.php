<footer id="footer" class="position-absolute bottom-0 w-100 text-secondary text-center">
    <p>
        &copy; <?php echo date('Y'); ?> All rights reserved.
        <?php if ($this->options->beian) : ?>
            <a class="text-decoration-none" href="http://beian.miit.gov.cn" target="_blank"><?php $this->options->beian() ?></a>
        <?php endif; ?>
        Powered by <a class="text-decoration-none" href="http://typecho.org" target="_blank">Typecho</a>.
        Theme by <a class="text-decoration-none" href="https://ilaozhu.com" target="_blank">BeaconNav</a>.
    </p>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
if ($this->options->adJs) {
    $this->options->adJs();
}
if ($this->options->statJs) {
    $this->options->statJs();
}
?>
<script>
    // 加载背景图
    const bgImgUrl = "<?= randomBgImage($this->options->themeUrl); ?>";
    loadBgImage(bgImgUrl);
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    function loadBgImage(url) {
        const loader = document.querySelector("#loader");
        const content = document.querySelector("#content");
        const img = new Image();
        img.src = url;
        img.onload = () => {
            content.style.backgroundImage = "url(" + url + ")";
            content.style.display = "block";
            loader.classList.add("hidden");
        };
    }
</script>