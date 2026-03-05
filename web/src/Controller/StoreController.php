<?php

namespace App\Controller;

class StoreController extends BaseController
{
    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photoBase64 = null;
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photoBase64 = base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
            }

            $data = [
                'nom'          => $_POST['nom'] ?? '',
                'description'  => $_POST['description'] ?? '',
                'date'         => $_POST['date'] ?? '',
                'avis'         => (int)($_POST['avis'] ?? 0),
                'latitude'     => (float)($_POST['latitude'] ?? 0),
                'longitude'    => (float)($_POST['longitude'] ?? 0),
                'contactNom'   => $_POST['contactNom'] ?? '',
                'contactEmail' => $_POST['contactEmail'] ?? '',
                'photo'        => $photoBase64
            ];

            $result = $this->callApi('http://api/stores', 'POST', $data);

            if (isset($result['id'])) {
                header('Location: /');
                exit;
            }

            echo $this->twig->render('create_store.html.twig', [
                'error' => $result['error'] ?? 'Erreur lors de la création'
            ]);
            return;
        }

        echo $this->twig->render('create_store.html.twig');
    }
    public function detail(string $id): void
    {
        $store = $this->callApi("http://api/stores/$id");

        if (!$store || isset($store['error'])) {
            header("Location: /?error=not_found");
            exit;
        }

        echo $this->twig->render('store_detail.html.twig', ['store' => $store]);
    }

    public function edit(string $id): void
    {
        $store = $this->callApi("http://api/stores/$id");

        if (!$store || isset($store['error'])) {
            header("Location: /?error=unauthorized_or_notfound");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photoBase64 = $store['photo'] ?? null;
            if (!empty($_FILES['photo']['tmp_name'])) {
                $photoBase64 = base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
            }

            $data = [
                'nom'          => $_POST['nom'] ?? $store['nom'],
                'description'  => $_POST['description'] ?? $store['description'],
                'date'         => $_POST['date'] ?? $store['date'],
                'avis'         => (int)($_POST['avis'] ?? $store['avis']),
                'latitude'     => (float)($_POST['latitude'] ?? $store['latitude']),
                'longitude'    => (float)($_POST['longitude'] ?? $store['longitude']),
                'contactNom'   => $_POST['contactNom'] ?? $store['contactNom'],
                'contactEmail' => $_POST['contactEmail'] ?? $store['contactEmail'],
                'photo'        => $photoBase64
            ];

            $result = $this->callApi("http://api/stores/$id", 'PUT', $data);

            if (isset($result['id']) || !isset($result['error'])) {
                header("Location: /store/$id");
                exit;
            }

            echo $this->twig->render('edit_store.html.twig', [
                'store' => $data,
                'error' => $result['error'] ?? 'Erreur de mise à jour'
            ]);
            return;
        }

        echo $this->twig->render('edit_store.html.twig', ['store' => $store]);
    }

    public function delete(string $id): void
    {
        $result = $this->callApi("http://api/stores/$id", 'DELETE');

        if (!isset($result['error'])) {
            header('Location: /');
            exit;
        }

        echo $this->twig->render('store_detail.html.twig', [
            'store' => ['id' => $id],
            'error' => $result['error'] ?? 'Erreur lors de la suppression'
        ]);
    }

    public function preview(string $id): void
    {
        $store = $this->callApi("http://api/stores/preview/$id");

        if (!$store || isset($store['error'])) {
            header("Location: /?error=preview_not_found");
            exit;
        }

        echo $this->twig->render('store_preview.html.twig', ['store' => $store]);
    }

    public function pdf(string $id): void
    {
        $store = $this->callApi("http://api/stores/preview/$id", 'GET', null, false);

        if (!$store || isset($store['error'])) {
            header("Location: /?error=preview_not_found");
            exit;
        }

        $address = "Adresse non disponible";
        $geoContext = stream_context_create(["http" => ["header" => "User-Agent: LegoMap/1.0\r\n"]]);
        $geoResult = @file_get_contents("https://nominatim.openstreetmap.org/reverse?format=json&lat={$store['latitude']}&lon={$store['longitude']}", false, $geoContext);

        if ($geoResult) {
            $geoData = json_decode($geoResult, true);
            $address = $geoData['display_name'] ?? $address;
        }

        $html = $this->twig->render('pdf/store_export.html.twig', [
            'store'   => $store,
            'address' => $address
        ]);

        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("LEGO_Map_" . $store['nom'] . ".pdf", ["Attachment" => true]);
        exit;
    }
}
