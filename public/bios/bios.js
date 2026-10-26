/*
 * BIOS RS Tk. II dr. Soepraoen — perilaku bersama semua halaman.
 */
(function (window, $) {
    'use strict';

    var BIOS = window.BIOS = window.BIOS || {};
    var BULAN = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    /** Tanggal lokal (WIB) dalam format YYYY-MM-DD.
     *  Dulu memakai toISOString() yang berbasis UTC, sehingga pengiriman antara
     *  pukul 00.00–06.59 WIB tercatat mundur satu hari. */
    BIOS.localDate = function (d) {
        var m = d.getMonth() + 1, day = d.getDate();
        return d.getFullYear() + '-' + (m < 10 ? '0' : '') + m + '-' + (day < 10 ? '0' : '') + day;
    };

    BIOS.prettyDate = function (d) {
        return d.getDate() + ' ' + BULAN[d.getMonth()] + ' ' + d.getFullYear();
    };

    BIOS.num = function (n, digits) {
        return Number(n || 0).toLocaleString('id-ID', { maximumFractionDigits: digits == null ? 0 : digits });
    };

    // Tanggal transaksi yang dikirim formulir (H-1)
    var tx = new Date();
    tx.setDate(tx.getDate() - 1);
    $('[data-bios-txdate]').text(BIOS.prettyDate(tx));

    // ---------------------------------------------------------- Menu: cari
    var $filter = $('#bios-menu-filter');
    $filter.on('input', function () {
        var q = $.trim(this.value).toLowerCase();
        var $nav = $('.nav-sidebar');
        var found = 0;
        $nav.find('[data-menu-item]').each(function () {
            var hit = !q || $(this).text().toLowerCase().indexOf(q) !== -1;
            $(this).toggle(hit);
            if (hit) { found++; }
        });
        $nav.find('[data-menu-group]').each(function () {
            var $g = $(this);
            var label = $g.children('.nav-link').text().toLowerCase();
            var groupHit = q && label.indexOf(q) !== -1;
            if (groupHit) { $g.find('[data-menu-item]').show(); }
            var visible = !q || groupHit || $g.find('[data-menu-item]').filter(function () { return this.style.display !== 'none'; }).length > 0;
            $g.toggle(visible);
            if (q && visible) {
                $g.addClass('menu-open').children('.nav-treeview').show();
                found++;
            }
        });
        $nav.find('.nav-header').toggle(!q);
        $nav.children('.nav-item').not('[data-menu-group],[data-menu-item]').toggle(!q);
        $('.bios-menu-empty').prop('hidden', !q || found > 0);
    }).on('keydown', function (e) {
        if (e.key === 'Escape') { this.value = ''; $(this).trigger('input'); }
        if (e.key === 'Enter') {
            var $first = $('.nav-sidebar [data-menu-item]:visible a').first();
            if ($first.length) { window.location = $first.attr('href'); }
        }
    });
    // "/" untuk langsung mencari menu
    $(document).on('keydown', function (e) {
        if (e.key === '/' && !$(e.target).is('input, textarea, select') && $filter.length) {
            e.preventDefault();
            $('body').removeClass('sidebar-collapse');
            $filter.trigger('focus');
        }
    });

    // Gulirkan menu aktif ke dalam pandangan
    var $active = $('.nav-sidebar .nav-treeview .nav-link.active').first();
    if ($active.length) {
        var box = $('.main-sidebar .sidebar')[0];
        var top = $active[0].getBoundingClientRect().top - box.getBoundingClientRect().top;
        if (top > box.clientHeight - 80) { box.scrollTop = top - box.clientHeight / 2; }
    }

    // ------------------------------------------- Formulir: status mengirim
    var $submit = $('#btn-submit');
    var submitHtml = $submit.html();
    $(document).on('ajaxSend', function (e, xhr, opts) {
        if ($submit.length && String(opts.type).toUpperCase() === 'POST') {
            $submit.prop('disabled', true).addClass('is-busy')
                .html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Mengirim…');
        }
    }).on('ajaxComplete', function (e, xhr, opts) {
        if ($submit.length && String(opts.type).toUpperCase() === 'POST') {
            $submit.prop('disabled', false).removeClass('is-busy').html(submitHtml);
        }
    });

    // Kolom otomatis (diisi dari SIMRS): tampilkan status, bukan placeholder isian
    var $auto = $('form input:disabled').not('[type=hidden]');
    $auto.attr('placeholder', 'Memuat dari SIMRS…');
    $(document).on('ajaxComplete', function (e, xhr, opts) {
        if (String(opts.type).toUpperCase() !== 'GET') { return; }
        $auto.each(function () {
            if (this.value === '') {
                this.placeholder = xhr.status >= 400 || xhr.status === 0 ? 'Data SIMRS tidak bisa dimuat' : 'Belum ada data dari SIMRS';
            }
        });
    });

    // Kolom angka: jangan berubah karena scroll mouse
    $(document).on('wheel', 'input[type=number]', function () { this.blur(); });

    // ------------------------------------------------ SweetAlert: tema
    if (window.Swal && Swal.mixin) {
        var base = Swal.fire;
        Swal.fire = function () {
            var args = Array.prototype.slice.call(arguments);
            if (args.length === 1 && typeof args[0] === 'object') {
                args[0] = $.extend({ confirmButtonColor: '#14284b', cancelButtonColor: '#8a94a3' }, args[0]);
                delete args[0].buttons;
            }
            return base.apply(Swal, args);
        };
    }

    // ----------------------------------------------- Chart.js: gaya dasar
    BIOS.chartDefaults = function () {
        if (!window.Chart) { return; }
        var C = window.Chart;
        C.defaults.font.family = '"Public Sans", "Segoe UI", system-ui, sans-serif';
        C.defaults.font.size = 12;
        C.defaults.color = '#5f6b7a';
        C.defaults.borderColor = '#e7ebf1';
        C.defaults.plugins.legend.labels.boxWidth = 10;
        C.defaults.plugins.legend.labels.boxHeight = 10;
        C.defaults.plugins.tooltip.backgroundColor = '#14284b';
        C.defaults.plugins.tooltip.padding = 10;
        C.defaults.plugins.tooltip.cornerRadius = 6;
        C.defaults.maintainAspectRatio = false;
    };
})(window, jQuery);
