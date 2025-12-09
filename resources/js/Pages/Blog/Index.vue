<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const docs = ref([])

onMounted(async () => {
    const res = await fetch('/api/blog')
    docs.value = await res.json()
})
</script>

<template>
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
</template>
