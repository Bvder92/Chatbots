<div class="m-2 text-2xl font-bold px-8 pt-6">Rechercher</div>
<div class="p-4">
    <form action=" {{ route('dashboard') }}" method="get">
        <input type="text" value="{{ request('search', '') }}" name="search" id="search" class="m-2 border-2 border-gray-500 border-t-0 border-x-0 bg-inherit">
        <button type="submit"
            class="btn-primary">Rechercher</button>
    </form>
</div>
