<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="login">
                            <input type="hidden" name="_token" :value="props.csrf_token">
                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input v-model="form.email" id="email" type="email" class="form-control" name="email"  required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                                <div class="col-md-6">
                                    <input v-model="form.password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useApi } from "@/services/useApi"
import { reactive } from "vue"
import { useNotification } from "@/services/useNotifications";


const api = useApi()
const { error } = useNotification()

const form = reactive({
    'email': '',
    'password': ''
})

const props = defineProps({
    csrf_token: {
        type: String,
        required: true
    }
})

async function login(event) {
    try {
        const { data } = await api.post('/login', form)
        sessionStorage.setItem('token', data?.token)
        event.target.submit()
    } catch ({ response }) {
        error(response?.data?.error)
    }
}
</script>
