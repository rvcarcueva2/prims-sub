<div class="mb-5">
    <div class="rounded-md shadow-md bg-prims-yellow-1 mt-5 p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Personal Information</h1>
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 my-4 items-center">
                <label class="font-bold text-lg">ID Number</label>
                <input type="text" wire:model.lazy="apc_id_number" wire:change="searchPatient" class="border p-2 rounded col-span-2" placeholder="Enter an ID number">

                <label class="font-bold text-lg">First Name</label>
                <input type="text" wire:model="first_name" class="border p-2 rounded col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name"> <!-- Hidden field to ensure submission -->

                <label class="font-bold text-lg">Last Name</label>
                <input type="text" wire:model="last_name" class="border p-2 rounded col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="last_name"> <!-- Hidden field to ensure submission -->

                <label class="font-bold text-lg">Middle Initial</label>
                <input type="text" wire:model="middle_initial" class="border p-2 rounded col-span-2 bg-gray-200" >
                <!-- <input type="hidden" wire:model="middle_initial"> Hidden field to ensure submission -->

                <label class="font-bold text-lg">Sex</label>
                <input type="text" wire:model="sex" class="border p-2 rounded col-span-2 bg-gray-200" >
                <!-- <input type="hidden" wire:model="sex"> Hidden field to ensure submission -->

                <label class="font-bold text-lg">Age</label>
                <input type="text" wire:model="age" class="border p-2 rounded col-span-2 bg-gray-200" >
                <!-- <input type="hidden" wire:model="age"> Hidden field to ensure submission -->

                <label class="font-bold text-lg">Date of Birth</label>
                <input type="text" wire:model="dob" class="border p-2 rounded col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="dob"> <!-- Hidden field to ensure submission -->

                <label class="font-bold text-lg">Nationality</label>
                <input type="text" wire:model="nationality" class="border p-2 rounded col-span-2 bg-gray-200" >
                <!-- <input type="hidden" wire:model="nationality"> Hidden field to ensure submission -->

                <label class="font-bold text-lg">Address</label>
                <input type="text" wire:model="address" class="border p-2 rounded col-span-2 bg-gray-200">
                <!-- <input type="hidden" wire:model="first_name"> Hidden field to ensure submission -->
                 
            </div>

            <hr class="mt-10">
            <h1 class="text-2xl font-bold text-center mt-6">Medical History</h1>
            <div class="mt-6">
                <label class="block text-lg font-medium">Reason for Visit</label>
                <select wire:model="reason" class="w-full p-2 border rounded-md mb-3">
                    <option value="">Select a reason</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Fever">Fever</option>
                    <option value="Emergency">Headache</option>
                    <option value="Injury">Injury</option>
                    <option value="Other">Other</option>
                </select>

                <label class="font-medium text-lg">Description of symptoms</label>
                <textarea wire:model="description" class="w-full border p-2 rounded mb-5" placeholder="Description of symptoms..."></textarea>

                <label class="font-bold text-lg mt-2">Allergies</label>
                <textarea wire:model="allergies" class="w-full border p-2 rounded" placeholder="Allergies..."></textarea>

                <label class="block text-lg font-medium">Diagnosis</label>
                <select wire:model="diagnosis" class="w-full p-2 border rounded-md mb-3 ">
                    <option value="">Select a diagnosis</option>
                    <optgroup label="Cardiology">
                        <option value="Hypertension">Hypertension</option>
                        <option value="BP Monitoring">BP Monitoring</option>
                        <option value="Bradycardia">Bradycardia</option>
                        <option value="Hypotension">Hypotension</option>
                        <option value="Angina">Angina</option>
                    </optgroup>
                    <optgroup label="Pulmonology">
                        <option value="URTI">URTI</option>
                        <option value="Pneumonia">Pneumonia</option>
                        <option value="PTB">PTB</option>
                        <option value="Bronchitis">Bronchitis</option>
                        <option value="Lung Pathology">Lung Pathology</option>
                        <option value="Acute Bronchitis">Acute Bronchitis</option>
                    </optgroup>
                    <optgroup label="Gastroenterology">
                        <option value="Acute Gastroenteritis">Acute Gastroenteritis</option>
                        <option value="GERD">GERD</option>
                        <option value="Hemorrhoids">Hemorrhoids</option>
                        <option value="Anorexia">Anorexia</option>
                    </optgroup>
                    <optgroup label="Musculo Skeletal">
                        <option value="Ligament Sprain">Ligament Sprain</option>
                        <option value="Muscle Strain">Muscle Strain</option>
                        <option value="Costochondritis">Costochondritis</option>
                        <option value="Soft Tissue Contusion">Soft Tissue Contusion</option>
                        <option value="Fracture">Fracture</option>
                        <option value="Gouty Arthritis">Gouty Arthritis</option>
                        <option value="Plantar Fasciitis">Plantar Fasciitis</option>
                        <option value="Dislocation">Dislocation</option>
                    </optgroup>
                </select>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
