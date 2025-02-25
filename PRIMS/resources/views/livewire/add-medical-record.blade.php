<div>
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-3 gap-4 mt-4 items-center">
            <label class="text-sm">First Name</label>
            <input type="text" wire:model="first_name" class="border p-2 rounded col-span-2">

            <label class="text-sm">Last Name</label>
            <input type="text" wire:model="last_name" class="border p-2 rounded col-span-2">

            <label class="text-sm">Date of Birth</label>
            <input type="date" wire:model="dob" class="border p-2 rounded col-span-2">

            <label class="text-sm">Address</label>
            <input type="text" wire:model="address" class="border p-2 rounded col-span-2">
        </div>

        <div class="mt-6">
            <label class="text-sm">Reason for visit</label>
            <textarea wire:model="reason" class="w-full border p-2 rounded" placeholder="Reason for visit..."></textarea>

            <label class="text-sm mt-2">Description of symptoms</label>
            <textarea wire:model="description" class="w-full border p-2 rounded mt-2" placeholder="Description of symptoms..."></textarea>

            <label class="text-sm mt-2">Allergies</label>
            <textarea wire:model="allergies" class="w-full border p-2 rounded mt-2" placeholder="Allergies..."></textarea>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Submit
            </button>
        </div>
    </form>
</div>
