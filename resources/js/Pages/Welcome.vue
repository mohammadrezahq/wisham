<template>
    <Head title="محل نگهداری آرزو ها" />
    <div class="flex sm:h-screen justify-center flex-col sm:flex-row" dir="rtl">
        <div
            class="overflow-hidden h-screen p-4 text-center flex items-center justify-center"
        >
            <div>
                <div>
                    <Logo class="w-full" />
                </div>
                <hr class="my-4" />
                <h1 class="text-2xl shabnam-bold">
                    <b class="text-blue-500">ویشام </b>لیستتو درست کن
                </h1>
                <p class="mt-2">
                    همین الان لیست چیزایی که دوست داری رو درست کن...
                </p>
                <br />
                <div class="text-center flex justify-center gap-x-2">
                    <PrimaryLink href="/login">ورود</PrimaryLink>
                    <PrimaryLink href="/register">ثبت نام</PrimaryLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PrimaryLink from "@/Components/PrimaryLink.vue";
import Logo from "@/Components/ApplicationLogo.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Wish from "@/Pages/Components/Wish.vue";
</script>
