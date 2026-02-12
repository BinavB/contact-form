class AuthAPI {
    constructor() {
        console.log('AuthAPI constructor called');
        this.token = localStorage.getItem('jwt_token');
        this.setupAxios();
    }

    setupAxios() {
        console.log('Setting up axios with token:', this.token ? 'present' : 'missing');
        if (this.token) {
            window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        }
    }

    async register(userData) {
        console.log('Register called with data:', userData);
        try {
            const response = await window.axios.post('/api/contact-form/register', userData);
            console.log('Register response:', response.data);
            if (response.data.success) {
                this.token = response.data.token;
                localStorage.setItem('jwt_token', this.token);
                this.setupAxios();
            }
            return response.data;
        } catch (error) {
            console.error('Register error:', error);
            throw error.response.data;
        }
    }

    async login(credentials) {
        console.log('Login called with credentials:', credentials);
        try {
            const response = await window.axios.post('/api/contact-form/login', credentials);
            console.log('Login response:', response.data);
            if (response.data.success) {
                this.token = response.data.token;
                localStorage.setItem('jwt_token', this.token);
                this.setupAxios();
            }
            return response.data;
        } catch (error) {
            console.error('Login error:', error);
            throw error.response.data;
        }
    }

    async logout() {
        try {
            const response = await window.axios.post('/api/contact-form/logout');
            this.token = null;
            localStorage.removeItem('jwt_token');
            delete window.axios.defaults.headers.common['Authorization'];
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    async me() {
        try {
            const response = await window.axios.get('/api/contact-form/me');
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    async submitContactForm(formData) {
        try {
            const response = await window.axios.post('/api/contact-form/submit', formData);
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    async getMySubmissions() {
        try {
            const response = await window.axios.get('/api/contact-form/my-submissions');
            return response.data;
        } catch (error) {
            throw error.response.data;
        }
    }

    isAuthenticated() {
        return !!this.token;
    }
}

// Initialize AuthAPI
console.log('Creating AuthAPI instance...');
window.AuthAPI = new AuthAPI();
console.log('AuthAPI created:', window.AuthAPI);
