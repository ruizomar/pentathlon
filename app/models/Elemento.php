<?php
class Elemento extends Eloquent{
	public $timestamps = false;
	protected $fillable = array('persona_id','estatura','peso','ocupacion','estadocivil','fechanacimiento','escolaridad','escuela','fechaingreso','lugarnacimiento','curp','calle','colonia','cp','municipio','reclutamiento','email','alergias','adiccion','tipoarma_id','tipocuerpo_id','companiasysubzona_id');
	
	public function persona(){
		return $this->belongsTo('Persona');
	}
	public function matricula(){
		return $this->hasOne('Matricula');
	}
	public function pagos(){
		return $this->hasMany('Pago');
	}
	public function grados(){
		return $this->belongsToMany('Grado','ascensos')->withPivot('fecha');
	}
	public function cargos(){
		return $this->belongsToMany('Cargo','cargosobtenido')->withPivot('fecha_inicio','fecha_fin');
	}
	public function companiasysubzona(){
		return $this->belongsTo('Companiasysubzona');
	}
	public function status(){
		return $this->hasMany('Statu');
	}
	public function asistencias(){
		return $this->hasMany('Asistencia');
	}
}