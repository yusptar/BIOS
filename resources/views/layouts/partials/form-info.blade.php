<aside class="card bios-card bios-info" aria-labelledby="bios-info-title">
    <div class="bios-card-head">
        <h2 id="bios-info-title"><i class="fas fa-info-circle" aria-hidden="true"></i> Ketentuan data</h2>
    </div>
    <div class="bios-card-body">
        @if (!empty($notes))
            <ul class="bios-notes">
                @foreach ($notes as $note)
                    <li>{{ $note }}</li>
                @endforeach
            </ul>
        @endif
        <dl class="bios-facts">
            <div>
                <dt>Tanggal transaksi</dt>
                <dd><span data-bios-txdate>—</span> <small>(otomatis H-1)</small></dd>
            </div>
            @if (!empty($auto))
                <div>
                    <dt>Kolom otomatis</dt>
                    <dd>Kolom bertanda <span class="bios-tag-auto">SIMRS</span> diisi dari database SIMRS dan tidak bisa diubah.</dd>
                </div>
            @endif
        </dl>
    </div>
</aside>
