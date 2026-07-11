<button {{ $attributes->merge([
    'type' => 'button',
    'class' => '
        inline-flex items-center justify-center
        rounded-xl
        text-white
        font-medium
        shadow-sm
        hover:shadow-md
        transition-all duration-200
        min-w-[44px] min-h-[44px]
        p-2
        leading-none
    '
]) }}>
    {{ $slot }}
</button>