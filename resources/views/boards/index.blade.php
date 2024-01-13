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

        <div class="p-5 grid grid-cols-8">
            @foreach($boards as $board)
                <div class="rounded-lg bg-white h-[250px] w-[200px] relative hover:bg-gray-50 mt-5">
                    <x-dropdown class="!absolute bg-red top-1 right-1" align="left">
                        <x-slot name="trigger">
                            <button class="hover:bg-gray-100 inline-flex items-center px-1 py-1 text-sm font-medium  text-gray-500 hover:text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="flex flex-col">
                                <button class="hover:bg-gray-100" @click="showModalEditBoard = true; currentBoard = {
                                        id: '{{{ $board->id }}}',
                                        name: '{{{ $board->name }}}',
                                        description: '{{{ $board->description }}}'
                                    };">Edit
                                </button>
                                <button class="hover:bg-gray-100" @click="showModalAddCollaborator = true;
                                    currentBoard = {
                                        id: '{{{ $board->id }}}'
                                    }">Tambah Kolaborator
                                </button>
                                <button class="hover:bg-gray-100" @click="showModalDeleteBoard = true;
                                    currentBoard = {
                                        id: '{{{ $board->id }}}',
                                        name: '{{{ $board->name }}}'
                                    }">Hapus
                                </button>
                            </div>
                        </x-slot>

                    </x-dropdown>
                    <a href="{{{ route('todo.show', ['boardId' => $board->id]) }}}" class="block w-full h-full p-5">
                        <h3 class="text-2xl font-semibold">{{{ $board->name }}}</h3>
                        <p class="font-thin text-sm text-gray-500">Owner: {{{ $board->username }}}</p>
                        @if(!empty($board->collaborators->toArray()))
                            <p class="font-thin text-sm text-gray-500">
                                Collaborators: {{{ implode(',', array_column($board->collaborators->toArray(), 'name')) }}}</p>
                        @endif
                        <p class="mt-5">{{{ $board->description }}}</p>

                    </a>
                    <div class="absolute left-2 bottom-2">

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
