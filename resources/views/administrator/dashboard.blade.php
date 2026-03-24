<x-layouts.app :title="__('Administrator Dashboard')" :header="__('Administrator Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <section class="grid auto-rows-min gap-4 md:grid-cols-3 lg:grid-cols-2">
            <h3 class="col-span-full text-lg font-semibold">
                Welcome to the Administrator Dashboard
            </h3>
            <!-- Leverancier Card -->
            <a href="{{ route('leverancier.index') }}"
                class="group relative aspect-video overflow-hidden rounded-xl border border-white/10 bg-white/5 p-4 shadow-lg ring-1 ring-white/10 backdrop-blur transition hover:-translate-y-1 hover:shadow-xl hover:ring-2 hover:ring-blue-400/50 dark:border-white/5 dark:bg-white/5">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/10 transition group-hover:stroke-blue-400/30 dark:stroke-neutral-100/10" />
                <div class="relative flex h-full flex-col justify-between text-white">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-blue-200/80">Navigatie</p>
                        <h4 class="mt-1 text-lg font-semibold">Overzicht Leverancier</h4>
                        <p class="mt-2 text-sm text-blue-50/80">Bekijk en beheer alle leveranciers vanuit dit overzicht.
                        </p>
                    </div>
                    <div
                        class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-blue-200 group-hover:text-blue-100">
                        Ga naar overzicht
                        <span aria-hidden="true">→</span>
                    </div>
                </div>
            </a>
            <!-- Allergeen Card -->
            <a href="{{ route('allergeen.index') }}"
                class="group relative aspect-video overflow-hidden rounded-xl border border-white/10 bg-white/5 p-4 shadow-lg ring-1 ring-white/10 backdrop-blur transition hover:-translate-y-1 hover:shadow-xl hover:ring-2 hover:ring-blue-400/50 dark:border-white/5 dark:bg-white/5">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/10 transition group-hover:stroke-blue-400/30 dark:stroke-neutral-100/10" />
                <div class="relative flex h-full flex-col justify-between text-white">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-blue-200/80">Navigatie</p>
                        <h4 class="mt-1 text-lg font-semibold">Overzicht Allergeen</h4>
                        <p class="mt-2 text-sm text-blue-50/80">Bekijk en beheer alle allergenen vanuit dit overzicht.
                        </p>
                    </div>
                    <div
                        class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-blue-200 group-hover:text-blue-100">
                        Ga naar overzicht
                        <span aria-hidden="true">→</span>
                    </div>
                </div>
            </a>
            <!-- Geleverde Producten Card -->
            <a href="{{ route('leverancier.geleverde-producten') }}"
                class="group relative aspect-video overflow-hidden rounded-xl border border-white/10 bg-white/5 p-4 shadow-lg ring-1 ring-white/10 backdrop-blur transition hover:-translate-y-1 hover:shadow-xl hover:ring-2 hover:ring-blue-400/50 dark:border-white/5 dark:bg-white/5">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/10 transition group-hover:stroke-blue-400/30 dark:stroke-neutral-100/10" />
                <div class="relative flex h-full flex-col justify-between text-white">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-blue-200/80">Navigatie</p>
                        <h4 class="mt-1 text-lg font-semibold">Overzicht Geleverde Producten</h4>
                        <p class="mt-2 text-sm text-blue-50/80">Bekijk en beheer alle geleverde producten vanuit dit
                            overzicht.</p>
                    </div>
                    <div
                        class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-blue-200 group-hover:text-blue-100">
                        Ga naar overzicht
                        <span aria-hidden="true">→</span>
                    </div>
                </div>
            </a>
             <!-- Magazijn -->
            <a href="{{ route('magazijn.index') }}"
                class="group relative aspect-video overflow-hidden rounded-xl border border-white/10 bg-white/5 p-4 shadow-lg ring-1 ring-white/10 backdrop-blur transition hover:-translate-y-1 hover:shadow-xl hover:ring-2 hover:ring-blue-400/50 dark:border-white/5 dark:bg-white/5">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/10 transition group-hover:stroke-blue-400/30 dark:stroke-neutral-100/10" />
                <div class="relative flex h-full flex-col justify-between text-white">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-blue-200/80">Navigatie</p>
                        <h4 class="mt-1 text-lg font-semibold">Overzicht Magazijn</h4>
                        <p class="mt-2 text-sm text-blue-50/80">Bekijk en beheer alle producten in het magazijn vanuit dit
                            overzicht.</p>
                    </div>
                    <div
                        class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-blue-200 group-hover:text-blue-100">
                        Ga naar overzicht
                        <span aria-hidden="true">→</span>
                    </div>
                </div>
            </a>
        </section>
    </div>
</x-layouts.app>
