<?php
namespace App\Virtual\Schemas;
/**
 * @OA\Schema(
 *     title="Error",
 *     description="Error",
 *     type="object",
 * )
 */

 class ErrorSchema{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error Message",
     *      example="An error has ocured"
     * )
     *
     * @var string
     */
    private $message;
 }