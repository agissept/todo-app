<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div x-data="{
    showModalEditTodo: false,
    showModalDeleteTodo: false,
    currentTodo: {
        deadline: null
        }
    }">
        <div class="p-6 grid grid-cols-2 gap-4 h-screen">
            <div class="rounded-lg shadow-lg p-6">
                <h2 class="text-4xl font-bold">Belum Selesai</h2>
                <div class="grid grid-cols-3 justify-items-center">
                    @foreach($todos as $todo)
                        @if(!$todo->status)
                            <div class="rounded-lg shadow-md w-[250px] h-[400px] p-4 flex flex-col mt-4">
                                <h3 class="text-2xl font-semibold">{{{ $todo->name }}}</h3>
                                <p class="font-thin text-sm text-gray-500">Deadline: {{{ $todo->deadline }}}</p>
                                <p class="font-thin text-sm text-gray-500">Owner: {{{ $todo->username }}}</p>
                                <p class="mt-3">{{{ $todo->description }}}</p>
                                <div class="mt-auto flex flex-col">
                                    <form method="post" action="{{{ route('todo.complete', ['id' => $todo->id]) }}}">
                                        @csrf
                                        <button class="w-full bg-green-500 px-3 py-1 rounded-md text-white mt-1">
                                            Selesaikan
                                        </button>
                                    </form>
                                    <button class="px-3 py-1 rounded-md text-black mt-1" @click="showModalEditTodo = true; currentTodo = {
                                        id: '{{{ $todo->id }}}',
                                        name: '{{{ $todo->name }}}',
                                        description: '{{{ $todo->description }}}',
                                        deadline: '{{{ \Carbon\Carbon::parse($todo->deadline)->format('Y-m-d') }}}'
                                    };">Edit
                                    </button>
                                    <button class="bg-red-500 px-3 py-1 rounded-md text-white mt-1" @click="showModalDeleteTodo = true;
                                    currentTodo = {
                                        id: '{{{ $todo->id }}}',
                                        name: '{{{ $todo->name }}}'
                                    }">Hapus
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="rounded-lg shadow-md p-6">
                <h2 class="text-4xl font-bold">Selesai</h2>
                <div class="grid grid-cols-3 justify-items-center">
                    @foreach($todos as $todo)
                        @if($todo->status)
                            <div class="rounded-lg shadow-md w-[250px] h-[400px] p-4 flex flex-col mt-4">
                                <h3 class="text-2xl font-semibold">{{{ $todo->name }}}</h3>
                                <p class="font-thin text-sm text-gray-500">Deadline: {{{ $todo->deadline }}}</p>
                                <p class="font-thin text-sm text-gray-500">Owner: {{{ $todo->username }}}</p>

                                <p class="mt-3">{{{ $todo->description }}}</p>
                                <div class="mt-auto flex flex-col">
                                    <form method="post" action="{{{ route('todo.uncompleted', ['id' => $todo->id]) }}}">
                                        @method('delete')
                                        @csrf
                                        <button class="w-full bg-green-500 px-3 py-1 rounded-md text-white mt-1">Belum
                                            selesai
                                        </button>
                                    </form>
                                    <button class="bg-red-500 px-3 py-1 rounded-md text-white mt-1" @click="showModalDeleteTodo = true;
                                        currentTodo = {
                                            id: '{{{ $todo->id }}}',
                                            name: '{{{ $todo->name }}}'
                                        }">Hapus
                                    </button>
                                </div>
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
