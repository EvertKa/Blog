<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link, Head } from "@inertiajs/vue3";
import Article from '@/Components/Article.vue'


const props = defineProps({
    articles: Object
});
</script>

<template>
    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <PrimaryButton class="">
                <Link class="" :href="route('articles.create')"
                    >Create new Article</Link
                >
            </PrimaryButton>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg p-6 grid gap-16 grid-cols-2"
                >
                    <div class="text-gray-900" v-for="article in articles">
                        <Article :article="article" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>