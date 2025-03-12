<div>
    <x-prims-sub-header>
        View Medical Record
    </x-prims-sub-header>

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4 p-6">
        <div class="bg-yellow-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Personal Information</h2>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4 items-center">
            <label class="text-sm">ID Number</label>
            <input type="text" value="{{ $record->apc_id_number }}" class="border p-2 rounded" readonly>

            <label class="text-sm">First Name</label>
            <input type="text" value="{{ $record->first_name }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Middle Initial</label>
            <input type="text" value="{{ $record->mi }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Last Name</label>
            <input type="text" value="{{ $record->last_name }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Gender</label>
            <input type="text" value="{{ $record->gender }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Age</label>
            <input type="text" value="{{ $record->age }}" class="border p-2 rounded" readonly>
        
            <label class="text-sm">Date of Birth</label>
            <input type="date" value="{{ $record->dob }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Address</label>
            <input type="text" value="{{ $record->address }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Email Address</label>
            <input type="text" value="{{ $record->email }}" class="border p-2 rounded" readonly>

            <label class="text-sm">Contact No.</label>
            <input type="text" value="{{ $record->contact }}" class="border p-2 rounded" readonly>
        </div>

        <div class="mt-6 bg-yellow-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Medical Concerns</h2>
        </div>
        <div class="mt-4">
            <label class="text-sm">Reason for visit</label>
            <textarea class="w-full border p-2 rounded" readonly>{{ $record->reason }}</textarea>

            <label class="text-sm mt-2">Description of symptoms</label>
            <textarea class="w-full border p-2 rounded mt-2" readonly>{{ $record->description }}</textarea>

            <label class="text-sm mt-2">Allergies</label>
            <textarea class="w-full border p-2 rounded mt-2" readonly>{{ $record->allergies }}</textarea>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('medical-records') }}">
                <button class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Back
                </button>
            </a>
        </div>
    </div>
</div>
