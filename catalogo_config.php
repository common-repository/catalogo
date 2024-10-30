<h1>CataloGO Admin</h1>
<?php
wp_register_script( 'catalogo.js', CATALOGO_PLUGIN_URL.'js/catalogo.js',  array('jquery'),time(),true);
wp_enqueue_script( 'catalogo.js' );

wp_register_style( 'catalogo.css', CATALOGO_PLUGIN_URL.'/css/catalogo.css', array(),'1.0','all' );
wp_enqueue_style( 'catalogo.css' );
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
//////////////////////////////////////////////////////
require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
?>




<input id="loadCatalogs" name="loadCatalogs" style="background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;" type="button" value="Load Catalogs">

<div class="clear"></div>

<div class="clear"></div>


<h2>Catalogs List</h2>

<table width="100%">
  <tr>
    <td>
      <table id="types"></table>
      <div id="types_pager"></div>
    </td>
    <td>
      <table id="type_columns"></table>
      <div id="type_colums_pager"></div>
    </td>
  </tr>
</table>
<br/>

<table id="catalogs"></table>
<div id="catalogs_pager"></div>
<br/>

<table id="catalogContent"></table>
<div id="catalogContent_pager"></div>
<br/>

<div id="regTitle"></div>
