setTimeout(function(){
	var cf_imgs_array = document.getElementsByTagName("img");
	console.log(cf_imgs_array);
	if(cf_imgs_array[0].src.indexOf("eland") > 0){
		cf_new_url = cf_imgs_array[0].src.replace("eland.doublemax.net/cfdmp/viewreceiver","events.doublemax.net/dspAlert/imp/newUrl")
		add_new_cf_log(cf_new_url);
		console.log(cf_imgs_array[0].src);
	}else if(cf_imgs_array[1].src.indexOf("eland") > 0){
		cf_new_url = cf_imgs_array[1].src.replace("eland.doublemax.net/cfdmp/viewreceiver","events.doublemax.net/dspAlert/imp/newUrl")
		add_new_cf_log(cf_new_url);
		console.log(cf_imgs_array[0].src);
	}else if(cf_imgs_array[2].src.indexOf("eland") > 0){
		cf_new_url = cf_imgs_array[2].src.replace("eland.doublemax.net/cfdmp/viewreceiver","events.doublemax.net/dspAlert/imp/newUrl")
		add_new_cf_log(cf_new_url);
		console.log(cf_imgs_array[0].src);
	}else if(cf_imgs_array[3].src.indexOf("eland") > 0){
		cf_new_url = cf_imgs_array[3].src.replace("eland.doublemax.net/cfdmp/viewreceiver","events.doublemax.net/dspAlert/imp/newUrl")
		add_new_cf_log(cf_new_url);
		console.log(cf_imgs_array[0].src);
	}
} , 1000);

function add_new_cf_log(url){
	var new_link = document.createElement("img");
	new_link.setAttribute('src', url);
	new_link.setAttribute('style', "display: none;");
	document.getElementsByClassName("CFAD_MT")[0].appendChild(new_link);
}
//4173|4142|4242|4250|4236