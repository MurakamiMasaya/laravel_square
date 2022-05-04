<div>
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 border-2 border-gray-500 rounded-md font-semibold text-sm text-gray-500 uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
</div>