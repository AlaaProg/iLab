<template>
    <div class="fixed bg-slate-300 bg-opacity-30 top-10 left-0 w-full h-full overflow-y-scroll">
        <div class="w-full flex items-center justify-center py-12 ">
            <div class="bg-white lg:w-1/3 md:w-1/2 w-full rounded-lg shadow-lg p-6">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
