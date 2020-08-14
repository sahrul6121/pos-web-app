// axios
import axios from 'axios'

const domain = process.env.MIX_APP_URL

const defaultOptions = {
    baseURL: domain,
    headers: {
        'Content-Type': 'application/json',
    },
}

    // Create instance
let instance = axios.create(defaultOptions);

    // Set the AUTH token for any request
instance.interceptors.request.use(function (config) {
    const token = localStorage.getItem('accessToken');
    config.headers.Authorization =  token ? `Bearer ${token}` : '';

    return config;
});

export default instance
