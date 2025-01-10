<script setup>
import { Bell, Package2 } from "lucide-vue-next";
import { Link } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import getMenus from "@/lib/menus";

const menus = getMenus();
</script>

<template>
    <div class="hidden border-r bg-muted/40 md:block">
        <div class="flex h-full max-h-screen flex-col gap-2">
            <div
                class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
            >
                <a href="/" class="flex items-center gap-2 font-semibold">
                    <Package2 class="h-6 w-6" />
                    <span class="">{{ $page.props.appName }}</span>
                </a>
                <Button variant="outline" size="icon" class="ml-auto h-8 w-8">
                    <Bell class="h-4 w-4" />
                    <span class="sr-only">Toggle notifications</span>
                </Button>
            </div>
            <div class="flex-1">
                <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
                    <Link
                        v-for="menu in menus"
                        :key="menu.name"
                        :href="menu.url"
                        :class="{
                            'bg-green-200 text-primary': $page.url.startsWith(
                                menu.url
                            ),
                        }"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                    >
                        <component :is="menu.icon" class="icon" />
                        {{ menu.name }}
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<style></style>
