<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>SYSTEM</title>
    	
	<link type="text/css" href="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/resources/theme-triton-all-debug.css" rel="stylesheet"/>
	<link type="text/css" href="<?php echo $baseUrl;?>resources/css/main.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/ext-all-debug.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/locale/locale-zh_CN-debug.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl;?>resources/js/ext/classic/theme-triton/theme-triton-debug.js"></script>

	
	
	<script>
		Ext.onReady(function () {
			var curNodeid = -1;

			Ext.EventManager.onWindowResize(function(width,height){
				//window.location.reload();
			});

			var treeListStores = Ext.create("Ext.data.TreeStore", {
				autoLoad: true,
				proxy: {
					type: "ajax",
					url: "/index.php/platform/RoleController/getRoleTree",
				}
			});

			treeListStores.addListener('load', function(st, rds, opts) {
				console.clear();
				console.log(1, st);
				console.log(2, rds);
				console.log(3, opts);
				//console.log(4, rds[0]);

				if(rds && rds[0]){
					var treelist = Ext.getCmp('treelist');
					treelist.setSelection(rds[0]);
					curNodeid = rds[0].data.id
				}
			});

			/*var treeListStores={navItems:{type:'tree',root:{expanded:true,children:[{id:'0',text:'首页',iconCls:'x-fa fa-home',leaf:true},{id:'1',text:'功能1',iconCls:'x-fa fa-user',children:[{id:'1-1',text:'功能1.1',iconCls:'x-fa fa-tag',nodeValue:'xx',leaf:true},{id:'1-2',text:'功能1.2',iconCls:'x-fa fa-trash',leaf:true}]},{id:'2',text:'功能2',iconCls:'x-fa fa-group',leaf:true},{id:'3',text:'功能3',iconCls:'x-fa fa-wrench',children:[{id:'3-1',text:'功能3.1',iconCls:'x-fa fa-share-alt',leaf:true},{id:'3-2',text:'功能3.2',iconCls:'x-fa fa-flag',leaf:true},{id:'3-3',text:'功能3.3',iconCls:'x-fa fa-signal',leaf:true}]}]}}};*/

			var toolbar_logout = Ext.create('Ext.button.Button', {
				id: 'cc',
				cls : "delete-focus-bg",
				iconCls : "x-fa fa-user",
			    scope   : this,
			    handler : function(e) {
			       	// console.log('e', e);
			        window.location.href = '<?php echo $baseUrl;?>index.php/platform/LoginController/logout';
			    }
			});

			var treelist = Ext.create('Ext.list.Tree', {
				id : 'treelist',
				scrollable : 'y',
				expanderFirst : false,
				expanderOnly : false,
				region : 'west',
				width : 250,
				//split: true,
				border : false,
				store : treeListStores
			});

			var mainPanel = Ext.create('Ext.panel.Panel', {
				layout : 'border',
				width : '100%',
				height : '100%',
				items : [{
						region : 'north',
						xtype : "toolbar",
						cls : "sencha-dash-dash-headerbar toolbar-btn-shadow",
						height : 64,
						itemId : "headerBar",
						items : [{
								xtype : "component",
								reference : "senchaLogo",
								cls : "sencha-logo",
								html : '<div class="main-logo">Sencha</div>',
								width : 250
							},{
								margin : "0 0 0 8",
								cls : "delete-focus-bg",
								iconCls : "x-fa fa-navicon",
								id : "main-navigation-btn"
							}, {
								xtype : "tbspacer",
								flex : 1
							}, {
								cls : "delete-focus-bg",
								iconCls : "x-fa fa-search",
								href : "#search",
								hrefTarget : "_self",
								tooltip : "See latest search"
							}, {
								cls : "delete-focus-bg",
								iconCls : "x-fa fa-envelope",
								href : "#email",
								hrefTarget : "_self",
								tooltip : "Check your email"
							}, {
								cls : "delete-focus-bg",
								iconCls : "x-fa fa-bell"
							}, {
								cls : "delete-focus-bg",
								iconCls : "x-fa fa-th-large",
								href : "#profile",
								hrefTarget : "_self",
								tooltip : "See your profile"
							},
							toolbar_logout, 
							{
								xtype : "tbtext",
								text : "王菲",
								cls : "top-user-name"
							}, {
								xtype : "image",
								cls : "header-right-profile-image",
								height : 35,
								width : 35,
								alt : "current user image",
								src : "<?php echo $baseUrl;?>resources/images/4.png"
							}
						]
					}, {
						region : 'center',
						width : '100%',
						layout : 'border',
						items : [{
								id : 'treePanel',
								region : 'west',
								width : 250,
								//split: true,
								border : false,
								scrollable : 'y',
								items : [treelist],
								listeners:{
									afterrender: function(){
										//alert(1);
									}
								}
							}, {
								id : 'content',
								region : 'center',
								bodyPadding : 5,
								html : '<iframe id="frame1" src="<?php echo $baseUrl;?>index.php/Platform/grid" frameborder="0" width="100%" height="100%"></iframe>'
							}
						],
						listeners : {
							click : {
								element : 'el',
								fn : function (e, w) {
									//console.log(e,w );
									var treelist = Ext.getCmp('treelist');
									var selData = treelist.getSelection().data;
									var iframe = Ext.getDom(frame1);
									console.clear();
									console.log(treelist.getSelection().data);
									if(curNodeid != selData.id && selData.leaf != false){
										curNodeid = selData.id;
										iframe.src = '<?php echo $baseUrl;?>index.php/Platform/functiontree';
									}

									//Ext.getCmp('content').resumeLayouts();

									
									//Ext.resumeLayouts();								
									//console.log(Ext.getDom(frame1));
									//console.log(iframe);
									//console.clear();
									//console.log(e,w);
									//console.log(e.target.id);
									//console.log(e.target.nodeName);

								}
							}
						}
					}
				],
				renderTo : Ext.getBody(),
			});
			
			var treelist = Ext.getCmp('treelist'),
			ct = Ext.getCmp('treePanel');
			treelist.setExpanderFirst(false);
			treelist.setUi('nav');
			treelist.setHighlightPath(true);
			ct['addCls']('treelist-with-nav');
			
		});
	</script>
	
	
	
</head>
<body>

</body>
</html>