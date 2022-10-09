<template>
    <AuthenticatedLayout>
        <Head title="خانه" />

        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div v-for="(label, type) in $page.props.types" :key="type">
                        <p
                            class="text-gray-500 text-lg text-center inline-block p-2 m-5"
                        >
                            {{ label + " ها" }}
                        </p>
                        <Wishes :wishes="wishes[type]" :text="text" />
                        <div class="h-10 px-4">
                            <PlusLink :href="route('wish.add', type)">
                                اضافه کن
                            </PlusLink>
                        </div>
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
import { ref } from "@vue/reactivity";

defineProps(["wishes"]);

const text = ref({
    title: "اسم",
    price: "قیمت",
    date: "تاریخ",
});
</script>
