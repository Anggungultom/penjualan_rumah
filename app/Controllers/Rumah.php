<?php

namespace App\Controllers;
use App\Models\RumahModel;

class Rumah extends BaseController
{
    public function index()
    {
        $model = new RumahModel();
        $data['rumah'] = $model->findAll();
        return view('rumah/index', $data);
    }

    public function tambah()
    {
        return view('rumah/tambah');
    }

    public function simpan()
    {
        $model = new RumahModel();
        $file = $this->request->getFile('gambar');
        $fileName = $file->getRandomName();
        $file->move('uploads', $fileName);

        $model->save([
            'nama' => $this->request->getPost('nama'),
            'lokasi' => $this->request->getPost('lokasi'),
            'harga' => $this->request->getPost('harga'),
            'gambar' => $fileName,
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/rumah');
    }

    public function detail($id)
    {
        $model = new RumahModel();
        $data['rumah'] = $model->find($id);
        return view('rumah/detail', $data);
    }

    public function hapus($id)
    {
        $model = new RumahModel();
        $model->delete($id);
        return redirect()->to('/rumah');
    }
    public function edit($id)
{
    $model = new RumahModel();
    $data['rumah'] = $model->find($id);
    return view('rumah/edit', $data);
}

public function update($id)
{
    $model = new RumahModel();
    $data = [
        'nama' => $this->request->getPost('nama'),
        'lokasi' => $this->request->getPost('lokasi'),
        'harga' => $this->request->getPost('harga'),
        'deskripsi' => $this->request->getPost('deskripsi'),
    ];

    // Jika gambar baru diupload
    $file = $this->request->getFile('gambar');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        $file->move('uploads', $fileName);
        $data['gambar'] = $fileName;
    }

    $model->update($id, $data);
    return redirect()->to('/rumah');
}

}
