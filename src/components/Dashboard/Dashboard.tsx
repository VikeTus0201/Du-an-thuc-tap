import React, { useState } from 'react';
import { useAuth } from '../../contexts/AuthContext';
import UserManagement from '../Admin/UserManagement';

const Dashboard: React.FC = () => {
  const { user, logout } = useAuth();
  const [activeTab, setActiveTab] = useState<'overview' | 'users' | 'courses'>('overview');

  const getRoleDisplayName = (role: string) => {
    switch (role) {
      case 'admin':
        return 'Quản trị viên';
      case 'teacher':
        return 'Giáo viên';
      case 'student':
        return 'Học sinh';
      default:
        return role;
    }
  };

  const getRoleStyle = (role: string) => {
    switch (role) {
      case 'admin':
        return { backgroundColor: '#fee2e2', color: '#991b1b' };
      case 'teacher':
        return { backgroundColor: '#dbeafe', color: '#1e40af' };
      case 'student':
        return { backgroundColor: '#d1fae5', color: '#065f46' };
      default:
        return { backgroundColor: '#f3f4f6', color: '#374151' };
    }
  };

  const renderOverview = () => (
    <div className="card">
      <h2 className="text-2xl font-bold text-gray-800 mb-6">Tổng quan</h2>
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '1.5rem' }}>
        <div className="card" style={{ backgroundColor: '#dbeafe' }}>
          <h3 className="font-semibold text-gray-800">Vai trò của bạn</h3>
          <p className="text-2xl font-bold text-blue-600 mt-2">{getRoleDisplayName(user?.role || '')}</p>
        </div>
        <div className="card" style={{ backgroundColor: '#d1fae5' }}>
          <h3 className="font-semibold text-gray-800">Trạng thái</h3>
          <p className="text-2xl font-bold text-green-600 mt-2">Hoạt động</p>
        </div>
        {user?.role === 'admin' && (
          <div className="card" style={{ backgroundColor: '#fee2e2' }}>
            <h3 className="font-semibold text-gray-800">Quyền quản trị</h3>
            <p className="text-2xl font-bold text-red-600 mt-2">Đầy đủ</p>
          </div>
        )}
      </div>
      
      <div className="mt-8">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">Chào mừng bạn đến với hệ thống!</h3>
        <p className="text-gray-600">
          Đây là trang tổng quan của hệ thống quản lý học tập. Bạn có thể sử dụng các tab ở trên để truy cập các chức năng khác nhau tùy theo vai trò của mình.
        </p>
      </div>
    </div>
  );

  const renderCourses = () => (
    <div className="card">
      <h2 className="text-2xl font-bold text-gray-800 mb-6">Quản lý Khóa học</h2>
      <p className="text-gray-600">Chức năng quản lý khóa học sẽ được phát triển tiếp theo.</p>
    </div>
  );

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header style={{ backgroundColor: 'white', borderBottom: '1px solid #e5e7eb', boxShadow: '0 1px 3px 0 rgba(0, 0, 0, 0.1)' }}>
        <div className="container">
          <div className="flex justify-between items-center h-16">
            <h1 className="text-xl font-semibold text-gray-900">
              Hệ thống Quản lý Học tập
            </h1>
            <div className="flex items-center space-x-4">
              <span className="text-sm text-gray-700">
                Xin chào, <strong>{user?.email}</strong>
              </span>
              <span 
                className="px-2 py-1 rounded-full text-xs font-medium"
                style={{ 
                  ...getRoleStyle(user?.role || ''),
                  padding: '0.25rem 0.5rem',
                  borderRadius: '9999px',
                  fontSize: '0.75rem',
                  fontWeight: '500'
                }}
              >
                {getRoleDisplayName(user?.role || '')}
              </span>
              <button
                onClick={logout}
                className="btn btn-danger"
                style={{ fontSize: '0.875rem' }}
              >
                Đăng xuất
              </button>
            </div>
          </div>
        </div>
      </header>

      {/* Navigation Tabs */}
      <nav style={{ backgroundColor: 'white', borderBottom: '1px solid #e5e7eb' }}>
        <div className="container">
          <div className="nav-tabs">
            <button
              onClick={() => setActiveTab('overview')}
              className={`nav-tab ${activeTab === 'overview' ? 'active' : ''}`}
            >
              Tổng quan
            </button>
            
            {user?.role === 'admin' && (
              <button
                onClick={() => setActiveTab('users')}
                className={`nav-tab ${activeTab === 'users' ? 'active' : ''}`}
              >
                Quản lý người dùng
              </button>
            )}
            
            {(user?.role === 'admin' || user?.role === 'teacher') && (
              <button
                onClick={() => setActiveTab('courses')}
                className={`nav-tab ${activeTab === 'courses' ? 'active' : ''}`}
              >
                Quản lý khóa học
              </button>
            )}
          </div>
        </div>
      </nav>

      {/* Main Content */}
      <main className="container py-8">
        {activeTab === 'overview' && renderOverview()}
        {activeTab === 'users' && user?.role === 'admin' && <UserManagement />}
        {activeTab === 'courses' && (user?.role === 'admin' || user?.role === 'teacher') && renderCourses()}
      </main>
    </div>
  );
};

export default Dashboard;
