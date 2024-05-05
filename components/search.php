<?php if (!empty($this->options->searchEngines)) :
    $allEngines = getAllSearchEngines();
?>
    <section>
        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col col-lg-10">
                    <div class="input-group input-group shadow">
                        <select id="search_engine" class="input-group-text text-start" style="outline: none;appearance: none;">
                            <?php foreach ($this->options->searchEngines as $engine) : ?>
                                <option value="<?= $engine; ?>" <?php if ($engine === 'self') echo 'selected'; ?>>
                                    <?php echo $allEngines[$engine]['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input id="search_kw" type="search" class="form-control border-start-0" placeholder="<?php _e('输入搜索关键词...') ?>">
                        <button class="btn btn-dark" type="button" onclick="search()"><?php _e('搜索') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function search() {
                const allEngines = <?= json_encode($allEngines); ?>;

                var kw = document.querySelector("#search_kw").value;
                var engine = document.querySelector("#search_engine").value;
                if (!kw && engine == 'self') {
                    return;
                }

                var url = allEngines[engine].url + kw;
                if (engine == 'self') {
                    location.href = url;
                } else {
                    window.open(url);
                }
            }
        </script>
    </section>
<?php endif; ?>