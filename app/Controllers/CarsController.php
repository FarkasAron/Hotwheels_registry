<?php
namespace App\Controllers;

use App\Models\CarModel;

class CarsController extends BaseController {

    public function index() {
        $q = $_GET['q'] ?? null;

        if ($q) {
            $cars = CarModel::search($q);
        } else {
            $cars = CarModel::getAll();
        }

        $this->render('cars/index', ['cars' => $cars]);
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

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) { echo "Nincs ID megadva."; return; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->collectFormData();
            CarModel::update($id, $data);
            header("Location: /?controller=cars&action=index");
            exit;
        }

        $car = CarModel::getById($id);
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
