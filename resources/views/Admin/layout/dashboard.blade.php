@extends('Admin.layout.index')
@Section('content')
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h5>
                    {{ __('Dashboard') }}
                </h5>
            </div>
            <div class="col-12">


                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: white">User Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}" style="color: white">{{ __('Profile') }}</a>
                    </li>

                </ul>
            </div>

        </div>

    </div>
@endsection
