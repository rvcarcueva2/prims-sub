<x-app-layout>
    <x-prims-sub-header>
    Add Medical Record
    </x-prims-sub-header>
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4 p-6">
        <div class="bg-yellow-300 rounded-lg p-4 flex items-center space-x-4">
            <div class="bg-yellow-400 p-4 rounded-lg">
                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a5 5 0 0 1 5 5v1h1a5 5 0 0 1 5 5v6a5 5 0 0 1-5 5H6a5 5 0 0 1-5-5v-6a5 5 0 0 1 5-5h1V7a5 5 0 0 1 5-5z"/></svg>
            </div>
            <div>
                <p class="text-lg font-semibold">2022-1187311</p>
                <p class="text-xl font-bold">Jay Chirst</p>
            </div>
        </div>

        <div class="mt-6 bg-yellow-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Personal Information</h2>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-4 items-center">
            <label class="text-sm">Date of Birth</label>
            <input type="date" class="border p-2 rounded col-span-2">
            <label class="text-sm">Address</label>
            <input type="text" placeholder="1234 Taft Avenue, Manila, Philippines" class="border p-2 rounded col-span-2">
            <label class="text-sm">Region</label>
            <input type="text" placeholder="NCR" class="border p-2 rounded">
            <label class="text-sm">City</label>
            <input type="text" placeholder="Manila" class="border p-2 rounded">
            <label class="text-sm">Zip</label>
            <input type="text" placeholder="1004" class="border p-2 rounded">
            <label class="text-sm">Email Address</label>
            <input type="text" placeholder="jcfernandez@student.apc.edu.ph" class="border p-2 rounded col-span-2">
            <label class="text-sm">Contact No.</label>
            <input type="text" placeholder="09123456789" class="border p-2 rounded">
            <label class="text-sm">Nationality</label>
            <input type="text" placeholder="Filipino" class="border p-2 rounded">
            <label class="text-sm">Civil Status</label>
            <select class="border p-2 rounded">
                <option>Single</option>
                <option>Married</option>
            </select>
            <label class="text-sm">Emergency Contact</label>
            <input type="text" placeholder="Jane Doe" class="border p-2 rounded">
            <label class="text-sm">Emergency Contact No.</label>
            <input type="text" placeholder="09987654321" class="border p-2 rounded">
        </div>

        <div class="mt-6 bg-yellow-200 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Medical Concerns</h2>
        </div>
        <div class="mt-4">
            <label class="text-sm">Reason for visit</label>
            <textarea class="w-full border p-2 rounded" placeholder="Reason for visit..."></textarea>
            <label class="text-sm mt-2">Description of symptoms</label>
            <textarea class="w-full border p-2 rounded mt-2" placeholder="Description of symptoms..."></textarea>
            <label class="text-sm mt-2">Allergies</label>
            <textarea class="w-full border p-2 rounded mt-2" placeholder="Allergies..."></textarea>
        </div>
        <a href="/staff/medical-records">
        <div class="mt-6 flex justify-end">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Submit</button>
        </div>
        </a>
    </div>
    
    </x-app-layout>