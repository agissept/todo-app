<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Boards') }}
        </h2>
    </x-slot>

    <div class="p-5">
        @foreach($boards as $board)
            <a href="#" class="block rounded-lg bg-white h-[200px] w-[200px] p-5">
                <h3 class="text-2xl font-semibold">{{{ $board->name }}}</h3>
                <p class="font-thin text-sm text-gray-500">Owner: {{{ $board->username }}}</p>
                <p class="mt-5">{{{ $board->description }}}</p>
            </a>
        @endforeach

    </div>


    @include('boards.add-modal')
</x-app-layout>
