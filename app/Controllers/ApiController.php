<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class ApiController extends ResourceController

{
    protected $apiKey;
    protected $user;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
    $this->apiKey = env('API_KEY');
    $this->user = new UserModel();
    $this->transaction = new TransactionModel();
    $this->transaction_detail = new TransactionDetailModel();
   }

    
    

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
{
    $data = [ 
        'results' => [],
        'status' => ["code" => 401, "description" => "Unauthorized"]
    ];

    $headers = $this->request->headers(); 

    array_walk($headers, function (&$value, $key) {
        $value = $value->getValue();
    });

    if(array_key_exists("Key", $headers)){
        if ($headers["Key"] == $this->apiKey) {
            $penjualan = $this->transaction->findAll();
            
            foreach ($penjualan as &$pj) {
                $pj['details'] = $this->transaction_detail->where('transaction_id', $pj['id'])->findAll();
            }

            $data['status'] = ["code" => 200, "description" => "OK"];
            $data['results'] = $penjualan;

        }
    } 

    return $this->respond($data);
}

public function jumlah_item()
{
    $id = $this->request->getGet('id');

    $db = \Config\Database::connect();
    $builder = $db->table('transaction_detail');
    $builder->selectSum('jumlah');
    $builder->where('transaction_id', $id);
    $query = $builder->get()->getRow();

    return $this->response->setJSON([
        'jumlah' => $query->jumlah ?? 0
    ]);
}

}