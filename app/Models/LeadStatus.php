<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LeadStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lead_statuses';
    protected $primaryKey = 'id'; 
   
    protected $fillable = ['status','leadstatus_color'];
    protected $dates = ['deleted_at'];

    // public function leads()
    // {
    //     return $this->hasMany(Lead::class);
    // } 
    
    // LeadStatus ke leads
    public function leads()
    {
        return $this->hasMany(Lead::class, 'status_id');
    }

    
}
