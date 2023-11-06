@if (session('success'))
    <x-alert class="bg-green-100 border-green-400 text-green-700">
        <x-slot name="status">Success!</x-slot>
        <x-slot name="massage">{{ session('success') }}</x-slot>
    </x-alert>
@endif
@if (session('warning'))
    <x-alert class="bg-orange-100 border-orange-400 text-orange-700">
        <x-slot name="status">Warning!</x-slot>
        <x-slot name="massage">{{ session('warning') }}</x-slot>
    </x-alert>
@endif
@if (session('error'))
    <x-alert class="bg-red-100 border-red-400 text-red-700">
        <x-slot name="status">Error!</x-slot>
        <x-slot name="massage">{{ session('error') }}</x-slot>
    </x-alert>
@endif
