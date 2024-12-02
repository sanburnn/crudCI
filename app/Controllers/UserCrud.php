<?php 
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserCrud extends Controller
{
    // show users list
    public function index(){
        $userModel = new UserModel();
        $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
        return view('user_view', $data);
    }
    // add user form
    public function create(){
        return view('add_user');
    }
 
    // insert data
    public function store() {
        $userModel = new UserModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'umur'  => $this->request->getVar('umur'),
            'kota'  => $this->request->getVar('kota'),
        ];
        $userModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));
    }
    // show single user
    public function singleUser($id = null){
        $userModel = new UserModel();
        $data['user_obj'] = $userModel->where('id', $id)->first();
        return view('edit_user', $data);
    }
    // update user data
    public function update(){
        $userModel = new UserModel();
        $id = $this->request->getVar('id');
        $data = [
            'nama' => $this->request->getVar('nama'),
            'umur'  => $this->request->getVar('umur'),
            'kota'  => $this->request->getVar('kota'),
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/users-list'));
    }
 
    // delete user
    public function delete($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/users-list'));
    }    

    public function export()
    {
        // $dataMobil = $mobil->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nama')
                    ->setCellValue('B1', 'Kelas')
                    ->setCellValue('C1', 'Jurusan')
                    ->setCellValue('D1', 'Angkatan')
                    ->setCellValue('E1', 'NIS');
        
        $column = 2;
        // tulis data mobil ke cell
        // foreach($dataMobil as $data) {
        //     $spreadsheet->setActiveSheetIndex(0)
        //                 ->setCellValue('A' . $column, $data['nama'])
        //                 ->setCellValue('B' . $column, $data['kelas'])
        //                 ->setCellValue('C' . $column, $data['jurusan'])
        //                 ->setCellValue('D' . $column, $data['angkatan'])
        //                 ->setCellValue('E' . $column, $data['nis']);
        //     $column++;
        // }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Siswa';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}