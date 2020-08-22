CREATE DEFINER=`root`@`localhost` PROCEDURE `valid_user`(in user_ varchar(50))
begin
	set @codigo=null;
	if exists (select cod_cliente from persona,cliente where cliente.id_persona = persona.id_persona and usuario = user_)then 
		select cod_cliente into @codigo from persona,cliente where cliente.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_admin from persona,administrador where administrador.id_persona = persona.id_persona and usuario = user_) then
		select cod_admin into @codigo from persona,administrador where administrador.id_persona = persona.id_persona and usuario = user_;
	elseif exists (select cod_administrativo from persona,trabajador,cat_trabajador,administrativo where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and administrativo.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then
		select cod_administrativo into @codigo from persona,trabajador,cat_trabajador,administrativo where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and administrativo.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	elseif exists (select cod_almacen from persona,trabajador,cat_trabajador,almacen where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and almacen.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then
		select cod_almacen into @codigo from persona,trabajador,cat_trabajador,almacen where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and almacen.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	elseif exists (select cod_repartidor from persona,trabajador,cat_trabajador,repartidor where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and repartidor.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_)then 
		select cod_repartidor into @codigo from persona,trabajador,cat_trabajador,repartidor where trabajador.id_persona = persona.id_persona and cat_trabajador.id_trabajador = trabajador.id_trabajador and repartidor.id_cat_trabajador = cat_trabajador.id_cat_trabajador and usuario = user_;
	end if;

	select @codigo;

end