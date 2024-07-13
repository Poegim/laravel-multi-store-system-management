<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">Recent Commits</h3>
                </div>
                <div class="px-6 py-4">
                    @foreach ($commits as $commit)
                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{$commit['commit']['message']}}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
