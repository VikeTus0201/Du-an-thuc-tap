import { useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import { useAuth } from '../contexts/AuthContext';
import { authAPI } from '../utils/api';
import type { LoginRequest, RegisterRequest } from '../types/auth';

export const useLogin = () => {
  const { login } = useAuth();
  const [error, setError] = useState<string>('');

  const mutation = useMutation({
    mutationFn: (data: LoginRequest) => authAPI.login(data),
    onSuccess: (response) => {
      login(response);
      setError('');
    },
    onError: (error: any) => {
      console.error('Lỗi đăng nhập:', error);
      if (error.response?.status === 400) {
        setError('Email hoặc mật khẩu không chính xác');
      } else {
        setError('Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại.');
      }
    }
  });

  return {
    login: mutation.mutate,
    isLoading: mutation.isPending,
    error,
    clearError: () => setError('')
  };
};

export const useRegister = () => {
  const { login } = useAuth();
  const [error, setError] = useState<string>('');

  const mutation = useMutation({
    mutationFn: (data: RegisterRequest) => authAPI.register(data),
    onSuccess: (response) => {
      login(response);
      setError('');
    },
    onError: (error: any) => {
      console.error('Lỗi đăng ký:', error);
      if (error.response?.status === 400) {
        setError('Email đã được sử dụng');
      } else {
        setError('Có lỗi xảy ra khi đăng ký. Vui lòng thử lại.');
      }
    }
  });

  return {
    register: mutation.mutate,
    isLoading: mutation.isPending,
    error,
    clearError: () => setError('')
  };
};
