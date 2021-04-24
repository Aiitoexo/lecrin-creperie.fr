<form action="{{ route('payment.info') }}" class="flex flex-col w-full gap-y-4 mt-16" method="post">
    @csrf
    <div class="flex w-full gap-x-6">
        <div class="flex flex-col items-center w-2/5">
            <label class="text-white w-full text-left" for="last_name">Nom</label>
            <input class="w-full rounded-xl border-2 border-yellow-500" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
            @error('last_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col items-center w-3/5">
            <label class="text-white w-full text-left" for="phone">Telephone</label>
            <input class="w-full rounded-xl border-2 border-yellow-500" type="number" name="phone" id="phone" value="{{ old('phone') }}">
        </div>
    </div>

    <div class="flex w-full gap-x-6">
        <div class="flex flex-col items-center w-2/5">
            <label class="text-white w-full text-left" for="first_name">Prénom</label>
            <input class="w-full rounded-xl border-2 border-yellow-500" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
        </div>

        <div class="flex flex-col items-center w-3/5">
            <label class="text-white w-full text-left" for="mail">E-mail</label>
            <input class="w-full rounded-xl border-2 border-yellow-500" type="email" name="mail" id="mail" value="{{ old('mail') }}">
        </div>
    </div>

    @if (session('type_command') == 'livraison')
        <div class="flex flex-col items-center w-full">
            <label class="text-white w-full text-left" for="adresse">Adresse</label>
            <input class="w-full rounded-xl border-2 border-yellow-500" type="text" name="adresse" id="adresse" value="{{ old('adresse') }}">
        </div>

        <div class="flex w-full gap-x-6">
            <div class="flex flex-col items-center w-2/5">
                <label class="text-white w-full text-left" for="postal">Code Postal</label>
                <input class="w-full rounded-xl border-2 border-yellow-500" type="number" name="postal" id="postal" value="{{ old('postal') }}">
            </div>

            <div class="flex flex-col items-center w-3/5">
                <label class="text-white w-full text-left" for="city">Ville</label>
                <input class="w-full rounded-xl border-2 border-yellow-500" type="text" name="city" id="city" value="{{ old('city') }}">
            </div>
        </div>
    @endif

    <div class="flex flex-col items-center w-full">
        <label class="text-white w-full text-left" for="text">Information Complémentaire</label>
        <textarea class="w-full h-24 rounded-xl border-2 border-yellow-500" name="text" id="text"></textarea>
    </div>

    <div class="w-full flex justify-end mt-4">
        <button class="px-12 py-2 bg-yellow-500 rounded-full text-gray-800">Valider</button>
    </div>
</form>
