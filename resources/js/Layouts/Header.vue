<script setup>
import { Link, router } from "@inertiajs/vue3";

import { Button } from "@/Components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import { Sheet, SheetContent, SheetTrigger } from "@/Components/ui/sheet";
import { CircleUser, Menu, Package2 } from "lucide-vue-next";

import { Icon } from "@iconify/vue";
import { useColorMode } from "@vueuse/core";
// Pass { disableTransition: false } to enable transitions
const mode = useColorMode();
//logout
const logout = () => {
    router.post(route("logout"));
};

// get data menu
import getMenus from "@/lib/menus";
const menus = getMenus();
</script>

<template>
    <header
        class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6"
    >
        <Sheet>
            <SheetTrigger as-child>
                <Button
                    variant="outline"
                    size="icon"
                    class="shrink-0 md:hidden"
                >
                    <Menu class="h-5 w-5" />
                    <span class="sr-only">Toggle navigation menu</span>
                </Button>
            </SheetTrigger>
            <SheetContent side="left" class="flex flex-col">
                <nav class="grid gap-2 text-lg font-medium">
                    <a
                        href="/dashboard"
                        class="flex items-center gap-2 text-lg font-semibold"
                    >
                        <Package2 class="h-6 w-6" />
                        <span class="sr-only">{{ $page.props.appName }}</span>
                    </a>
                    <Link
                        v-for="menu in menus"
                        :key="menu.name"
                        :href="menu.url"
                        :class="{
                            'bg-green-200 text-primary': $page.url === menu.url,
                        }"
                        class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                    >
                        <component :is="menu.icon" class="icon" />
                        {{ menu.name }}
                    </Link>
                </nav>
            </SheetContent>
        </Sheet>
        <div class="w-full flex-1">
            <!-- slot untuk navbar atas tapi tidak digunakan. hanya untuk space tambahan -->
        </div>
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <Button variant="outline">
                    <Icon
                        icon="radix-icons:moon"
                        class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"
                    />
                    <Icon
                        icon="radix-icons:sun"
                        class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"
                    />
                    <span class="sr-only">Toggle theme</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
                <DropdownMenuItem @click="mode = 'light'">
                    Light
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'dark'">
                    Dark
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'auto'">
                    System
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <Button variant="secondary" size="icon" class="rounded-full">
                    <CircleUser class="h-5 w-5" />
                    <span class="sr-only">Toggle user menu</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
                <DropdownMenuLabel>
                    Hello, {{ $page.props.auth.user.name }}
                </DropdownMenuLabel>
                <DropdownMenuSeparator />
                <DropdownMenuItem as="button" @click="logout">
                    Logout
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    </header>
</template>

<style></style>
