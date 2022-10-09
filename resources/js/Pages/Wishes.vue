<template>
    <AuthenticatedLayout>
        <Head :title="type.title + ' ها'" />
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <p
                        class="text-gray-500 text-lg text-center inline-block p-2 m-5"
                    >
                        {{ type.title + " ها" }}
                    </p>

                    <p v-if="wishes.length == 0" class="p-2">
                        لیستت خالیه هنوز، ازین پایین اضافه کن
                    </p>

                    <Wishes
                        :wishes="wishes"
                        :text="{
                            title: type.title ?? 'Title',
                            date: 'تاریخ',
                            comment: 'توضیحات',
                            price: 'قیمت',
                        }"
                    />

                    <div class="h-10 px-4">
                        <PlusLink :href="route('wish.add', type.name)">
                            اضافه کن
                        </PlusLink>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Wishes from "@/Pages/Components/Wishes.vue";
import PlusLink from "@/Components/PlusLink.vue";

defineProps(["wishes", "type"]);
</script>
