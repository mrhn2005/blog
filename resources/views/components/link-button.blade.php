
<a {{ $attributes->merge(['class' => "inline-flex items-center px-4 py-2 bg-{$bcolor}-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-{$bcolor}-700 active:bg-{$bcolor}-900 focus:outline-none focus:border-{$bcolor}-900 focus:ring ring-{$bcolor}-300 disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</a>
