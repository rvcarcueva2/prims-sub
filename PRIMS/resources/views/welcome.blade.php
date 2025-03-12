@section('title', 'PRIMS')

<x-app-layout>
        <div class="background-section h-[calc(100vh-4rem)] bg-cover bg-center relative bg-blend-overlay bg-prims-azure-900 bg-opacity-60" style="background-image: url(img/homepage-bg.png);">
            <div class="relative w-2/5 h-full flex flex-col justify-center ml-40 font-nunito">

                <!-- logo ulet -->
                <img src="img/homepage-logo.svg" class="w-1/2 my-6">

                <!-- text -->
                <p class="my-6 text-xl text-white">“The preservation of <strong>HEALTH</strong> is easier than the <strong>CURE</strong> of the disease.”</p>

                <!-- buttons -->
                <div class="relative flex flex-row items-center">
                    <x-prims-main-button href="/appointment" class="my-6">Set an Appointment</x-prims-main-button>
                    <a href="" class="text-prims-yellow-1 font-semibold p-6 underline hover:text-white transition ease-in-out duration-150">Contact Us</a>
                </div> 
            </div>
        </div>

        <div class="-mt-20 relative w-[70%] mx-auto">
            <div class="container mx-auto grid grid-cols-4 text-white">

                <!-- Schedule -->
                <div class="flex flex-col rounded-l-2xl bg-prims-yellow-1 py-8 px-6">
                    <h3 class="text-4xl font-extrabold mb-3">Schedule</h3>
                    <h4 class="text-xl font-light mb-3">Walk-ins</h4>
                    <h5 class="text-2xl">Morning</h5>
                    <h5 class="text-2xl font-extralight mb-3">7:00 AM - 11:30 AM</h5>
                    <h5 class="text-2xl">Afternoon</h5>
                    <h5 class="text-2xl font-extralight:">1:00 PM - 5:00 PM</h5>
                </div>

                <!-- Checkups -->
                <div class="flex flex-col bg-prims-yellow-1 py-8 px-6">
                    <h3 class="text-4xl font-extrabold mb-3">Checkups</h3>
                    <h4 class="text-xl font-light mb-3">Walk-ins (Wednesdays)</h4>
                    <h5 class="text-2xl">Morning</h5>
                    <h5 class="text-2xl font-extralight mb-3">7:00 AM - 11:30 AM</h5>
                    <h5 class="text-2xl">Afternoon</h5>
                    <h5 class="text-2xl font-extralight:">1:00 PM - 5:00 PM</h5>
                </div>

                <!-- Patient Portal -->
                <div class="flex flex-col bg-prims-yellow-1 py-8 px-6">
                    <h3 class="text-4xl font-extrabold mb-3">Patient Portal</h3>
                    <h5 class="text-md">You can access our patient portal to request medical records or set appointments in the calendar.</h5>
                    <div class="flex justify-end">
                        <x-prims-sub-button1 href="" class="my-6">Go to portal</x-prims-sub-button1>
                    </div>
                </div>

                <!-- About Us -->
                <div class="flex flex-col rounded-r-2xl bg-prims-yellow-1 py-8 px-6">
                    <h3 class="text-4xl font-extrabold mb-3">About Us</h3>
                    <h5 class="text-md">Learn about the APC-Clinic including its facilities and personnel.</h5>
                    <div class="flex justify-end">
                        <x-prims-sub-button1 href="" class="my-6">About Us</x-prims-sub-button1>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-12 w-[70%] py-12 mx-auto">
            <div class="w-[45%]">
                <img src="img/sample-pic.svg" class="object-cover rounded-lg">
            </div>
            <div class="flex flex-col w-[50%] text-left">
                <p class="font-bold text-4xl mb-6">We care for you.</p>
                <p class="text-lg">At APC Clinic, we are dedicated to providing quality and accessible healthcare services to our community. Our clinic offers free checkups, including blood pressure monitoring and COVID-19 testing, ensuring that everyone has access to essential health screenings. In addition, we are excited to announce that our dental clinic will be launching soon to expand our services further. <br><br> Committed to promoting wellness and preventive care, APC Clinic strives to create a healthier environment for all. Visit us today and experience compassionate care at no cost!</p>
            </div>
        </div>

        <footer class="bg-prims-yellow-1 w-full h-16 pl-6">
            <div class="container flex gap-4 items-center">
                <img src="img/apc-logo.svg" class="object-scale-down h-16">
                <p>Asia Pacific College</p>
            </div>
        </footer>
        
</x-app-layout>
