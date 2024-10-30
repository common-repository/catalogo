<?php
// Class for return result with ajax 
Class CatalogoPluginAjaxResult{
    private $result;
    private $text;
    private $object;
    private $object2;

    public function setResult($result){
        $this->result=$result;
    }
    public function getResult(){
        return $this->result;
    }
    public function setText($text){
        $this->text=$text;
    }
    public function getText(){
        return $this->text;
    }
    public function setObject($object){
        $this->object=$object;
    }
    public function getObject(){
        return $this->object;
    }
    public function setObject2($object2){
        $this->object2=$object2;
    }
    public function getObject2(){
        return $this->object2;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

// Class for store data of a catalog
// data is an array with the registers
// head is an array with names of columns
// headtype is an array with types for data of columns
Class CatalogoPluginCatalogResult{
    private $data;
    private $head;
    private $headType;

    public function setData($data){
        $this->data=$data;
    }
    public function getData(){
        return $this->data;
    }
    public function setHead($head){
        $this->head=$head;
    }
    public function getHead(){
        return $this->head;
    }
    public function setHeadType($headType){
        $this->headType=$headType;
    }
    public function getHeadType(){
        return $this->headType;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogoPluginCatalogConstants{
    public static $catalogdbPrefix = "catalogoplugin_";
}


Class CatalogoPluginColumnDefinition{
    private $id;
    private $name;
    private $description;
    private $definition;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }

    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDefinition($definition){
        $this->definition=$definition;
    }
    public function getDefinition(){
        return $this->definition;
    }
     function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogoPluginColumn{
    private $id;
    private $name;
    private $description;
    private $idColumnDefinition;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setIdColumnDefinition($idColumnDefinition){
        $this->idColumnDefinition=$idColumnDefinition;
    }
    public function getIdColumnDefinition(){
        return $this->idColumnDefinition;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogoPluginType{
    private $id;
    private $name;
    private $description;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogoPluginTypeColumns{
    private $idType;
    private $idColumn;

    public function setIdType($idType){
        $this->idType=$idType;
    }
    public function getIdType(){
        return $this->idType;
    }
    public function setIdColumn($idColumn){
        $this->idColumn=$idColumn;
    }
    public function getIdColumn(){
        return $this->idColumn;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogoPluginCatalog{
    private $id;
    private $name;
    private $description;
    private $tableName;
    private $idType;
    private $typeName;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setdescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setTableName($tableName){
        $this->tableName=$tableName;
    }
    public function getTableName(){
        return $this->tableName;
    }
    public function setIdType($idType){
        $this->idType=$idType;
    }
    public function getIdType(){
        return $this->idType;
    }
    public function setNameType($nameType){
        $this->nameType=$nameType;
    }
    public function getNameType(){
        return $this->nameType;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}



Class CatalogoPluginOperations{


}


Class CatalogoPluginColumnDefinitionOperations extends CatalogoPluginOperations{

    private static $tableName = null; 
    private $subixTableName = "column_definition"; 

    public function insert($columnDefinition){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, definition) values('".$columnDefinition->getName()."', '".$columnDefinition->getDescription()."','".$columnDefinition->getDefinition()."')";
        $wpdb->query($sql);
    }

    public function insertGet($columnDefinition){
        $this->insert($columnDefinition);
        return $this->getByName($columnDefinition->getName());
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $columnDefinition = new CatalogoPluginColumnDefinition();
            $columnDefinition->setId($result[0]->id);
            $columnDefinition->setName($result[0]->name);
            $columnDefinition->setDescription($result[0]->description);
            $columnDefinition->setDefinition($result[0]->definition);
            return $columnDefinition;
        }else{
            return null;
        }
    }

    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $columnDefinition = new CatalogoPluginColumnDefinition();
            $columnDefinition->setId($result[0]->id);
            $columnDefinition->setName($result[0]->name);
            $columnDefinition->setDescription($result[0]->description);
            $columnDefinition->setDefinition($result[0]->definition);
            return $columnDefinition;
        }else{
            return null;
        }
    }

    public function createTable(){
        global $wpdb;
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140),
                definition char(255) NOT NULL,
                PRIMARY KEY ( `id` ),
                KEY (`name`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }

	public function getIdFromName($columnsDefinitions,$name){
        foreach($columnsDefinitions as $columnsDefinition){
            if($columnsDefinition->getName()==$name){
                return $columnsDefinition->getId();
            }
        }
        return -1;
    }
	
}



Class CatalogoPluginColumnOperations{

    private static $tableName = null; 
    private $subixTableName = "column"; 

    public function insert($column){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, id_column_definition) values('".$column->getName()."', '".$column->getDescription()."',".$column->getIdColumnDefinition().")";
        $wpdb->query($sql);
    }

    public function insertGet($column){
        $this->insert($column);
        return $this->getByName($column->getName());
    }

    public function getByIdType($id){
        global $wpdb;
        $typeColumnsOperations = new CatalogoPluginTypeColumnsOperations();
        $typeColumnsTable = $typeColumnsOperations->getTableName();
        $sql="select * from ".$this->getTableName()." c,".$typeColumnsTable." ct where ct.id_type='".$id."' and ct.id_column=c.id";
        $result = $wpdb->get_results( $sql );
        if($result){
            $columns = array();
            foreach ($result as $row ){
                $column = new CatalogoPluginColumn();
                $column->setId($row->id);
                $column->setName($row->name);
                $column->setDescription($row->description);
                $column->setIdColumnDefinition($row->id_column_definition);
                array_push($columns, $column);
            }
            return $columns;
        }else{
            return null;
        }
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $column = new CatalogoPluginColumn();
            $column->setId($result[0]->id);
            $column->setName($result[0]->name);
            $column->setDescription($result[0]->description);
            $column->setIdColumnDefinition($result[0]->id_column_definition);
            return $column;
        }else{
            return null;
        }
    }

    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $column = new CatalogoPluginColumn();
            $column->setId($result[0]->id);
            $column->setName($result[0]->name);
            $column->setDescription($result[0]->description);
            $column->setIdColumnDefinition($result[0]->id_column_definition);
            return $column;
        }else{
            return null;
        }
    }

    public function createTable(){
        global $wpdb;
        $columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
        $tableColumnDefinition=$columnDefinitionOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(32) NOT NULL ,
                description char(128) ,
                id_column_definition int NOT NULL,
                PRIMARY KEY ( `id`  ),
                FOREIGN KEY (`id_column_definition`) REFERENCES ".$tableColumnDefinition."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getIdFromName($columns,$name){
        foreach($columns as $column){
            if($column->getName()==$name){
                return $column->getId();
            }
        }
        return -1;
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}



Class CatalogoPluginTypeOperations{

    private static $tableName = null; 
    private $subixTableName = "type"; 

    public function insert($type){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description) values('".$type->getName()."', '".$type->getDescription()."')";
        $wpdb->query($sql);
    }

    public function insertGet($type){
        $this->insert($type);
        return $this->getByName($type->getName());
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $type = new CatalogoPluginType();
            $type->setId($result[0]->id);
            $type->setName($result[0]->name);
            $type->setDescription($result[0]->description);
            return $type;
        }else{
            return null;
        }
    }

    public function getAllTypes(){
        global $wpdb;
        $types = array();
        $sql="select * from ".$this->getTableName();
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $type = new CatalogoPluginType();
            $type->setId($row->id);
            $type->setName($row->name);
            $type->setDescription($row->description);
            array_push($types, $type);
        }
        return $types;
    }

    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $type = new CatalogoPluginType();
            $type->setId($result[0]->id);
            $type->setName($result[0]->name);
            $type->setDescription($result[0]->description);
            return $type;
        }else{
            return null;
        }
    }

    public function createTable(){
        global $wpdb;
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140),
                PRIMARY KEY ( `id` ),
                UNIQUE KEY (`name`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getIdFromName($types,$name){
        foreach($types as $type){
            if($type->getName()==$name){
                return $type->getId();
            }
        }
        return -1;
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }


}


Class CatalogoPluginTypeColumnsOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "type_columns"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto

    public function insert($columnType){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(id_type, id_column) values(".$columnType->getIdType().", ".$columnType->getIdColumn().")";
        $wpdb->query($sql);
    }


	public function createTable(){
        global $wpdb;
        $columnOperations = new CatalogoPluginColumnOperations();
        $tableColumn=$columnOperations->getTableName();
        $typeOperations = new CatalogoPluginTypeOperations();
        $tableType=$typeOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id_type int(11) NOT NULL,
                id_column int(11) NOT NULL,
                PRIMARY KEY ( `id_type`, `id_column` ),
                FOREIGN KEY (`id_type`) REFERENCES ".$tableType."(`id`),
                FOREIGN KEY (`id_column`) REFERENCES ".$tableColumn."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getIdFromName($types,$name){
        foreach($types as $type){
            if($type->getName()==$name){
                return $type->getId();
            }
        }
        return -1;
    }


    public function getByIdType($idType){
        $columnsType = array();
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id_type='".$idType."'";
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $columnType = new CatalogoPluginTypeColumns();
            $columnType->setIdType($row->id_type);
            $columnType->setIdColumn($row->id_column);
            array_push($columnsType, $columnType);
        }
        return $columnsType;
    }


    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}

Class CatalogoPluginCatalogOperations{

    private static $tableName = null; 
    private $subixTableName = "catalog"; 

    public function insert($catalog){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, table_name, id_type) values('".$catalog->getName()."', '".$catalog->getDescription()."','".$catalog->getTableName()."',".$catalog->getIdType().")";
        $wpdb->query($sql);
    }

    public function insertWithId($catalog){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(id, name, description, table_name, id_type) values(".$catalog->getId().", '".$catalog->getName()."', '".$catalog->getDescription()."','".$catalog->getTableName()."',".$catalog->getIdType().")";
        $wpdb->query($sql);
    }

    public function edit($catalog){
        global $wpdb;
        $sql="update ".$this->getTableName()." set name='".$catalog->getName()."', description='".$catalog->getDescription()."' where id=".$catalog->getId();
        $wpdb->query($sql);
    }

    public function delete($id){
        global $wpdb;
        $sql="delete from ".$this->getTableName()." where id=".$id;
        $wpdb->query($sql);
    }


    public function dropTable(){
        global $wpdb;
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getLastId(){
      global $wpdb;
      $sql="select id from ".$this->getTableName()." order by id desc limit 1";
      $result = $wpdb->get_results( $sql );
      foreach ($result as $row ){
        $lastId = $row->id;
      }
      return $lastId;
    }

    public function getAllCatalogs(){
        global $wpdb;
        $typeOperations = new CatalogoPluginTypeOperations();
        $tableType=$typeOperations->getTableName();
        $catalogs = array();
        $sql="select a.id, a.name, a.description, a.table_name, a.id_type, b.name name_type from ".$this->getTableName()." a,$tableType b where a.id_type=b.id";
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $catalog = new CatalogoPluginCatalog();
            $catalog->setId($row->id);
            $catalog->setName($row->name);
            $catalog->setDescription($row->description);
            $catalog->setTableName($row->table_name);
            $catalog->setIdType($row->id_type);
            $catalog->setNameType($row->name_type);
            array_push($catalogs, $catalog);
        }
        return $catalogs;
    }

    public function getCatalog($id){
        global $wpdb;
        $catalogs = array();
        $sql="select * from ".$this->getTableName()." where id=".$id;
        $result = $wpdb->get_results( $sql );
        if($result){
            $catalog = new CatalogoPluginCatalog();
            $catalog->setId($result[0]->id);
            $catalog->setName($result[0]->name);
            $catalog->setDescription($result[0]->description);
            $catalog->setTableName($result[0]->table_name);
            $catalog->setIdType($result[0]->id_type);
            return $catalog;
        }else{
            return null;
        }
    }
	
	
	public function getCatalogByName($name){
        global $wpdb;
        $catalogs = array();
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $catalog = new CatalogoPluginCatalog();
            $catalog->setId($result[0]->id);
            $catalog->setName($result[0]->name);
            $catalog->setDescription($result[0]->description);
            $catalog->setTableName($result[0]->table_name);
            $catalog->setIdType($result[0]->id_type);
            return $catalog;
        }else{
            return null;
        }

    }
	
	public function getCatalogByNameForAnotherId($name,$id){
        global $wpdb;
        $catalogs = array();
        $sql="select * from ".$this->getTableName()." where name='".$name."' and id<>'".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $catalog = new CatalogoPluginCatalog();
            $catalog->setId($result[0]->id);
            $catalog->setName($result[0]->name);
            $catalog->setDescription($result[0]->description);
            $catalog->setTableName($result[0]->table_name);
            $catalog->setIdType($result[0]->id_type);
            return $catalog;
        }else{
            return null;
        }

    }
	
    public function createTable(){
        global $wpdb;
        $typeOperations = new CatalogoPluginTypeOperations();
        $tableType=$typeOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140),
                table_name char(64) NOT NULL,
                id_type int NOT NULL,
                PRIMARY KEY ( `id` ),
                UNIQUE KEY ( `name` ),
                KEY ( `table_name` ),
                FOREIGN KEY (`id_type`) REFERENCES ".$tableType."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
	
	public function checkTable(){
		global $wpdb;
		if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'")!=$this->getTableName()){
			return false;
		}else{
			return true;
		}
		
	}
}



Class CatalogoPluginRealCatalogOperations{

    private static $tableName = null;
    private $subixTableName = "real_catalog";

    public function createCatalog($catalog){
        $tableName = $catalog->getTableName();
        $idType=$catalog->getIdType();
        $query = "CREATE TABLE ".$tableName."(
            id int(11) NOT NULL AUTO_INCREMENT";
			
        $columnTypeOperations = new CatalogoPluginTypeColumnsOperations();

        $columnsType = $columnTypeOperations->getByIdType($idType);

        $columnOperations = new CatalogoPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }

        $columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
        foreach($columns as $column){
            $columnDefinition=$columnDefinitionOperations->getById($column->getIdColumnDefinition());
            $query = $query .", ".$column->getName()." ".$columnDefinition->getDefinition();
        }
        $query = $query.",PRIMARY KEY ( `id` ));";
        global $wpdb;
        dbDelta($query);
    }

    public function createCatalog2($catalog){
        $tableName = $catalog->getTableName();
        $idType=$catalog->getIdType();
        $query = "CREATE TABLE ".$tableName."(
            id int(11) NOT NULL AUTO_INCREMENT";
			
        $columnTypeOperations = new CatalogoPluginTypeColumnsOperations();

        $columnsType = $columnTypeOperations->getByIdType($idType);

        $columnOperations = new CatalogoPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }

        $columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
        foreach($columns as $column){
            $columnDefinition=$columnDefinitionOperations->getById($column->getIdColumnDefinition());
            $query = $query .", ".$column->getName()." ".$columnDefinition->getDefinition();
        }
        $query = $query.",PRIMARY KEY ( `id` ));";
        global $wpdb;
        $wpdb->query($query);
    }

    public function getCatalogName($id){
      $tableName = $this->getTableName();
      $tableName = $tableName."".$id;
      return $tableName;
    }

    public function getColumns($catalog){
        $tableName = $catalog->getTableName();
        $idType=$catalog->getIdType();


        $columnTypeOperations = new CatalogoPluginTypeColumnsOperations();

        $columnsType = $columnTypeOperations->getByIdType($idType);

        $columnOperations = new CatalogoPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }

        return $columns;
    }


    public function add($row, $catalog){
      $columns = $this->getColumns($catalog);
      $columnNames=array();
      array_push($columnNames, "id");
      $sql = "insert into ".$catalog->getTableName();
      $first = true;
      foreach($columns as $column){
        if($first){
          $sql=$sql."(".($column->getName());
          $values="'".esc_attr($row[$column->getName()])."'";
          $first=false;
        }else{
          $sql=$sql.",".($column->getName());
          $values=$values.",'".esc_attr($row[$column->getName()])."'";
        }
      }
	  
      if(!$first){
        $sql=$sql.") values(".$values.")";
        global $wpdb;
        $wpdb->query($sql);
      }
    }

    public function edit($row, $catalog){
      $columns = $this->getColumns($catalog);
      $columnNames=array();
      array_push($columnNames, "id");
      $sql = "update ".$catalog->getTableName()." set ";
      $first = true;
      foreach($columns as $column){
        if($first){
          $sql=$sql."".($column->getName())."='".esc_attr($row[$column->getName()])."'";
          $first=false;
        }else{
          $sql=$sql.",".($column->getName())."='".esc_attr($row[$column->getName()])."'";
        }

      }


      if(!$first){
        $sql=$sql." where id=".$row['id'];
        global $wpdb;
        $wpdb->query($sql);
      }
    }

    public function delete($row, $catalog){
      $sql="delete from ".$catalog->getTableName()." where id=".esc_attr($row['id']);
      global $wpdb;
      $wpdb->query($sql);
    }



    public function getData($catalog){
		
        $columns=array();

        $columns = $this->getColumns($catalog);
        // Se añade el id al principio del array que contiene los nombres de las columnas
        $data = array();
        global $wpdb;
        $sql="select * from ".$catalog->getTableName();
		try{
	        $result = $wpdb->get_results( $sql );
	        foreach ($result as $row ){
	            $rowArray = array();
				array_push($rowArray, $row->id);
	            foreach($columns as $column){
					array_push($rowArray, $row->{$column->getName()});
	            }
	           array_push($data, $rowArray);
	        }
	        return $data;
		} catch (Exception $e) { 
			return null; 
		} 
    }
	

    public function getRowsData($catalog, $columns){
		       
        $data = array();
        global $wpdb;
        $sql="select ";
		$firstColumn=true;
		foreach($columns as $column){
			if($firstColumn){
				$sql=$sql.$column;	
				$firstColumn=false;
			}else{
				$sql=$sql.",".$column;	
			}

		}
		$sql=$sql." from ".$catalog->getTableName();

        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $rowArray = array();
			foreach($columns as $column){
                array_push($rowArray, $row->{$column});
            }
           array_push($data, $rowArray);
        }
        return $data;
    }


    public function getCatalogForm($catalog){
    	$idType=$catalog->getIdType();
    	$columnTypeOperations = new CatalogoPluginTypeColumnsOperations();
        $columnsType = $columnTypeOperations->getByIdType($idType);
        $columnOperations = new CatalogoPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }
        $columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
        $columnDefinitions= array();
        foreach($columns as $column){
            $columnDefinition=$columnDefinitionOperations->getById($column->getIdColumnDefinition());
            array_push($columnDefinitions, $columnDefinition);
        }
        $form="";
        $form+="<form name='' action=''>";
        $form+="</form>";
        return $form;
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
	
	

}



Class CatalogoPluginCatalogData{

    public function getColumnDefinitions(){
        $columnDefinitions = array();
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("ref");
        $columnDefinition->setDescription("reference[4]");
        $columnDefinition->setDefinition("varchar(4) NOT NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("label");
        $columnDefinition->setDescription("label[50]");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("autor");
        $columnDefinition->setDescription("autor[50]");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("title");
        $columnDefinition->setDescription("title[50]");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("comment");
        $columnDefinition->setDescription("comment[255]");
        $columnDefinition->setDefinition("varchar(255) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogoPluginColumnDefinition();
        $columnDefinition->setName("storage");
        $columnDefinition->setDescription("storage[2]");
        $columnDefinition->setDefinition("varchar(2) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        return $columnDefinitions;
    }


    public function getColumns($columnDefinitions){
        $columnDefinitionOperations = new CatalogoPluginColumnDefinitionOperations();
        $columns = array();
        $column = new CatalogoPluginColumn();
        $column->setName("ref");
        $column->setDescription("reference[4] NOT NULL");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"ref"));
        array_push($columns, $column);
        $column = new CatalogoPluginColumn();
        $column->setName("label");
        $column->setDescription("label[50]");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"label"));
        array_push($columns, $column);
        $column = new CatalogoPluginColumn();
        $column->setName("autor");
        $column->setDescription("autor[50]");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"autor"));
        array_push($columns, $column);
        $column = new CatalogoPluginColumn();
        $column->setName("title");
        $column->setDescription("title[50]");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"title"));
        array_push($columns, $column);
        $column = new CatalogoPluginColumn();
        $column->setName("comment");
        $column->setDescription("comment[255]");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"comment"));
        array_push($columns, $column);
        $column = new CatalogoPluginColumn();
        $column->setName("storage");
        $column->setDescription("id of storage[2]");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"storage"));
        array_push($columns, $column);
        return $columns;
    }

    public function getTypes(){
        $types = array();
        $type = new CatalogoPluginType();
        $type->setName("general catalog");
        $type->setDescription("test catalog");
        array_push($types, $type);
        return $types;
    }

    public function getTypeColumns($types,$columns){
        $columnOperations = new CatalogoPluginColumnOperations();
        $typeOperations = new CatalogoPluginTypeOperations();
        $typeColumns = array();
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"ref"));
        array_push($typeColumns, $typeColumn);
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"label"));
        array_push($typeColumns, $typeColumn);
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"autor"));
        array_push($typeColumns, $typeColumn);
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"title"));
        array_push($typeColumns, $typeColumn);
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"comment"));
        array_push($typeColumns, $typeColumn);
        $typeColumn = new CatalogoPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"general catalog"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"storage"));
        array_push($typeColumns, $typeColumn);
        return $typeColumns;
    }


    public function getCatalogs($types){
        $typeOperations = new CatalogoPluginTypeOperations();
        global $wpdb;
        $tablePrefix = $wpdb->prefix . CatalogoPluginCatalogConstants::$catalogdbPrefix;
        $catalogs = array();
        //$catalog = new CatalogoPluginCatalog();
        //$catalog->setName("referencia");
        //$catalog->setDescription("descripcion del campo");
        //$catalog->setTableName($tablePrefix."prueba_tabla");
        //$catalog->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        //array_push($catalogs, $catalog);
        return $catalogs;
    }
}


?>
