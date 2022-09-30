<?php
namespace App\Virtual\Schemas;
/**
 * @OA\Schema(
 *     title="List Candidate",
 *     description="List Candidate Response",
 *     type="object",
 * )
 */

 class ListResponseSchema{
    /**
     * @OA\Property(
     *      title="Current Page",
     *      description="Current retrieved page",
     *      example=1
     * )
     *
     * @var int
     */
    private $current_page;


    /**
     * @OA\Property(
     *      title="Data",
     *      description="Array of datas to be displayed",
     *      @OA\Items(
     *          ref="#/components/schemas/CandidateSchema"
     *      )
     * )
     *
     * @var array
     */
    private $data;

    /**
     * @OA\Property(
     *      title="First page url",
     *      description="URL to retrieve first page",
     *      example="http://localhost/list?page=1"
     * )
     *
     * @var string
     */
    private $first_page_url;

    /**
     * @OA\Property(
     *      title="From",
     *      description="Int index of the displayed data is from",
     *      example=21
     * )
     *
     * @var int
     */
    private $from;

    /**
     * @OA\Property(
     *      title="Last Page",
     *      description="Last page number",
     *      example=10
     * )
     *
     * @var int
     */
    private $last_page;

    /**
     * @OA\Property(
     *      title="Last page url",
     *      description="URL to retrieve last page",
     *      example="http://localhost/list?page=10"
     * )
     *
     * @var string
     */
    private $last_page_url;

    /**
     * @OA\Property(
     *      title="Links",
     *      description="Array of pagiantion links",
     *      @OA\Items(
     *          ref="#/components/schemas/PaginationLinksSchema"
     *      )
     * )
     *
     * @var array
     */
    private $links;

    /**
     * @OA\Property(
     *      title="Next page url",
     *      description="URL to retrieve next page",
     *      example="http://localhost/list?page=2"
     * )
     *
     * @var string
     */
    private $next_page_url;

    /**
     * @OA\Property(
     *      title="Path",
     *      description="Base path for this request",
     *      example="http://localhost/list"
     * )
     *
     * @var string
     */
    private $path;

    /**
     * @OA\Property(
     *      title="Per page",
     *      description="Number of item displayed per page",
     *      example=20
     * )
     *
     * @var int
     */
    private $per_page;

    /**
     * @OA\Property(
     *      title="Prev page url",
     *      description="URL to retrieve previous page",
     *      example="http://localhost/list?page=1"
     * )
     *
     * @var string
     */
    private $prev_page_url;

     /**
     * @OA\Property(
     *      title="To",
     *      description="Int index of the displayed data is to",
     *      example=40
     * )
     *
     * @var int
     */
    private $to;

    /**
     * @OA\Property(
     *      title="Total",
     *      description="Total number of item",
     *      example=400
     * )
     *
     * @var int
     */
    private $total;

 }