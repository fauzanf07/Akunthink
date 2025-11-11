<script setup>
import axios from "axios";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import Toast from "primevue/toast";
import { ref } from "vue";
import { useToast } from "primevue/usetoast";
import { router } from "@inertiajs/vue3";

const companyName = ref('');
const waNum = ref('');
const isDisabled = ref(true);

const toast = useToast();

const onInput = () => {
    if(companyName.value && waNum.value){
        isDisabled.value = false;
    }else{
        isDisabled.value = true;
    }
}

const saveData = () =>{
    if(!isDisabled.value){
        axios
            .post(
                route('profile.initialData.save'),
                {
                    companyName: companyName.value,
                    waNum: waNum.value
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                }
            )
            .then((response) => {
                if (response.data.status === 'success') {
                    toast.add({ severity: 'success', summary: 'Berhasil', detail: 'Berhasil menyimpan Data', life: 3000 });
                    setTimeout(() => {
                        router.visit(route('dashboard'));
                    }, 500);
                    
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
}

</script>
<template>
    <div
        class="flex min-h-screen flex-col items-center  pt-6 sm:justify-center sm:pt-0"
    >

        <div
            class="mt-6 w-full overflow-hidden px-14 py-4 pb-7 shadow-md sm:max-w-md sm:rounded-lg border-2 border-slate-300 ">
            <div class="flex flex-col justify-center items-center">
                <img src="/storage/images/akunthink-logo.png" width="120" />
            </div>
            <div class="flex flex-col mt-5 gap-3">
                <div class="w-full">
                    <label for="companyName" class="font-bold">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <InputText id="companyName" label="Nama Perusahaan" class="w-full" v-model="companyName" @input="onInput"/>
                </div>
                <div class="w-full">
                    <label for="waNum" class="font-bold">Nomor WhatsApp <span class="text-red-500">*</span></label>
                    <InputText id="waNum" label="Nomor WhatsApp" class="w-full"  oninput="this.value = this.value.replace(/\D+/g, '')" maxlength="13" v-model="waNum" @input="onInput"/>
                </div>
                <div class="mt-3 w-full">
                    <Button label="Simpan Data" class="w-full" :disabled="isDisabled" @click="saveData"/>
                </div>
            </div>
        </div>
        <div class="flex absolute bottom-4 items-center justify-center">
        </div>
    </div>
    <Toast/>
</template>