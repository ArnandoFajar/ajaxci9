<?php

namespace App\Controllers;

use App\Models\PeopleModel;

class People extends BaseController
{

    private $PeopleModel;
    public function __construct()
    {
        $this->PeopleModel = new PeopleModel;
    }


    public function index()
    {
        return view('index');
    }

    public function findAll()
    {
        $peoples = $this->PeopleModel->orderBy('id DESC')->findAll();
        $data['data'] = array();
        $no = 1;
        foreach ($peoples as $key => $value) {

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
        // return $this->response->setJSON($data);
        return json_encode($data);
    }

    public function remove()
    {
        $id = $this->request->getPost('id');
        if ($this->PeopleModel->where('id', $id)->delete()) {
            $response['success'] = true;
            $response['messages'] = "Delete Data Berhasil";
        } else {

            $response['success'] = false;
            $response['messages'] = "Delete Data Error";
        }
        return $this->response->setJSON($response);
    }
    public function getOne()
    {
        $id = $this->request->getPost('id');
        $data = $this->PeopleModel->find($id);
        return $this->response->setJSON($data);
    }
    public function save()
    {
        $data = [
            "name" => $this->request->getPost('name'),
            "phone" => $this->request->getPost('phone'),
            "email" => $this->request->getPost('email'),
            "country" => $this->request->getPost('country'),
        ];
        $id =  $this->request->getPost('id');


        if ($id) {
            if ($this->PeopleModel->update($id, $data)) {
                $response['success'] = true;
                $response['messages'] = "Update Data Berhasil";
            } else {
                $response['success'] = false;
                $response['messages'] = "Update Data Gagal";
            }
        } else {
            if ($this->PeopleModel->insert($data)) {
                $response['success'] = true;
                $response['messages'] = "Add Data Berhasil";
            } else {
                $response['success'] = false;
                $response['messages'] = "Add Data Gagal";
            }
        }
        return $this->response->setJSON($response);
    }
}
