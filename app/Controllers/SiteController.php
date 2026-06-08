<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Course;
use App\Models\News;
use App\Models\Setting;
use App\Models\Teacher;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('site/index', [
            'settings' => Setting::allKeyed(),
            'courses' => Course::featured(6),
            'teachers' => array_slice(Teacher::all('id DESC'), 0, 3),
            'news' => array_slice(News::active(), 0, 3),
        ]);
    }

    public function actionCourses(): string
    {
        $filters = [
            'q' => trim($_GET['q'] ?? ''),
            'category_id' => (int) ($_GET['category_id'] ?? 0),
        ];

        return $this->render('site/courses', [
            'courses' => Course::active($filters),
            'categories' => Category::byType('course'),
            'filters' => $filters,
        ]);
    }

    public function actionCourse(): string
    {
        $course = Course::findBySlug($_GET['slug'] ?? '');
        if (!$course) {
            return $this->actionNotFound();
        }

        return $this->render('site/course', ['course' => $course]);
    }

    public function actionTeachers(): string
    {
        return $this->render('site/teachers', ['teachers' => Teacher::all('id DESC')]);
    }

    public function actionNews(): string
    {
        $filters = [
            'q' => trim($_GET['q'] ?? ''),
            'category_id' => (int) ($_GET['category_id'] ?? 0),
        ];

        return $this->render('site/news', [
            'news' => News::active($filters),
            'categories' => Category::byType('news'),
            'filters' => $filters,
        ]);
    }

    public function actionNewsView(): string
    {
        $item = News::findPublic((int) ($_GET['id'] ?? 0));
        if (!$item) {
            return $this->actionNotFound();
        }

        return $this->render('site/news-view', ['item' => $item]);
    }

    public function actionApply(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            $data = [
                'course_id' => (int) ($_POST['course_id'] ?? 0),
                'first_name' => trim($_POST['first_name'] ?? ''),
                'last_name' => trim($_POST['last_name'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'message' => trim($_POST['message'] ?? ''),
            ];

            foreach (['first_name' => 'Ism', 'last_name' => 'Familiya', 'phone' => 'Telefon'] as $field => $label) {
                if ($data[$field] === '') {
                    $errors[] = $label . ' maydoni to‘ldirilishi shart.';
                }
            }

            if ($errors === []) {
                Application::create($data);
                $_SESSION['flash'] = 'Arizangiz qabul qilindi. Tez orada operatorimiz siz bilan bog‘lanadi.';
                $this->redirect('site/apply');
            }
        }

        return $this->render('site/apply', [
            'courses' => Course::active(),
            'errors' => $errors,
        ]);
    }

    public function actionContact(): string
    {
        return $this->render('site/contact', ['settings' => Setting::allKeyed()]);
    }

    public function actionNotFound(): string
    {
        http_response_code(404);
        return $this->render('site/not-found');
    }
}
