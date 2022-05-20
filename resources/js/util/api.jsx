import axios from "axios";

let baseURL = "http://localhost:8000"

export const getCSRF = async () => axios.get(`${baseURL}/sanctum/csrf-cookie`)

export const api = axios.create({
    baseURL: `${baseURL}/api/v1`,
    headers: {
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    },
    withCredentials: true
});

export default api;
