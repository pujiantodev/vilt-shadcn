<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Search } from "lucide-vue-next";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

defineProps({
    users: Object,
});
const search = ref("");
const isLoading = ref(false);
const fetchUsers = () => {
    isLoading.value = true;
    router.get(
        route("users.index", { search: search.value }),
        {},
        {
            replace: true,
            preserveState: true,
            preserveScroll: true,
            onFinish: () => (isLoading.value = false),
        },
    );
};

import { useDebounceFn } from "@vueuse/core";
import LoadingOverlay from "@/Components/LoadingOverlay.vue";
const debouncedFn = useDebounceFn(() => {
    fetchUsers();
}, 1000);
watch(search, () => {
    debouncedFn();
});
</script>

<template>
    <Head title="User" />
    <LoadingOverlay :isLoading="isLoading" />
    <AuthenticatedLayout>
        <template #header>Daftar Pengguna</template>
        <Card>
            <CardHeader class="flex flex-row justify-between">
                <div class="relative w-full max-w-sm items-center">
                    <Input
                        id="search"
                        type="text"
                        placeholder="Search..."
                        class="pl-10"
                        v-model="search"
                        @change="fetchUsers"
                    />
                    <span
                        class="absolute inset-y-0 start-0 flex items-center justify-center px-2"
                    >
                        <Search class="size-6 text-muted-foreground" />
                    </span>
                </div>
                <Link :href="route('users.create')">
                    <Button>Tambah User Baru</Button>
                </Link>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Email</TableHead>
                            <TableHead>Nama</TableHead>
                            <TableHead>Nomor HP</TableHead>
                            <TableHead class="text-right"> Aksi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in users.data" :key="user.id">
                            <TableCell class="font-medium">
                                {{ user.name }}
                            </TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>{{ user.phone ?? "-" }}</TableCell>
                            <TableCell class="text-right">
                                <Link :href="route('users.show', user.ulid)">
                                    <Button>Detail</Button>
                                </Link>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
            <CardFooter class="flex justify-start gap-2">
                <Link :href="users.prev_page_url ?? '#'">
                    <Button
                        variant="secondary"
                        type="button"
                        :disabled="!users.prev_page_url"
                    >
                        Prev
                    </Button>
                </Link>
                <Button variant="secondary" type="button">
                    {{ users.current_page }}
                </Button>
                <Link :href="users.next_page_url ?? '#'">
                    <Button
                        variant="secondary"
                        type="button"
                        :disabled="!users.next_page_url"
                    >
                        Next
                    </Button>
                </Link>
            </CardFooter>
        </Card>
    </AuthenticatedLayout>
</template>

<style></style>
