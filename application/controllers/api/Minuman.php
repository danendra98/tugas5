<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Minuman extends \Restserver\Libraries\REST_Controller {


    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('crud');
    }

    public function index_get()
    {
        $id_minuman = $this->get('id_minuman');

        // If the id parameter doesn't exist return all the users

        if ($id_minuman === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            $data = $this->crud->get('minuman');

            if (!empty($data))
            {
                // Set the response and exit
                $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id_minuman = (int) $id_minuman;

            // Validate the id.
            if ($id_minuman <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            } else {
                $data = $this->crud->get('minuman', array('id_minuman' => $id_minuman));
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            if (!empty($data))
            {
                $this->set_response($data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Data of the Cacastie could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function add_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'harga' => $this->post('harga'),
            'stok' => $this->post('stok')
        ];

        $insert = $this->crud->insert('minuman', $data);

        if ($insert) {
            $this->set_response(['message' => 'Data berhasil ditambahkan'], \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        } else {
            $this->response(['message' => 'Data gagal ditambahkan'], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
    }

    public function delete_get()
    {
        $id_minuman = (int) $this->get('id_minuman');
        $data = $this->crud->delete('minuman', ['id_minuman' => $id_minuman]);

        if ($data) {
            $message = [
                'id_minuman' => $id_minuman,
                'message' => 'Deleted the resource'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Data gagal dihapus'], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        
    }

    public function edit_post()
    {
        $id_minuman     = $this->post('id_minuman');
        $nama_minuman   = $this->post('nama');
        $harga = $this->post('harga');
        $stok = $this->post('stok');
        $cek    = $this->crud->update('minuman', ['nama' => $nama_minuman, 'harga' => $harga, 'stok' => $stok], ['id_minuman' => $id_minuman]);

        if ($cek) {
            $this->set_response(['status' => TRUE, 'message' => 'Data minuman berhasil diupdate'], \Restserver\Libraries\REST_Controller::HTTP_CREATED); 
        } else {
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'Data minuman tidak ditemukan'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
}
