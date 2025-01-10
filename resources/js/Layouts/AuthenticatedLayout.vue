<script setup lang="ts">
import Header from "./Header.vue";
import SidebarDesktop from "./SidebarDesktop.vue";
</script>

<template>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <!-- sidebar dekstop -->
        <SidebarDesktop />
        <div class="flex flex-col">
            <!-- header -->
            <Header />
            <main
                class="flex flex-1 flex-col gap-4 bg-gray-100 p-4 dark:bg-gray-900 lg:gap-6 lg:p-6"
            >
                <!-- HEADER CONTENT  -->
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold md:text-2xl">
                        <slot name="header" />
                    </h1>
                </div>
                <!-- BODY CONTENT -->
                <slot />
            </main>
        </div>
    </div>
</template>
