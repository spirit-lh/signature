<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>cuikai</title>
    
	<link type="text/css" href="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/resources/theme-triton-all-debug.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/ext-all-debug.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/locale/locale-zh_CN-debug.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/theme-triton-debug.js"></script>
	
	<style>
		body, html { height: 100%; }
	</style>
	
	<script type="text/javascript">
		Ext.onReady(function () {
			var cm = ([
				{ text: 'Name', dataIndex: 'name' },
				{ text: 'Email', dataIndex: 'email', flex: 1 },
				{ text: 'Phone', dataIndex: 'phone' }
			]);
			
			Ext.create("Ext.data.Store", {
				storeId: 'simpsonsStore',
				autoLoad: true,
				pageSize: 3,
				proxy: {
					type: "ajax",
					url: "<?php echo $baseUrl;?>data/grid.json",
					reader: {
						rootProperty: 'list',
						totalProperty: 'totalCount'
					}
				}
			});
			
			var toolbar = {
					xtype: 'toolbar',
					items: [{
						iconCls: 'x-fa fa-check-square',
						text: '添加',
						scope: this,
						handler: function () {
							Panel.show();
						}
					}, {
						iconCls: 'x-fa fa-remove',
						text: '删除',
						//disabled: true,
						itemId: 'delete',
						scope: this,
						handler: function () {
							//var selModel = grid.getSelectionModel();
							var selected = grid.getSelectionModel().getSelection();
							var Ids = []; //要删除的id
							Ext.each(selected, function (item) {
								Ids.push(item.data.id); //id 对应映射字段
							})
							//alert(Ids);
						}
					}]
			};
			
			

			var pagingtoolbar = {
					xtype: 'pagingtoolbar',
					store: Ext.data.StoreManager.lookup('simpsonsStore'), 
					dock: 'bottom',
					emptyMsg: '没有数据',
					displayInfo: true,
					displayMsg: '当前显示{0}-{1}条记录 / 共{2}条记录 ',
					beforePageText: '第',
					afterPageText: '页/共{0}页',
					items: [
						 '-', {
							 pressed: true,
							 enableToggle: true,
							 text: '预览',
							 cls: 'x-btn-text-icon details',
							 toggleHandler: function(btn, pressed) {
								var records = grid.getSelectionModel();
								console.log('records',records);
								 //var view = grid.getView();
								 //view.showPreview = pressed;
								 //view.refresh();
							 }
					}]
			};

			var grid = Ext.create('Ext.grid.Panel', {
				title: 'GRID',
				selModel: new Ext.selection.CheckboxModel,
				store: Ext.data.StoreManager.lookup('simpsonsStore'),
				columns: cm,
				width: '100%',
				height: '100%',
				dockedItems: [
					pagingtoolbar, 
					toolbar
				],
				renderTo: Ext.getBody()
			});
			
		});

	</script>
</head>
<body>

</body>
</html>