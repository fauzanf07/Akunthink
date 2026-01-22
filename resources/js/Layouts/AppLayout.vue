<script setup>
import { Menubar } from 'primevue';
import { h, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const menuRoutes = (menu) =>{
    if(menu=='home'){
        router.visit(route('home'));
    }
    else if(menu=='blog'){
        router.visit(route('blog.index'));
    }
    else{
        router.visit(route('pricing'));
    }
}

const url = window.location.href;

</script>
<template>
    <div class="flex flex-col">
        <div class=" sticky top-0 w-full z-30">
            <Menubar :model="items" pt:root:class="py-6 px-8">
                <template #start>
                    <h1 class="text-xl font-bold">Akunthink</h1>
                </template>
                <template #item>
                </template>
                <template #end>
                    <div class="flex flex-row gap-10  text-lg font-semibold phone:hidden">
                        <div class="flex flex-row gap-3 items-center hover:text-[#EB8227] hover:cursor-pointer" :class="!url.includes('blog') && !url.includes('pricing')  ? 'text-[#EB8227]' : ''" @click="menuRoutes('home')">
                            <i class="pi pi-home" style="font-size: 1.4rem;"/>
                            <span class="mt-1">Home</span>
                        </div>
                        <div class="flex flex-row gap-3 items-center hover:text-[#EB8227] hover:cursor-pointer mt-1" :class="url.includes('blog') ? 'text-[#EB8227]' : ''" @click="menuRoutes('blog')">
                            <i class="pi pi-heart" style="font-size: 1.4rem;"/>
                            <span class="">Blog</span>
                        </div>
                        <div class="flex flex-row gap-3 items-center hover:text-[#EB8227] hover:cursor-pointer mt-1" :class="url.includes('pricing') ? 'text-[#EB8227]' : ''" @click="menuRoutes('pricing')">
                            <i class="pi pi-tags" style="font-size: 1.4rem;"/>
                            <span class="">Pricing</span>
                        </div>
                    </div>
                </template>
            </Menubar>
        </div>
        <main>
            <slot name="main">
            </slot>
        </main>
    </div>
</template>