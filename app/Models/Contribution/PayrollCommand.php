<?php

namespace App\Models\Contribution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Affiliate\Affiliate;
use App\Models\Contribution\ContributionPassive;
use App\Models\Contribution\PayrollCommand;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollCommand extends Model
{
    protected $table = "payroll_commands";
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;
    public $guarded = ['id'];
    protected $fillable = [
        'affiliate_id',
        'unit_id',
        'breakdown_id',
        'month_p',
        'year_p',
        'identity_card',
        'last_name',
        'mothers_last_name',
        'surname_husband',
        'first_name',
        'second_name',
        'civil_status',
        'nivel',
        'grade',
        'gender',
        'base_wage',
        'seniority_bonus',
        'study_bonus',
        'position_bonus',
        'border_bonus',
        'east_bonus',
        'public_security_bonus',
        'gain',
        'total',
        'payable_liquid',
        'birth_date',
        'date_entry',
        'affiliate_type'
    ];
    
    /*public function payroll_command_contribution()
    {
        return $this->morphMany(Contribution::class,'contributionable');
    }*/
    
    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
    public static function data_period($month,$year)
    {
        $data = collect([]);
        $exists_data = true;
        $payroll = PayrollCommand::whereMonth_p($month)->whereYear_p($year)->count();
        if($payroll == 0) $exists_data = false;

        $data['exist_data'] = $exists_data;
        $data['count_data'] = $payroll;

        return  $data;
    }
}
