<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Platform')" class="grid">
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Cars')" class="grid">
                <flux:sidebar.item icon="home" :href="route('cars.index')"
                    :current="request()->routeIs('cars.index')" wire:navigate>
                    {{ __('Cars') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="home" :href="route('cars.create')"
                    :current="request()->routeIs('cars.create')" wire:navigate>
                    {{ __('Create Car') }}
                </flux:sidebar.item>
                {{-- <flux:sidebar.item icon="home" :href="route('cars.edit')" :current="request()->routeIs('cars.edit')"
                    wire:navigate>
                    {{ __('Edit Car') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="home" :href="route('cars.show')" :current="request()->routeIs('cars.show')"
                    wire:navigate>
                    {{ __('Show Car') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="home" :href="route('cars.destroy')" :current="request()->routeIs('cars.destroy')"
                    wire:navigate>
                    {{ __('Delete Car') }}
                </flux:sidebar.item> --}}
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        @auth
            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        @else
            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="{{ route('login') }}" wire:navigate>
                    {{ __('Login') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="{{ route('register') }}" wire:navigate>
                    {{ __('Register') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        @endauth
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            @auth
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            @endauth

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        @auth
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        @endauth
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    @auth
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    @endauth
                </flux:menu.radio.group>

                <flux:menu.separator />

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                @endauth
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
