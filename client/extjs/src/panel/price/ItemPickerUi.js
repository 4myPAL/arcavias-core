/*!
 * Copyright (c) Metaways Infosystems GmbH, 2011
 * LGPLv3, http://www.arcavias.com/en/license
 */


Ext.ns('MShop.panel.price');

MShop.panel.price.ItemPickerUi = Ext.extend( MShop.panel.AbstractListItemPickerUi, {

	title : _('Price'),

	initComponent : function() {

		Ext.apply(this.itemConfig, {
			title : _('Associated Prices'),
			xtype : 'MShop.panel.listitemlistui',
			domain : 'price',
			getAdditionalColumns : this.getAdditionalColumns.createDelegate(this)
		});

		Ext.apply(this.listConfig, {
			title : _('Available Prices'),
			xtype : 'MShop.panel.price.listuismall'
		});

		MShop.panel.price.ItemPickerUi.superclass.initComponent.call(this);
	},

	getAdditionalColumns : function() {

		var conf = this.itemConfig;
		this.typeStore = MShop.GlobalStoreMgr.get('Price_Type', conf.domain);
		this.listTypeStore = MShop.GlobalStoreMgr.get(conf.listTypeControllerName, conf.domain);

		return [
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'typeid',
				header : _('List type'),
				id : 'listtype',
				width : 70,
				renderer : this.typeColumnRenderer.createDelegate(this, [ this.listTypeStore, conf.listTypeLabelProperty ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Status'),
				id : 'refstatus',
				width : 50,
				align: 'center',
				renderer : this.refStatusColumnRenderer.createDelegate(this, [ 'price.status' ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Type'),
				id : 'reftype',
				width : 70,
				renderer : this.refTypeColumnRenderer.createDelegate(this, [ this.typeStore, 'price.typeid', 'price.type.label' ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Label'),
				id : 'reflabel',
				width : 100,
				hidden : true,
				renderer : this.refColumnRenderer.createDelegate(this, [ "price.label" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Currency'),
				id : 'refcurrency',
				width : 50,
				renderer : this.refColumnRenderer.createDelegate(this, [ "price.currencyid" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Quantity'),
				id : 'refquantiy',
				width : 70,
				align : 'right',
				renderer : this.refColumnRenderer.createDelegate(this, [ "price.quantity" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Price'),
				id : 'refcontent',
				align : 'right',
				renderer : this.refDecimalColumnRenderer.createDelegate(this, [ "price.value" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Rebate'),
				id : 'refrebate',
				width : 70,
				align : 'right',
				hidden : true,
				renderer : this.refDecimalColumnRenderer.createDelegate(this, [ "price.rebate" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Costs'),
				sortable : false,
				id : 'refshipping',
				width : 70,
				align : 'right',
				hidden : true,
				renderer : this.refDecimalColumnRenderer.createDelegate(this, [ "price.costs" ], true)
			},
			{
				xtype : 'gridcolumn',
				dataIndex : conf.listNamePrefix + 'refid',
				header : _('Tax rate'),
				sortable : false,
				id : 'reftaxrate',
				width : 70,
				align : 'right',
				hidden : !MShop.Config.get( 'client/extjs/panel/price/itempickerui/taxrate', 
				MShop.Config.get('client/extjs/panel/price/taxrate', false ) ),
				renderer : this.refDecimalColumnRenderer.createDelegate(this, [ "price.taxrate" ], true)
			}
		];
	}
});

Ext.reg('MShop.panel.price.itempickerui', MShop.panel.price.ItemPickerUi);
