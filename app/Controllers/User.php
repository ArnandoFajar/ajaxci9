<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    private $UserModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => "Ajax Crud"
        ];
        return view('user/index', $data);
    }

    public function findAll()
    {
        $user = $this->UserModel->orderBy('id DESC')->findAll();
        $data['data'] = array();
        $no = 1;
        foreach ($user as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '<a class="btn btn-sm btn-primary" role="button"  onClick="edit(' . $value->id . ')"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="bi bi-pencil-square"></i> </a>';
            $ops .= '<a class="btn btn-sm btn-danger" role="button" onClick="remove(' . $value->id . ')"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="bi bi-trash-fill"></i></a>';
            $ops .= '</div>';

            $data['data'][$key] = array(
                $no++,
                $value->name,
                $value->phone,
                $value->email,
                $value->country,
                $ops
            );
        }
        return json_encode($data);
    }

    public function save()
    {
        if (!$this->validate([
            'name' => [
                'rules'  => 'min_length[10]',
                'errors' => [
                    'min_length' => 'Huruf minimal 10',
                ],
            ],
            'phone' => [
                'rules' => 'decimal',
                'errors' => [
                    'decimal' => 'Kolom telp wajib angka'
                ],
            ],
        ])) {
            // $data = [
            //     'messages' => 'Gagal, Mohon Aktifkan Javascript Anda'
            // ];
            // return json_encode($data);
        }

        $data = [
            'name' => esc($this->request->getVar("name")),
            'phone' => esc($this->request->getVar('phone')),
            'email' => esc($this->request->getVar('email')),
            'country' => esc($this->request->getVar('country')),
        ];

        $insert = $this->UserModel->insert($data);

        if ($insert) {
            $msg = [
                'success' => true,
                'messages' => 'Data berhasil disimpan'
            ];
        } else {
            $msg = [
                'status' => false,
                'messages' => 'Data gagal disimpan'
            ];
        }

        return $this->response->setJSON($msg);
    }

    public function remove()
    {
        $id = $this->request->getVar('id');

        if ($this->UserModel->where('id', $id)->delete()) {
            $response['success'] = true;
            $response['messages'] = 'Delete data berhasil';
        } else {
            $response['success'] = false;
            $response['messages'] = "Delete data Gagal";
        }
        return json_encode($response);
    }

    public function getOne()
    {
        $id = $this->request->getVar('id');
        $data = $this->UserModel->find($id);
        return json_encode($data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = [
            'name' => esc($this->request->getVar('name')),
            'phone' => esc($this->request->getVar('phone')),
            'email' => esc($this->request->getVar('email')),
            'country' => esc($this->request->getVar('country'))
        ];

        if ($this->UserModel->update($id, $data)) {
            $response['success'] = true;
            $response['messages'] = 'Update data berhasil';
        } else {
            $response['success'] = false;
            $response['messages'] = "Update data Gagal";
        }
        return json_encode($response);
    }
    
    public function delete(){
        
    }
}
