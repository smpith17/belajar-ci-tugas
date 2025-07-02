<?php

namespace App\Controllers;

use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();

        // Cek role admin
        if (session()->get('role') !== 'admin') {
            exit('Akses ditolak. Hanya admin yang bisa mengakses halaman ini.');
        }
    }

    public function index()
    {
        $data['diskon'] = $this->diskonModel->findAll();
        return view('v_diskon', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'tanggal' => 'required|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('failed', implode(', ', $validation->getErrors()));
            return redirect()->back();
        }

        $this->diskonModel->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Diskon berhasil ditambahkan');
        return redirect()->to('/diskon');
    }

    public function update($id)
    {
        $this->diskonModel->update($id, [
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Diskon berhasil diubah');
        return redirect()->to('/diskon');
    }

    public function delete($id)
    {
        $this->diskonModel->delete($id);
        session()->setFlashdata('success', 'Diskon berhasil dihapus');
        return redirect()->to('/diskon');
    }
}
