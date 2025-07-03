<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\DiskonModel;
use CodeIgniter\I18n\Time; // ✅ penting!

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url'];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // ✅ Pakai Time bawaan CI4 dengan zona waktu Indonesia
        $diskonModel = new DiskonModel();
        $today = Time::now('Asia/Jakarta')->toDateString(); // contoh: 2025-07-03

        $diskon = $diskonModel->where('tanggal', $today)->first();

        if ($diskon) {
            session()->set('diskon', $diskon['nominal']);
        } else {
            session()->remove('diskon');
        }
    }
}
