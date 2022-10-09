<template>
    <div class="pb-10 flex flex-wrap">
        <div
            v-for="(wish, index) in wishes"
            :key="wish.id"
            class="w-full inline-block md:w-1/2 p-2"
        >
            <Wish
                :wish="wish"
                :text="text"
                :i="index"
                v-on:remove="removeWish(index)"
            />
        </div>
    </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import Wish from "./Wish.vue";

const props = defineProps(["wishes", "text"]);

const wishes = ref(props.wishes);
const text = ref(props.text);

const removeWish = (i) => {
    wishes.value.splice(i, 1);
};
</script>
