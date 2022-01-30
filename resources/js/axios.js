import axios from "axios"

const instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/'
});

instance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("access_token")}`;

export default instance;