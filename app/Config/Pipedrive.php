<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pipedrive extends BaseConfig{
    
    /**
     * pipedrive api token
     * @var string
     */
    public string $apiToken = 'd046f6ccd8a86ba7ba7a8abedb0dd33e219d48d2';
    
    /**
     * pipedrive oauth client id 
     * @var string
     */
    public string $oAuthClientId = '468b29bb703fcea3';
    
    /**
     * pipedrive oauth clitnt secret
     * @var string
     */
    public string $oAuthClientSecret = '7ef5ce46171286aea34451629b7bd1416e482c7d';
    
    /**
     * pipedrive oauth redierct url
     * @var string
     */
    public string $oAuthRedirectUri = 'https://9e3e-95-158-20-237.eu.ngrok.io/pipedrive-oauth-callback';

    /**
     * Promotion custom field
     * @var string
     */
    public string $fieldPromotion = 'ee4cd043245f509f2f51a5b6b46666fd813b5d5a';
    
    /**
     * Referral custom field
     * @var string
     */
    public string $fieldReferral = 'd9067bfe9913907a5cfda81d28b462718cde95f9';
    
    /**
     * Url custom field
     * @var string
     */
    public string $fieldUrl = '6599b967bf3ce002a621aef93cb79b0f1ecd103b';
    
    /**
     * Campaign custom field
     * @var string
     */
    public string $fieldCampaign = 'dfd57ae82f984ddd04800086f470dcbae001524b';
    
    /**
     * Content custom field
     * @var string
     */
    public string $fieldContent = '7b008adb16c68c71d3eac30f2f31d7c9d7af5092';
    
    /**
     * Medium custom field
     * @var string
     */
    public string $fieldMedium = '97dd8d5d267a9a67325c9629a6c272bfc9923794';
    
    /**
     * Source custom field
     * @var string
     */
    public string $fieldSource = '7f92b3d9f1f950c404cdbc58f9abcdf0d995c089';
    
    /**
     * Term custom field
     * @var string
     */
    public string $fieldTerm = 'e214ccd526fece873ecfa938bd73bce65cb685a8';
    
    /**
     * Names of stages
     * @var array
     */
    private array $stageNames = [
        1 => 'Stage.Name.Qualified',
        2 => 'Stage.Name.Invited',
        3 => 'Stage.Name.Demo',
        4 => 'Stage.Name.Proposal',
        5 => 'Stage.Name.Payment',
    ];
    
    public function stageName(?int $stage_id) : string
    {
        return $this->stageNames[$stage_id] ?? 'NoName';
    }
}
