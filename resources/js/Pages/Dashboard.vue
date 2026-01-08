<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Button } from 'primevue';

const props = defineProps({
    sheetId: {
        type: String,
        default:  ''
    },
    idUser: {
        type: String,
        default:  ''
    },
});

const openForm = (sheetId, idUser) =>{
    const link = 'https://script.google.com/macros/s/AKfycbx8DC0eKRVZwJavVg219y47Qmn3KcRFK8MlnqL1LZguuZAjcbKuJTHl957QU7kXdMC5/exec?id='+ sheetId + '&' + idUser;
    window.open(link, '_blank');
}
const openSpreadsheet = (sheetId) =>{
    const link = 'https://docs.google.com/spreadsheets/d/'+ sheetId;
    window.open(link, '_blank');
}
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
                        <div class="flex flex-row gap-5">
                            <Button label="Klik disini untuk menuju halaman Form" @click="openForm(sheetId, idUser)"/>
                            <Button label="Klik disini untuk menuju halaman Google Spreadsheet" @click="openSpreadsheet(sheetId)"/>
                        </div>
                            <!-- <a
                                :href="'https://script.google.com/macros/s/AKfycbx8DC0eKRVZwJavVg219y47Qmn3KcRFK8MlnqL1LZguuZAjcbKuJTHl957QU7kXdMC5/exec?id='+sheetId"
                                class="text-blue-400 underline break-all"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                https://script.google.com/macros/s/AKfycbx8DC0eKRVZwJavVg219y47Qmn3KcRFK8MlnqL1LZguuZAjcbKuJTHl957QU7kXdMC5/exec?id={{sheetId}}
                            </a> -->
                    
                            <!-- <a
                                :href="'https://docs.google.com/spreadsheets/d/'+sheetId"
                                class="text-blue-400 underline break-all"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                https://docs.google.com/spreadsheets/d/{{sheetId}}
                            </a> -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
