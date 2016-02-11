<?php

class UsuarioService
{

	public function createPerfilVacio($UsuId){
		$perfil = new perfilSocial();
		$perfil->id_usuario = $UsuId;
		$perfil->foto1 = 'profile_defect_picture.png';
		$perfil->descripcion = '¡Escribe algo acerca de tí!';
		$perfil->fhcreacion = new CDbExpression('NOW()');
		$perfil->fhultmod = new CDbExpression('NOW()');
		$perfil->cusuario = $UsuId;
		$perfil->save();


	}


}
