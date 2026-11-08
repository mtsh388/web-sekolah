@php
    use App\Models\RunningText;

    $runningTexts = RunningText::query()
        ->where('is_active', true)
        ->orderBy('urutan', 'asc')
        ->orderBy('id', 'asc')
        ->get();
@endphp

@if ($runningTexts->isNotEmpty())

    @php
        // Gunakan setting running text pertama sebagai setting utama bar.
        $firstRunningText = $runningTexts->first();

        $background = $firstRunningText->warna_background ?: '#0083b4';
        $textColor = $firstRunningText->warna_text ?: '#ffffff';

        // Semakin besar kecepatan, semakin cepat animasi.
        $speed = max(5, min(120, (int) $firstRunningText->kecepatan));

        // Konversi nilai kecepatan menjadi durasi animasi.
        $duration = max(8, 130 - $speed);
    @endphp

    <div
        class="running-text-wrapper"
        style="
            --running-bg: {{ $background }};
            --running-text: {{ $textColor }};
            --running-duration: {{ $duration }}s;
        "
    >

        {{-- Label --}}
        <div class="running-text-label">
            <i class="fas fa-bullhorn"></i>
        </div>

        {{-- Area running text --}}
        <div class="running-text-marquee">

            <div class="running-text-track">

                {{-- Konten pertama --}}
                <div class="running-text-items">

                    @foreach ($runningTexts as $runningText)

                        @if ($runningText->link)

                            <a
                                href="{{ $runningText->link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="running-text-item"
                            >
                                {{ $runningText->teks }}
                            </a>

                        @else

                            <span class="running-text-item">
                                {{ $runningText->teks }}
                            </span>

                        @endif

                        @if (!$loop->last)
                            <span class="running-text-separator">
                                <i class="fas fa-circle"></i>
                            </span>
                        @endif

                    @endforeach

                </div>

                {{-- Duplikat untuk membuat animasi seamless --}}
                <div class="running-text-items" aria-hidden="true">

                    @foreach ($runningTexts as $runningText)

                        @if ($runningText->link)

                            <a
                                href="{{ $runningText->link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="running-text-item"
                                tabindex="-1"
                            >
                                {{ $runningText->teks }}
                            </a>

                        @else

                            <span class="running-text-item">
                                {{ $runningText->teks }}
                            </span>

                        @endif

                        @if (!$loop->last)
                            <span class="running-text-separator">
                                <i class="fas fa-circle"></i>
                            </span>
                        @endif

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <style>
        .running-text-wrapper {
            width: 100%;
            height: 42px;
            display: flex;
            align-items: center;
            overflow: hidden;
            background-color: var(--running-bg);
            color: var(--running-text);
            position: relative;
            z-index: 1020;
        }

        .running-text-label {
            flex: 0 0 auto;
            width: 55px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.12);
            color: var(--running-text);
            font-size: 15px;
            position: relative;
            z-index: 2;
        }

        .running-text-marquee {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .running-text-track {
            display: flex;
            width: max-content;
            animation: runningTextAnimation var(--running-duration) linear infinite;
            will-change: transform;
        }

        .running-text-items {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .running-text-item {
            color: var(--running-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 0 25px;
            transition: opacity 0.2s ease;
        }

        .running-text-item:hover {
            color: var(--running-text);
            opacity: 0.75;
            text-decoration: underline;
        }

        .running-text-separator {
            color: var(--running-text);
            opacity: 0.6;
            font-size: 6px;
        }

        @keyframes runningTextAnimation {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 576px) {

            .running-text-wrapper {
                height: 38px;
            }

            .running-text-label {
                width: 45px;
                font-size: 13px;
            }

            .running-text-item {
                font-size: 12px;
                padding: 0 18px;
            }

            .running-text-separator {
                font-size: 5px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .running-text-track {
                animation: none;
            }
        }
    </style>

@endif
