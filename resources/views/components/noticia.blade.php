@props(['noticia'])

<div class="flex justify-between w-full p-6 mt-2 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-blue-500 hover:underline">
            <a href="{{ $noticia->url }}">{{ $noticia->titular }}</a>
        </h5>
        <p class="text-xs text-gray-500 pb-5">{{ $noticia->created_at }}</p>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ $noticia->descripcion }}</p>
    </div>
    <div>
        <img src="{{ $noticia->imagen }}" />
    </div>
</div>
