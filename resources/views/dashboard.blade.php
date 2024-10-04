<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-[50%] mx-auto p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-xl mb-5">Shorten url here</p>
                    <form method="POST" action="{{ route('shorten.url') }}">
                        @csrf
                        <div>
                            <x-input-label for="url" :value="__('Enter main Url')" />
                            <x-text-input id="url" class="block mt-1 w-full" type="text" name="main_url"
                                :value="old('main_url')" autofocus autocomplete="main_url" />
                            <x-input-error :messages="$errors->get('main_url')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                    @if (session('url'))
                        <p class="dark:text-gray-100 text-gray-800">
                            Short URL: <a
                                href="{{ url('/') . '/' . session('url.short_url') }}">{{ session('url.short_url') }}</a>
                        </p>
                        <p class="dark:text-gray-100 text-gray-800">
                            Main URL: <a href="{{ session('url.main_url') }}"
                                target="_blank">{{ session('url.main_url') }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-[50%] mx-auto p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-xl mb-5">Check Shorten url here</p>
                    <form action="{{ route('redirect') }}">
                        @csrf
                        <div>
                            <x-input-label for="url" :value="__('Enter Short Url')" />
                            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url"
                                :value="old('url')" autofocus autocomplete="url" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3" width="50%">
                        Main URL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Short URL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Clicks
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->main_url }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->shortened_url }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->click_count }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-lg text-center dark:text-gray-50 text-gray-800 py-5" colspan="3">No data in
                            url
                            system</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</x-app-layout>
