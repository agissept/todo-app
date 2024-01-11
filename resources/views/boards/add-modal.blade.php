<div x-data="{showModalAddBoard: false}" x-cloak>
    <button class="bg-green-500 text-white text-2xl rounded-md px-3 py-2 fixed bottom-10 right-10"
            @click="showModalAddBoard = true">Tambah Board
    </button>

    <div x-show="showModalAddBoard" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <form method="post" action="{{{ route('board.store') }}}" class="bg-white p-6 rounded-md shadow-md w-[500px]"
              x-on:click.outside="showModalAddBoard = false">
            @csrf
            <h2 class="text-xl font-semibold mb-4">Tambahkan Board</h2>
            <div>
                <label for="board-name">Nama board</label>
                <input type="text" class="block w-full" placeholder="Contoh: Tugas kuliah" id="board-name"
                       name="board_name" required>
            </div>
            <div>
                <label for="board-description">Deskripsi</label>
                <textarea class="block w-full  resize-none" placeholder="Contoh: Berisi tugas kuliah di semester 5"
                          id="board-description" name="board_description" required></textarea>
            </div>
            <div class="ml-auto w-fit">
                <button x-on:click="showModalAddBoard = false" class="mt-4 text-black text-white p-2 rounded-md">
                    Batal
                </button>
                <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Submit</button>
            </div>
        </form>
    </div>
</div>
