<x-app-layout>
    <!-- Admin Header -->
    @if(isset($user) && $user->admin_flg === 1)
        <x-admin-header />
    @endif

    <div class="max-w-4xl mx-auto my-10 px-2 md:px-10">
        <div class="md:px-10 text-gray-700">
            <div>
                <div class="text-xl md:text-2xl font-bold text-red-500">スクール情報の確認</div>
            </div>
            <div class="my-5 p-5 md:p-10 shadow-xl">
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mt-4" :errors="$errors" />
        
                <form action="{{ route('admin.school.register') }}" method="post">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ $schoolInfo['id'] ?? null }}">
                    
                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        スクール名 : 
                        <input type="text" name="name" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $schoolInfo['name'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        所在地 : 
                        <input type="text" name="address" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $schoolInfo['address'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        電話番号 : 
                        <input type="number" name="phone" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $schoolInfo['phone'] }}"/>
                    </div>

                    <div class="mt-5 text-sm md:text-md lg:text-lg font-bold">
                        WebサイトURL : 
                        <input type="text" name="website_url" readonly required class="w-full shadow appearance-none border-none rounded py-2 px-3 text-gray-700 leading-tight" value="{{ $schoolInfo['website_url'] }}"/>
                    </div>

                    <div class="mt-10">
                        <x-button.go-next text="スクール情報の登録"/>
                    </div>
                    <div class="mt-10">
                        <x-button.go-refere type="submit" text="スクールの編集に戻る"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>