<x-app-layout>
    <x-slot name="header">
        <h2 class="breadcrumb md:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="top-header-breadcrumb-title">
            {{ __('Users') }}
            </div>
        </h2>
    </x-slot>
    
    @livewire('management.user.index-users')

</x-app-layout>
