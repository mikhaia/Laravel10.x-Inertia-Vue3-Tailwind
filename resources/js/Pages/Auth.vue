<script setup>
import modalAuth from './Modals/Auth.vue';
const openAuthModal = () => {
    modalAuth.open()
}
</script>

<template>
    <Toast></Toast>
    <div class="auth-container h-screen">
        <a class="auth-via steam" href="steam">
            <span>Sing in via <b>Steam</b></span>
        </a>
        <div class="auth-via login" @click="openAuthModal()">
            <span>Sing in via <b>Login</b></span>
        </div>
        <a class="auth-via google" href="google">
            <span>Sing in via <b>Google</b></span>
        </a>
    </div>
    <modalAuth></modalAuth>
</template>
