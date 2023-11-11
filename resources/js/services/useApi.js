import axios from "axios";
import { getCookie } from "@/services/utils";

const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL + '/api/v1'
})

api.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${getCookie('token')}`;
    return config;
}, error => {
    return Promise.reject(error);
});

export function useApi() {
    return api
}


