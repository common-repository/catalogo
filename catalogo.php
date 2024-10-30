<?php
/*
Plugin Name: cataloGO
Plugin URI: http://hechizo.info/proyectos/catalogo
Description: Plugin for create, manage and publish catalogs
Author: Julio Mateos
Version: 1.0
Author URI: http://www.hechizo.info
License: GPL2
*/



$thisFile = __FILE__;
if (defined('USE_SYMLINKS') and USE_SYMLINKS) {
    $thisFile = basename(dirname(__FILE__) . '\\' . basename(__FILE__));
}


define("CATALOGO_PLUGIN_VERSION", "0.1");
define("CATALOGO_PLUGIN_FILE_URL" , $thisFile);
define("CATALOGO_PLUGIN_URL", plugin_dir_url($thisFile));
define("CATALOGO_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("CATALOGO_PLUGIN_DIRNAME", dirname(__FILE__));


/***********************************/
// SHORTCODES
/***********************************/
add_action('init', 'catalogoPlugin_register_shortcodes');

function catalogoPlugin_register_shortcodes() {
      add_shortcode( 'catalogo', 'catalogoPlugin_showCatalog' );
}

function catalogoPlugin_showCatalog($args, $content) {
	$name = "";
	if(isset($args['name'])){
		$name = $args['name'];
		if(isset($args['columns'])){
			$columns = $args['columns'];	
			$arrayColumns = explode("|",$columns);
		}else{
			$columns = null;
		}
		
		if(isset($args['title'])){
			$title = $args['title'];	
		}else{
			$title = "";
		}
	
		require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
		$catalogOperations = new CatalogoPluginCatalogOperations();
		$catalog=$catalogOperations->getCatalogByName($name);
	
		if($catalog!=null){
			$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
		
			$columnNames=array();
			if($columns==null){
				$columns = $realCatalogOperations->getColumns($catalog);	
				$columnNames=array();
				// add id, this column is present for all catalogs
				$columnsText = "id";
				array_push($columnNames, "id");
				foreach($columns as $column){
					array_push($columnNames, $column->getName());	
				}
			}else{
				$columnNames=$arrayColumns;
			}
			
			$datas = $realCatalogOperations->getRowsData($catalog,$columnNames);
			if(!is_null($datas)){

				//$columnText = "<table id='catalogPostContent'></table><div id='catalogPostContent_pager'></div><table id='prueba'></table><div id='prueba_pager'></div>";
				$columnText = "<table id='catalogPostContent'></table><div id='catalogPostContent_pager'></div><table id='prueba'></table>";
								
				// JQGRID ////////////////////////////////////////////
				wp_register_script( 'jquery.jqGrid.min.js', CATALOGO_PLUGIN_URL.'js/jquery.jqGrid.min.js',  array('jquery'),time(),true);
				wp_enqueue_script( 'jquery.jqGrid.min.js' );

				wp_register_script( 'grid.celledit.js', CATALOGO_PLUGIN_URL.'js/grid.celledit.js',  array('jquery'),time(),true);
				wp_enqueue_script( 'grid.celledit.js' );

				wp_register_script( 'grid.locale-es.js', CATALOGO_PLUGIN_URL.'js/grid.locale-es.js',  array('jquery'),time(),true);
				wp_enqueue_script( 'grid.locale-es.js' );

				wp_register_style( 'jquery-ui.css', CATALOGO_PLUGIN_URL.'/css/jquery-ui.css', array(),'1.0','all' );
				wp_enqueue_style( 'jquery-ui.css' );

				wp_register_style( 'ui.jqgrid.css', CATALOGO_PLUGIN_URL.'/css/ui.jqgrid.css', array(),'1.0','all' );
				wp_enqueue_style( 'ui.jqgrid.css' );	
								
				
				wp_enqueue_script( 'catalogoPlugin_catalogView' );

				$params = array(
				  'catalogName' => $catalog->getName(),
				  'columnNames' => $columnNames,
				  'title' => $title,
				  'ajaxurl' => admin_url('admin-ajax.php')
				);

				wp_localize_script( 'catalogoPlugin_catalogView', 'MyScriptParams', $params );
				
				return $columnText;
			}else{
				return "ERROR";
			}
		}else{
			return "ERROR, invalid catalog name";
		}
	
	}else{
		return "ERROR, name parameter is mandatory";
	}

	
}




/***********************************/
// HOOKS
/***********************************/
register_activation_hook( $thisFile, 'catalogoPlugin_activationHook' );
register_deactivation_hook( $thisFile, 'catalogoPlugin_deactivationHook' );
register_uninstall_hook( $thisFile, 'catalogoPlugin_uninstallHook' );



/***********************************/
// AJAX FUNCTIONS
/***********************************/

/***********************************/
// GETCATALOG
/***********************************/
function catalogoPlugin_getCatalog(){
  	$result['result'] = 2;
	
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$catalogOperations = new CatalogoPluginCatalogOperations();
	$catalogsJson = array();
	$catalogs = $catalogOperations->getAllCatalogs();
	foreach($catalogs as $catalog){
		array_push($catalogsJson, $catalog->getJsonData());
	}

  	$ajaxResult = new CatalogoPluginAjaxResult();
	$ajaxResult->setObject($catalogsJson);
	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;
  	die();
}

/***********************************/
// GETTYPES
/***********************************/
function catalogoPlugin_getTypes(){
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$typeOperations = new CatalogoPluginTypeOperations();
	$typesJson = array();
	$types = $typeOperations->getAllTypes();
	foreach($types as $type){
		array_push($typesJson, $type->getJsonData());
	}
	
	$ajaxResult = new CatalogoPluginAjaxResult();
	$ajaxResult->setObject($typesJson);
	$result=json_encode($ajaxResult->getJsonData());
	echo $result;
  	die();
}

/***********************************/
// GETTYPECOLUMNS
/***********************************/
function catalogoPlugin_getTypeColumns(){
	$id=$_POST['id'];
	
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$ajaxResult = new CatalogoPluginAjaxResult();
	$columnOperations = new CatalogoPluginColumnOperations();

	$columns=$columnOperations->getByIdType($id);

	if($columns ==null){
		$ajaxResult->setResult(-1);
	}else{
		$ajaxResult->setResult(1);
		$columnsJson = array();
		foreach($columns as $column){
			array_push($columnsJson, $column->getJsonData());
		}
		$ajaxResult->setObject($columnsJson);
	}
	$result=json_encode($ajaxResult->getJsonData());
	echo $result;
   	die();
}

/***********************************/
// GETREALCATALOGDATA
/***********************************/
function catalogoPlugin_getRealCatalogData(){
	$id=$_POST['id'];

	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$ajaxResult = new CatalogoPluginAjaxResult();
	$catalogOperations = new CatalogoPluginCatalogOperations();

	$catalog=$catalogOperations->getCatalog($id);

	if($catalog ==null){
		$ajaxResult->setResult(-1);
	}else{
		$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
		$ajaxResult->setResult(1);
		$columns = $realCatalogOperations->getColumns($catalog);
		$columnNames=array();
		// Add id, present for all catalogs
		array_push($columnNames, "id");
		foreach($columns as $column){
			array_push($columnNames, $column->getName());
    	}

		$catalogResult = new CatalogoPluginCatalogResult();
		$catalogResult->setHead($columnNames);
		$catalogResult->setData($realCatalogOperations->getData($catalog));
		$ajaxResult->setObject($catalogResult->getJsonData());
	}
	$result=json_encode($ajaxResult->getJsonData());
	echo $result;
  	die();
}


/***********************************/
// GETPOSTREALCATALOGDATA
/***********************************/
function catalogoPlugin_getPostRealCatalogData(){
	$catalogName=$_POST['catalogName'];
	$columnNames = $_POST['columnNames'];
	
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$ajaxResult = new CatalogoPluginAjaxResult();
	$catalogOperations = new CatalogoPluginCatalogOperations();

	$catalog=$catalogOperations->getCatalogByName($catalogName);

	if($catalog ==null){
		$ajaxResult->setResult(-1);
	}else{
		$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
		$datas = $realCatalogOperations->getRowsData($catalog,$columnNames);
		if(!is_null($datas)){
			$ajaxResult->setResult(1);
			$catalogResult = new CatalogoPluginCatalogResult();
			$catalogResult->setHead($columnNames);
			$catalogResult->setData($datas);
			$ajaxResult->setObject($catalogResult->getJsonData());
		}else{
			$ajaxResult->setResult(-1);
		}
	}
	$result=json_encode($ajaxResult->getJsonData());
	echo $result;
  	die();
}

/***********************************/
// ADD CATALOG
/***********************************/
function catalogoPlugin_addCatalog(){
  	$rowData=$_POST['rowData'];
  
  	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
  	$ajaxResult = new CatalogoPluginAjaxResult();
  	$catalog = new CatalogoPluginCatalog();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  
  	if($catalogOperations->getCatalogByName($rowData['name'])!=null){
		$ajaxResult->setResult(-1);
  	}else{
		$realcatalogOperations = new CatalogoPluginRealCatalogOperations();
	  	$id = $catalogOperations->getLastId() + 1;
	  	$catalogName = $realcatalogOperations->getCatalogName($id);
	  	$catalog->setName(esc_attr($rowData['name']));
	  	$catalog->setDescription(esc_attr($rowData['description']));
	  	$catalog->setTableName($catalogName);
	  	$catalog->setIdType(esc_attr($rowData['idType']));
	  	$catalog->setId($id);
	
	  	$realcatalogOperations->createCatalog2($catalog);
	  	$catalogOperations->insertWithId($catalog); 
	  	$ajaxResult->setResult(0);
	}
 
  	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;

  	die();
}

/***********************************/
// EDIT CATALOG
/***********************************/
function catalogoPlugin_editCatalog(){
  	$rowData=$_POST['rowData'];
  
  	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
  	$ajaxResult = new CatalogoPluginAjaxResult();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  
  	if($catalogOperations->getCatalogByNameForAnotherId($rowData['name'],$rowData['id'])!=null){
	  	$ajaxResult->setResult(-1);
  	}else{
		$catalog = new CatalogoPluginCatalog();
  		$catalog->setId(esc_attr($rowData['id']));
  		$catalog->setName(esc_attr($rowData['name']));
  		$catalog->setDescription(esc_attr($rowData['description']));
  	 	$catalogOperations->edit($catalog);
	 	$ajaxResult->setResult(0);
	}
	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;

  	die();
	
}

/***********************************/
// DELETE CATALOG
/***********************************/
function catalogoPlugin_deleteCatalog(){
  	$rowData=$_POST['rowData'];

  	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
  	$catalog = new CatalogoPluginCatalog();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  	$catalogOperations->delete(esc_attr($rowData['id']));
  	$ajaxResult = new CatalogoPluginAjaxResult();
  	$ajaxResult->setResult(0);
  	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;

  	die();
}

/***********************************/
// ADD CATALOG CONTENT
/***********************************/
function catalogoPlugin_addCatalogContent(){
	$rowData=$_POST['rowData'];
	$catalogId = $rowData['catalogId'];
	
  	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
  	$ajaxResult = new CatalogoPluginAjaxResult();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  	
	$catalog=$catalogOperations->getCatalog($catalogId);
  	if($catalog ==null){
    	$ajaxResult->setResult(-1);
  	}else{
    	$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
    	$realCatalogOperations->add($rowData, $catalog);
 		$ajaxResult->setResult(0);
	}
  	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;
  	die();
}

/***********************************/
// EDIT CATALOG CONTENT
/***********************************/
function catalogoPlugin_editCatalogContent(){
	$rowData=$_POST['rowData'];
	$catalogId = $rowData['catalogId'];
	
  	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	$ajaxResult = new CatalogoPluginAjaxResult();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  	$catalog=$catalogOperations->getCatalog($catalogId);
  	if($catalog ==null){
    	$ajaxResult->setResult(-1);
  	}else{
    	$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
    	$realCatalogOperations->edit($rowData, $catalog);
		$ajaxResult->setResult(0);
	}
  	$result=json_encode($ajaxResult->getJsonData());
  	echo $result;
  	die();
}

/***********************************/
// DELETE CATALOG CONTENT
/***********************************/
function catalogoPlugin_deleteCatalogContent(){
	$rowData=$_POST['rowData'];
	$catalogId = $rowData['catalogId'];	
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
  	$ajaxResult = new CatalogoPluginAjaxResult();
  	$catalogOperations = new CatalogoPluginCatalogOperations();
  
	$catalog=$catalogOperations->getCatalog($catalogId);
  	if($catalog ==null){
    	$ajaxResult->setResult(-1);
  	}else{
    	$realCatalogOperations = new CatalogoPluginRealCatalogOperations();
    	$realCatalogOperations->delete($rowData, $catalog);
		$ajaxResult->setResult(0);
  	}
  	$result=json_encode($ajaxResult->getJsonData());
	  echo $result;
  	die();
 }

/***********************************/
// REGISTER AJAX FUNCTIONS
/***********************************/
add_action( 'wp_ajax_catalogoPlugin_getTypes', 'catalogoPlugin_getTypes' );
add_action( 'wp_ajax_catalogoPlugin_getTypeColumns', 'catalogoPlugin_getTypeColumns' );
add_action( 'wp_ajax_catalogoPlugin_getCatalog', 'catalogoPlugin_getCatalog' );
add_action( 'wp_ajax_catalogoPlugin_getRealCatalogData', 'catalogoPlugin_getRealCatalogData' );
add_action( 'wp_ajax_nopriv_catalogoPlugin_getPostRealCatalogData', 'catalogoPlugin_getPostRealCatalogData' );
add_action( 'wp_ajax_catalogoPlugin_addCatalog', 'catalogoPlugin_addCatalog');
add_action( 'wp_ajax_catalogoPlugin_editCatalog', 'catalogoPlugin_editCatalog');
add_action( 'wp_ajax_catalogoPlugin_deleteCatalog', 'catalogoPlugin_deleteCatalog');
add_action( 'wp_ajax_catalogoPlugin_addCatalogContent', 'catalogoPlugin_addCatalogContent');
add_action( 'wp_ajax_catalogoPlugin_editCatalogContent', 'catalogoPlugin_editCatalogContent');
add_action( 'wp_ajax_catalogoPlugin_deleteCatalogContent', 'catalogoPlugin_deleteCatalogContent');

/***********************************/
// REGISTER CATALOG VIEW
/***********************************/
add_action( 'wp_enqueue_scripts', 'catalogoPlugin_register_catalogView' );
function catalogoPlugin_register_catalogView() {
	wp_register_script( 'catalogoPlugin_catalogView', CATALOGO_PLUGIN_URL.'js/catalogoView.js',  array('jquery'), '1.0.0', true );
}






/***********************************/
// ACTION HOOK
/***********************************/
function catalogoPlugin_activationHook(){
	global $wpdb;
	$catalogdbPrefix = "catalogoplugin_";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	
	$catalogOperations = new CatalogoPluginCatalogOperations();
	if($catalogOperations->checkTable()){
		// Exist the catalog table, then it's possible exist CataloGO structures
	}else{
		
		$catalogData = new CatalogoPluginCatalogData();
		$columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
			
		$columnDefinitionOperations->createTable();
		$columnsDefinitions = $catalogData->getColumnDefinitions();
	
		for ($i=0;$i<count($columnsDefinitions); $i++){
			$columnsDefinitions[$i]=$columnDefinitionOperations->insertGet($columnsDefinitions[$i]);
		}
		
		$columnOperations = new CatalogoPluginColumnOperations();
		$columnOperations->createTable();
		$columns = $catalogData->getColumns($columnsDefinitions);
	
		for ($i=0;$i<count($columns); $i++){
			$columns[$i]=$columnOperations->insertGet($columns[$i]);
		}
		
		$typeOperations = new CatalogoPluginTypeOperations();
		$typeOperations->createTable();
		$types = $catalogData->getTypes();
	
		for ($i=0;$i<count($types); $i++){
			$types[$i]=$typeOperations->insertGet($types[$i]);
		}
		
		$typeColumnsOperations = new CatalogoPluginTypeColumnsOperations();
		$typeColumnsOperations->createTable();
		$typeColumns = $catalogData->getTypeColumns($types,$columns);
	
		for ($i=0;$i<count($typeColumns); $i++){
			$typeColumnsOperations->insert($typeColumns[$i]);
		}
			
		$realcatalogOperations = new CatalogoPluginRealCatalogOperations();
		$catalogOperations->createTable();
		$catalogs = $catalogData->getCatalogs($types);
	
		for ($i=0;$i<count($catalogs); $i++){
			$catalogOperations->insert($catalogs[$i]);
			$realcatalogOperations->createCatalog($catalogs[$i]);
		}	
	}
}

/***********************************/
// DEACTION HOOK
/***********************************/
function catalogoPlugin_deactivationHook() {

}

/***********************************/
// UNINSTALL HOOK
/***********************************/
function catalogoPlugin_uninstallHook(){
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');

	$catalogOperations = new CatalogoPluginCatalogOperations();
	$catalogOperations->dropTable();

	$typeColumnsOperations = new CatalogoPluginTypeColumnsOperations	();
	$typeColumnsOperations->dropTable();

	$columnOperations = new CatalogoPluginColumnOperations();
	$columnOperations->dropTable();

	$typeOperations = new CatalogoPluginTypeOperations();
	$typeOperations->dropTable();

	$columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
	$columnDefinitionOperations->dropTable();
}




/***********************************/
// PLUGIN MENU
/***********************************/
add_action( 'admin_menu', 'catalogoPlugin_registerMyCustomMenuPage' );

function catalogoPlugin_registerMyCustomMenuPage(){
	add_menu_page( 'cataloGO', 'cataloGO', 'manage_options', 'customteam', 'catalogoPlugin_myCustomMenuPage');
}
function catalogoPlugin_myCustomMenuPage() {
    require("catalogo_config.php");
}

?>
