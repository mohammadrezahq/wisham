<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-6 py-2 bg-gradient-to-br from-blue-500 to-indigo-300 rounded-full font-semibold text-sm text-white hover:scale-110 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
