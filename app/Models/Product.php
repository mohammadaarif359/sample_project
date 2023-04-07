<?php
  
namespace App\Models;
   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];
	protected $appends = [
        'image_url',
    ];
	/* product image url */
	public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/products/'.$this->image)  : "";
    }
}