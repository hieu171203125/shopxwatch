<?php 
/**
 * 
 */
class Social extends Model
{
	
	public $timespamps = false;
	protected $fillable = [
		'provider_customer_id','provider','customer'
	];

	protected $primaryKey='customer_id';
	protected $table = 'social';
	public function login()
	{
	return $this->belongsTo('App/Login','user');
	
	}
}
 ?>