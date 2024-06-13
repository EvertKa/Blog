<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const form = useForm({
    title: '',
    description: '',
});

const submit = () => {
    form.post(route('articles.store'));
};


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout class="">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Articles</h2>
        </template>
        <div class=" py-2">
            <form @submit.prevent="submit" class="w-fit p-6 m-auto">
                <div>
                    <InputLabel for="title" value="Title" />

                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="description" value="Description" />

                    <TextInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="flex justify-end mt-4">
                    <PrimaryButton class="m-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create article
                    </PrimaryButton>
                </div>
            </form>

        </div>

    </AuthenticatedLayout>
</template>