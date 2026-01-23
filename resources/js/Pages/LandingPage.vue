<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

function loginWithGoogle() {
  window.location.href = route('google.redirect')
}

</script>

<template>
    <AppLayout>
        <template #main>
            <Head title="Akunthink" />
            <div class="w-full flex flex-col items-center">
                <div class="w-[70dvw]  flex items-center gap-10 pr-10 phone:flex-col phone:pr-3 phone:gap-5  phone:w-[90dvw]">
                    <img src="/storage/images/akunthink-illustration.jpg" width="650" class="phone:!w-[100%]"/>
                    <div class=" flex flex-col gap-10 phone:items-center ">
                        <span class="text-[#80da5a] text-6xl phone:text-3xl text-center">Tak perlu bayar software akuntansi mahal, kalau pakai Excel* juga bisa</span>
                        <Button label="Mulai Coba" pt:root:class="w-64 bg-[#eb8227] border-[#eb8227] text-xl py-3" @click="loginWithGoogle"/>
                    </div>
                </div>
                <div class="w-[70dvw]  flex items-center gap-10 mt-7 phone:flex-col phone:w-[90dvw]">
                    <div class="grid grid-cols-2 gap-10 w-full phone:grid-cols-1">
                        <div class=" col-span-1 px-10 py-5 phone:px-0 ">
                            <h1 class="text-5xl text-[#80da5a] font-bold leading-[3.5rem]">Apa itu AkunThink?</h1>
                            <p class="mt-5 text-2xl w-[80%] leading-10 phone:w-[100%] phone:text-justify phone:text-xl">Diadaptasi dari kebiasaan <b>pemilik bisnis kecil</b> mencatat pembukuan dengan menggunakan aplikasi <b>spreadsheet</b> (Excel, Gsheets, dll).</p>
                            <p class="mt-5 text-2xl w-[80%] leading-10 phone:w-[100%] phone:text-justify phone:text-xl">Lalu Kami buat dengan tambahan metode <b>Single Entry Modified</b>.  Hasilnya adalah aplikasi akuntansi yang <b>mudah</b> dipahami dan <b>cepat</b> dikerjakan.</p>
                        </div>
                        <div class=" col-span-1 pt-5 phone:pt-0">
                            <div class="h-[30rem] bg-[url(/storage/images/akunthink-illustration-2.jpg)] 
                            rounded-l-[2rem] bg-[length:650px_auto] bg-[position:50%_40%] bg-no-repeat
                            phone:h-[22rem] phone:rounded-[1rem] phone:bg-[length:430px_auto] phone:bg-[position:40%_30%]
                            "></div>
                        </div>
                    </div>
                </div>
                <div class="w-full  flex  flex-col justify-center items-center gap-10  bg-[#eb8227] py-12">
                    <div class="w-[70dvw] flex  flex-col justify-center  gap-10 px-10 phone:w-[90dvw] phone:justify-start phone:px-3">
                        <div class="w-[50%] phone:w-[100%]">
                            <h1 class="text-5xl leading-[3.5rem] phone:text-4xl">3 alasan AkunThink paling pas untuk bisnis kecil !! </h1>
                        </div>
                        <div class="flex flex-row gap-12 w-full justify-center phone:flex-col">
                            <div class="flex flex-col phone:border phone:border-black phone:py-7 phone:rounded-md">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center w-28 h-28 border-8 rounded-full border-black">
                                        <span class="text-6xl font-bold">Rp</span>
                                    </div>
                                </div>
                                <h3 class="text-3xl mt-5 phone:text-center">Murah dibanding software lainnya </h3>
                                <span class="text-xl mt-3 phone:text-center">Tak perlu bayar jutaan per tahun untuk berlangganan software akuntansi</span>
                            </div>
                            <div class="flex flex-col phone:border phone:border-black phone:py-7 phone:rounded-md">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center w-28 h-28 border-8 rounded-full border-black">
                                        <i class="pi pi-google text-6xl font-bold"/>
                                    </div>
                                </div>
                                <h3 class="text-3xl mt-5 phone:text-center">Berbasis Platform Google Workspace </h3>
                                <span class="text-xl mt-3 phone:text-center">Jaminan keandalan dalam bekerja dan menyimpan data online</span>
                            </div>
                            <div class="flex flex-col pl-6 phone:border phone:border-black phone:py-7 phone:pl-0 phone:rounded-md">
                                <div class="flex justify-center">
                                    <div class="flex justify-center items-center w-28 h-28 border-8 rounded-full border-black">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="4"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            width="80"
                                            height="80"
                                        >
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
        
                                    </div>
                                </div>
                                <h3 class="text-3xl mt-5 phone:text-center">Metode Input Transaksi Termudah </h3>
                                <span class="text-xl mt-3 phone:text-center">Dibuat dengan metode single entry modified yang mengadaptasi Jurnal Kas</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[70dvw]  flex items-center gap-10 mt-10 px-10 phone:w-[100dvw]">
                    <div class="grid grid-cols-3 w-full gap-7 phone:flex phone:flex-col">
                        <div class="flex flex-col min-h-[30rem] justify-between phone:flex-row phone:min-h-0 phone:items-center">
                            <h1 class="text-5xl text-[#eb8227] font-bold">Mulai <br/>saja dulu...</h1>
                            <img src="/storage/images/akunthink-logo.png" width="200" class="ml-4 phone:w-32"/>
                        </div>
                        <div class="flex flex-col gap-5 items-center">
                            <div class="flex flex-col bg-[#7ed957] items-center rounded-xl py-7 px-5 min-h-[28rem]">
                                <h1 class="text-3xl  font-bold mb-7">BASIC</h1>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="font-extrabold text-xl">Maks. 3 input transaksi per tanggal</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="text-xl">Laporan Keuangan (Laba Rugi, Neraca, Perubahan Modal, Arus Kas)</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="text-xl">Multi Editor</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="font-extrabold text-xl">Tanpa Konsultasi</span>
                                </div>
                                <h1 class="text-3xl  font-bold mt-7">Gratis Selamanya</h1>
                            </div>
                            <Button label="Mulai Coba" pt:root:class="w-64 bg-[#7ed957] border-[#7ed957] text-xl py-3"/>
                        </div>
                        <div class="flex flex-col gap-5 items-center">
                            <div class="flex flex-col bg-[#eb8227] items-center rounded-xl py-7 px-5 min-h-[28rem]">
                                <h1 class="text-3xl  font-bold mb-7">PREMIUM</h1>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="font-extrabold text-xl">Tanpa batasan input transaksi per tanggal</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="text-xl">Laporan Keuangan (Laba Rugi, Neraca, Perubahan Modal, Arus Kas)</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="text-xl">Multi Editor</span>
                                </div>
                                <div class="border-b py-2 text-center w-full border-slate-300">
                                    <span class="font-extrabold text-xl">Konsultasi*</span>
                                </div>
                                <h1 class="text-3xl  font-bold mt-7">Rp 25.000/bulan*</h1>
                                <span class="text-xl">(Dibayar per 6 bulan/ 1 tahun)</span>
                            </div>
                            <Button label="Mulai Coba" pt:root:class="w-64 bg-[#eb8227] border-[#eb8227] text-xl py-3"/>
                        </div>
        
                    </div>
                </div>
                <div class="w-full  flex  flex-col justify-center items-center gap-10  bg-[#7ed957] py-12 mt-14">
                    <div class="w-[70dvw] flex  flex-col justify-center  gap-10 px-10 items-center phone:w-[85dvw]">
                        <h1 class="text-4xl text-white font-bold w-[30rem] text-center">Kata mereka yang sudah menggunakan AkunThink</h1>
                        <div class="grid grid-cols-3 w-full gap-7 mt-24 phone:flex phone:flex-col phone:mt-7">
                            <div class="flex flex-col gap-4 phone:border phone:border-white phone:p-4 phone:rounded-md">
                                <div class="flex gap-3 items-end">
                                    <div class="w-20 h-20 rounded-3xl bg-[url(/storage/images/sidonikmat.jpg)] bg-cover"></div>
                                    <h1 class="text-xl font-extrabold text-white">Bakmi Jawa<br/> Sido Nikmat</h1>
                                </div>
                                <p class="text-white phone:text-justify">Ternyata mengerjakan keuangan di sela-sela kesibukan mengurusi operasional kedai, sangat bisa lho! Terimakasih  untuk AkunThink yang sudah membantu kami.</p>
                            </div>
                            <div class="flex flex-col gap-4 phone:border phone:border-white phone:p-4 phone:rounded-md">
                                <div class="flex gap-3 items-end">
                                    <div class="w-20 h-20 rounded-3xl bg-[url(/storage/images/rendang-sapi-uni-vivi.jpg)] bg-cover bg-center"></div>
                                    <h1 class="text-xl font-extrabold text-white">Rendang Sapi<br/> Uni Vivi</h1>
                                </div>
                                <p class="text-white phone:text-justify">Produk kami biasanya dipesan pas ada event seperti arisan dan acara keluarga. Kami butuhnya aplikasi akuntansi yang mudah dan murah. Untung ada AkunThink!</p>
                            </div>
                            <div class="flex flex-col gap-4 phone:border phone:border-white phone:p-4 phone:rounded-md">
                                <div class="flex gap-3 items-end">
                                    <div class="w-20 h-20 rounded-3xl bg-[url(/storage/images/sambal-gledek.jpg)] bg-cover bg-center"></div>
                                    <h1 class="text-xl font-extrabold text-white">Sambal Gledeg<br/> BVJ Original</h1>
                                </div>
                                <p class="text-white phone:text-justify">Buat kami yang berjualan online, AkunThink sangat membantu dalam mencatat transaksi penjualan dan pembelian bahan baku. Simpel dan mudah dipahami. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[70dvw]  flex items-center gap-10 px-10 py-10">
                    <div class="grid grid-cols-2 w-full gap-7 phone:flex phone:flex-col">
                        <div class="flex flex-col min-h-[30rem] justify-between ">
                            <h1 class="text-5xl text-[#eb8227] font-bold leading-[3.5rem]">Jangan ragu <br/>kontak kami!</h1>
                            <img src="/storage/images/akunthink-logo.png" width="200" class="ml-4"/>
                            <Button label="Mulai Coba" pt:root:class="w-64 bg-[#eb8227] border-[#eb8227] text-xl py-3"/>
                        </div>
        
                        <div class="flex flex-col min-h-[30rem] gap-16 ">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-4xl text-[#7ed957] font-bold">WA (chat only)</h1>
                                <span class="text-2xl">0821-2660-6079</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="text-4xl text-[#7ed957] font-bold">Email</h1>
                                <span class="text-2xl">akunthinkid@gmail.com</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="text-4xl text-[#7ed957] font-bold">Sosial</h1>
                                <div class="flex gap-5">
                                    <i class="pi pi-facebook text-2xl"/>
                                    <i class="pi pi-instagram text-2xl"/>
                                    <i class="pi pi-tiktok text-2xl"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>