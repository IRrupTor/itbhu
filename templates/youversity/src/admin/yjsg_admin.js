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
//YJSGtime
var YJTime = {
	start: function(){
		YJTime.startTime = new Date().getTime();
		
		var saveBtn = $('toolbar-save').getElement('a');
		var applyBtn = $('toolbar-apply').getElement('a');
		
		saveBtn.addEvent('click', YJTime.setTimer );
		applyBtn.addEvent('click', function(event){ new Event(event).stop(); YJTime.setTimer() });
	},
	
	setTimer: function(){
		
		var path = $('YJSG_template_path').get('value');
		
		var myRequest = new Request({method: 'get', url: path+'/yjsgcore/yjsgajax_reset.php'});
		myRequest.send();
		
		/*
		var hElement = $('paramsadmin_css_time')
		var c = hElement.getValue().toInt();
		var e = new Date().getTime();
		var d = e - YJTime.startTime;
		Cookie.set('param_css_time', c+d, {path:'/'});
		//*/
	}
}
window.addEvent('domready', YJTime.start);

// YJSGcheckboxes

var YJCheckboxes = new Class({
	initialize: function(options) {
		this.options = Object.extend({
			labels: '.option',
			checkboxes: '.check'
		}, options || {});
		
		this.start();		
	},
	
	start: function(){
		this.makeCheckBoxes();		
	
	},	
	
	makeCheckBoxes: function(){
		
		this.lbls = $$(this.options.labels);
		this.lbls.fx = [];
		this.parseChecks();
		
		var allinputs = $$( this.options.labels+' '+this.options.checkboxes );
		
		allinputs.each(function(chk){
			chk.inputElement = chk.getElement('input');
			chk.inputElement.setStyle('opacity', .001);
		}.bind(this));
		
		allinputs.each(function(chk,i){
			if (chk.inputElement.checked==1){ 
				chk.index = i;
				this.selectBox(chk);
			}
		}.bind(this));	
		
	},
	
	parseChecks: function(){
		this.lbls.each(function(lbl, i){
			//this.lbls.fx[i] = new Fx.Styles(lbl, {wait: false, duration: 300});

			var chk = lbl.getElement(this.options.checkboxes);
			chk.index = i;
			
			lbl.addEvent('click', function(){
				if (!chk.hasClass('selected')){
					this.selectBox(chk);
				}
				else if (lbl.hasClass('check')){ 
					this.deselectBox(chk);
				}
				
				lbl.getElement('input[type=checkbox]').fireEvent('click');
				
			}.bind(this));	
			
			lbl.addEvent('mouseover',function(el){
				lbl.setStyle('cursor','pointer');
			}.bind(this))
		}.bind(this));
	},
	
	selectBox: function(chk){		
		chk.inputElement.checked = 'checked';	
		//this.lbls.fx[chk.index].start({ 'color': '#59AC00' });		
		this.lbls[chk.index].removeClass('unlocked').addClass('locked');		
		chk.addClass('selected');
		this.checkAny+=1;
	},

	deselectBox: function(chk){
		chk.inputElement.checked = false;
		//this.lbls.fx[chk.index].start({ 'color': '#000000' });
		this.lbls[chk.index].removeClass('locked').addClass('unlocked');		
		chk.removeClass('selected');
		this.checkAny-=1;
	}
	
});
window.addEvent('domready', function(){
	var YJChecks = new YJCheckboxes();
})

/**
* @file elSelect.js
* @downloaded from http://www.cult-f.net/2007/12/14/elselect/
* @author Sergey Korzhov aka elPas0
* @site  http://www.cult-f.net
* @date December 14, 2007
* 
*/
var elSelect = new Class({
	options: {
		container: false,
		baseClass : 'elSelect'
	},
	source : false,
	selected : false,
	_select : false,
	current : false,
	selectedOption : false,
	dropDown : false,
	optionsContainer : false,
	hiddenInput : false,
	/*
	pass the options,
	create html and inject into container
	*/
	initialize: function(options){
		this.setOptions(options)
		
		if ( !this.options.container ) return;
		
		this.selected = false;
		this.source = $(this.options.container).getElement('select');
		this.buildFrameWork();
		
		var t = new Element('div', {'class':'YJSG_sbox'}).injectAfter($(this.options.container));
		
		$(this.source).getElements('option').each( this.addOption, this );
		$(this.options.container).set({'html':''}).injectInside(t);
		this._select.injectInside($(this.options.container));
		
		this.hiddenInput.injectInside($(this.options.container));
		
		this.bindEvents();
		
	},
	
	buildFrameWork : function() {
		this._select = new Element('div').addClass( this.options.baseClass ).set({'id':this.source.getProperty('id')});
		this.current = new Element('div').addClass('selected').injectInside($(this._select))
		this.selectedOption = new Element('div').addClass('selectedOption').injectInside($(this.current))
		this.dropDown = new Element('div').addClass('dropDown').injectInside($(this.current))
		new Element('div').addClass('clear').injectInside($(this._select))
		this.optionsContainer = new Element('div').addClass('optionsContainer').injectInside($(this._select))
		var t = new Element('div').addClass('optionsContainerTop').injectInside($(this.optionsContainer))
		var o = new Element('div').injectInside($(t))
		var p = new Element('div').injectInside($(o))
		var t = new Element('div').addClass('optionsContainerBottom').injectInside($(this.optionsContainer))
		var o = new Element('div').injectInside($(t))
		var p = new Element('div').injectInside($(o))

		this.hiddenInput = new Element('input').setProperties({
			type  : 'hidden',
			name  : this.source.get('name')				
		})
				
	},
	
	bindEvents : function() {
		document.addEvent('click', function(event) {
			if ( this.optionsContainer.getStyle('display') == 'block'){
				this.onDropDown();
				return;
			}
		}.bind(this));
			
		$(this.options.container).addEvent( 'click', function(e) { new Event(e).stop(); } )		
		this.current.addEvent('click', this.onDropDown.bindWithEvent(this) )
		
	},
	
	//add single option to select
	addOption: function( option ){
    	var o = new Element('div').addClass('option').setProperty('value',option.value);
		
		if( option.getProperty('class') )
			option.addClass(option.getProperty('class'));
		
		if ( option.disabled ) { o.addClass('disabled') } else {
			o.addEvents( {
				'click': this.onOptionClick.bindWithEvent(this),
				'mouseout': this.onOptionMouseout.bindWithEvent(this),
				'mouseover': this.onOptionMouseover.bindWithEvent(this)
			})
		}
		
		if ( $defined(option.getProperty('class')) && $chk(option.getProperty('class')) ) 
			o.addClass(option.getProperty('class'))

	
		if ( option.selected ) { 
			if ( this.selected) this.selected.removeClass('selected');
			this.selected = o
			o.addClass('selected')
			
			if( option.getProperty('class') ){
				this.selectedOption.addClass(option.getProperty('class'));
			}
			
			this.selectedOption.set({'text':option.text});
			this.hiddenInput.setProperty('value',option.value);
		}
		o.set({'text': option.text})		
		o.injectBefore($(this.optionsContainer).getLast())
	},
	
	onDropDown : function( e ) {
			
			if ( this.optionsContainer.getStyle('display') == 'block') {
				this.optionsContainer.setStyle('display','none')
			} else {
				if( $(this.options.container).hasClass('disabled')) return;
				this.optionsContainer.setStyle('display','block')
				this.selected.addClass('selected')
				//needed to fix min-width in ie6
				var width =  this.optionsContainer.getStyle('width').toInt() > this._select.getStyle('width').toInt() ?
															this.optionsContainer.getStyle('width')
															:
															this._select.getStyle('width')
															
				this.optionsContainer.setStyle('width', width)
				this.optionsContainer.getFirst().setStyle('width', width)
				this.optionsContainer.getLast().setStyle('width', width)
			}						
	},
	onOptionClick : function(e) {
		var event = new Event(e)
		if ( this.selected != event.target ) {
			this.selected.removeClass('selected')
			event.target.addClass('selected')
			this.selected = event.target
			this.selectedOption.set({'text':this.selected.get('text')});
			this.hiddenInput.setProperty('value',this.selected.get('value'));
			
			this.fireEvent('onChange', [this.selected.getProperty('value'), e.target.hasClass('disable_next'), e.target.hasClass('enable_next'), e.target.getProperty('class')]);
		}
		this.onDropDown()
	},
	onOptionMouseover : function(e){
		var event = new Event(e)
		this.selected.removeClass('selected')
		event.target.addClass('selected')
	},
	onOptionMouseout : function(e){
		var event = new Event(e)
		event.target.removeClass('selected')
	}
	
});
elSelect.implement(new Events);
elSelect.implement(new Options);

var YJSelectBoxes = {
	start: function(){
		
		$$('div.fltrt select').each(function(el, i){
			
			if( el.getProperty('multiple') )
				return;
			
			var elid = 'mySelect_'+i;
			new Element('div').set({'id':elid, 'class':'selectsContainer'}).setStyle('z-index', 1000-i).injectAfter(el).adopt(el);
			new elSelect({
				container : elid,
				onChange: function(value, disable_next, enable_next, dsb){
					
					var cssClasses = dsb.split(' ');
					var disableElems = [];
					var enableElems = [];
					var sClass = '';
					
					cssClasses.each(function(c, i){
						if( c == 'disable_next' ){
							
							disableElems = cssClasses[i+1].split('|');
							sClass +=' disable_next '+cssClasses[i+1];
						}
						if( c == 'enable_next' ){	
							enableElems = cssClasses[i+1].split('|');	
							sClass +=' enable_next '+cssClasses[i+1];
						}
					})
					
					this.selectedOption.set({'class':'selectedOption'+sClass});
					
					disableElems.each( function( elm, i ){
						
						if( !$(elm) ) return;
						
						if( $(elm).hasClass('elSelect') ){					
							var element = $(elm).getParent();					
							if( element.hasClass('disabled') ) return;
							
							new Element('div').set({'class':'overDiv'}).injectInside(element);
							element.addClass('disabled');
							
						}else{
							$(elm).set({'disabled':'disabled'});	
						}
					})				
					
					enableElems.each( function( elm, i ){
						
						if( !$(elm) ) return;
						
						if( $(elm).hasClass('elSelect') ){					
							
							var element = $(elm).getParent();	
							var oDiv = element.getElement('.overDiv');
							if( oDiv ) oDiv.dispose();
							element.removeClass('disabled');
							
						}else{
							$(elm).set({'disabled':''});	
						}
						
					});
					
					YJSelectBoxes.parseBosex();
					
				}
			});	
		});		
		
		YJSelectBoxes.parseBosex();
		
	},
	
	parseBosex: function(){
		$$('.selectsContainer').each(function(el, i){
		
			var sOption = el.getElement('.selectedOption');		
			if( sOption.hasClass('disable_next') ){
				
				var cssClasses = sOption.getProperty('class').split(' ');
				var disableElems = [];
				var enableElems = [];
				
				cssClasses.each(function(c, i){
					if( c == 'disable_next' )
						disableElems = cssClasses[i+1].split('|');
					if( c == 'enable_next' )	
						enableElems = cssClasses[i+1].split('|');						
				})
				
				disableElems.each(function(elm, i){
					if( !$(elm) ) return;
					
					if( $(elm).hasClass('elSelect') ){
						
						var nextElem = $(elm).getParent();
						if( !nextElem.hasClass('disabled')  ){					
							new Element('div').set({'class':'overDiv'}).injectInside(nextElem);
							nextElem.addClass('disabled');
						}
					}else{					
						$(elm).set({'disabled':'disabled'});					
					}					
					
				})
			}
		})
	}
	
}

window.addEvent('domready', YJSelectBoxes.start);
// YJSGserialize
var YJSerialize = {
	start: function(){
				
		var containers = $$('div.YJSG_multiple');
		
		containers.each( function(e, i){
			
			var elems = e.getElements('input.serialize_multiple');
			if( elems.length == 0 ) return;
			
			var locks = e.getElements('input[type=checkbox]');			
			var hiddenInput = new Element('input')
							  .set({'type':'hidden', 'name': elems[0].getProperty('name').replace('[]', ''), 'value':''}).injectAfter(elems.getLast());
			hiddenInput.addClass(elems[0].getProperty('class'));				  
			
			var initialValue = '';
			elems.each( function(el, i){
				initialValue += el.get('value');
				//if( i!== elems.length-1 )
					initialValue+='|';
			});
			locks.each( function(el, i){
				initialValue += el.checked ? 1 : 0;
				if( i!== locks.length-1 )
					initialValue += '|';
			});
			hiddenInput.set({'value': initialValue});
			
			elems.addEvent('click', function(event){ this.select(); });			
			elems.addEvent('keyup', function(){ YJSerialize.assembleVariable(elems, locks, hiddenInput, this); });	
			locks.addEvent('click', function(){ YJSerialize.assembleVariable(elems, locks, hiddenInput, false); });
		})		
		YJSerialize.resetValues();		
	},
	
	assembleVariable: function( elems, locks, hiddenInput, elem ){
		
		initialValue = '';
		if( elem ){
			
			var val = elem.get('value').toFloat().round(2);
			var v = val ? val : 0;
			elem.set({'value': v});
			YJSerialize.verifyInput( elems, elem, locks );
		}
		
		elems.each( function(el, i){
			initialValue += el.get('value').toFloat().round(2);
			//if( i!== elems.length-1 )
				initialValue+='|';
		});
		locks.each( function(el, i){
			initialValue += el.checked ? 1 : 0;
			if( i!== locks.length-1 )
				initialValue += '|';
		});
		hiddenInput.set({'value': initialValue});
		
	},
	
	verifyInput: function(elems, el, locks){
	
		var elementValue = el.get('value').toInt();
		if( elementValue >100 ){
			el.set({'value':100});
			elementValue = 100;
		}
		
		var locked = [];
		locks.each(function(e, i){
			if( e.checked )
				locked.include(i);
		})
		
		var elIndex = elems.indexOf(el);
		var s = 0;
		var eVals = [];
		var eKeys = [];
		elems.each(function(e, i){
			if(i == elIndex) return;
			var stopped = false;
			locked.each( function(e){
				if( i == e ) {
					elementValue += elems[e].get('value').toFloat().round(2);
					stopped = true;
				}
			})
			
			if( stopped ) return;
			
			var v = e.get('value').toFloat().round(2);			
			eVals[ eVals.length ] = v;
			eKeys.include(i);			
			s += v;
		});
		
		if( elementValue > 100 ){
			elementValue-= el.get('value');
			el.set({'value':0});
		}
		
		if( s + elementValue > 100 ){
			
			var exceed = 100 - elementValue;
			
			eKeys.each( function( real, key ){
				
				var r = s == 0 ? 0 : eVals[key]/s;
				
				var newSize = exceed*r;
				
				elems[real].set({'value': newSize.toFloat().round(2)});
				
			});	
			
		};		
	},
	
	resetValues: function(hiddenInput){
		
		$$('a.YJSG_reset-values').addEvent('click', function(event){
			new Event(event).stop();
			
			var values = this.getProperty('rel').split('|');
			var elemsCSS = this.getProperty('id');
			
			$$('input.'+elemsCSS+'[type=text]').each(function(el, i){
				el.set({'value': values[i]});
			});
			
			$$('input.'+elemsCSS+'[type=checkbox]').each(function(el, i){
				el.set({'checked':''});
				el.getParent().getParent().removeClass('locked').addClass('unlocked');
				el.getParent().removeClass('selected');
			});
			
			$$('input.'+elemsCSS+'[type=hidden]').set({'value': this.getProperty('rel')});			
		});	
	}
}
window.addEvent('domready', YJSerialize.start);

var roundCorners = {
	start: function(){
		$$('.panel .jpane-slider fieldset.panelform').each(function(el, i){
			//alert(i);
			var tl = new Element('div', {'class':'tl'});
			var tr = new Element('div', {'class':'tr'});
			var bl = new Element('div', {'class':'bl'});
			var br = new Element('div', {'class':'br'});
			
			tl.wraps(tr.wraps(bl.wraps(br.wraps(el))));			
		})
	}
}
window.addEvent('domready', roundCorners.start);
