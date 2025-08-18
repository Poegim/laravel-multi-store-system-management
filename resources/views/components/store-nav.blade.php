<div class="shadow px-3 bg-white">
    <div class="mx-auto">
        <div class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
                <div class="flex space-x-2 bg-white dark:bg-slate-800 px-2 rounded">
                    <a href="{{ route('sale.create', $storeId) }}" 
                       class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group">

                        <svg class="store-dashboard-icon fill-amber-500 dark:fill-amber-400"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>

                        <span class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                            {{ __('New sale') }}
                        </span>
                    </a>

                    <a href="{{route('sale.index')}}" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group">
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-amber-500 dark:fill-amber-400" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M60.5,21h-27c-4.687,0-8.5-3.813-8.5-8.5S28.813,4,33.5,4h27c4.687,0,8.5,3.813,8.5,8.5S65.187,21,60.5,21z M33.5,8 c-2.481,0-4.5,2.019-4.5,4.5s2.019,4.5,4.5,4.5h27c2.481,0,4.5-2.019,4.5-4.5S62.981,8,60.5,8H33.5z"></path> </g> <g> <path d="M60.5,68h-27c-4.687,0-8.5-3.813-8.5-8.5s3.813-8.5,8.5-8.5h27c4.687,0,8.5,3.813,8.5,8.5S65.187,68,60.5,68z M33.5,55 c-2.481,0-4.5,2.019-4.5,4.5s2.019,4.5,4.5,4.5h27c2.481,0,4.5-2.019,4.5-4.5S62.981,55,60.5,55H33.5z"></path> </g> <g> <path d="M60.5,45h-27c-4.687,0-8.5-3.813-8.5-8.5s3.813-8.5,8.5-8.5h27c4.687,0,8.5,3.813,8.5,8.5S65.187,45,60.5,45z M33.5,32 c-2.481,0-4.5,2.019-4.5,4.5s2.019,4.5,4.5,4.5h27c2.481,0,4.5-2.019,4.5-4.5S62.981,32,60.5,32H33.5z"></path> </g> </g> <g> <g> <path d="M12.5,21h-1C6.813,21,3,17.187,3,12.5S6.813,4,11.5,4h1c4.687,0,8.5,3.813,8.5,8.5S17.187,21,12.5,21z M11.5,8 C9.019,8,7,10.019,7,12.5S9.019,17,11.5,17h1c2.481,0,4.5-2.019,4.5-4.5S14.981,8,12.5,8H11.5z"></path> </g> <g> <path d="M12.5,68h-1C6.813,68,3,64.187,3,59.5S6.813,51,11.5,51h1c4.687,0,8.5,3.813,8.5,8.5S17.187,68,12.5,68z M11.5,55 C9.019,55,7,57.019,7,59.5S9.019,64,11.5,64h1c2.481,0,4.5-2.019,4.5-4.5S14.981,55,12.5,55H11.5z"></path> </g> <g> <path d="M12.5,45h-1C6.813,45,3,41.187,3,36.5S6.813,28,11.5,28h1c4.687,0,8.5,3.813,8.5,8.5S17.187,45,12.5,45z M11.5,32 C9.019,32,7,34.019,7,36.5S9.019,41,11.5,41h1c2.481,0,4.5-2.019,4.5-4.5S14.981,32,12.5,32H11.5z"></path> </g> </g> </g> </g></svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('Sale list') }}
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('external-invoice.create', $storeId) }}" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group">
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-lime-700 dark:fill-lime-500"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('New invoice purchase') }}
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('external-invoice.index', $storeId) }}" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" wire:navigate>
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-lime-700 dark:fill-lime-500"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM64 80c0-8.8 7.2-16 16-16l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L80 96c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16l0 17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5 .1s0 0 0 0s0 0 0 0c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1l0 17.1c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c0 0 0 0 0 0c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5 .8 4.8 1.6 7.1 2.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c13.6 4.6 24.6 8.4 36.3 8.7c9.1 .3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5s0 0 0 0c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7l0-17.3c0-8.8 7.2-16 16-16z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('invoices list') }}
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('stock.index', $storeId) }}" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group">
                        <div class="mx-auto flex items-center gap-1">
                            <svg fill="currentColor" class="store-dashboard-icon fill-gray-800 dark:fill-gray-300"
                                version="1.2" baseProfile="tiny" id="inventory" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 230" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M61.2,106h37.4v31.2H61.2V106z M61.2,178.7h37.4v-31.2H61.2V178.7z M61.2,220.1h37.4v-31.2H61.2V220.1z M109.7,178.7H147 v-31.2h-37.4V178.7z M109.7,220.1H147v-31.2h-37.4V220.1z M158.2,188.9v31.2h37.4v-31.2H158.2z M255,67.2L128.3,7.6L1.7,67.4 l7.9,16.5l16.1-7.7v144h18.2V75.6h169v144.8h18.2v-144l16.1,7.5L255,67.2z">
                                    </path>
                                </g>
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('stock') }}
                            </div>
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-cyan-800 dark:fill-cyan-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                            </svg>

                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('new transfer') }}
                            </div>
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-cyan-800 dark:fill-cyan-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M32 96l320 0 0-64c0-12.9 7.8-24.6 19.8-29.6s25.7-2.2 34.9 6.9l96 96c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-96 96c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6l0-64L32 160c-17.7 0-32-14.3-32-32s14.3-32 32-32zM480 352c17.7 0 32 14.3 32 32s-14.3 32-32 32l-320 0 0 64c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-96-96c-6-6-9.4-14.1-9.4-22.6s3.4-16.6 9.4-22.6l96-96c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 64 320 0z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('transfers list') }}
                            </div>
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-violet-800 dark:fill-violet-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('new customer service') }}
                            </div> 
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-violet-800 dark:fill-violet-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M413.5 237.5c-28.2 4.8-58.2-3.6-80-25.4l-38.1-38.1C280.4 159 272 138.8 272 117.6l0-12.1L192.3 62c-5.3-2.9-8.6-8.6-8.3-14.7s3.9-11.5 9.5-14l47.2-21C259.1 4.2 279 0 299.2 0l18.1 0c36.7 0 72 14 98.7 39.1l44.6 42c24.2 22.8 33.2 55.7 26.6 86L503 183l8-8c9.4-9.4 24.6-9.4 33.9 0l24 24c9.4 9.4 9.4 24.6 0 33.9l-88 88c-9.4 9.4-24.6 9.4-33.9 0l-24-24c-9.4-9.4-9.4-24.6 0-33.9l8-8-17.5-17.5zM27.4 377.1L260.9 182.6c3.5 4.9 7.5 9.6 11.8 14l38.1 38.1c6 6 12.4 11.2 19.2 15.7L134.9 484.6c-14.5 17.4-36 27.4-58.6 27.4C34.1 512 0 477.8 0 435.7c0-22.6 10.1-44.1 27.4-58.6z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('customer services list') }}
                            </div>
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-pink-700 dark:fill-pink-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('new supplier service') }}
                            </div>
                        </div>
                    </a>
                    <a href="#" class="store-dashboard-link flex items-center gap-1 bg-white dark:bg-slate-800 px-2 rounded transition-all duration-300 group" >
                        <div class="mx-auto flex items-center gap-1">
                            <svg class="store-dashboard-icon fill-pink-700 dark:fill-pink-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M0 488L0 171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4L640 488c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-264c0-17.7-14.3-32-32-32l-384 0c-17.7 0-32 14.3-32 32l0 264c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24zm488 24l-336 0c-13.3 0-24-10.7-24-24l0-56 384 0 0 56c0 13.3-10.7 24-24 24zM128 400l0-64 384 0 0 64-384 0zm0-96l0-80 384 0 0 80-384 0z" />
                            </svg>
                            <div class="uppercase roboto font-semibold text-xs tracking-tighter whitespace-nowrap overflow-hidden max-w-0 opacity-0 transition-all duration-300 group-hover:max-w-[200px] group-hover:opacity-100">
                                {{ __('supplier services list') }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>