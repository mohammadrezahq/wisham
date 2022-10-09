<template>
    <div class="break-words">
        <b>{{ bold }}</b> <slot></slot>
    </div>
</template>
<script setup>
defineProps(["bold"]);
</script>
