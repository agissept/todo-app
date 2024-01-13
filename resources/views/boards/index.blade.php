<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Boards') }}
        </h2>
    </x-slot>

    <div x-data="{
        showModalEditBoard: false,
        showModalDeleteBoard: false,
        showModalAddCollaborator: false,
        currentBoard: {}
    }">

        <div class="p-5 grid grid-cols-5">
            @foreach($boards as $board)
                <div class="rounded-lg bg-white h-[250px] w-[200px] p-5 relative">
                    <a href="{{{ route('todo.show', ['boardId' => $board->id]) }}}" class="block w-full h-full">
                        <h3 class="text-2xl font-semibold">{{{ $board->name }}}</h3>
                        <p class="font-thin text-sm text-gray-500">Owner: {{{ $board->username }}}</p>
                        @if(!empty($board->collaborators->toArray()))
                            <p class="font-thin text-sm text-gray-500">
                                Collaborators: {{{ implode(',', array_column($board->collaborators->toArray(), 'name')) }}}</p>
                        @endif
                        <p class="mt-5">{{{ $board->description }}}</p>

                    </a>
                    <div class="absolute left-2 bottom-2">
                        <button class="px-3 py-1 rounded-md text-black" @click="showModalEditBoard = true; currentBoard = {
                                        id: '{{{ $board->id }}}',
                                        name: '{{{ $board->name }}}',
                                        description: '{{{ $board->description }}}'
                                    };">Edit
                        </button>
                        <button class="bg-red-500 px-3 py-1 rounded-md text-white mt-1" @click="showModalDeleteBoard = true;
                                    currentBoard = {
                                        id: '{{{ $board->id }}}',
                                        name: '{{{ $board->name }}}'
                                    }">Hapus
                        </button>
                        <button class="bg-green-500 px-3 py-1 rounded-md text-white mt-1" @click="showModalAddCollaborator = true;
                                    currentBoard = {
                                        id: '{{{ $board->id }}}'
                                    }">Tambah Kolaborator
                        </button>
                    </div>
                </div>
            @endforeach

        </div>

        @include('boards.add-modal')
        @include('boards.edit-modal')
        @include('boards.delete-modal')
        @include('boards.add-collaborators-modal')
    </div>

</x-app-layout>
