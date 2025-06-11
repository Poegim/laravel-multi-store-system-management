<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
                {{ __('Dashboard') }}
            </div>
        </h2>
    </x-slot>

    <div class="py-2 sm:py-4">
        <div class="">
            <div class="bg-white dark:bg-gray-800 sm:rounded-2xl  shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Latest Code Changes</h3>
                </div>
                <div class="px-6 py-4 space-y-2">

                    @if (array_key_exists('error', $commits))
                    <div class="text-gray-500 dark:text-gray-400">
                        {{ $commits['error'] }}
                    </div>
                    @else

                    @foreach ($commits as $commit)
                    <div
                        class="flex items-start justify-between text-sm text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">

                        <div class="flex min-w-0 items-center space-x-2">
                            <a href="{{ $commit['html_url'] }}" target="_blank"
                            class="hover:underline text-slate-700 dark:text-slate-300 break-words w-full">
                            {{ $commit['commit']['message'] }}
                            </a>
                            <span class="text-gray-400 text-xs font-mono hidden sm:inline">
                                ({{ substr($commit['sha'], 0, 7) }})
                            </span>
                        </div>

                        <div class="ml-4 flex-shrink-0 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->diffForHumans() }}
                            <span
                                title="{{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->toDayDateTimeString() }}">⏰</span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
