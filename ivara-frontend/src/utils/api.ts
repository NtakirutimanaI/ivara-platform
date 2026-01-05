import axios from 'axios';

// Front‑end will call Laravel's API gateway, which forwards to the Node micro‑service
export const api = axios.create({
    baseURL: 'http://localhost:8000/api/gateway',
    withCredentials: true,
});
