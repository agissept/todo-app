<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Board ' . $board->name) }}
        </h2>
    </x-slot>

    <div x-data="{
    showModalEditTodo: false,
    showModalDeleteTodo: false,
    currentBoardId: '{{{ $board->id }}}}',
    currentTodo: {
        deadline: null
        }
    }">
        <div class="p-6 grid grid-cols-2 gap-4 h-screen">
            <div class="rounded-lg p-6">
                <h2 class="text-3xl font-bold">Belum Selesai</h2>
                <div class="grid grid-cols-3 justify-items-center">
                    @foreach($todos as $todo)
                        @if(!$todo->status)
                            <div class="rounded-lg bg-white w-[250px] h-[400px] p-4 flex flex-col mt-4 relative">
                                <x-dropdown class="!absolute bg-red top-1 right-1" align="left">
                                    <x-slot name="trigger">
                                        <button
                                            class="hover:bg-gray-100 inline-flex items-center px-1 py-1 text-sm font-medium  text-gray-500 hover:text-gray-700">
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
                                            <button class="hover:bg-gray-100" @click="showModalEditTodo = true; currentTodo = {
                                                    id: '{{{ $todo->id }}}',
                                                    name: '{{{ $todo->name }}}',
                                                    description: '{{{ $todo->description }}}',
                                                    deadline: '{{{ \Carbon\Carbon::parse($todo->deadline)->format('Y-m-d') }}}'
                                                };">Edit
                                            </button>
                                            <button class="hover:bg-gray-100" @click="showModalDeleteTodo = true;
                                                currentTodo = {
                                                    id: '{{{ $todo->id }}}',
                                                    name: '{{{ $todo->name }}}'
                                                }">Hapus
                                            </button>
                                        </div>
                                    </x-slot>

                                </x-dropdown>

                                <h3 class="text-2xl font-semibold">{{{ $todo->name }}}</h3>
                                <p class="font-thin text-sm text-gray-500">Deadline: {{{ $todo->deadline }}}</p>
                                <p class="font-thin text-sm text-gray-500">Owner: {{{ $todo->username }}}</p>
                                <p class="mt-3">{{{ $todo->description }}}</p>
                                <div class="mt-auto flex flex-col">
                                    <form method="post"
                                          action="{{{ route('todo.complete', ['id' => $todo->id, 'boardId' => $board->id]) }}}">
                                        @csrf
                                        <button class="w-full bg-green-500 px-3 py-1 rounded-md text-white mt-1">
                                            Selesaikan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="rounded-lg p-6">
                <h2 class="text-3xl font-bold">Selesai</h2>
                <div class="grid grid-cols-3 justify-items-center">
                    @foreach($todos as $todo)
                        @if($todo->status)
                            <div class="rounded-lg bg-white w-[250px] h-[400px] p-4 flex flex-col mt-4 relative">
                                <x-dropdown class="!absolute bg-red top-1 right-1" align="left">
                                    <x-slot name="trigger">
                                        <button
                                            class="hover:bg-gray-100 inline-flex items-center px-1 py-1 text-sm font-medium  text-gray-500 hover:text-gray-700">
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
                                            <form method="post" action="{{{ route('todo.uncompleted', ['id' => $todo->id, 'boardId' => $board->id]) }}}" class="flex">
                                                @method('delete')
                                                @csrf
                                                <button class="hover:bg-gray-100 w-full">Belum selesai</button>
                                            </form>
                                            <button class="hover:bg-gray-100" @click="showModalDeleteTodo = true;
                                                currentTodo = {
                                                    id: '{{{ $todo->id }}}',
                                                    name: '{{{ $todo->name }}}'
                                                }">Hapus
                                            </button>
                                        </div>
                                    </x-slot>

                                </x-dropdown>


                                <h3 class="text-2xl font-semibold">{{{ $todo->name }}}</h3>
                                <p class="font-thin text-sm text-gray-500">Deadline: {{{ $todo->deadline }}}</p>
                                <p class="font-thin text-sm text-gray-500">Owner: {{{ $todo->username }}}</p>

                                <p class="mt-3">{{{ $todo->description }}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        @include('todos.add-modal')
        @include('todos.edit-modal')
        @include('todos.delete-modal')
    </div>

</x-app-layout>
