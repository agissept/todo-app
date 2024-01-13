<div x-cloak x-show="showModalDeleteTodo" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-md shadow-md w-[500px]" x-on:click.outside="showModalDeleteTodo = false">
        <h2 class="text-xl font-semibold mb-4" x-text="'Hapus ' + currentTodo.name">Hapus</h2>
        <div class="ml-auto w-fit">
            <button x-on:click="showModalDeleteTodo = false" class="mt-4 text-black p-2 rounded-md">Batal</button>

            <form method="post" x-bind:action="'/boards/{{{ $board->id }}}/todos/' + currentTodo.id" class="inline">
                @csrf
                @method('delete')
                <button type="submit" class="mt-4 bg-red-500 text-white p-2 rounded-md">Hapus</button>
            </form>
        </div>
    </div>
</div>
