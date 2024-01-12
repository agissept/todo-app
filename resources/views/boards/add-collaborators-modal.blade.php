<div x-cloak x-show="showModalAddCollaborator"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <form method="post" x-bind:action="`/boards/${currentBoard.id}/collaborators`"  class="bg-white p-6 rounded-md shadow-md w-[500px]"
          x-on:click.outside="showModalAddCollaborator = false">
        @csrf
        <h2 class="text-xl font-semibold mb-4">Tambahkan Kolaborator</h2>
        <div>
            <label for="user-id">User Id</label>
            <input type="text" class="block w-full" placeholder="Contoh: 123" id="user-id"
                   name="user_id" required>
        </div>
        <div class="ml-auto w-fit">
            <button x-on:click="showModalAddCollaborator = false" class="mt-4 text-black p-2 rounded-md">
                Batal
            </button>
            <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Submit</button>
        </div>
    </form>
</div>

