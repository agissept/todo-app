<div x-cloak x-show="showModalEditTodo" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <form method="post" class="bg-white p-6 rounded-md shadow-md w-[500px]"
          x-bind:action="'/todos/' + currentTodo.id"
          x-on:click.outside="showModalEditTodo = false">
        @csrf
        @method('put')
        <h2 class="text-xl font-semibold mb-4">Edit Todo</h2>
        <div>
            <label for="todo-name">Nama todo</label>
            <input type="text" class="block w-full" placeholder="Contoh: Tugas matematika" id="todo-name"
                   name="todo_name" required x-model="currentTodo.name">
        </div>
        <div>
            <label for="todo-description">Deskripsi</label>
            <textarea class="block w-full  resize-none" placeholder="Contoh: Kerjakan soal 1-10 Bab 2"
                      id="todo-description" name="todo_description" x-model="currentTodo.description"
                      required></textarea>
        </div>
        <div>
            <label for="todo-deadline">Deadline</label>
            <input type="date" class="block w-full" id="todo-deadline"
                   min="{{{ \Carbon\Carbon::now()->format('Y-m-d') }}}" name="todo_deadline" required
                   x-model="currentTodo.deadline">
        </div>
        <div class="ml-auto w-fit">
            <button x-on:click="showModalEditTodo = false" class="mt-4 text-black text-black p-2 rounded-md">
                Batal
            </button>
            <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Submit</button>
        </div>
    </form>
</div>

