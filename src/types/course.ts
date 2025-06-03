export interface Course {
  id: string;
  title: string;
  description: string;
  instructor: string;
  instructorId: string;
  duration: number; // in hours
  level: 'beginner' | 'intermediate' | 'advanced';
  category: string;
  thumbnail?: string;
  price: number;
  maxStudents: number;
  currentStudents: number;
  startDate: string;
  endDate: string;
  status: 'draft' | 'published' | 'completed' | 'cancelled';
  createdAt: string;
  updatedAt: string;
}

export interface CreateCourseRequest {
  title: string;
  description: string;
  duration: number;
  level: 'beginner' | 'intermediate' | 'advanced';
  category: string;
  thumbnail?: string;
  price: number;
  maxStudents: number;
  startDate: string;
  endDate: string;
}

export interface UpdateCourseRequest extends Partial<CreateCourseRequest> {
  status?: 'draft' | 'published' | 'completed' | 'cancelled';
}

export interface CourseEnrollment {
  id: string;
  courseId: string;
  studentId: string;
  enrolledAt: string;
  status: 'enrolled' | 'completed' | 'dropped';
  progress: number; // percentage 0-100
}
