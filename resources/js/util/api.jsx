import axios from "axios";
import { logout } from "../redux/slices/authSlice";
import Store from "../redux/Store";

let baseURL = "http://localhost:8000";

export const getCSRF = async () => axios.get(`${baseURL}/sanctum/csrf-cookie`);

export const api = axios.create({
    baseURL: `${baseURL}/api/v1`,
    headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
    withCredentials: true,
});

export const authApi = axios.create({
    baseURL: `${baseURL}/api/v1`,
    headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
    withCredentials: true,
});

authApi.interceptors.response.use(
    res => {
        return res;
    },
    err => {
        if (err.response.status == 401) Store.dispatch(logout());
        return err;
    }
);

export default api;
