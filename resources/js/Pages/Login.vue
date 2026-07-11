<script setup>
// ----------------------------------
// Imports
import { reactive } from 'vue'

// ----------------------------------
// Define Layouts
defineOptions({
    layout: null
})

// ----------------------------------
// Datatypes
defineProps({
    user: String
})

// ----------------------------------
// Submit Form Process
const form = reactive({
    username: null,
    password: null
})

const submitForm = () => {
    console.log(form);
}
// ----------------------------------
</script>

<template>
    <div>

        <Head title="Landing Page" />
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="text-center">LAVA</h2>

                    <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" v-model="form.username">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" v-model="form.password">
                        </div>

                        <input type="submit" value="Login" class="btn btn-custom w-100">

                        <div class="d-flex align-items-center mt-3">
                            <hr class="flex-grow-1">
                            <span class="px-2 text-muted">or</span>
                            <hr class="flex-grow-1">
                        </div>

                        <div class="mt-3">
                            <Link href="#" class="btn btn-outline-danger w-100">
                            <i class="bi bi-google"></i> Sign in with Google
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
