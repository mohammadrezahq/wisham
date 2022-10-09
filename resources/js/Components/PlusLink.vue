<template>
    <Link
        class="rounded-full mt-2 py-2 px-4 text-gray-400 border-gray-400 hover:text-gray-700 hover:border-gray-700 border transition"
        :href="href"
    >
        <slot></slot>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 inline-block align-sub"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd"
            />
        </svg>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps(["href"]);
</script>
