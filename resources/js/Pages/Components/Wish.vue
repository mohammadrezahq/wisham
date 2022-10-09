<template>
    <transition name="fade">
        <div
            v-if="show"
            class="bg-white shadow-xl rounded-lg my-2 mx-auto relative"
            style="max-width: 450px; min-height: 200px; padding: 20px"
        >
            <Row v-if="wish.title" :bold="text.title">
                {{ wish.title }}
            </Row>

            <Row v-if="wish.price" :bold="text.price">
                {{ formatMoney(wish.price) }} تومان
            </Row>

            <Row v-if="wish.date" :bold="text.date">
                {{ doDate(wish.date) }}
            </Row>

            <div v-if="wish.comment" class="mb-20">
                <hr class="my-2" />

                <b>توضیحات: </b>
                <p class="break-words">{{ wish.comment }}</p>
            </div>

            <a
                v-if="wish.link"
                class="absolute bottom-0 break-words right-0 mt-2 p-2 text-gray-400 inline-block"
                :href="wish.link"
            >
                مشاهده
            </a>

            <div
                :style="isPassed() ? 'z-index:9999; color:white' : ''"
                @click="menu[i] = !menu[i]"
                class="absolute cursor-pointer"
                style="top: 10px; left: 5px"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                    />
                </svg>
            </div>

            <div
                @mouseleave="menu[i] = false"
                :style="isPassed() ? 'z-index:9999' : ''"
                v-if="menu[i]"
                class="absolute shadow p-2 bg-white"
                style="left: 5px; top: 35px"
            >
                <Link
                    class="block text-gray-500 hover:text-gray-700 m-4"
                    :href="'/wish/edit/' + wish.id"
                    v-if="props.canDoActions"
                >
                    ویرایش
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 inline-block"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                        />
                    </svg>
                </Link>
                <a
                    class="block text-gray-500 hover:text-gray-700 m-4 cursor-pointer"
                    @click="remove()"
                >
                    حذف
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 inline-block"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </a>
            </div>

            <a
                @click="complete()"
                class="absolute z-40 cursor-pointer p-2 transition-all rounded-tl-none rounded-bl-lg bg-gradient-to-r from-blue-500 to-indigo-300 hover:scale-150 hover:shadow hover:rounded-tr-lg text-white"
                style="left: 0; bottom: 0"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 inline-block"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>
            </a>

            <transition name="fade">
                <div
                    v-if="success"
                    class="sm:rounded-lg z-50 flex text-4xl font-bold items-center justify-center absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-r from-green-500 to-green-700 opacity-80 text-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    تبریک
                </div>
            </transition>

            <div
                v-if="isPassed() && !success"
                class="sm:rounded-lg flex text-4xl font-bold items-center justify-center absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-r from-red-500 to-red-700 opacity-80 text-white"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-10 w-10"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                تایم این گذشته
            </div>

            <div
                v-if="removed"
                class="sm:rounded-lg z-50 flex text-4xl font-bold items-center justify-center absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-r from-red-500 to-red-700 opacity-80 text-white"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-10 w-10"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                حذف
            </div>

            <div
                v-if="isForToday() && !success"
                class="absolute w-24 select-none m-auto font-bold inset-x-0 bottom-2 py-1 px-4 transition rounded-full bg-gradient-to-r from-pink-300 to-pink-500 text-white"
            >
                برای امروز
            </div>
        </div>
    </transition>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Row from "./Wish/Row.vue";
import { ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";

const emit = defineEmits(["remove"]);

const props = defineProps({
    wish: {
        type: Object,
    },
    text: {
        type: Object,
    },
    i: {
        type: Number,
    },
    canDoActions: {
        type: Boolean,
        default: true,
    },
});

const show = ref(true);
const wish = ref(props.wish);
const text = ref(props.text);
const i = ref(props.i);
const canDoActions = props.canDoActions;

const menu = ref([]);
const removed = ref(false);
const success = ref(false);

const formatMoney = (str) => {
    str = str.replace(/\,/g, "");
    var objRegex = new RegExp("(-?[0-9]+)([0-9]{3})");

    while (objRegex.test(str)) {
        str = str.replace(objRegex, "$1,$2");
    }

    return str;
};

const doDate = (input) => {
    const date = new Date(input);
    const faDate = new Intl.DateTimeFormat("fa", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    }).format(date);
    return faDate;
};

const remove = () => {
    if (!canDoActions) {
        return;
    }
    removed.value = true;
    emitRemove();
    Inertia.delete(route("wish.delete", props.wish.id), {
        preserveScroll: true,
    });
};

const complete = () => {
    if (!canDoActions) {
        return;
    }
    success.value = true;
    emitRemove();
    Inertia.post(route("wish.complete", props.wish.id), {
        preserveScroll: true,
    });
};

const isForToday = () => {
    let wishDate = new Date(props.wish.date);
    let today = new Date();

    if (
        wishDate.getMonth() == today.getMonth() &&
        wishDate.getDate() == today.getDate() &&
        wishDate.getFullYear() == today.getFullYear()
    ) {
        return true;
    }

    return false;
};

const isPassed = () => {
    let wishDate = new Date(props.wish.date);
    let today = new Date();
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    today.setMilliseconds(0);

    if (wishDate < today) {
        return true;
    }

    return false;
};

const emitRemove = () => {
    menu.value[i.value] = false;
    setTimeout(() => (show.value = false), 1000);
    setTimeout(() => emit("remove", i.value), 2000);
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
