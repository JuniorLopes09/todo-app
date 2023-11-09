import axios from "axios";

const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL + '/api/v1'
})

api.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${sessionStorage.getItem('token')}`;
    return config;
}, error => {
    return Promise.reject(error);
});

export function useApi() {
    return api
}


