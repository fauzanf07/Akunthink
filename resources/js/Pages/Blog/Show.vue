<script setup>
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const html = ref('')

onMounted(async () => {
    const res = await fetch(`/api/blog/${page.props.id}`)
    const data = await res.json()
    console.log(data)
    html.value = data.html
})
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Blog Post</h1>

        <div v-html="html" class="prose"></div>
    </div>
</template>
