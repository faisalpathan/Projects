
// var cuteID = cuteslider + csVarId;

var csVarId = cs_vars.id;
var cutesliderid = 'cuteslider' + csVarId;

var cutesliderid = new Cute.Slider();
console.log(cutesliderid);
cutesliderid.setup("cuteslider_" + csVarId, "cuteslider_"+ csVarId + "_wrapper", cs_vars.path + "/skins/"+ cs_vars.prop_skin +"/style/slider-style.css");

if( typeof cs_vars.prop_auto != 'undefined' && cs_vars.prop_auto != 'on'  ){
	cutesliderid.pause();
}

/*************/
/* CALLBACKS */
/*************/

// Cute.SliderEvent.CHANGE_START
cutesliderid.api.addEventListener(Cute.SliderEvent.CHANGE_START, cs_vars.prop_api_change_start );

// Cute.SliderEvent.CHANGE_END
cutesliderid.api.addEventListener(Cute.SliderEvent.CHANGE_END, cs_vars.prop_api_change_end );

// Cute.SliderEvent.WATING
cutesliderid.api.addEventListener(Cute.SliderEvent.WATING, cs_vars.prop_api_wating );

// Cute.SliderEvent.CHANGE_NEXT_SLIDE
cutesliderid.api.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, cs_vars.prop_api_change_next );

// Cute.SliderEvent.WATING_FOR_NEXT
cutesliderid.api.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, cs_vars.prop_api_waiting_next );