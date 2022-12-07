<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;

/**
 * Description of CallLogs
 *
 * @author alexey
 */
class CallLogs {
    
    /*
     * The ID of the owner of the call log
     * optional
     */
    protected $userId;

    /*
     * If specified, this activity will be converted into a call log, with the information provided. When this field is used, you don't need to specify deal_id, person_id or org_id, as they will be ignored in favor of the values already available in the activity.
     * optional
     */
    protected $activityId;

    /*
     * Name of the activity this call is attached to
     * optional
     */
    protected $subject;

    /*
     * Call duration in seconds
     * optional
     */
    protected $duration;
    
    /*
     * Describes the outcome of the call
     * required
     */
    protected $outcome;
    
    /*
     * The number that made the call
     * optional
     */
    protected $fromPhoneNumber;
    
    /*
     * The number called
     * required
     */
    protected $toPhoneNumber;
    
    /*
     * The date and time of the start of the call in UTC. Format: YYYY-MM-DD HH:MM:SS.
     * required
     */
    protected $startTime;
    
    /*
     * The date and time of the end of the call in UTC. Format: YYYY-MM-DD HH:MM:SS.
     * required
     */
    protected $endTime;
    
    /*
     * The ID of the Person this call is associated with
     * optional
     */
    protected $personId;
    
    /*
     * The ID of the Organization this call is associated with
     * optional
     */
    protected $orgId;
    
    /*
     * The ID of the Deal this call is associated with
     * optional
     */
    protected $dealId;

    /*
     * The note for the call log in HTML format
     */
    protected $note;

    /*
     * Client`s phone number
     */
    protected $clientsPhoneNumber;
    
    /*
     * arra data
     */
    protected $postedData;

    /**
     * constructor
     * @param array $data
     */
    public function __construct(?array $data = []) {
        $this->postedData = $data;
        if($this->postedData){
            $this->setUserId();
            $this->setActivityId();
            $this->setSubject();
            $this->setDuration();
            $this->setOutcome();
            $this->setFromPhoneNumber();
            $this->setToPhoneNumber();
            $this->setStartTime();
            $this->setEndTime();
            $this->setPersonId();
            $this->setOrgId();
            $this->setDealId();
            $this->setNote();
            $this->setClientsPhoneNumber();
        }
    }
    
    /**
     * set CRM user id
     * @param int|null $value
     * @return CallLogs
     */
    public function setUserId(?int $value = null) : CallLogs
    {
        $this->userId = $value ?? $this->postedData['user_id'] ?? null;
        return $this;
    }
    
    /**
     * set the activity id
     * @param int|null $value
     * @return CallLogs
     */
    public function setActivityId(?int $value = null) : CallLogs
    {
        $this->activityId = $value ?? $this->postedData['activity_id'] ?? null;
        return $this;
    }
    
    /**
     * set the activity subject
     * @param string|null $value
     * @return CallLogs
     */
    public function setSubject(?string $value = null) : CallLogs
    {
        $this->subject = $value ?? $this->postedData['subject'] ?? null;
        return $this;
    }
    
    /**
     * set the duration value
     * @param string|null $value
     * @return CallLogs
     */
    public function setDuration(?string $value = null) : CallLogs
    {
        $this->duration = $value ?? $this->postedData['duration'] ?? null;
        return $this;
    }
    
    /**
     * set the outcome (status) of voice call
     * @param string|null $value
     * @return CallLogs
     * @throws \Exception
     */
    public function setOutcome(?string $value = null) : CallLogs
    {
        $outcomes = [
            'completed' => 'connected', 
            'no-answer' => 'no_answer', 
            'failed' => 'no_answer', 
            'cancelled' => 'no_answer', 
            'busy' => 'busy',
        ];
        if($value && !isset($outcomes[$value])){
            throw new \Exception('Parameter value must be one of: completed, no-answer, failed, cancelled, busy');
        }
        if(!$value && (!isset($this->postedData['status']) || !isset($outcomes[$this->postedData['status']]))){
            throw new \Exception('Posted Data value must be one of: completed, no-answer, failed, cancelled, busy');
        }
        $this->outcome = $outcomes[$value] ?? $outcomes[$this->postedData['status']] ?? null;
        return $this;
    }
    
    /**
     * set the phone from was called
     * @param string|null $value
     * @return CallLogs
     */
    public function setFromPhoneNumber(?string $value = null) : CallLogs
    {
        helper('phones');
        $phone = $value ?? $this->postedData['from'] ?? null;
        $this->fromPhoneNumber = phone_validate($phone);
        return $this;
    }
    
    /**
     * set the phone to was called
     * @param string|null $value
     * @return CallLogs
     */
    public function setToPhoneNumber(?string $value = null) : CallLogs
    {
        helper('phones');
        $phone = $value ?? $this->postedData['to'] ?? null;
        $this->toPhoneNumber = phone_validate($phone);
        return $this;
    }
    
    /**
     * set the start calling time
     * @param string|null $value
     * @return CallLogs
     */
    public function setStartTime(?string $value = null) : CallLogs
    {
        $start_time = $value ?? $this->postedData['start_time'] ?? null;
        if(!$start_time){
            throw new \Exception('Start time required');
        }
        $time = Time::parse($start_time, 'UTC');
        $this->startTime = $time->toDateTimeString();
        return $this;
    }
    
    /**
     * set the end calling time
     * @param string|null $value
     * @return CallLogs
     */
    public function setEndTime(?string $value = null) : CallLogs
    {
        $end_time = $value ?? $this->postedData['end_time'] ?? null;
        if(!$end_time){
            throw new \Exception('End time required');
        }
        $time = Time::parse($end_time, 'UTC');
        $this->endTime = $time->toDateTimeString();
        return $this;
    }
    
    /**
     * set the person id
     * @param int|null $value
     * @return CallLogs
     */
    public function setPersonId(?int $value = null) : CallLogs
    {
        $this->personId = $value ?? $this->postedData['person_id'] ?? null;
        return $this;
    }
    
    /**
     * set the organization id
     * @param int|null $value
     * @return CallLogs
     */
    public function setOrgId(?int $value = null) : CallLogs
    {
        $this->orgId = $value ?? $this->postedData['org_id'] ?? null;
        return $this;
    }
    
    /**
     * set the deal id
     * @param int|null $value
     * @return CallLogs
     */
    public function setDealId(?int $value = null) : CallLogs
    {
        $this->dealId = $value ?? $this->postedData['deal_id'] ?? null;
        return $this;
    }
    
    /**
     * set the note
     * @param string|null $value
     * @return CallLogs
     */
    public function setNote(?string $value = null) : CallLogs
    {
        $this->note = $value ?? $this->postedData['note'] ?? null;
        return $this;
    }
    
    /**
     * find the clients phone
     * @return CallLogs
     */
    public function setClientsPhoneNumber(?string $value = null) : CallLogs
    {
        $direction = $value ?? $this->postedData['direction'] ?? null;
        if(!$direction){
            return $this;
        }
        if($direction == 'inbound'){
            $this->clientsPhoneNumber = $this->fromPhoneNumber;
        }else{
            $this->clientsPhoneNumber = $this->toPhoneNumber;
        }
        return $this;
    }
    
    /**
     * get the user id
     * @return int|null
     */
    public function getUserId() : ?int
    {
        return $this->userId;
    }
    
    /**
     * get activity id
     * @return int|null
     */
    public function getActivityId() : ?int 
    {
        return $this->activityId;
    }
    
    /**
     * get the subject
     * @return string|null
     */
    public function getSubject() : ?string
    {
        return $this->subject;
    }
    
    /**
     * get the duration
     * @return string|null
     */
    public function getDuration() : ?string
    {
        return $this->duration;
    }
    
    /**
     * get the outcome
     * @return string|null
     */
    public function getOutcome() : ?string
    {
        return $this->outcome;
    }
    
    /**
     * get the from phone numger
     * @return string|null
     */
    public function getFromPhoneNumber() : ?string
    {
        return $this->fromPhoneNumber;
    }
    
    /**
     * get the to phone number
     * @return string|null
     */
    public function getToPhoneNumber() : ?string
    {
        return $this->toPhoneNumber;
    }
    
    /**
     * get the start time
     * @return string|null
     */
    public function getStartTime() : ?string
    {
        return $this->startTime;
    }
    
    /**
     * get the end time
     * @return string|null
     */
    public function getEndTime() : ?string
    {
        return $this->endTime;
    }
    
    /**
     * get the person id
     * @return int|null
     */
    public function getPersonId() : ?int
    {
        return $this->personId;
    }
    
    /**
     * get the organisation id
     * @return int|null
     */
    public function getOrgId() : ?int
    {
        return $this->orgId;
    }
    
    /**
     * get the deal id
     * @return int|null
     */
    public function getDealId() : ?int
    {
        return $this->dealId;
    }
    
    /**
     * get the note
     * @return string|null
     */
    public function getNote() : ?string
    {
        return $this->note;
    }
    
    /**
     * get the client phone
     * @return string|null
     */
    public function getClientsPhoneNumber() : ?string
    {
        return $this->clientsPhoneNumber;
    }
    
    /**
     * create the json for call log addign
     * @return string|null
     */
    public function toArray() : ?array
    {
        $send_data = [];
        if($this->getUserId()){
            $send_data['user_id'] = $this->getUserId();
        }
        if($this->getActivityId()){
            $send_data['activity_id'] = $this->getActivityId();
        }
        if($this->getSubject()){
            $send_data['subject'] = $this->getSubject();
        }
        if($this->getDuration()){
            $send_data['duration'] = $this->getDuration();
        }
        if($this->getOutcome()){
            $send_data['outcome'] = $this->getOutcome();
        }else{
            return null;
        }
        if($this->getFromPhoneNumber()){
            $send_data['from_phone_number'] = $this->getFromPhoneNumber();
        }else{
            return null;
        }
        if($this->getToPhoneNumber()){
            $send_data['to_phone_number'] = $this->getToPhoneNumber();
        }else{
            return null;
        }
        if($this->getStartTime()){
            $send_data['start_time'] = $this->getStartTime();
        }else{
            return null;
        }
        if($this->getEndTime()){
            $send_data['end_time'] = $this->getEndTime();
        }else{
            return null;
        }
        if($this->getPersonId()){
            $send_data['person_id'] = $this->getPersonId();
        }
        if($this->getOrgId()){
            $send_data['org_id'] = $this->getOrgId();
        }
        if($this->getDealId()){
            $send_data['deal_id'] = $this->getDealId();
        }
        if($this->getNote()){
            $send_data['note'] = $this->getNote();
        }
        return $send_data;
    }
}
