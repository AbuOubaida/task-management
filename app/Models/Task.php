<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','team_member_id','title','deadline','priorities','progress','description','created_by','updated_by'];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function teamMember()
    {
        return $this->belongsTo(User::class,'team_member_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
