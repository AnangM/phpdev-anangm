<?php
namespace App\Virtual\Schemas;

/**
 * @OA\Schema(
 *     title="Pagination Link",
 *     description="Item on pagination links",
 *     type="object",
 * )
 */
 class PaginationLinksSchema{
    /**
     * @OA\Property(
     *      title="Url",
     *      description="link url",
     *      example="http://localhost/list?page=1"
     * )
     *
     * @var string
     */
    private $url;

     /**
     * @OA\Property(
     *      title="Label",
     *      description="Label used on the link",
     *      example="&raquo; next"
     * )
     *
     * @var string
     */
    private $label;

    /**
     * @OA\Property(
     *      title="Active",
     *      description="Flag to check wether if links is active",
     *      example=false
     * )
     *
     * @var boolean
     */
    private $active;
 }
