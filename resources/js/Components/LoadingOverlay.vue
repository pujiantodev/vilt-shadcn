<script setup>
defineProps({
    isLoading: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <div v-if="isLoading" class="overlay">
        <div class="loader"></div>
    </div>
</template>

<style scoped>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}
/* HTML: <div class="loader"></div> */
.loader {
    width: 50px;
    aspect-ratio: 1;
    border-radius: 50%;
    border: 8px solid #0000;
    border-right-color: #ffa50097;
    position: relative;
    animation: l24 1s infinite linear;
}
.loader:before,
.loader:after {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    border: inherit;
    animation: inherit;
    animation-duration: 2s;
}
.loader:after {
    animation-duration: 4s;
}
@keyframes l24 {
    100% {
        transform: rotate(1turn);
    }
}
</style>
