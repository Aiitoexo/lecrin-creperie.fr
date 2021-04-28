@extends('pages.admin.layouts.default_admin')

@section('main_admin')
    <form action="{{ route('admin.tva.store') }}" method="post">
        @csrf
        <div>
            <label for="name_tva">Nom TVA</label>
            <input name="name_tva" id="name_tva" type="text">
        </div>

        <div>
            <label for="tva">Taux TVA</label>
            <input name="tva" id="tva" type="text">
        </div>

        <button>Ajouter</button>
    </form>

    @foreach($all_tva as $tva)
        <p>{{ $tva->name_tva }}</p>
        <p>{{ $tva->tva }}</p>
    @endforeach
@endsection
