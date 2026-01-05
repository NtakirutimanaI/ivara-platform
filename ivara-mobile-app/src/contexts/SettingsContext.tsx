"use client";

import React, { createContext, useContext, useState, useEffect } from 'react';
import api from '@/lib/api';

interface SettingsState {
    [key: string]: any;
}

interface SettingsContextType {
    settings: SettingsState;
    loading: boolean;
    refreshSettings: () => Promise<void>;
}

const SettingsContext = createContext<SettingsContextType>({
    settings: {},
    loading: true,
    refreshSettings: async () => { },
});

export const useSettings = () => useContext(SettingsContext);

export const SettingsProvider = ({ children }: { children: React.ReactNode }) => {
    const [settings, setSettings] = useState<SettingsState>({});
    const [loading, setLoading] = useState(true);

    const fetchSettings = async () => {
        try {
            // Note: If the endpoint is protected, this usually requires a token.
            // If the user isn't logged in, they might get 401. 
            // We should handle that gracefully (maybe empty settings or default).
            const token = localStorage.getItem('token');
            if (token) {
                const response = await api.get('/settings');
                setSettings(response.data);
            }
        } catch (error) {
            console.error('Failed to load settings:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchSettings();
    }, []);

    return (
        <SettingsContext.Provider value={{ settings, loading, refreshSettings: fetchSettings }}>
            {children}
        </SettingsContext.Provider>
    );
};
