<?php
namespace App\Controllers;

use App\Models\CarModel;

class CarsController extends BaseController {

    public function index() {
        $filters = [
            'color_id'    => $_GET['color_id'] ?? null,
            'year_id'     => $_GET['year_id'] ?? null,
            'designer_id' => $_GET['designer_id'] ?? null,
        ];

        if ($filters['color_id'] || $filters['year_id'] || $filters['designer_id']) {
            $cars = \App\Models\CarModel::filter($filters);
        } else {
            $cars = \App\Models\CarModel::getAll();
        }

        $pdo = \App\Database\Database::getInstance();
        $colors    = $pdo->query("SELECT id, color FROM colors ORDER BY color")->fetchAll(\PDO::FETCH_ASSOC);
        $years     = $pdo->query("SELECT id, year FROM years ORDER BY year DESC")->fetchAll(\PDO::FETCH_ASSOC);
        $designers = $pdo->query("SELECT id, designer FROM designers ORDER BY designer")->fetchAll(\PDO::FETCH_ASSOC);

        $this->render('cars/index', [
            'cars'      => $cars,
            'colors'    => $colors,
            'years'     => $years,
            'designers' => $designers,
            'filters'   => $filters
        ]);
    }



    public function view($id = null) {
        if ($id === null && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!$id) {
            die("Hiányzó ID!");
        }
        $car = CarModel::getById($id);
        $this->render('cars/view', ['car' => $car]);
}


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->collectFormData();
            CarModel::create($data);
            header("Location: /?controller=cars&action=index");
            exit;
        }
        $this->render('cars/create');
    }

    public function edit($id = null) {
        $id = $id ?? ($_GET['id'] ?? null);

        if (!$id) {
            die("Hiányzó ID a szerkesztéshez.");
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ID biztosítása POST‑ból
            $id = $_POST['id'] ?? $id;

            \App\Models\CarModel::update($id, $_POST);

            header('Location: /?controller=cars&action=view&id=' . urlencode($id));
            exit;
        }

        $car = \App\Models\CarModel::getById($id);
        if (!$car) {
            echo "<p class='alert alert-danger'>Nem található ilyen autó.</p>";
            return;
        }


        $this->render('cars/edit', ['car' => $car]);
    }



    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            CarModel::delete($id);
        }
        header("Location: /?controller=cars&action=index");
        exit;
    }

    private function collectFormData() {
        return [
            'name' => $_POST['name'],
            'toy_code' => $_POST['toy_code'],
            'color_id' => $_POST['color_id'],
            'year_id' => $_POST['year_id'],
            'series_id' => $_POST['series_id'],
            'notes' => $_POST['notes'],
            'extras' => $_POST['extras'],
            'packed' => isset($_POST['packed']) ? 1 : 0,
            'designer_id' => $_POST['designer_id'],
            'img_url' => $_POST['img_url']
        ];
    }
}
