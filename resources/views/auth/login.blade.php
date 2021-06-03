@extends('base')

@section('body')
    <div class="w-screen h-screen flex flex-col justify-center items-center gap-y-10">
        <div class="w-3/12 mx-auto bg-yellow-500 py-12 px-20 rounded-6xl border-8 border-gray-800">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input id="email"
                           class="block mt-1 w-full rounded"
                           type="email"
                           name="email"
                           :value="old('email')"
                           required
                           autofocus>
                </div>

                <div class="mt-4">
                    <label for="password">Password</label>
                    <input id="password"
                           class="block mt-1 w-full rounded"
                           type="password"
                           name="password"
                           required autocomplete="current-password">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="button">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


