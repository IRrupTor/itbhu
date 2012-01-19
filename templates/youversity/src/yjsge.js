/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla LLC. All Rights Reserved.            ||
|| # Authors - Dragan Todorovic and Constantin Boiangiu                 ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla LLC                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/

var ie6Alert = {
	display: function(){
		//if( !window.ie6 ) return;
		// Moo to Mo
		if (Cookie.set === undefined) {
			Cookie.get = Cookie.read;
			Cookie.set = Cookie.write;
			Cookie.remove = Cookie.dispose;
		}
		if (Fx.Styles === undefined) {
			Fx.Styles = Fx.Morph;
		}
		
		if( Cookie.get('IE6Warned') ) return;
		var fx = new Fx.Styles('ie6Warning', {wait:false, fx: Fx.Transitions.Back.easeIn, duration:800});
		$('ie6Warning').setStyles({'display':'block', 'opacity':0});
		fx.start({'top':0, 'opacity': 1});
		
		$('closeIe6Alert').addEvent('click', function(event){
			new Event(event).stop();
			fx.start({'opacity':0}).chain(function(){
				$('ie6Warning').setStyles({'display':'none', 'top':-150});
				Cookie.set('IE6Warned', true);
			})
		})
		
	}
}
window.addEvent('domready', ie6Alert.display);