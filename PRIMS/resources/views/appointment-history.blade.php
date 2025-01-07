@section('title', 'PRIMS · Appointment History')

<x-app-layout>
    
    <div class="py-12">
        <!-- div ni erika -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 lg:p-8 gap-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex flex-wrap justify-around">
                        <!-- left - picture -->
                        <div>
                            <img src="img/appointment-history/temp-id-pic.jpg" class="max-h-44 inline-block align-middle">
                        </div>
                        <!-- center - personal details -->
                        <div class="flex flex-col">
                            <!-- name -->
                            <div class="text-2xl pb-5">
                                <strong>Jay Christ Fernandez</strong>
                            </div>
                            <div class="flex justify-between gap-3 flex-wrap">
                                <div class="flex flex-col gap-3">
                                    <!-- student number -->
                                    <div class="text-sm flex flex-row align-center gap-2">
                                        <img src="img/appointment-history/id-number-icon.svg" class="max-h-20">
                                        <span>2022-187311</span>
                                    </div>
                                    <!-- contact number -->
                                    <div class="text-sm flex flex-row align-center gap-2">
                                        <img src="img/appointment-history/contact-number-icon.svg" class="max-h-20">
                                        <span>09752986539</span>
                                    </div>
                                    
                                </div>
                                <div class="flex flex-col gap-3 max-w-[70%]">
                                    <!-- email -->
                                    <div class="text-sm flex flex-row align-center gap-2 break-all">
                                        <img src="img/appointment-history/email-icon.svg" class="max-h-20">
                                        <span>jcfrancisco@student.apc.edu.ph</span>
                                    </div>
                                    <!-- address -->
                                    <div class="text-sm flex flex-row align-center gap-2 break-words">
                                        <img src="img/appointment-history/address-icon.svg" class="max-h-20">
                                        <span>1234 Taft Avenue, Malate, Manila, Philippines long long long long long long long long </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right - appointments -->
                        <div>
                            <div class="flex flex-col gap-3">
                                <span><strong>Upcoming Appointment:</strong></span>
                                <span class="text-sm">[date] - [start_time] to [end_time]</span>
                                <span class="text-sm">January 5, 2027 - 1:45 to 2:30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                            

</x-app-layout>