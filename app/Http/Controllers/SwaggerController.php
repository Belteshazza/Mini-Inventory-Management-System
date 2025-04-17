<?php

/**
 * @OA\Info(
 *     title="Mini Inventory Management System API",
 *     version="1.0.0",
 *     description="API for managing inventory with user authentication and multi-tenancy"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    //
}
