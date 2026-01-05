import axios, { AxiosError } from 'axios';

const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:5001/api';

const api = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        'Content-Type': 'application/json',
    },
    timeout: 15000, // 15 second timeout
});

// Add a request interceptor to add the auth token to headers
api.interceptors.request.use(
    (config) => {
        const token = typeof window !== 'undefined' ? localStorage.getItem('token') : null;
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Add a response interceptor to handle auth errors
api.interceptors.response.use(
    (response) => {
        return response;
    },
    (error: AxiosError) => {
        if (typeof window !== 'undefined') {
            const status = error.response?.status;

            // Handle unauthorized (token expired or invalid)
            if (status === 401) {
                console.log('[API] Unauthorized - clearing auth data');
                localStorage.removeItem('token');
                localStorage.removeItem('user');

                // Redirect to login if not already there
                if (!window.location.pathname.includes('/login')) {
                    window.location.href = '/login?session_expired=true';
                }
            }

            // Handle forbidden (no permission)
            if (status === 403) {
                console.log('[API] Forbidden - user lacks permission');
                // Redirect to unauthorized page
                if (!window.location.pathname.includes('/unauthorized')) {
                    window.location.href = '/unauthorized';
                }
            }

            // Handle rate limiting
            if (status === 429) {
                console.log('[API] Rate limited - too many requests');
                // Could show a toast notification here
            }
        }

        return Promise.reject(error);
    }
);

export default api;

// Export helper functions for common API calls
export const apiGet = async <T>(url: string): Promise<T> => {
    const response = await api.get<T>(url);
    return response.data;
};

export const apiPost = async <T>(url: string, data?: unknown): Promise<T> => {
    const response = await api.post<T>(url, data);
    return response.data;
};

export const apiPut = async <T>(url: string, data?: unknown): Promise<T> => {
    const response = await api.put<T>(url, data);
    return response.data;
};

export const apiDelete = async <T>(url: string): Promise<T> => {
    const response = await api.delete<T>(url);
    return response.data;
};
