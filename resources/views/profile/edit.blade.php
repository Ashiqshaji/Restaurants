<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">

            <div class="w-1/2">
                <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ __('Profile') }}
                </h1>
            </div>


            <div class="w-1/2">

                <a href="{{ route('admin.reservationlist') }}" id="profile_image" class="logo d-flex ">
                    <img src="{{ URL::to('assets/img/Quince-brand.png') }}" alt=""
                        style="
                    height: 38px;
                ">
                    <!-- <h1 class="sitename">Quince</h1> -->
                </a>
            </div>
        </div>

    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
