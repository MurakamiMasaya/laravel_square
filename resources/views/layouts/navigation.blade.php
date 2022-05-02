<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center pl-5 sm:pl-10 lg:pl-20">
                <div class="w-28 sm:w-40 md:w-48">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>
            <div class="hidden sm:block my-auto pr-5 sm:pr-10 lg:pr-20">
                <div>
                    <a href="#" class="text-sm text-gray-700 dark:text-gray-500">お問い合わせ</a>
                    <a href="#" class="ml-5 text-sm text-gray-700 dark:text-gray-500">マイページ</a>
                </div>
                <div class="">
                    @auth
                        <a href="{{ url('/logout') }}" class="lg:text-lg text-red-600 dark:text-red-500">ログアウト</a>
                    @else
                        <a href="{{ route('login') }}" class="lg:text-lg text-red-600 dark:text-red-500">ログイン</a>
                        <a href="{{ route('register') }}" class="ml-5 lg:ml-10 lg:text-lg text-red-600 dark:text-red-500">新規登録</a>
                    @endauth
                </div>
            </div>
            <!-- Hamburger -->
            <div class="flex items-center sm:hidden bg-red-500 px-3">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white focus:outline-nonetransition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
    </div>

    <!-- Top Bar -->
    <header class="bg-red-500 shadow">
        <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto flex justify-center sm:justify-between items-center">
                <div class="flex">
                    {{-- todo: inputにフォーカスした時、青い枠線が出現する --}}
                    <form action="#" method="post" class="mr-2 lg:mr-5 w-32 md:w-40">
                        <input class="bg-white appearance-none border-2 border-white rounded w-full py-2 px-2 md:px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-300"
                        type="text" name="" value="会社を検索">
                    </form>
                    <form action="#" method="post" class="mr-2 w-32 md:w-40">
                        <input class="bg-white appearance-none border-2 border-white rounded w-full py-2 px-2 md:px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-300"
                        type="text" name="" value="スクールを検索">
                    </form>
                </div>
                <div class="hidden sm:block">
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">企業情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">スクール情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold mr-2 lg:mr-5">イベント情報</a>
                    <a href="#" class="text-white dark:text-white text-sm lg:text-lg font-bold lg:mr-5">特集記事</a>
                </div>
            </div>
        </div>
    </header>
</nav>
