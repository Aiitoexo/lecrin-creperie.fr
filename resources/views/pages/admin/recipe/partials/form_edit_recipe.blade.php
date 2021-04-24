@if(isset($errors))
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="text-red-500" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
@endif

<form action="{{ route('admin.recipe.update', ['id' => $item_menu->id]) }}"
      method="post"
      enctype="multipart/form-data"
      class="w-full">
    @csrf
    <div class="w-full flex justify-evenly">
        <div>
            <input name="name" id="name" type="text" placeholder="Nom" value="{{ $item_menu->name }}">
        </div>

        <div>
            <input name="price" id="price" type="text" placeholder="Prix" value="{{ $item_menu->price }}">
        </div>

        <ul>
            <select name="section" id="section">
                <option value="">Section</option>
                @foreach($all_sections as $section)
                    <option value="{{ $section->id }}" {{ $item_menu->section == $section->id ? 'selected' : '' }}>
                        {{ $section->name }}
                    </option>
                @endforeach
            </select>
        </ul>
    </div>

    <div class="flex">
        <div>
            <label for="img"></label>
            <input name="img" id="img" type="file">
        </div>

        <div>
            <input class="w-96" name="alt_img" id="alt_img" type="text" placeholder="Description Image" value="{{ $item_menu->alt_img }}">
        </div>
    </div>

    <hr>
    <ul class="grid grid-cols-2">
        @foreach($all_ingredients as $ingredient)
            <li class="col-span-1">
                <input name="ingredients[]" id="ingredient_{{ $ingredient->id }}"
                       value="{{ $ingredient->id }}"
                       type="checkbox"
                    {{ $item_menu->ingredientRecipe->pluck('id')->contains($ingredient->id) ? 'checked' : '' }}>
                <label for="ingredient_{{ $ingredient->id }}">{{ $ingredient->name }}</label>
            </li>
        @endforeach
    </ul>
    <hr>
    <ul class="grid grid-cols-2">
        @foreach($all_allergens as $allergen)
            <li class="col-span-1">
                <input name="allergens[]" id="allergen_{{ $allergen->id }}"
                       value="{{ $allergen->id }}"
                       type="checkbox"
                    {{ $item_menu->allergenRecipe->pluck('id')->contains($allergen->id) ? 'checked' : '' }}>
                <label for="allergen_{{ $allergen->id }}">{{ $allergen->name }}</label>
            </li>
        @endforeach
    </ul>

    <div>
        <select name="menu" id="menu">menu
            <option value="">Menu</option>
            @if ($item_menu->menu == true)
                <option value="1" selected>Oui</option>
                <option value="0">Non</option>
            @else
                <option value="1">Oui</option>
                <option value="0" selected>Non</option>
            @endif
        </select>
    </div>

    <button class="button" type="submit">Modifier</button>
</form>
