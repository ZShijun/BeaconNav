<?php if ($this->options->calendar == 'Show') : ?>
    <div id='calendar' class="d-none d-lg-block">
        <a id="solarDate" class="text-decoration-none" href="https://www.baidu.com/s?wd=%C8%D5%C0%FA" target="_blank" title="<?php _e('点击查看日历') ?>"></a>
        <div class="card bg-black bg-opacity-50 shadow">
            <div class="card-body">
                <div id="lunarDate" class="fs-3 text-center fw-bold"></div>
                <div class="row mt-2">
                    <div class="col-3 fw-bold"><?php _e('干支') ?></div>
                    <div id="ganzhi" class="col-9"></div>
                </div>
                <div class="row">
                    <div class="col-3 fw-bold"><?php _e('生肖') ?></div>
                    <div id="animal" class="col-9"></div>
                </div>
                <div class="row">
                    <div class="col-3 fw-bold"><?php _e('星座') ?></div>
                    <div id="astro" class="col-9"></div>
                </div>
                <div class="row">
                    <div class="col-3 fw-bold"><?php _e('节日') ?></div>
                    <div id="festival" class="col-9"></div>
                </div>
                <div class="row">
                    <div class="col-3 fw-bold"><?php _e('节气') ?></div>
                    <div id="term" class="col-9"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php $this->options->themeUrl('static/js/js-calendar-converter.js'); ?>"></script>
    <script>
        showCalendar();

        function showCalendar() {
            const lunar = calendar.solar2lunar();
            document.querySelector('#solarDate').textContent = `${lunar.cYear}年${lunar.cMonth}月${lunar.cDay}日 ${lunar.ncWeek}`;
            document.querySelector('#lunarDate').textContent = `${lunar.IMonthCn}${lunar.IDayCn}`;
            document.querySelector('#ganzhi').textContent = `${lunar.gzYear}年${lunar.gzMonth}月${lunar.gzDay}日`;
            document.querySelector('#animal').textContent = lunar.Animal;
            document.querySelector('#astro').textContent = lunar.astro;
            if (lunar.festival) {
                document.querySelector('#festival').textContent = lunar.festival;
            } else if (lunar.lunarFestival) {
                document.querySelector('#festival').textContent = lunar.lunarFestival;
            }

            if (lunar.isTerm) {
                document.querySelector('#term').textContent = lunar.Term;
            }
        }
    </script>
<?php endif; ?>