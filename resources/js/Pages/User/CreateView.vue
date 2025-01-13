<script setup>
import { Card, CardContent } from "@/Components/ui/card";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Textarea } from "@/Components/ui/textarea";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import LoadingOverlay from "@/Components/LoadingOverlay.vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { Button } from "@/Components/ui/button";
import { Plus } from "lucide-vue-next";
import { ref, reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
    errors: Object,
});
const newUser = reactive({
    name: "",
    email: "",
    phone: "",
    address: "",
    gender: null,
});
const isLoading = ref(false);
const submit = () => {
    isLoading.value = true;
    router.post(route("users.store"), newUser, {
        onSuccess: () => {
            isLoading.value = false;
        },
    });
};
</script>

<template>
    <Head title="Create User" />
    <LoadingOverlay :isLoading="isLoading" />
    <AuthenticatedLayout>
        <template #header>Create User</template>
        <Card class="py-4">
            <CardContent>
                <form @submit.prevent="submit">
                    <div class="mb-4 grid gap-4 sm:grid-cols-2">
                        <div>
                            <Label for="name" class="required"> Nama </Label>
                            <Input
                                v-model:model-value="newUser.name"
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Tulisakan nama karyawan"
                                autocomplete="off"
                            />
                            <InputError
                                v-if="errors.name"
                                class="mt-2"
                                :message="errors.name"
                            />
                        </div>
                        <div>
                            <Label class="required" for="email">Email</Label>
                            <Input
                                v-model:model-value="newUser.email"
                                type="email"
                                name="email"
                                id="email"
                                placeholder="email aktif karyawan"
                                autocomplete="off"
                            />
                            <InputError
                                v-if="errors.email"
                                class="mt-2"
                                :message="errors.email"
                            />
                        </div>
                        <div>
                            <Label class="required" for="phone"
                                >HP / WhatsApp</Label
                            >
                            <Input
                                v-model:model-value="newUser.phone"
                                type="tel"
                                name="phone"
                                id="phone"
                                placeholder="082240200xxx"
                            />
                            <InputError
                                v-if="errors.phone"
                                class="mt-2"
                                :message="errors.phone"
                            />
                        </div>
                        <div>
                            <Label for="gender" class="required">Gender</Label>
                            <Select v-model="newUser.gender">
                                <SelectTrigger id="gender">
                                    <SelectValue
                                        placeholder="Pilih Jenis Kelamin"
                                    />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Jenis Kelamin</SelectLabel>
                                        <SelectItem value="1">
                                            Laki-laki
                                        </SelectItem>
                                        <SelectItem value="0">
                                            Perempuan
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError
                                v-if="errors.gender"
                                class="mt-2"
                                :message="errors.gender"
                            />
                        </div>
                        <div class="sm:col-span-2">
                            <Label for="address">Alamat</Label>
                            <Textarea
                                v-model:model-value="newUser.address"
                                id="address"
                                name="address"
                                rows="4"
                                placeholder="Jl. Kutisari xxx..."
                            />
                        </div>
                    </div>
                    <Button type="submit"><Plus />Simpan User Baru</Button>
                </form>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>

<style scoped>
.required::after {
    content: "*";
    color: red;
}
</style>
