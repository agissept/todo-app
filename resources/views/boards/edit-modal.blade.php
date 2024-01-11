<div x-cloak x-show="showModalEditBoard" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <form method="post" class="bg-white p-6 rounded-md shadow-md w-[500px]"
          x-bind:action="'/boards/' + currentBoard.id"
          x-on:click.outside="showModalEditBoard = false">
        @csrf
        @method('put')
        <h2 class="text-xl font-semibold mb-4">Edit Board</h2>
        <div>
            <label for="board-name">Nama board</label>
            <input type="text" class="block w-full" placeholder="Contoh: Tugas matematika" id="board-name"
                   name="board_name" required x-model="currentBoard.name">
        </div>
        <div>
            <label for="board-description">Deskripsi</label>
            <textarea class="block w-full  resize-none" placeholder="Contoh: Kerjakan soal 1-10 Bab 2"
                      id="board-description" name="board_description" x-model="currentBoard.description"
                      required></textarea>
        </div>
        <div class="ml-auto w-fit">
            <button type="button" x-on:click="showModalEditBoard = false" class="mt-4 text-black text-black p-2 rounded-md">
                Batal
            </button>
            <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Submit</button>
        </div>
    </form>
</div>

