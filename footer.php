<footer id="footer" class="position-absolute bottom-0 w-100 text-secondary fs-6 text-center">
    <p>
        &copy; <?php echo date('Y'); ?> All rights reserved.
        <?php if ($this->options->beian) : ?>
            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="http://beian.miit.gov.cn" target="_blank"><?php $this->options->beian() ?></a>
        <?php endif; ?>
        Powered by <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="http://typecho.org" target="_blank">Typecho</a>.
        Theme by <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="https://ilaozhu.com" target="_blank">BeaconNav</a>.
    </p>
</footer><!-- end #footer -->
</div>
<?php $this->footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
if ($this->options->footerJs) {
    $this->options->footerJs();
}
?>
<script>
    const bgImgs = <?= $this->options->bgImgs; ?>;
    const loader = document.querySelector("#loader");
    if (bgImgs.length > 0) {
        const bgImgUrl = bgImgs[Math.floor(Math.random() * bgImgs.length)];
        const content = document.querySelector("#content");
        const img = new Image();
        img.src = bgImgUrl;
        img.onload = () => {
            content.style.backgroundImage = "url(" + bgImgUrl + ")";
            content.style.display = "block";
            loader.classList.add("hidden");
        };
    } else {
        content.style.display = "block";
        loader.classList.add("hidden");
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>

</html>