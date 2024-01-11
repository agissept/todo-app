<div x-data="{showModalAddTodo: false}" x-cloak>
    <button class="bg-green-500 text-white text-2xl rounded-md px-3 py-2 fixed bottom-10 right-10"
            @click="showModalAddTodo = true">Tambah Todo
    </button>

    <div x-show="showModalAddTodo" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <form method="post" action="{{{ route('todo.store') }}}" class="bg-white p-6 rounded-md shadow-md w-[500px]"
              x-on:click.outside="showModalAddTodo = false">
            @csrf
            <h2 class="text-xl font-semibold mb-4">Tambahkan Todo</h2>
            <div>
                <label for="todo-name">Nama todo</label>
                <input type="text" class="block w-full" placeholder="Contoh: Tugas matematika" id="todo-name"
                       name="todo_name" required>
            </div>
            <div>
                <label for="todo-description">Deskripsi</label>
                <textarea class="block w-full  resize-none" placeholder="Contoh: Kerjakan soal 1-10 Bab 2"
                          id="todo-description" name="todo_description" required></textarea>
            </div>
            <div>
                <label for="todo-deadline">Deadline</label>
                <input type="date" class="block w-full" id="todo-deadline"
                       min="{{{ \Carbon\Carbon::now()->format('Y-m-d') }}}" name="todo_deadline" required>
            </div>
            <div class="ml-auto w-fit">
                <button x-on:click="showModalAddTodo = false" class="mt-4 text-black text-white p-2 rounded-md">
                    Batal
                </button>
                <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Submit</button>
            </div>
        </form>
    </div>
</div>
