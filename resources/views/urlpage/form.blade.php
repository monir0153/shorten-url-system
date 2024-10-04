<div class="max-w-xl mx-auto">
    <form method="POST" action="{{ route('shorten.url') }}">
        @csrf
        <div>
            <x-input-label for="url" :value="__('Enter main Url')" />
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="main_url" :value="old('main_url')"
                autofocus autocomplete="main_url" />
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
            Short URL: <a href="{{ url('/') . '/' . session('url.short_url') }}">{{ session('url.short_url') }}</a>
        </p>
        <p class="dark:text-gray-100 text-gray-800">
            Main URL: <a href="{{ session('url.main_url') }}" target="_blank">{{ session('url.main_url') }}</a>
        </p>
    @endif
</div>
