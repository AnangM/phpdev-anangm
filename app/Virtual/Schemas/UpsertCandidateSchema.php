<?php
namespace App\Virtual\Schemas;
/**
 * @OA\Schema(
 *     title="Update / Create Candidate",
 *     description="Create / Update Candidate Request",
 *     type="object",
 *     required={"name", "education", "birthday", "experience","last_position","applied_position", "top_skills", "resume_url", "email", "phone"}
 * )
 */
class UpsertCandidateSchema{

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
     *      @OA\Items(
     *      )
     * )
     *
     * @var array
     */
    private $top_skills;


    /**
     * @OA\Property(
     *      title="Resume File",
     *      description="A PDF file encoded with base 64 and the data:mime/type should be included",
     *      example="data:application/pdf;base64,JVBERi0xLjMKJcTl8uXrp/Og0MTGCjMgMCBvYmoKPDwgL0ZpbHRlciAvRmxhdGVEZWNvZGUgL0xlbmd0aCAxMTkgPj4Kc3RyZWFtCngBK1QIVChU0HcuNlRILlYwAMPiZKCQgZ6RCYQPYhhaKJhaGOtZGikk5yo4hQBlDQwMjBVCkhVMIXqAlJGRqYKpoSVXSK6CfkiIkYKhQkiagoaikrKipkJIloJrCNgq/OYiTDM2MtQzNLQwwmKkCsK8QABJcSgnCmVuZHN0cmVhbQplbmRvYmoKMSAwIG9iago8PCAvVHlwZSAvUGFnZSAvUGFyZW50IDIgMCBSIC9SZXNvdXJjZXMgNCAwIFIgL0NvbnRlbnRzIDMgMCBSIC9NZWRpYUJveCBbMCAwIDYxMiA3OTJdCj4+CmVuZG9iago0IDAgb2JqCjw8IC9Qcm9jU2V0IFsgL1BERiAvVGV4dCBdIC9Db2xvclNwYWNlIDw8IC9DczEgNSAwIFIgPj4gL0ZvbnQgPDwgL1RUMiA3IDAgUgo+PiA"
     * )
     *
     * @var string
     */
    private $resume;

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