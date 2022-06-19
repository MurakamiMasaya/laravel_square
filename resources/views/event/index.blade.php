<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-6xl mx-auto mb-5 sm:mb-10">
        <div class="md:flex relative">
            <!-- Left sides of main -->
            <div class="md:w-2/3 md:mr-5">
                <div>
                    <x-event.banner />
                    <x-event.ranking :events="$events"/>
                </div>

            </div>

            <!-- Right side of main -->
            <div class="md:w-1/3 mt-10">
                @if(!Auth::check())
                <div>
                    <x-login-register />
                </div>
                @endif

                <x-school.top-three :schools="$schools"/>
                <x-article.top-eight :articles="$articles"/>
                  
            </div>
            <x-bg-text first="React,Vue" second="Swift,Flutter"/>
        </div>
    </div>


    <!-- Footer Image -->
    {{-- #TODO: 画像を横にスライドできる機能を後ほど実装 --}}
    <x-eye-catching-image />
</x-app-layout>