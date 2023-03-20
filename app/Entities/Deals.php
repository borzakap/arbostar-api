<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Deals extends Entity
{
    protected $datamap = [];
    protected $dates   = ['added_at', 'stage_change_time', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    /**
     * get oly domains name from url
     * @param string|null $referral
     * @return self
     */
    public function setReferral(?string $referral) : self
    {
        if(filter_var($referral, FILTER_VALIDATE_URL)){
            $this->attributes['referral'] = str_ireplace('www.', '', parse_url($referral, PHP_URL_HOST));
        }elseif($referral){
            $this->attributes['referral'] = trim($referral);
        }else{
            $this->attributes['referral'] = 'null';
        }
        return $this;
    }

    /**
     * set utm_source right value
     * @param string|null $utm_source
     * @return self
     */
    public function setUtmSource(?string $utm_source) : self
    {
        $this->attributes['utm_source'] = !$utm_source ? 'null' : trim($utm_source);
        return $this;
    }

    /**
     * set utm_medium right value
     * @param string|null $utm_medium
     * @return self
     */
    public function setUtmMedium(?string $utm_medium) : self
    {
        $this->attributes['utm_medium'] = !$utm_medium ? 'null' : trim($utm_medium);
        return $this;
    }

    /**
     * set utm_campaign right value
     * @param string|null $utm_campaign
     * @return self
     */
    public function setUtmCampaign(?string $utm_campaign) : self
    {
        $this->attributes['utm_campaign'] = !$utm_campaign ? 'null' : trim($utm_campaign);
        return $this;
    }

    /**
     * set utm_content right value
     * @param string|null $utm_content
     * @return self
     */
    public function setUtmContent(?string $utm_content) : self
    {
        $this->attributes['utm_content'] = !$utm_content ? 'null' : trim($utm_content);
        return $this;
    }
    
    /**
     * set utm_term right value
     * @param string|null $utm_term
     * @return self
     */
    public function setUtmTerm(?string $utm_term) : self
    {
        $this->attributes['utm_term'] = !$utm_term ? 'null' : trim($utm_term);
        return $this;
    }
}
