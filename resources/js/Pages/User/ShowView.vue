<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";

const props = defineProps({
    user: Object,
});
</script>

<template>
    <Head :title="user?.name" />
    <AuthenticatedLayout>
        <div class="flex flex-col gap-2 xl:flex-row">
            <section class="w-full xl:w-2/3">
                <Card>
                    <CardHeader>
                        <CardTitle>{{ user.name }}</CardTitle>
                        <CardDescription>
                            {{ user.position ?? "-" }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent> Card Content </CardContent>
                    <CardFooter> Card Footer </CardFooter>
                </Card>
            </section>
            <section class="w-full xl:w-1/3">
                <Card>
                    <CardHeader>
                        <CardTitle>Card Title</CardTitle>
                        <CardDescription>Card Description</CardDescription>
                    </CardHeader>
                    <CardContent> Card Content </CardContent>
                    <CardFooter> Card Footer </CardFooter>
                </Card>
            </section>
        </div>
        {{ user }}
    </AuthenticatedLayout>
</template>

<style></style>
