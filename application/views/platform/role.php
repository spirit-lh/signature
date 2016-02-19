<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>functiontree</title>
    
	<link type="text/css" href="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/resources/theme-triton-all-debug.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/ext-all-debug.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/locale/locale-zh_CN-debug.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/theme-triton-debug.js"></script>
	
	<style>
		body, html { height: 100%; }
	</style>
	
	<script type="text/javascript">
		Ext.onReady(function () {

			Ext.create("Ext.data.TreeStore", {
				storeId: 'functiontreeStore',
				autoLoad: true,
				proxy: {
					type: "ajax",
					url: "/index.php/Platform/test",
				}
			});

			var mainPanel = Ext.create('Ext.panel.Panel', {
				title: 'Simple Tree',
				layout : 'border',
				width : '100%',
				height : '100%',

				items : [{
						region : 'west',
						xtype : "treepanel",
						width : 250,
						rootVisible: false,
						store: Ext.data.StoreManager.lookup('functiontreeStore'),
						itemId : "tree",
					}, {
						region : 'center',
						itemId : 'panel',
						width : '100%',
						items : [
						],
					}
				],
				renderTo : Ext.getBody(),
			});

		});

	</script>
</head>
<body>

</body>
</html>