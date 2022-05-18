<x-guest-layout>
    <x-auth-card>
        <div class="py-10 px-5 md:px-10 lg:px-15">
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>
    
            <div class="mb-4 text-sm text-gray-600">
                パスワードをお忘れですか？メールアドレスをお知らせいただければ、新しいパスワードを選択できるパスワードリセットリンクをメールでお送りします。
            </div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
    
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>
    
                <div class="flex items-center justify-between mt-10 text-sm">
                    <a href="{{ route('top') }}">
                        <x-button.secondary-button class="w-40">
                            TOPに戻る
                        </x-button.secondary-button>
                    </a>
                    <x-button.primary-button >
                        送信
                    </x-button.primary-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
