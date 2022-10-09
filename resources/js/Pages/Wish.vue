<template>
    <AuthenticatedLayout>
        <Head title="افزودن" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-200 mx-auto py-2"
                >
                    <div class="flex p-6 gap-x-2 flex-col lg:flex-row">
                        <div class="w-full lg:w-1/2">
                            <h3 class="font-bold">انتخاب دسته</h3>
                            <div class="flex gap-x-2 mb-6">
                                <PrimaryLink
                                    v-for="(label, t) in $page.props.types"
                                    :href="route('wish.add', t)"
                                    :class="{
                                        'from-red-400 to-red-600':
                                            t == type.name,
                                    }"
                                >
                                    {{ label }}
                                </PrimaryLink>
                            </div>
                            <form @submit.prevent="submit">
                                <div v-if="'title' in type.fields">
                                    <InputLabel
                                        for="title"
                                        :value="'اسم ' + type.title"
                                    />
                                    <TextInput
                                        id="title"
                                        maxlength="100"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.title"
                                        :placeholder="type.fields.title.label"
                                        required
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.title"
                                    />
                                </div>

                                <div class="mt-4" v-if="'price' in type.fields">
                                    <InputLabel for="price" :value="'قیمت'" />
                                    <TextInput
                                        id="price"
                                        type="number"
                                        class="mt-1 block w-full"
                                        :placeholder="type.fields.price.label"
                                        v-model="form.price"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.price"
                                    />
                                </div>

                                <div class="mt-4" v-if="'link' in type.fields">
                                    <InputLabel for="link" :value="'لینک'" />
                                    <TextInput
                                        id="link"
                                        type="url"
                                        :dir="form.link != '' ? 'ltr' : 'rtl'"
                                        class="mt-1 block w-full"
                                        :placeholder="type.fields.link.label"
                                        v-model="form.link"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.link"
                                    />
                                </div>

                                <div class="mt-4" v-if="'date' in type.fields">
                                    <InputLabel for="date" :value="'تاریخ'" />
                                    <TextInput
                                        id="date"
                                        type="text"
                                        class="mt-1 block w-full"
                                        :placeholder="type.fields.date.label"
                                        v-model="form.date"
                                        required
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.date"
                                    />
                                    <date-picker
                                        format="YYYY-MM-DD"
                                        element="date"
                                        v-model="form.date"
                                        simple
                                        auto-submit
                                    ></date-picker>
                                </div>

                                <div
                                    class="mt-4"
                                    v-if="'comment' in type.fields"
                                >
                                    <InputLabel
                                        for="comment"
                                        :value="'توضیحات'"
                                    />
                                    <TextareaField
                                        id="comment"
                                        class="w-full"
                                        maxlength="140"
                                        rows="4"
                                        :placeholder="type.fields.comment.label"
                                        v-model="form.comment"
                                    ></TextareaField>
                                    <span class="text-gray-400">
                                        {{ cmr }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <PrimaryButton
                                        class="mr-4"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        {{ !onEdit ? "اضافه کردن" : "ویرایش" }}
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <Wish
                                :wish="form"
                                :text="{
                                    title: type.title ?? 'Title',
                                    date: 'تاریخ',
                                    comment: 'توضیحات',
                                    price: 'قیمت',
                                }"
                                :canDoActions="false"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";
import TextInput from "@/Components/TextInput.vue";
import TextareaField from "@/Components/Textarea.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import DatePicker from "vue3-persian-datetime-picker";
import Wish from "@/Pages/Components/Wish.vue";
import { ref } from "@vue/reactivity";
import Toast from "more-toast";
import { computed } from "@vue/runtime-core";

const props = defineProps({
    type: Object,
    wish: Object,
});

const type = ref(props.type);
const onEdit = ref(props.wish ? true : false);

const form = useForm(
    props.wish ?? {
        type: props.type.name,
        title: "",
        link: "",
        date: "",
        price: "",
        comment: "",
    }
);

const cmr = computed(() => 140 - form.comment.length);

const submit = () => {
    const config = {
        position: "top-right",
        in: "slide-right",
        out: "slide-right",
        showTime: 2000,
        dir: "rtl",
        canClose: true,
        progressBar: true,
        pauseOnHover: true,
    };

    const style = {
        icon: "success",
        iconColor: "#3b82f6",
        progressBarColor: "#3b82f6",
    };

    const advanced = {
        enterDuration: 700,
        exitDuration: 700,
    };

    const toast = new Toast(config, style, advanced);

    if (!props.wish) {
        form.post(route("wish.store"), {
            onSuccess: () => {
                toast.show("با موفقیت اضافه شد.");
                form.reset();
            },
        });
    }

    if (props.wish) {
        form.put(route("wish.update", props.wish.id), {
            preserveScroll: true,
            onSuccess: () => {
                toast.show("با موفقیت ویرایش شد.");
            },
        });
    }
};
</script>
