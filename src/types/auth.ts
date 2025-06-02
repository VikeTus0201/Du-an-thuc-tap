export interface User {
  id: number;
  email: string;
  password?: string;
  role: 'admin' | 'teacher' | 'student';
  createdAt: string;
}

export interface UserProfile {
  id: number;
  userId: number;
  fullName: string;
  avatar?: string;
  phone?: string;
  dateOfBirth?: string;
  address?: string;
  bio?: string;
}

export interface AuthResponse {
  accessToken: string;
  user: User;
}

export interface LoginRequest {
  email: string;
  password: string;
}

export interface RegisterRequest {
  email: string;
  password: string;
  fullName: string;
  role: 'teacher' | 'student';
}
