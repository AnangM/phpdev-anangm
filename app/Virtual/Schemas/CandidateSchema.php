<?php
namespace App\Virtual\Schemas;
/**
 * @OA\Schema(
 *     title="Candidate",
 *     description="Candidate Response",
 *     type="object",
 *     required={"name", "education", "birthday", "experience","last_position","applied_position", "top_skills", "resume_url", "email", "phone"}
 * )
 */
class CandidateSchema{

      /**
     * @OA\Property(
     *      title="Id",
     *      description="Candidate Id",
     *      example="761cf4bf-24be-40b4-ac1a-92de8a75e055"
     * )
     *
     * @var string
     */
    private $id;
    
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the candidate",
     *      example="John Doe"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *      title="Education",
     *      description="Candidate education",
     *      example="Universitas Gadjah Mada"
     * )
     *
     * @var string
     */
    private $education;

    /**
     * @OA\Property(
     *      title="Birthday",
     *      description="Candidate birthday in YYYY-MM-DD",
     *      example="1995-05-23"
     * )
     *
     * @var string
     */
    private $birthday;

     /**
     * @OA\Property(
     *      title="Experience",
     *      description="Candidate experience",
     *      example="5 years"
     * )
     *
     * @var string
     */
    private $experience;

     /**
     * @OA\Property(
     *      title="Last Position",
     *      description="Candidate last position",
     *      example="Java Developer"
     * )
     *
     * @var string
     */
    private $last_position;

    /**
     * @OA\Property(
     *      title="Applied Position",
     *      description="Candidate applied position",
     *      example="Senior Java Developer"
     * )
     *
     * @var string
     */
    private $applied_position;

      /**
     * @OA\Property(
     *      title="Top Skills",
     *      description="Candidate top 5 skills in array",
     *      example="['json', 'rest', 'php', 'git', 'java']",
     *      @OA\Items(
     *        example="json"
     *      )
     * )
     *
     * @var array
     */
    private $top_skills;


    /**
     * @OA\Property(
     *      title="Resume URL",
     *      description="Candidate resume url",
     *      example="http://localhost/storage/resume.pdf"
     * )
     *
     * @var string
     */
    private $resume_url;

    /**
     * @OA\Property(
     *      title="E-Mail",
     *      description="Candidate email",
     *      example="candidate@email.com"
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *      title="Phone",
     *      description="Candidate phone number",
     *      example="08123123123"
     * )
     *
     * @var string
     */
    private $phone;
}