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
<?php $this->need('components/loader.php'); ?>
<script src="<?php $this->options->themeUrl('static/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
<?php $this->footer(); ?>
<?php
if ($this->options->footerJs) {
    $this->options->footerJs();
}
?>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>

</html>