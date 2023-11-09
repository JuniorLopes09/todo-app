<template>
    <div class="container">
        <h1>Lista de tarefas </h1>
        <input v-model="taskName" class="form-control border-0 border-bottom rounded-0 fs-3 shadow-none mb-2" placeholder="Inserir nova tarefa">
        <ul class="list-group">
            <li v-for="task in tasks" :key="task.id" class="list-group-item d-flex justify-content-between align-items-center">
                <input
                    :checked="task.concluida"
                    @change="task.concluida = !task.concluida"
                    @blur="atualizarTarefa(task)"
                    id="flexCheckDefault"
                    class="form-check-input checkbox-xl shadow-none me-2"
                    type="checkbox"
                >
                <input
                    v-model="task.nome"
                    class="form-control border-0 shadow-none fs-3"
                    :class="{'text-decoration-line-through text-gray': task.concluida }"
                    @blur="atualizarTarefa(task)"
                >
                <button @click="removerTarefa(task.id)" class="btn btn-danger">
                    <i class="bi bi-x-lg"></i>
                </button>
            </li>
        </ul>
        <button @click="adicionarTarefa" class="btn btn-primary mt-2">Adicionar Tarefa</button>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useApi } from "@/services/useApi"
import { useNotification } from "@/services/useNotifications"
import 'bootstrap-icons/font/bootstrap-icons.css'


const api = useApi()
const { error } = useNotification()
const taskName = ref('')

let tasks = ref([]);

const carregarTarefas = async () => {
    try {
        const { data } = await api.get('/tarefas')
        tasks.value = data.data;
    } catch ({ response }) {
        error(response?.data?.message)
    }

}
carregarTarefas()
const adicionarTarefa = async () => {
    try {
        const { data } = await api.post('/tarefas', { nome: taskName.value })
        const newTask = data.data;
        tasks.value.push(newTask);
        taskName.value = ''
    } catch ({ response }) {
        error(response?.data?.message)
    }
};
const atualizarTarefa = async (task) => {
    try {
        console.log(task)
        await api.put(`/tarefas/${task.id}`, task)
    } catch ({ response }) {
        error(response?.data?.message)
    }
};
const removerTarefa = async (id) => {
    try {
        await api.delete(`/tarefas/${id}`)
        tasks.value = tasks.value.filter((task) => task.id !== id);
    } catch ({ response }) {
        error(response?.data?.message)
    }
};
</script>
<style scoped>
.text-gray {
    color: #888;
}
.checkbox-xl
{
    scale: 2;
}
</style>



