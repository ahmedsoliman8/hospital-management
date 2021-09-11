<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/26/2021
 * Time: 2:09 PM
 */

namespace App\Interfaces\DoctorDashboard;


Interface InvoiceRepositoryInterface
{
    // Get All Inovices
    public function index();

    public  function completedInvoices();

    public function reviewInvoices();
}