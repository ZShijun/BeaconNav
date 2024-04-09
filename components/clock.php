<?php if ($this->options->clock == 'Show') : ?>
    <section>
        <div class="container">
            <div class="clock d-flex justify-content-center text-white">
                <span id="hour">00</span>
                <span class="fw-bold px-2" style="font-size: 60px;">:</span>
                <span id="minutes">00</span>
                <span id="seconds" class="align-self-end mb-3 ms-2" style="font-size: 32px;">00</span>
            </div>
        </div>
        <script>
            const hourEl = document.querySelector("#hour");
            const minuteEl = document.querySelector("#minutes");
            const secondEl = document.querySelector("#seconds");
            updateClock();

            function updateClock() {
                const now = new Date();
                const h = now.getHours().toString().padStart(2, "0");
                const m = now.getMinutes().toString().padStart(2, "0");
                const s = now.getSeconds().toString().padStart(2, "0");

                hourEl.innerText = h;
                minuteEl.innerText = m;
                secondEl.innerText = s;
                setTimeout(updateClock, 1000);
            }
        </script>
    </section>
<?php endif; ?>