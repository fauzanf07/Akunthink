<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const docs = ref([])
const blog = ref('')
const loading = ref(true);

const dateModified = ref('');

function formatIndoDate(dateString) {
    const months = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    const date = new Date(dateString);

    const day = String(date.getDate()).padStart(2, '0');
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');

    return `${day} ${month} ${year}, ${hours}:${minutes}`;
}

onMounted(async () => {
    const res = await fetch('/api/blog')
    docs.value = await res.json()

    if (docs.value.length) {
        const resBlog = await fetch('/api/blog/' + docs.value[0].id)
        const data = await resBlog.json();
        blog.value = data.html.original.html;
        dateModified.value = formatIndoDate(data.html.original.modifiedTime);
    }

    loading.value = false
})
</script>


<template>
    <AppLayout>
        <template #main>
            <div class="grid grid-cols-10 h-full min-h-full">
                <div class="col-span-7 p-10">
                    <div class="flex justify-end mb-7">
                        <span class="text-sm font-">{{ dateModified }}</span>
                    </div>
                    <div v-if="loading">Loading...</div>
                    <div v-else v-html="blog" class="prose"></div>
                </div>
                <div class="col-span-3 px-3 border-l min-h-full">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold mb-4">Blog</h1>
        
                        <ul class="space-y-2">
                            <li v-for="doc in docs" :key="doc.id">
                                <Link :href="`/blog/${doc.id}`" class="text-blue-600 hover:underline">
                                    {{ doc.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>

</template>
