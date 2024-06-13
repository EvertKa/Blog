<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps(['article'])

const form = useForm({
    description: props.article.description,
    title: props.article.title,
});

const submit = () => {
    form.put(route('articles.update', props.article));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Log in" />
        <div class="w-full m-auto sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit" class="w-fit p-6 m-auto">
                <div>
                    <InputLabel for="title" value="Article Name" />

                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                        
                    />

                    <TextInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        required
                        
                    />

                    <InputError class="mt-2" :message="form.errors.description" />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="m-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Edit Article
                    </PrimaryButton>
                </div>
            </form>
        </div>
        
    </AuthenticatedLayout>
</template>