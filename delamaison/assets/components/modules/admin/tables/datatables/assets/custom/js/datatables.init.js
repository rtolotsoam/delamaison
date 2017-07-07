(function($, window)
{

	$(window).on('load', function()
	{
		function fnInitCompleteCallback(that)
		{
			var p = that.parents('.dataTables_wrapper').first();
	    	var l = p.find('.row').find('label');

	    	l.each(function(index, el) {
	    		var iw = $("<div>").addClass('col-md-8').appendTo($(el).parent());
	    		$(el).parent().addClass('form-group margin-none').parent().addClass('form-horizontal');
	            $(el).find('input, select').addClass('form-control').removeAttr('size').appendTo(iw);
	            $(el).addClass('col-md-4 control-label');
	    	});

	    	var s = p.find('select');
	    	s.addClass('.selectpicker').selectpicker();
		}

		/* DataTables */
		if ($('.dynamicTable').size() > 0)
		{
			$('.dynamicTable').each(function()
			{
				// DataTables with TableTools
				if ($(this).is('.tableTools'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-5'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Afficher"
						},
						"oTableTools": {
							"sSwfPath": componentsPath + "modules/admin/tables/datatables/assets/lib/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
					    },
					    "aoColumnDefs": [
				          { 'bSortable': false, 'aTargets': [ 0 ] }
				       	],
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
					    "fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				// colVis extras initialization
				else if ($(this).is('.colVis'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-6'C>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Nb entrées"
						},
						"oColVis": {
							"buttonText": "Afficher / Masquer les colonnes",
							"sAlign": "right"
						},
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
						"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				else if ($(this).is('.scrollVertical'))
				{
					$(this).dataTable({
						"bPaginate": false,
						"sScrollY": "200px",
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"sDom": "<'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
				else if ($(this).is('.ajax'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"bProcessing": true,
						"bServerSide": true,
						"sAjaxSource": rootPath + 'front/accueil/datatable',
				       	"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-3'C><'col-md-3 export'>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Nb entrées"
						},
						"oColVis": {
							"buttonText": "Afficher / Masquer les colonnes",
							"sAlign": "right"
						},
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        },
				        "fnServerData": function(sSource, aoData, fnCallback)
			            {
			              $.ajax
			              ({
				                'dataType': 'json',
				                'type'    : 'POST',
				                'url'     : sSource,
				                'data'    : aoData,
				                'success' : fnCallback
			              });
			            }
					});

					$("div.export").html('<a style="margin-left: 150px;" href="#modal-compose" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw icon-document-blank-fill"></i> Export</a>');
				}
				else if ($(this).is('.ajax2'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"bProcessing": true,
						"bServerSide": true,
						"sAjaxSource": rootPath + 'front/accueil/datatableUser',
				       	"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-6'C>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Nb entrées"
						},
						"oColVis": {
							"buttonText": "Afficher / Masquer les colonnes",
							"sAlign": "right"
						},
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        },
				        "fnServerData": function(sSource, aoData, fnCallback)
			            {
			              $.ajax
			              ({
				                'dataType': 'json',
				                'type'    : 'POST',
				                'url'     : sSource,
				                'data'    : aoData,
				                'success' : fnCallback
			              });
			            }
					});

				}
				else if ($(this).is('.ajax3'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"bProcessing": true,
						"bServerSide": true,
						"sAjaxSource": rootPath + 'front/accueil/datatableAdmin',
				       	// "sDom": "<'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-6'C>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Nb entrées"
						},
						"oColVis": {
							"buttonText": "Afficher / Masquer les colonnes",
							"sAlign": "right"
						},
				       	"sScrollX": "100%",
				       	"sScrollY": "350px",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        },
				        "fnServerData": function(sSource, aoData, fnCallback)
			            {
			              $.ajax
			              ({
				                'dataType': 'json',
				                'type'    : 'POST',
				                'url'     : sSource,
				                'data'    : aoData,
				                'success' : fnCallback
			              });
			            },
			            "fnCreatedRow" : function(nRow, aData, iDataIndex){
			            	$(nRow).attr('class', 'center');
			            }
					});
				}
                                else if ($(this).is('.ajax4'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"bProcessing": true,
						"bServerSide": true,
						"sAjaxSource": rootPath + 'front/accueil/datatableNotif',
				       	// "sDom": "<'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"sDom": "<'row separator bottom'<'col-md-3'f><'col-md-3'l><'col-md-6'C>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"oLanguage": {
							"sLengthMenu": "_MENU_ Nb entrées"
						},
						"oColVis": {
							"buttonText": "Afficher / Masquer les colonnes",
							"sAlign": "right"
						},
				       	"sScrollX": "100%",
				       	"sScrollY": "350px",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        },
				        "fnServerData": function(sSource, aoData, fnCallback)
			            {
			              $.ajax
			              ({
				                'dataType': 'json',
				                'type'    : 'POST',
				                'url'     : sSource,
				                'data'    : aoData,
				                'success' : fnCallback
			              });
			            },
			            "fnCreatedRow" : function(nRow, aData, iDataIndex){
			            	$(nRow).attr('class', 'center');
			            }
					});
				}
				else if ($(this).is('.fixedHeaderColReorder'))
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
				       	"sDom": "R<'clear'><'row separator bottom'<'col-md-12'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				       	"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
				       	"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
					    	var t = this;
					    	setTimeout(function(){
					    		new FixedHeader( t );
					    	}, 1000);
				        }
					});
				}
				// default initialization
				else
				{
					$(this).dataTable({
						"sPaginationType": "bootstrap",
						"sDom": "<'row separator bottom'<'col-md-5'T><'col-md-3'l><'col-md-4'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
						"sScrollX": "100%",
				       	"sScrollXInner": "100%",
				        "bScrollCollapse": true,
						"oLanguage": {
							"sLengthMenu": "_MENU_ par page"
						},
						"fnInitComplete": function () {
					    	fnInitCompleteCallback(this);
				        }
					});
				}
			});
		}
	});
	
})(jQuery, window);