@php
    $states = [
        [
            'state' => 'Belum Unggah',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Menunggu',
            'isSelected' => true,
            'isLast' => false,
        ],
        [
            'state' => 'Revisi Pembina',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Telah Direvisi',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Disetujui Pembina',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Revisi Kemahasiswaan',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Telah Direvisi',
            'isSelected' => false,
            'isLast' => false,
        ],
        [
            'state' => 'Disetujui',
            'isSelected' => false,
            'isLast' => true,
        ],
    ];
@endphp

<div class="mt-6 md:mt-0 flex flex-row justify-center pt-4">
    @foreach ($states as $item)
        <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
            <div class="flex flex-row items-center">
                <div
                    class="w-6 md:w-10 lg:w-14 h-6 md:h-10 lg:h-14 {{ $item['isSelected'] ? 'bg-blue-600' : 'bg-gray-400' }} rounded-full flex items-center justify-center">
                    @if ($item['state'] == 'Belum Unggah')
                        <i class="fas fa-upload text-white text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Menunggu')
                        <i class="fas fa-clock text-white text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Revisi Pembina')
                        <i class="fas fa-pencil-alt text-white text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Telah Direvisi')
                        <i class="fa-solid fa-check text-customWhite text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Disetujui Pembina')
                        <i class="fa-solid fa-check-double text-customWhite text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Revisi Kemahasiswaan')
                        <i class="fas fa-pencil-alt text-customWhite text-lg md:text-2xl lg:text-3xl"></i>
                    @elseif ($item['state'] == 'Disetujui')
                        <i class="fa-solid fa-check-double text-customWhite text-lg md:text-2xl lg:text-3xl"></i>
                    @endif
                </div>
                @if (!$item['isLast'])
                    <div
                        class="w-4 md:w-20 lg:w-20 h-1 md:h-2 mx-1 {{ $item['isSelected'] ? 'bg-blue-600' : 'bg-gray-400' }}">
                    </div>
                @endif
            </div>
            <p
                class="max-lg:hidden w-14 text-center text-sm md:text-base {{ $item['isSelected'] ? 'text-customBlue' : 'text-customBlack' }}">
                {{ $item['state'] }}
            </p>
        </div>
    @endforeach
</div>
