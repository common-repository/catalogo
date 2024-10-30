var selectType;


// NAVBAR FOR CATALOG
var addCatalogOptions = {
	afterSubmit: function (response, postdata) {
		var res = response.responseText;
		return [true, ''];
	},
    aftersavefunc: function (rowid, response) {
		var rowData = jQuery("#catalogs").getRowData(rowid);
		addCatalog(rowData);
	},
    errorfunc: function (rowid, response) {
	},
    successfunc: function (response) {
		return true;
	}
};

var addCatalogParameters = {
	addRowParams: addCatalogOptions,
	reloadAfterSubmit: false
};

var editCatalogParameters = {
	url: 'clientArray',
	successfunc: function(response){
		return true;
	},
	oneditfunc:function(rowid){
		var row = jQuery("#catalogs").getLocalRow(rowid);
		idTypeBefore = row.idType;
	},
	errorfunc:function(rowid){
		
	},
	afterrestorefunc:function(rowid){

	},
	aftersavefunc: function(rowid, response) {
		// aftersavefunc: Also the event is called too when the url is set to 'clientArray'.
		var rowData = jQuery("#catalogs").getRowData(rowid);
		// Its not possible change idType
		if(idTypeBefore!=rowData.idType){
			alert("Error, it's not possible change type!");
			loadCatalogs();
		}else{
			editCatalog(rowData);			
		}
	},
	reloadAfterSubmit: true
};


var inlineCatalogParameters = {
  edit: true,
  editicon: "ui-icon-pencil",
  save: true,
  saveicon: "ui-icon-disk",
  cancel: true,
  cancelicon: "ui-icon-cancel",
  add: true,
  addicon: "ui-icon-plus",
 	searchtext: "Search",
	addtext: "Add",
	edittext: "Edit",
  addParams: addCatalogParameters,
  editParams: editCatalogParameters,
  reloadAfterSubmit: true,
  restoreAfterSelect: false
};


// NAVBAR FOR CATALOG CONTENT
var addCatalogContentOptions = {
	beforeShowForm: function(form) {

	},
 	afterSubmit: function (response, postdata) {
		var res = response.responseText;
		return [true, ''];
	},
  	aftersavefunc: function (rowid, response) {
		var rowData = jQuery("#catalogContent").getRowData(rowid);
		rowData['catalogId']=catalogId;
		addCatalogContent(rowData);
	},
  	errorfunc: function (rowid, response) {
	},
  	successfunc: function (response) {
		return true;
	}
};

var addCatalogContentParameters = {
	addRowParams: addCatalogContentOptions,
	reloadAfterSubmit: false
};

var editCatalogContentParameters = {
	url: 'clientArray',
 	beforeShowForm: function(form) {
		
	},
	successfunc: function(response){
		return true;
	},
	oneditfunc:function(rowid){
		
	},
	errorfunc:function(rowid){
		
	},
	afterrestorefunc:function(rowid){
		
	},
	aftersavefunc: function(rowid, response) {
		var rowData = jQuery("#catalogContent").getRowData(rowid);
		rowData['catalogId']=catalogId;
		editCatalogContent(rowData);
	},
	reloadAfterSubmit: true
};


var inlineCatalogContentParameters = {
	edit: true,
	editicon: "ui-icon-pencil",
	save: true,
	saveicon: "ui-icon-disk",
	cancel: true,
	cancelicon: "ui-icon-cancel",
	add: true,
 	addicon: "ui-icon-plus",
 	searchtext: "Search",
	addtext: "Add",
	edittext: "Edit",
 	addParams: addCatalogContentParameters,
	editParams: editCatalogContentParameters,
	reloadAfterSubmit: true,
	restoreAfterSelect: false
};



/**********************************************/
// LOAD TYPES
/**********************************************/
function loadTypes(){
 	jQuery.post(
  		ajaxurl,
   		{
      		action: 'catalogoPlugin_getTypes'
    	},
    	function( response ) {
      		var obj = jQuery.parseJSON(response);
      		var lang = '';
      		// unload previous data
        	jQuery('#types').jqGrid('GridUnload');
        	// create a grid for types
			jQuery("#types").jqGrid({
				datatype: "local",
				width: 300,
				colNames: ['Id','Nombre', 'Descripcion'],
				colModel: [
					{
				    	name: 'id',
				    	index: 'id',
				    	width: 10,
				    	hidden: false,
				    	sorttype: "string"
				  	},
				  	{
				    	name: 'name',
				    	index: 'name',
				    	width: 60,
				    	hidden: false,
				    	sorttype: "string",
							editable: true,
				    	editrules:{required:true}
				  	},
				  	{
				    	name: 'description',
				    	index: 'description',
				    	width: 90,
				    	sorttype: "string",
				  		editable: true,
				    	editrules:{required:true}
					}
				],
				rowList:[10,20,30],
				pager: '#types_pager',
				caption: "Types",
				ondblClickRow: function(rowid,iRow,iCol,e){
					loadTypeColums(rowid)
				}
			});
			var names = ["id", "name", "description"];
			// Create select for add or edit a catalog
			selectType = "0:-Select Type-";
  			jQuery.each(obj.object, function() {
  				mydata = {};
  				mydata[names[0]] = this['id'];
  				mydata[names[1]] = this['name'];
  				mydata[names[2]] = this['description'];
  				selectType=selectType+";"+this['id']+":"+this['name']
  				jQuery("#types").addRowData(this['id'], mydata);
			});
   		}
	);
}


/**********************************************/
// LOAD TYPES COLUMNS
/**********************************************/
function loadTypeColums(rowId){
	var rowData = jQuery("#types").getRowData(rowId);
	var id = rowData['id'];
	jQuery.post(
	  	ajaxurl,
	   	{
	    	action: 'catalogoPlugin_getTypeColumns',
	    	id: id
	    },
	    function( response ) {
	    	var obj = jQuery.parseJSON(response);
	    	var lang = '';
	    	// unload previous data
	      	jQuery('#type_columns').jqGrid('GridUnload');
	      	// create a grid for type columns
			jQuery("#type_columns").jqGrid({
		    	datatype: "local",
		    	width: 300,
		    	colNames: ['Id','Nombre', 'Descripcion'],
		    	colModel: [
					{
		      			name: 'id',
			      		index: 'id',
			      		width: 10,
			      		hidden: false,
			      		sorttype: "string"
			    	},
			    	{
			      		name: 'name',
			      		index: 'name',
			      		width: 60,
			      		hidden: false,
			      	sorttype: "string"
			    	},
			    	{
			      		name: 'description',
			      		index: 'description',
			      		width: 90,
			      		sorttype: "string",
			      		editable: true,
			      		editrules:{required:true}
					}
			  	],
			  	rowList:[10,20,30],
			  	pager: '#catalogs_pager',
			  	caption: "Types",
			});
			var names = ["id", "name", "description"];
		    jQuery.each(obj.object, function() {
	  			mydata = {};
	  			mydata[names[0]] = this['id'];
	  			mydata[names[1]] = this['name'];
	  			mydata[names[2]] = this['description'];
	  			jQuery("#type_columns").addRowData(this['id'], mydata);
			});
		    jQuery("#type_columns").jqGrid('navGrid','#type_columns_pager',{edit:false,add:false,del:false});
	   	}
	);
}




/**********************************************/
// LOAD CATALOGS
/**********************************************/
function loadCatalogs() {
	jQuery.post(
		ajaxurl,
 		{
   			action: 'catalogoPlugin_getCatalog'
		},
		function( response ) {
  			var obj = jQuery.parseJSON(response);
			var lang = '';
  			// unload previous data
	    	jQuery('#catalogs').jqGrid('GridUnload');
	    	jQuery("#catalogs").jqGrid({
			datatype: "local",
			width: 800,
			colNames: ['Id','Name', 'Description','Type'],
			colModel: [
				{
			    	name: 'id',
				    index: 'id',
				    width: 10,
				    hidden: false,
				    sorttype: "string"
				},
				{
				    name: 'name',
				    index: 'name',
				    width: 60,
				    hidden: false,
				    sorttype: "string",
						editable: true,
				    editrules:{required:true}
				},
				{
				    name: 'description',
				    index: 'description',
				    width: 90,
				    sorttype: "string",
				    editable: true,
				    editrules:{required:true}
				},
				  {
				    name: 'idType',
				    index: 'idType',
				    width: 30,
				    sorttype: "string",
				    editable: true,
				    edittype: "select",
				    formatter:'select',
				    editoptions: { value: selectType },
				    editrules:{required:true}
				}
			],
			rowList:[10,20,30],
			pager: '#catalogs_pager',
			caption: "Catalogos",
			ondblClickRow: function(rowid,iRow,iCol,e){
			  	showRealCatalog(rowid)
			},
			onInitializeForm : function(formid) {
				
			},
			onSelectRow:function(id){
				
			}
			/*
			// EVENTS
			afterInsertRow: function(rowid, rowdata, rowelem){alert('afterInsertRow')},
			gridComplete: function(){alert('gridComplete')},
			loadBeforeSend: function(xhr){alert('loadBeforeSend')},
			loadComplete: function(){alert('loadComplete')},
			loadError: function(xhr, st, err){alert('loadError')},
			onCellSelect: function(rowid, iCol, cellcontent){alert('onCellSelect')},
			ondblClickRow: function(rowid,iRow,iCol,e){alert('ondblClickRow'+rowid)},
			onHeaderClick: function(gridstate){alert('onHeaderClick')},
			onRightClickRow: function(rowid){alert('onRightClickRow')},
			onSelectAll: function(array){alert('onSelectAll')},
			onSelectRow: function(rowid){alert('onSelectRow')},
			onSortCol: function(index, colindex, sortorder){alert('onSortCol')}*/
		});
		
		var names = ["id","name", "description","idType"];
      	jQuery.each(obj.object, function() {
      		mydata = {};
      		mydata[names[0]] = this['id'];
      		mydata[names[1]] = this['name'];
      		mydata[names[2]] = this['description'];
      		mydata[names[3]] = this['idType'];
		
			jQuery("#catalogs").addRowData(this['id'], mydata);
		});
		var rowData = jQuery("#catalog").getRowData(1);
      	jQuery("#catalogs").jqGrid('navGrid','#catalogs_pager',
      		{
				edit:false,
				add:false,
				del:false
			},
      		{
				beforeShowForm: function(form) {

    		}
      	});
      	jQuery("#catalogs").jqGrid('inlineNav','#catalogs_pager',inlineCatalogParameters);
      	jQuery("#catalogs").navButtonAdd('#catalogs_pager',
			{
				caption: "Delete",
			  	buttonicon: "ui-icon-del",
			  	position: "last",
			  	onClickButton: function(id) {
            		rowId = jQuery("#catalogs").getGridParam('selrow');
            		if(rowId==null){
						alert("Error, select a catalog to delete");
					}else{
						var rowData = jQuery("#catalogs").getRowData(rowId);
	      				deleteCatalog(rowData);
					}
	        	}
  			});
   	});
}



/**********************************************/
// SHOW REAL CATALOG
/**********************************************/
function showRealCatalog(rowId){
	var rowData = jQuery("#catalogs").getRowData(rowId);
	var id = rowData['id'];
	var catalogName = rowData['name'];
	catalogId = rowId;
	jQuery.post(
		ajaxurl,
 		{
   			action: 'catalogoPlugin_getRealCatalogData',
   			id: id
		},
		function( response ) {
			var obj = jQuery.parseJSON(response);
			colModel = new Array();
 			colName = new Array();
 			/*
 			colModel = [
				{property1:value1, property2:value2...}, ..., {property1:value1, property2:value2...}
 			]
 			*/
 			jQuery.each(obj.object.head, function() {
  				var objModel = {};
  				objModel['name']=this;
  				objModel['editable']=true;
  				if(this=='id'){
  					objModel['editable']=false;
					objModel['key']=true;
  				}
  				colName.push(this);
  				colModel.push(objModel);
			});
			// Add catalogId
			var objModel = {};
			objModel['name']="catalogId";
			objModel['editable']=false;
			colName.push("catalogId");
			colModel.push(objModel);

 			// unload previous data
      		jQuery('#catalogContent').jqGrid('GridUnload');
  			jQuery("#catalogContent").jqGrid({
	      		datatype: "local",
	      		width: 800,
	      		colNames: colName,
	      		colModel: colModel,
	      		//cellEdit: true,
	      		rowNum:10,
				rowList:[10,20,30],
				pager: '#catalogContent_pager',
 				sortname: 'id',
 				sortname: 'id',
  				viewrecords: true,
  				sortorder: "desc",
		    	caption: "Catalog Content",
		    	onSelectRow:function(id){

		    	},
				ondblClickRow: function(rowid,iRow,iCol,e){
				}				
			});
			jQuery("#catalogContent").jqGrid('navGrid','#catalogContent_pager',
      			{
					edit:false,
					add:false,
					del:false
				},
      			{
					beforeShowForm: function(form) {

    				}
				}
			);

			jQuery("#catalogContent").jqGrid('inlineNav','#catalogContent_pager',inlineCatalogContentParameters);
			
			jQuery("#catalogContent").navButtonAdd('#catalogContent_pager',
				{
					caption: "Delete",
					buttonicon: "ui-icon-del",
					position: "last",
					onClickButton: function(id) {
						rowId = jQuery("#catalogContent").getGridParam('selrow');
						// Si rowId no es null ni está vacío
						if(rowId==null){
							alert("Error, select a register to delete");
						}else{
							var rowData = jQuery("#catalogContent").getRowData(rowId);
							deleteCatalogContent(rowData);
						}
					}
				}
			);


			// Load grid
	   		jQuery.each(obj.object.data, function() {
   				mydata = {};
				/*jQuery.each(obj.object.head, function() {
  				mydata[obj.object.head[i]] = this[i];
    			//alert(this);
				});*/
  				for(var i=0;i<colName.length;i++){
  					//alert(obj.object.head[i]);
  					//alert(this[i]);
   					mydata[colName[i]] = this[i];
  				}
				mydata["catalogId"]=catalogId;
  				jQuery("#catalogContent").addRowData(this['id'], mydata);
			});
		}
	);
	
	// Text for help to use
	html = "<h2>Example for publish the catalog</h2>";
	html += "For add the catalog in a post";
	html += "<h3>all columns</h3>";
	html += "[catalogo name='"+catalogName+"'][\/catalogo]";
	html += "<h3>specifics columns<\/h3>";
	html += "[catalogo name='"+catalogName+"' columns='column|column2|...|column'][/catalogo]";
	html += "<h3>title<\/h3>";
	html += "[catalogo name='"+catalogName+"' title='title'][/catalogo]";
	jQuery("#regTitle").html(html);
}


/**********************************************/
// DELETE CATALOG
/**********************************************/
function deleteCatalog(rowData){
	if(rowData!=null && rowData.idType!=0){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_deleteCatalog',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result!=0){
					alert("Error");
				}
				loadCatalogs();
			}
		);
	}else{
		alert("Error, select a type");
	}
}

/**********************************************/
// EDIT CATALOG
/**********************************************/
function editCatalog(rowData){
	if(rowData!=null && rowData.idType!=0){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_editCatalog',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result==-1){
					alert("Error, catalog with this name exist!");
				}
				loadCatalogs();
			}
		);
	}else{
		alert("Error, select a type");
		loadCatalogs();
	}
}

/**********************************************/
// ADD CATALOG
/**********************************************/
function addCatalog(rowData){
	if(rowData!=null && rowData.idType!=0){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_addCatalog',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result==-1){
					alert("Error, catalog with this name exist!");
				}
				loadCatalogs();
			}
		);
	}else{
		alert("Error, select a type");
		loadCatalogs();
	}
}

/**********************************************/
// ADD CATALOG CONTENT
/**********************************************/
function addCatalogContent(rowData){
	if(rowData!=null){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_addCatalogContent',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result!=0){
					alert("Error");
				}
				showRealCatalog(catalogId);
			}
		);
	}else{
		alert("Error");
		showRealCatalog(catalogId);
	}
}

/**********************************************/
// EDIT CATALOG CONTENT
/**********************************************/
function editCatalogContent(rowData){
	if(rowData!=null){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_editCatalogContent',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result!=0){
					alert("Error");
				}
				showRealCatalog(catalogId);
			}
		);
	}else{
		alert("Error");
		showRealCatalog(catalogId);
	}
}

/**********************************************/
// DELETE CATALOG CONTENT
/**********************************************/
function deleteCatalogContent(rowData){
	if(rowData!=null){
		jQuery.post(
			ajaxurl,
			{
				action: 'catalogoPlugin_deleteCatalogContent',
				rowData: rowData
			},
			function( response ) {
				var obj = jQuery.parseJSON(response);
				if(obj.result!=0){
					alert("Error");
				}
				showRealCatalog(catalogId);
			}
		);
	}else{
		alert("Error");
		showRealCatalog(catalogId);
	}
}

/**********************************************/
// START SCRIPT
/**********************************************/	
jQuery(document).ready(function($){
	loadTypes();
	jQuery("#loadCatalogs").click(
		function(){
			loadCatalogs();
		}
	);
});
