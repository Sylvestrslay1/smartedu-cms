<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;
use App\Models\Application;
use App\Models\Category;
use App\Models\Course;
use App\Models\News;
use App\Models\Setting;
use App\Models\Teacher;
use App\Models\User;

class AdminController extends Controller
{
    protected string $layout = 'admin';

    public function __construct()
    {
        Auth::requireAdmin();
    }

    public function actionDashboard(): string
    {
        $pdo = Database::pdo();
        $applicationRows = Application::withCourses();
        $statusCounts = [];
        foreach ($applicationRows as $row) {
            $statusCounts[$row['status']] = ($statusCounts[$row['status']] ?? 0) + 1;
        }

        return $this->render('admin/dashboard', [
            'counts' => [
                'Kurslar' => $pdo->query('SELECT COUNT(*) FROM courses')->fetchColumn(),
                'O‘qituvchilar' => $pdo->query('SELECT COUNT(*) FROM teachers')->fetchColumn(),
                'Arizalar' => $pdo->query('SELECT COUNT(*) FROM applications')->fetchColumn(),
                'Yangiliklar' => $pdo->query('SELECT COUNT(*) FROM news')->fetchColumn(),
            ],
            'statusCounts' => $statusCounts,
            'applications' => array_slice($applicationRows, 0, 5),
        ]);
    }

    public function actionCourses(): string
    {
        $filters = [
            'q' => trim($_GET['q'] ?? ''),
            'category_id' => (int) ($_GET['category_id'] ?? 0),
            'status' => $_GET['status'] ?? '',
        ];

        return $this->render('admin/courses', [
            'courses' => Course::withTeachers($filters),
            'categories' => Category::byType('course'),
            'filters' => $filters,
        ]);
    }

    public function actionCourseForm(): string
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $course = $id ? Course::find($id) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            Course::save([
                'category_id' => (int) ($_POST['category_id'] ?? 0),
                'teacher_id' => (int) ($_POST['teacher_id'] ?? 0),
                'title' => trim($_POST['title'] ?? ''),
                'slug' => trim($_POST['slug'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'duration' => trim($_POST['duration'] ?? ''),
                'price' => trim($_POST['price'] ?? ''),
                'image' => trim($_POST['image'] ?? ''),
                'status' => (int) ($_POST['status'] ?? 1),
                'featured' => (int) ($_POST['featured'] ?? 0),
            ], $id);
            $this->redirect('admin/courses');
        }

        return $this->render('admin/course-form', [
            'course' => $course,
            'teachers' => Teacher::all('full_name ASC'),
            'categories' => Category::byType('course'),
        ]);
    }

    public function actionCourseDelete(): never
    {
        Course::delete((int) ($_GET['id'] ?? 0));
        $this->redirect('admin/courses');
    }

    public function actionTeachers(): string
    {
        return $this->render('admin/teachers', ['teachers' => Teacher::all('id DESC')]);
    }

    public function actionTeacherForm(): string
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $teacher = $id ? Teacher::find($id) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            Teacher::save([
                'full_name' => trim($_POST['full_name'] ?? ''),
                'specialty' => trim($_POST['specialty'] ?? ''),
                'experience' => (int) ($_POST['experience'] ?? 1),
                'phone' => trim($_POST['phone'] ?? ''),
                'bio' => trim($_POST['bio'] ?? ''),
                'status' => (int) ($_POST['status'] ?? 1),
            ], $id);
            $this->redirect('admin/teachers');
        }

        return $this->render('admin/teacher-form', ['teacher' => $teacher]);
    }

    public function actionTeacherDelete(): never
    {
        Teacher::delete((int) ($_GET['id'] ?? 0));
        $this->redirect('admin/teachers');
    }

    public function actionApplications(): string
    {
        $filters = [
            'q' => trim($_GET['q'] ?? ''),
            'status' => trim($_GET['status'] ?? ''),
            'course_id' => (int) ($_GET['course_id'] ?? 0),
        ];

        return $this->render('admin/applications', [
            'applications' => Application::withCourses($filters),
            'courses' => Course::withTeachers(),
            'filters' => $filters,
        ]);
    }

    public function actionApplicationStatus(): never
    {
        $this->verifyCsrf();
        Application::updateStatus((int) ($_POST['id'] ?? 0), $_POST['status'] ?? 'Yangi');
        $this->redirect('admin/applications');
    }

    public function actionApplicationDelete(): never
    {
        Application::delete((int) ($_GET['id'] ?? 0));
        $this->redirect('admin/applications');
    }

    public function actionNews(): string
    {
        $filters = [
            'q' => trim($_GET['q'] ?? ''),
            'category_id' => (int) ($_GET['category_id'] ?? 0),
            'status' => $_GET['status'] ?? '',
        ];

        return $this->render('admin/news', [
            'news' => News::withCategories($filters),
            'categories' => Category::byType('news'),
            'filters' => $filters,
        ]);
    }

    public function actionNewsForm(): string
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $item = $id ? News::find($id) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            News::save([
                'category_id' => (int) ($_POST['category_id'] ?? 0),
                'title' => trim($_POST['title'] ?? ''),
                'short_text' => trim($_POST['short_text'] ?? ''),
                'body' => trim($_POST['body'] ?? ''),
                'image' => trim($_POST['image'] ?? ''),
                'status' => (int) ($_POST['status'] ?? 1),
                'featured' => (int) ($_POST['featured'] ?? 0),
                'published_at' => trim($_POST['published_at'] ?? date('Y-m-d')),
            ], $id);
            $this->redirect('admin/news');
        }

        return $this->render('admin/news-form', [
            'item' => $item,
            'categories' => Category::byType('news'),
        ]);
    }

    public function actionNewsDelete(): never
    {
        News::delete((int) ($_GET['id'] ?? 0));
        $this->redirect('admin/news');
    }

    public function actionCategories(): string
    {
        return $this->render('admin/categories', ['categories' => Category::all('type ASC, name ASC')]);
    }

    public function actionCategoryForm(): string
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $category = $id ? Category::find($id) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            Category::save([
                'name' => trim($_POST['name'] ?? ''),
                'type' => trim($_POST['type'] ?? 'news'),
                'color' => trim($_POST['color'] ?? '#75f7ff'),
            ], $id);
            $this->redirect('admin/categories');
        }

        return $this->render('admin/category-form', ['category' => $category]);
    }

    public function actionCategoryDelete(): never
    {
        Category::delete((int) ($_GET['id'] ?? 0));
        $this->redirect('admin/categories');
    }

    public function actionUsers(): string
    {
        return $this->render('admin/users', ['users' => User::all('id DESC')]);
    }

    public function actionUserForm(): string
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $user = $id ? User::find($id) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            User::save([
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'role' => trim($_POST['role'] ?? 'operator'),
                'password' => trim($_POST['password'] ?? ''),
            ], $id);
            $this->redirect('admin/users');
        }

        return $this->render('admin/user-form', ['user' => $user]);
    }

    public function actionUserDelete(): never
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id !== (int) (Auth::user()['id'] ?? 0)) {
            User::delete($id);
        }
        $this->redirect('admin/users');
    }

    public function actionSettings(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            Setting::setMany($_POST['settings'] ?? []);
            $_SESSION['flash'] = 'Sayt sozlamalari saqlandi.';
            $this->redirect('admin/settings');
        }

        return $this->render('admin/settings', ['settings' => Setting::allKeyed()]);
    }

    public function actionProfile(): string
    {
        $message = null;
        $user = User::find((int) (Auth::user()['id'] ?? 0));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $password = trim($_POST['password'] ?? '');
            if ($password !== '') {
                User::changePassword((int) $user['id'], $password);
                $message = 'Parol yangilandi.';
            }
            $user = User::find((int) $user['id']);
        }

        return $this->render('admin/profile', ['user' => $user, 'message' => $message]);
    }
}
