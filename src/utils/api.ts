import axios from 'axios';
import type { AuthResponse, LoginRequest, RegisterRequest, User, UserProfile } from '../types/auth';

const API_BASE_URL = 'http://localhost:3000';

// Tạo axios instance
const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Interceptor để tự động thêm token vào header
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('accessToken');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Interceptor để xử lý response và error
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token hết hạn hoặc không hợp lệ
      localStorage.removeItem('accessToken');
      localStorage.removeItem('user');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

export const authAPI = {
  // Đăng nhập
  login: async (data: LoginRequest): Promise<AuthResponse> => {
    const response = await api.post('/login', data);
    return response.data;
  },

  // Đăng ký
  register: async (data: RegisterRequest): Promise<AuthResponse> => {
    const { fullName, ...authData } = data;
    
    try {
      // Đăng ký user
      const response = await api.post('/register', authData);
      
      // Tạo profile cho user
      await api.post('/userProfiles', {
        userId: response.data.user.id,
        fullName,
        avatar: '',
        phone: '',
        dateOfBirth: '',
        address: '',
        bio: ''
      });
      
      return response.data;
    } catch (error) {
      throw error;
    }
  },

  // Lấy thông tin user hiện tại
  getCurrentUser: async (): Promise<User> => {
    const response = await api.get('/600/users/me');
    return response.data;
  },

  // Lấy tất cả users (chỉ admin)
  getAllUsers: async (): Promise<User[]> => {
    const response = await api.get('/600/users');
    return response.data;
  },

  // Cập nhật thông tin user
  updateUser: async (id: number, data: Partial<User>): Promise<User> => {
    const response = await api.patch(`/600/users/${id}`, data);
    return response.data;
  },

  // Xóa user (chỉ admin)
  deleteUser: async (id: number): Promise<void> => {
    await api.delete(`/600/users/${id}`);
  }
};

export const profileAPI = {
  // Lấy profile của user
  getProfile: async (userId: number): Promise<UserProfile> => {
    const response = await api.get(`/600/userProfiles?userId=${userId}`);
    return response.data[0];
  },

  // Cập nhật profile
  updateProfile: async (id: number, data: Partial<UserProfile>): Promise<UserProfile> => {
    const response = await api.patch(`/600/userProfiles/${id}`, data);
    return response.data;
  }
};

export default api;
