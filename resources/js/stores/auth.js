import { defineStore } from "pinia";
import axios from "axios";

export const authStore = defineStore("auth", {
    state: () => {
        return {
            token: localStorage.getItem('token') || null,
            role: localStorage.getItem('role') || null,
            errors: {},
            loading: false
        }
    },
    getters: {
        isAdmin: (state) => state.role === 'admin',
        isUser: (state) => state.role === 'user',
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        async login(url, formData) {
            this.loading = true;
            try {
                const response = await axios.post(url, formData);

                this.token = response.data.token;
                this.role = response.data.user.role;

                localStorage.setItem("token", this.token);
                localStorage.setItem("role", this.role);
                axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;

                return true;
            } catch (error) {
                this.errors = error.response.data.errors || error.response.data.message || "Login failed";
                return false;
            } finally {
                this.loading = false;
            }
        },

        async logout(url) {
            this.loading = true;
            this.errors = {};
            try {
                await axios.post(url, {},
                    {
                        headers: {
                            "Authorization": `Bearer ${this.token}`,
                        },
                    }
                );
            } catch (error) {
                console.warn("Logout API failed, but clearing local state anyway:", error);
            } finally {
                this.token = null;
                this.role = null;
                this.errors = {};

                localStorage.removeItem("token");
                localStorage.removeItem("role");

                delete axios.defaults.headers.common["Authorization"];
                this.loading = false;
            }
        },

        async getProfile() {
            try {
                const response = await axios.get('/api/profile', {
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    },
                });
                return response.data;
            } catch (error) {
                this.errors = error.response?.data?.message || "Failed to fetch user data";
                return null;
            }
        },

        init() {
            if (this.token) {
                axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
            }
        },


    }
})