{{-- #TODO: フロント側でバリデーションを実装する必要がある --}}
<x-guest-layout>
    <x-auth-card>
        <div class="flex justify-center">
            <!-- Left side -->
            <div class="hidden md:w-1/3 bg-gray-200 md:flex flex-col justify-center px-2">
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
                <div class="text-sm text-gray-500 mb-28">
                    ReviewHubに登録することで、たくさんの情報が自由に閲覧できるようになります。さああなたも貴重な情報を掴み、ライバルと差をつけましょう！
                </div>
            </div>

            <!-- Right side -->
            <div class="md:w-2/3 py-5 px-5 max-w-md mx-auto">
                <div class="w-40 sm:w-56 mt-10">
                    <a href="/">
                        <x-application-logo />
                    </a>
                </div>
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('register') }}" class="mt-10">
                    @csrf

                    <div class="font-bold">新規会員登録</div>
        
                    <!-- Email Address -->
                    <div class="mt-5">
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="メールアドレス(必須)"/>
                    </div>
        
                    <!-- Password -->
                    <div class="mt-5">
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password"
                                        placeholder="パスワード(必須)" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-2">
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required
                                        placeholder="パスワード確認用(必須)" />
                    </div>
        
                    <!-- Name -->
                    <div class="mt-5">
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="氏名(必須)" />
                    </div>
        
                    <!-- birthday -->
                    <div class="mt-5">
                        <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus placeholder="生年月日(必須)" />
                    </div>
                    
                    <!-- gender -->
                    <div class="flexs mt-5">
                        <x-input id="gender" class="mt-1" type="radio" name="gender" value="0" required />男性
                        <x-input id="gender" class="mt-1" type="radio" name="gender" value="1" required />女性
                    </div>
                    
                    <!-- username -->
                    <div class="mt-5">
                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus placeholder="ユーザーネーム(必須)" />
                    </div>
        
                    <!-- phone -->
                    <div class="mt-5">
                        <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus placeholder="電話番号(必須)" />
                    </div>

                    <!-- privacy policy -->
                    {{-- #TODO: 個人情報保護方針ページから戻ってきた際にデータが消えていることの修正 --}}
                    <div class="mt-10 text-xs text-center">
                        <a href="/privacy_policy" class="text-blue-400">
                            個人情報保護方針
                        </a>
                        <span>
                            に同意いただいた上で、会員登録をお願いいたします
                        </span>
                        <div class="text-center mt-2">
                            <input type="checkbox" name="privacy_policy" value="1" class="rounded-full mr-2">同意する    
                        </div>
                    </div>
        
                    <div class="my-10 text-center">
                        <x-button.primary-button class="w-52">
                            新規登録
                        </x-button.primary-button>
                        <a href="{{ route('login') }}">
                            <x-button.secondary-button class="w-52 mt-5">
                                ログインはこちら
                            </x-button.secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>