<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fs-3 text-bg-secondary">Login</div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="login">
                            <input type="hidden" name="_token" :value="props.csrf_token">
                            <div class="form-floating mb-3">
                                <input  v-model="form.email" type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" required>
                                <label for="email" class="form-label">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input v-model="form.password" type="password" class="form-control" id="password" name="password" placeholder="Sua senha" required>
                                <label for="password" class="form-label">Senha</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue"
import { useApi } from "@/services/useApi"
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
        document.cookie = `token=${data?.token}`
        event.target.submit()
    } catch ({ response }) {
        error(response?.data?.message)
    }
}
</script>
