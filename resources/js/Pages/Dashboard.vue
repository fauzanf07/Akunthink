<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    sheetId: {
        type: String,
        default:  ''
    },
});

console.log(props);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Selamat Datang
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6"
                >
                    <div class=" text-gray-900">
                        <h1 class="text-lg font-bold">Tata cara menggunakan aplikasi Akunthink :</h1>
                        <ul class="list-disc pl-6 ">
                            <li>Terdapat dua link di bawah ini yang akan digunakan untuk pembuatan data akun ataupun laporan keuangan</li>
                            <li>Link form digunakan untuk pembuatan data akun dan laporan keuangan</li>
                            <li>Link google spreadsheet digunakan untuk melihat hasil dari data akun dan laporan keuangan yang dibuat di link form</li>
                        </ul>
                    </div>
                    <div class="w-full mt-5">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="border-2 border-black w-1/2 bg-green-300">Link Form</th>
                                    <th class="border-2 border-black w-1/2 bg-green-300">Link Google Spreadsheet</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-5 border-2 border-black break-all">
                                        <a
                                            :href="'https://script.google.com/macros/s/AKfycbx8DC0eKRVZwJavVg219y47Qmn3KcRFK8MlnqL1LZguuZAjcbKuJTHl957QU7kXdMC5/exec?id='+sheetId"
                                            class="text-blue-400 underline break-all"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            https://script.google.com/macros/s/AKfycbx8DC0eKRVZwJavVg219y47Qmn3KcRFK8MlnqL1LZguuZAjcbKuJTHl957QU7kXdMC5/exec?id={{sheetId}}
                                        </a>
                                    </td>

                                    <td class="p-5 border-2 border-black break-all">
                                        <a
                                            :href="'https://docs.google.com/spreadsheets/d/'+sheetId"
                                            class="text-blue-400 underline break-all"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            https://docs.google.com/spreadsheets/d/{{sheetId}}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
