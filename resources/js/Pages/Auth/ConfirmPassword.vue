<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="تایید رمز عبور" />

        <div class="mb-4 text-sm text-gray-600">
            قبل از ادامه رمز عبور خود را وارد کنید.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="رمز عبور" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex justify-end mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    تایید
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
