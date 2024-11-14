<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="sm:flex py-6 px-4">
            {{ __('Dashboard') }}
            </div>
        </h2>
    </x-slot>

    <div class="py-2 sm:py-4">
        <div class="">
            <div class="bg-white dark:bg-gray-800 rounded-mid  shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">Recent Commits</h3>
                </div>
                <div class="px-6 py-4">
                    @foreach ($commits as $commit)
                        @if (is_string($commit))
                           <div class="roboto tracking-wide italic text-red-700 dark:text-red-200 font-semibold">
                            {{ $commit }}
                           </div>
                        @else
                        <div class="">
                            <a href="{{$commit['html_url']}}" target="_blank" class="link">
                                <span class="link">{{$commit['commit']['message']}}</span>
                            </a>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->diffForHumans() }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
