<div class="m-2 text-2xl font-bold px-8 pt-8">Rechercher</div>
<div class="p-4">
    <form action=" {{ route('dashboard') }}" method="get">
        <input type="text" name="search" id="search" class="m-2 border-2 border-gray-200">
        <button type="submit"
            class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Rechercher</button>
    </form>
</div>
