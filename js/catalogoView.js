jQuery(document).ready(function($){
	showCatalog(MyScriptParams.catalogName,MyScriptParams.columnNames,MyScriptParams.title,MyScriptParams.ajaxurl );

});

function showCatalog(catalogName,columnNames, title, ajaxurl){
	jQuery.post(
		ajaxurl,
 		{
   			action: 'catalogoPlugin_getPostRealCatalogData',
   			catalogName: catalogName,
			columnNames: columnNames
		},
		function( response ) {
  			var obj = jQuery.parseJSON(response);
  			colModel = new Array();
 			colName = new Array();

 			/*
 			colModel = [
			{propiedad1:value1, propiedad2:value2...}, ..., {propiedad1:value1, propiedad2:value2...}
 			]
 			*/
 			jQuery.each(obj.object.head, function() {
	  			var obj = {};
	  			obj['name']=this;
	  			obj['editable']=false;
	  			
	  			colName.push(this);
	  			colModel.push(obj);
			});
			divId = "catalogPostContent";
			divId = "#"+divId;
     		jQuery('#catalogPostContent').jqGrid('GridUnload');
  			jQuery("#catalogPostContent").jqGrid({
	      		datatype: "local",
	      		width: 500,
	      		colNames: colName,
	      		colModel: colModel,
				viewrecords: true,
  				sortorder: "desc",
		    	caption: title,
		    });
			
			jQuery.each(obj.object.data, function() {
  				mydata = {};
					for(var i=0;i<colName.length;i++){
  					mydata[colName[i]] = this[i];
  				}
				jQuery("#catalogPostContent").addRowData(this['id'], mydata);
			});
   		}
	);
}