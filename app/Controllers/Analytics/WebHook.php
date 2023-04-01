<?php

namespace App\Controllers\Analytics;

use App\Controllers\BaseController;
use App\Models\Deals as DealsModel;
use App\Models\Stages as StagesModel;
use App\Entities\Deals as DealsEntity;
use App\Entities\Stages as StagesEntity;

class WebHook extends BaseController
{
    public function index() : void
    {
        $deal = $this->request->getJSON();
        if(!isset($deal->meta->id)){
            return;
        }
        $modelDeals = new DealsModel();
        $pipedriveConfig = config('Pipedrive');
        if(!$entityDeals = $modelDeals->find($deal->meta->id)){
            $entityDeals = new DealsEntity();
            $entityDeals->id = $deal->meta->id;
            $entityDeals->referral = $deal->previous->{$pipedriveConfig->fieldReferral};
            $entityDeals->utm_source = $deal->previous->{$pipedriveConfig->fieldSource};
            $entityDeals->utm_medium = $deal->previous->{$pipedriveConfig->fieldMedium};
            $entityDeals->utm_campaign = $deal->previous->{$pipedriveConfig->fieldCampaign};
            $entityDeals->utm_content = $deal->previous->{$pipedriveConfig->fieldContent};
            $entityDeals->utm_term = $deal->previous->{$pipedriveConfig->fieldTerm};
            $entityDeals->status = $deal->previous->status;
            $entityDeals->added_at = $deal->previous->add_time;
            $entityDeals->stage_id = (string)$deal->previous->stage_id;
            $entityDeals->stage_order_nr = $deal->previous->stage_order_nr;
            $entityDeals->stage_change_time = $deal->previous->stage_change_time;
            $modelDeals->insert($entityDeals);
        }
        $entityDeals->referral = $deal->current->{$pipedriveConfig->fieldReferral};
        $entityDeals->utm_source = $deal->current->{$pipedriveConfig->fieldSource};
        $entityDeals->utm_medium = $deal->current->{$pipedriveConfig->fieldMedium};
        $entityDeals->utm_campaign = $deal->current->{$pipedriveConfig->fieldCampaign};
        $entityDeals->utm_content = $deal->current->{$pipedriveConfig->fieldContent};
        $entityDeals->utm_term = $deal->current->{$pipedriveConfig->fieldTerm};
        $entityDeals->status = $deal->current->status;
        $entityDeals->stage_id = (string)$deal->current->stage_id;
        $entityDeals->stage_order_nr = $deal->current->stage_order_nr;
        $entityDeals->stage_change_time = $deal->current->stage_change_time;
        $modelDeals->update($deal->meta->id, $entityDeals);
        if($entityDeals->hasChanged('stage_id')){
            // write the stage change table
            $entityStages = new StagesEntity();
            $entityStages->deal_id = $deal->meta->id;
            $entityStages->stage_id = (int)$deal->current->stage_id;
            $entityStages->name = $pipedriveConfig->stageName($deal->current->stage_id);
            $entityStages->order_nr = $deal->current->stage_order_nr;
            $entityStages->stage_change_time = $deal->current->stage_change_time;
            $modelStages = new StagesModel();
            $modelStages->insert($entityStages);
        }
    }
}
