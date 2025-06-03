import React, { useState } from 'react';
import { useRegister } from '../../hooks/useAuth';
import type { RegisterRequest } from '../../types/auth';

interface RegisterFormProps {
  onSwitchToLogin: () => void;
}

const RegisterForm: React.FC<RegisterFormProps> = ({ onSwitchToLogin }) => {
  const { register, isLoading, error, clearError } = useRegister();
  const [formData, setFormData] = useState<RegisterRequest>({
    email: '',
    password: '',
    fullName: '',
    role: 'student'
  });
  const [confirmPassword, setConfirmPassword] = useState('');
  const [validationError, setValidationError] = useState('');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    if (name === 'confirmPassword') {
      setConfirmPassword(value);
    } else {
      setFormData(prev => ({
        ...prev,
        [name]: value
      }));
    }
    clearError(); // Xóa lỗi khi user thay đổi input
    setValidationError(''); // Xóa lỗi validation
  };

  const validateForm = (): string | null => {
    if (formData.password !== confirmPassword) {
      return 'Mật khẩu xác nhận không khớp';
    }
    if (formData.password.length < 6) {
      return 'Mật khẩu phải có ít nhất 6 ký tự';
    }
    if (!formData.fullName.trim()) {
      return 'Vui lòng nhập họ tên';
    }
    return null;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    const validationError = validateForm();
    if (validationError) {
      setValidationError(validationError);
      return;
    }
    setValidationError('');
    register(formData);
  };

  return (
    <div className="card" style={{ maxWidth: '28rem', margin: '0 auto' }}>
      <h2 className="text-2xl font-bold text-center text-gray-800 mb-6">Đăng Ký</h2>
      
      {(error || validationError) && (
        <div className="alert alert-error">
          {error || validationError}
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label htmlFor="fullName" className="block text-sm font-medium text-gray-700 mb-1">
            Họ và tên
          </label>
          <input
            type="text"
            id="fullName"
            name="fullName"
            value={formData.fullName}
            onChange={handleChange}
            required
            placeholder="Nhập họ và tên"
          />
        </div>

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
          <label htmlFor="role" className="block text-sm font-medium text-gray-700 mb-1">
            Vai trò
          </label>
          <select
            id="role"
            name="role"
            value={formData.role}
            onChange={handleChange}
          >
            <option value="student">Học sinh</option>
            <option value="teacher">Giáo viên</option>
            <option value="admin">Quản trị viên</option>
          </select>
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
            placeholder="Nhập mật khẩu (ít nhất 6 ký tự)"
          />
        </div>

        <div>
          <label htmlFor="confirmPassword" className="block text-sm font-medium text-gray-700 mb-1">
            Xác nhận mật khẩu
          </label>
          <input
            type="password"
            id="confirmPassword"
            name="confirmPassword"
            value={confirmPassword}
            onChange={handleChange}
            required
            placeholder="Nhập lại mật khẩu"
          />
        </div>

        <button
          type="submit"
          disabled={isLoading}
          className={`btn w-full ${isLoading ? 'btn-secondary' : 'btn-success'}`}
          style={{ cursor: isLoading ? 'not-allowed' : 'pointer' }}
        >
          {isLoading ? 'Đang đăng ký...' : 'Đăng Ký'}
        </button>
      </form>

      <div className="mt-6 text-center">
        <p className="text-sm text-gray-600">
          Đã có tài khoản?{' '}
          <button
            onClick={onSwitchToLogin}
            style={{ 
              background: 'none', 
              border: 'none', 
              color: '#3b82f6', 
              fontWeight: '500', 
              cursor: 'pointer' 
            }}
          >
            Đăng nhập ngay
          </button>
        </p>
      </div>
    </div>
  );
};

export default RegisterForm;
