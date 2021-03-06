<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Cviebrock\EloquentTaggable\Taggable;

use Auth;

class Report extends Model
{
   use Cachable,Taggable;

   protected $fillable = ['name','description','user_id','group_id'];

   public function files()
   {
      return $this->hasMany(File::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function group()
   {
      return $this->belongsTo(Group::class);
   }

   public function createFile($name,$type,$path)
  {
    return $this->files()->create(['name'=>$name,'type'=>$type,'path'=>$path]);
  }

   public function scopeFilterReports($query)
  {
      return (Auth::user()->isAdmin()) ? $query : $this->filter($query->get());
  }

  public function updateReport()
  {
      $this->update(request(['name','description','group_id']));
      $this->retag(request('tags'));
  }

  public function deleteReport()
  {
      $this->detag();
      return $this->delete();
  }
  public function getPathFiles()
  {
    $this->files->pluck('path')->toArray();
  }

  public function filter($reports)
  {
     $user_groups = Auth::user()->userGroupIds();
     $result = $reports->filter(function ($value, $key) use($user_groups) {
                      return in_array($value->group_id,$user_groups) ;
                });
     return $result;
  }

}
