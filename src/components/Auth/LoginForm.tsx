import React, { useState } from 'react';
import { useLogin } from '../../hooks/useAuth';
import type { LoginRequest } from '../../types/auth';

interface LoginFormProps {
  onSwitchToRegister: () => void;
}

const LoginForm: React.FC<LoginFormProps> = ({ onSwitchToRegister }) => {
  const { login, isLoading, error, clearError } = useLogin();
  const [formData, setFormData] = useState<LoginRequest>({
    email: '',
    password: ''
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
    clearError(); // Xóa lỗi khi user thay đổi input
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    login(formData);
  };

  return (
    <div className="card" style={{ maxWidth: '28rem', margin: '0 auto' }}>
      <h2 className="text-2xl font-bold text-center text-gray-800 mb-6">Đăng Nhập</h2>
      
      {error && (
        <div className="alert alert-error">
          {error}
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-1">
            Email
          </label>
          <input
            type="email"
            id="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
            placeholder="Nhập email của bạn"
          />
        </div>

        <div>
          <label htmlFor="password" className="block text-sm font-medium text-gray-700 mb-1">
            Mật khẩu
          </label>
          <input
            type="password"
            id="password"
            name="password"
            value={formData.password}
            onChange={handleChange}
            required
            placeholder="Nhập mật khẩu"
          />
        </div>

        <button
          type="submit"
          disabled={isLoading}
          className={`btn w-full ${isLoading ? 'btn-secondary' : 'btn-primary'}`}
          style={{ cursor: isLoading ? 'not-allowed' : 'pointer' }}
        >
          {isLoading ? 'Đang đăng nhập...' : 'Đăng Nhập'}
        </button>
      </form>

      <div className="mt-6 text-center">
        <p className="text-sm text-gray-600">
          Chưa có tài khoản?{' '}
          <button
            onClick={onSwitchToRegister}
            style={{ 
              background: 'none', 
              border: 'none', 
              color: '#3b82f6', 
              fontWeight: '500', 
              cursor: 'pointer' 
            }}
          >
            Đăng ký ngay
          </button>
        </p>
      </div>
    </div>
  );
};

export default LoginForm;
