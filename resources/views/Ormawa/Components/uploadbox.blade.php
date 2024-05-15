<div class=" left-0 right-0 ml-4 md:ml-16 lg:ml-36 mt-4 md:mt-16 lg:16 ">
    <div class="w-full max-w-screen-lg">
        <div
            class="w-5/6 md:w-2/5 lg:w-9/12 h-auto bg-customWhite border border-customBlue rounded-md mx-auto shadow-xl">
            <p class="ml-2 mt-1 text-base md:text-lg">Unggah dan tambahkan file</p>
            <p class="ml-2 mt-1 text-sm md:text-base">{{ $proposal }}</p>
            <div
                class="w-10/12 h-32 md:h-36 lg:h-40 mt-4 bg-customWhite border-dashed border-2 border-customBlack rounded-md mx-auto flex flex-col items-center justify-center">
                <label for="{{ $inputId }}" class="cursor-pointer flex flex-col items-center">
                    <i class="fas fa-file-alt fa-4x md:fa-5x lg:fa-6x text-customBlack mb-2"></i>
                    <p class="text-xs md:text-sm lg:text-base text-customBlack">Klik untuk Unggah atau seret dan lepas
                    </p>
                    <p class="text-xs md:text-sm lg:text-base text-customBlack">Ukuran maksimal file 5 MB</p>
                </label>
                <input id="{{ $inputId }}" name="{{ $inputId }}"type="file" class="hidden" />
            </div>
            <div id={{ $loadingId }}
                class="mt-4 mb-4 w-10/12 h-14 md:h-16 lg:h-20 rounded-md bg-white border border-customBlack opacity-75 mx-auto flex flex-row items-center justify-center relative">
                <i class="fas fa-file-alt fa-2x md:fa-3x lg:fa-4x text-customBlack ml-2 md:ml-4"></i>
                <div class="flex flex-col items-start justify-center ml-2 md:ml-4 w-3/4">
                    <p class="text-xs md:text-base lg:text-lg font-bold">{{ $proposal }}</p>
                    <span id="{{ $fileSizeId }}" class="text-xxs md:text-xs lg:text-sm text-customBlack">Size :</span>
                    <progress id="{{ $progressBarId }}" value="0" max="100"
                        class="w-full h-1 md:h-2 lg:h-3 rounded-lg"></progress>
                </div>
                <div class="mr-2 flex flex-col items-end">
                    <i id="{{ $cancelBtnId }}"
                        class="fa-solid fa-x fa-xs md:fa-1x lg:fa-2x mb-1 md:mb-2 ml-6 md:ml-10"></i>
                    <span id="{{ $percentageId }}"
                        class="text-xxs md:text-xs lg:text-sm text-customBlack mt-1 md:mt-3 ml-4 md:ml-6">0%</span>
                </div>
            </div>
        </div>
    </div>
</div>
