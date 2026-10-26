@php($biosPage = \App\Support\BiosMenu::current())
<header class="bios-pagehead">
    <div class="container-fluid">
        @if (!empty($biosPage['group_label']))
            <p class="bios-eyebrow">{{ $biosPage['group_label'] }}</p>
        @elseif (!empty($eyebrow))
            <p class="bios-eyebrow">{{ $eyebrow }}</p>
        @endif
        <div class="bios-pagehead-row">
            <h1>{{ $title }}</h1>
            @if (!empty($freq))
                <span class="bios-freq" title="Periode pengiriman data">
                    <i class="fas fa-sync-alt" aria-hidden="true"></i> {{ $freq }}
                </span>
            @endif
        </div>
        @if (!empty($lead))
            <p class="bios-lead">{{ $lead }}</p>
        @endif
    </div>
</header>
