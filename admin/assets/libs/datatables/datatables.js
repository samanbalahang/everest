(function(factory){"use strict";if(typeof define==='function'&&define.amd){define(['jquery'],function($){return factory($,window,document)})}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window}
if(!$){$=typeof window!=='undefined'?require('jquery'):require('jquery')(root)}
return factory($,root,root.document)}}
else{factory(jQuery,window,document)}}(function($,window,document,undefined){"use strict";var DataTable=function(options)
{this.$=function(sSelector,oOpts)
{return this.api(!0).$(sSelector,oOpts)};this._=function(sSelector,oOpts)
{return this.api(!0).rows(sSelector,oOpts).data()};this.api=function(traditional)
{return traditional?new _Api(_fnSettingsFromNode(this[_ext.iApiIndex])):new _Api(this)};this.fnAddData=function(data,redraw)
{var api=this.api(!0);var rows=$.isArray(data)&&($.isArray(data[0])||$.isPlainObject(data[0]))?api.rows.add(data):api.row.add(data);if(redraw===undefined||redraw){api.draw()}
return rows.flatten().toArray()};this.fnAdjustColumnSizing=function(bRedraw)
{var api=this.api(!0).columns.adjust();var settings=api.settings()[0];var scroll=settings.oScroll;if(bRedraw===undefined||bRedraw){api.draw(!1)}
else if(scroll.sX!==""||scroll.sY!==""){_fnScrollDraw(settings)}};this.fnClearTable=function(bRedraw)
{var api=this.api(!0).clear();if(bRedraw===undefined||bRedraw){api.draw()}};this.fnClose=function(nTr)
{this.api(!0).row(nTr).child.hide()};this.fnDeleteRow=function(target,callback,redraw)
{var api=this.api(!0);var rows=api.rows(target);var settings=rows.settings()[0];var data=settings.aoData[rows[0][0]];rows.remove();if(callback){callback.call(this,settings,data)}
if(redraw===undefined||redraw){api.draw()}
return data};this.fnDestroy=function(remove)
{this.api(!0).destroy(remove)};this.fnDraw=function(complete)
{this.api(!0).draw(complete)};this.fnFilter=function(sInput,iColumn,bRegex,bSmart,bShowGlobal,bCaseInsensitive)
{var api=this.api(!0);if(iColumn===null||iColumn===undefined){api.search(sInput,bRegex,bSmart,bCaseInsensitive)}
else{api.column(iColumn).search(sInput,bRegex,bSmart,bCaseInsensitive)}
api.draw()};this.fnGetData=function(src,col)
{var api=this.api(!0);if(src!==undefined){var type=src.nodeName?src.nodeName.toLowerCase():'';return col!==undefined||type=='td'||type=='th'?api.cell(src,col).data():api.row(src).data()||null}
return api.data().toArray()};this.fnGetNodes=function(iRow)
{var api=this.api(!0);return iRow!==undefined?api.row(iRow).node():api.rows().nodes().flatten().toArray()};this.fnGetPosition=function(node)
{var api=this.api(!0);var nodeName=node.nodeName.toUpperCase();if(nodeName=='TR'){return api.row(node).index()}
else if(nodeName=='TD'||nodeName=='TH'){var cell=api.cell(node).index();return[cell.row,cell.columnVisible,cell.column]}
return null};this.fnIsOpen=function(nTr)
{return this.api(!0).row(nTr).child.isShown()};this.fnOpen=function(nTr,mHtml,sClass)
{return this.api(!0).row(nTr).child(mHtml,sClass).show().child()[0]};this.fnPageChange=function(mAction,bRedraw)
{var api=this.api(!0).page(mAction);if(bRedraw===undefined||bRedraw){api.draw(!1)}};this.fnSetColumnVis=function(iCol,bShow,bRedraw)
{var api=this.api(!0).column(iCol).visible(bShow);if(bRedraw===undefined||bRedraw){api.columns.adjust().draw()}};this.fnSettings=function()
{return _fnSettingsFromNode(this[_ext.iApiIndex])};this.fnSort=function(aaSort)
{this.api(!0).order(aaSort).draw()};this.fnSortListener=function(nNode,iColumn,fnCallback)
{this.api(!0).order.listener(nNode,iColumn,fnCallback)};this.fnUpdate=function(mData,mRow,iColumn,bRedraw,bAction)
{var api=this.api(!0);if(iColumn===undefined||iColumn===null){api.row(mRow).data(mData)}
else{api.cell(mRow,iColumn).data(mData)}
if(bAction===undefined||bAction){api.columns.adjust()}
if(bRedraw===undefined||bRedraw){api.draw()}
return 0};this.fnVersionCheck=_ext.fnVersionCheck;var _that=this;var emptyInit=options===undefined;var len=this.length;if(emptyInit){options={}}
this.oApi=this.internal=_ext.internal;for(var fn in DataTable.ext.internal){if(fn){this[fn]=_fnExternApiFunc(fn)}}
this.each(function(){var o={};var oInit=len>1?_fnExtend(o,options,!0):options;var i=0,iLen,j,jLen,k,kLen;var sId=this.getAttribute('id');var bInitHandedOff=!1;var defaults=DataTable.defaults;var $this=$(this);if(this.nodeName.toLowerCase()!='table')
{_fnLog(null,0,'Non-table node initialisation ('+this.nodeName+')',2);return}
_fnCompatOpts(defaults);_fnCompatCols(defaults.column);_fnCamelToHungarian(defaults,defaults,!0);_fnCamelToHungarian(defaults.column,defaults.column,!0);_fnCamelToHungarian(defaults,$.extend(oInit,$this.data()));var allSettings=DataTable.settings;for(i=0,iLen=allSettings.length;i<iLen;i++)
{var s=allSettings[i];if(s.nTable==this||(s.nTHead&&s.nTHead.parentNode==this)||(s.nTFoot&&s.nTFoot.parentNode==this)){var bRetrieve=oInit.bRetrieve!==undefined?oInit.bRetrieve:defaults.bRetrieve;var bDestroy=oInit.bDestroy!==undefined?oInit.bDestroy:defaults.bDestroy;if(emptyInit||bRetrieve)
{return s.oInstance}
else if(bDestroy)
{s.oInstance.fnDestroy();break}
else{_fnLog(s,0,'Cannot reinitialise DataTable',3);return}}
if(s.sTableId==this.id)
{allSettings.splice(i,1);break}}
if(sId===null||sId==="")
{sId="DataTables_Table_"+(DataTable.ext._unique++);this.id=sId}
var oSettings=$.extend(!0,{},DataTable.models.oSettings,{"sDestroyWidth":$this[0].style.width,"sInstance":sId,"sTableId":sId});oSettings.nTable=this;oSettings.oApi=_that.internal;oSettings.oInit=oInit;allSettings.push(oSettings);oSettings.oInstance=(_that.length===1)?_that:$this.dataTable();_fnCompatOpts(oInit);_fnLanguageCompat(oInit.oLanguage);if(oInit.aLengthMenu&&!oInit.iDisplayLength)
{oInit.iDisplayLength=$.isArray(oInit.aLengthMenu[0])?oInit.aLengthMenu[0][0]:oInit.aLengthMenu[0]}
oInit=_fnExtend($.extend(!0,{},defaults),oInit);_fnMap(oSettings.oFeatures,oInit,["bPaginate","bLengthChange","bFilter","bSort","bSortMulti","bInfo","bProcessing","bAutoWidth","bSortClasses","bServerSide","bDeferRender"]);_fnMap(oSettings,oInit,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"]]);_fnMap(oSettings.oScroll,oInit,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);_fnMap(oSettings.oLanguage,oInit,"fnInfoCallback");_fnCallbackReg(oSettings,'aoDrawCallback',oInit.fnDrawCallback,'user');_fnCallbackReg(oSettings,'aoServerParams',oInit.fnServerParams,'user');_fnCallbackReg(oSettings,'aoStateSaveParams',oInit.fnStateSaveParams,'user');_fnCallbackReg(oSettings,'aoStateLoadParams',oInit.fnStateLoadParams,'user');_fnCallbackReg(oSettings,'aoStateLoaded',oInit.fnStateLoaded,'user');_fnCallbackReg(oSettings,'aoRowCallback',oInit.fnRowCallback,'user');_fnCallbackReg(oSettings,'aoRowCreatedCallback',oInit.fnCreatedRow,'user');_fnCallbackReg(oSettings,'aoHeaderCallback',oInit.fnHeaderCallback,'user');_fnCallbackReg(oSettings,'aoFooterCallback',oInit.fnFooterCallback,'user');_fnCallbackReg(oSettings,'aoInitComplete',oInit.fnInitComplete,'user');_fnCallbackReg(oSettings,'aoPreDrawCallback',oInit.fnPreDrawCallback,'user');oSettings.rowIdFn=_fnGetObjectDataFn(oInit.rowId);_fnBrowserDetect(oSettings);var oClasses=oSettings.oClasses;$.extend(oClasses,DataTable.ext.classes,oInit.oClasses);$this.addClass(oClasses.sTable);if(oSettings.iInitDisplayStart===undefined)
{oSettings.iInitDisplayStart=oInit.iDisplayStart;oSettings._iDisplayStart=oInit.iDisplayStart}
if(oInit.iDeferLoading!==null)
{oSettings.bDeferLoading=!0;var tmp=$.isArray(oInit.iDeferLoading);oSettings._iRecordsDisplay=tmp?oInit.iDeferLoading[0]:oInit.iDeferLoading;oSettings._iRecordsTotal=tmp?oInit.iDeferLoading[1]:oInit.iDeferLoading}
var oLanguage=oSettings.oLanguage;$.extend(!0,oLanguage,oInit.oLanguage);if(oLanguage.sUrl)
{$.ajax({dataType:'json',url:oLanguage.sUrl,success:function(json){_fnLanguageCompat(json);_fnCamelToHungarian(defaults.oLanguage,json);$.extend(!0,oLanguage,json);_fnInitialise(oSettings)},error:function(){_fnInitialise(oSettings)}});bInitHandedOff=!0}
if(oInit.asStripeClasses===null)
{oSettings.asStripeClasses=[oClasses.sStripeOdd,oClasses.sStripeEven]}
var stripeClasses=oSettings.asStripeClasses;var rowOne=$this.children('tbody').find('tr').eq(0);if($.inArray(!0,$.map(stripeClasses,function(el,i){return rowOne.hasClass(el)}))!==-1){$('tbody tr',this).removeClass(stripeClasses.join(' '));oSettings.asDestroyStripes=stripeClasses.slice()}
var anThs=[];var aoColumnsInit;var nThead=this.getElementsByTagName('thead');if(nThead.length!==0)
{_fnDetectHeader(oSettings.aoHeader,nThead[0]);anThs=_fnGetUniqueThs(oSettings)}
if(oInit.aoColumns===null)
{aoColumnsInit=[];for(i=0,iLen=anThs.length;i<iLen;i++)
{aoColumnsInit.push(null)}}
else{aoColumnsInit=oInit.aoColumns}
for(i=0,iLen=aoColumnsInit.length;i<iLen;i++)
{_fnAddColumn(oSettings,anThs?anThs[i]:null)}
_fnApplyColumnDefs(oSettings,oInit.aoColumnDefs,aoColumnsInit,function(iCol,oDef){_fnColumnOptions(oSettings,iCol,oDef)});if(rowOne.length){var a=function(cell,name){return cell.getAttribute('data-'+name)!==null?name:null};$(rowOne[0]).children('th, td').each(function(i,cell){var col=oSettings.aoColumns[i];if(col.mData===i){var sort=a(cell,'sort')||a(cell,'order');var filter=a(cell,'filter')||a(cell,'search');if(sort!==null||filter!==null){col.mData={_:i+'.display',sort:sort!==null?i+'.@data-'+sort:undefined,type:sort!==null?i+'.@data-'+sort:undefined,filter:filter!==null?i+'.@data-'+filter:undefined};_fnColumnOptions(oSettings,i)}}})}
var features=oSettings.oFeatures;var loadedInit=function(){if(oInit.aaSorting===undefined){var sorting=oSettings.aaSorting;for(i=0,iLen=sorting.length;i<iLen;i++){sorting[i][1]=oSettings.aoColumns[i].asSorting[0]}}
_fnSortingClasses(oSettings);if(features.bSort){_fnCallbackReg(oSettings,'aoDrawCallback',function(){if(oSettings.bSorted){var aSort=_fnSortFlatten(oSettings);var sortedColumns={};$.each(aSort,function(i,val){sortedColumns[val.src]=val.dir});_fnCallbackFire(oSettings,null,'order',[oSettings,aSort,sortedColumns]);_fnSortAria(oSettings)}})}
_fnCallbackReg(oSettings,'aoDrawCallback',function(){if(oSettings.bSorted||_fnDataSource(oSettings)==='ssp'||features.bDeferRender){_fnSortingClasses(oSettings)}},'sc');var captions=$this.children('caption').each(function(){this._captionSide=$(this).css('caption-side')});var thead=$this.children('thead');if(thead.length===0){thead=$('<thead/>').appendTo($this)}
oSettings.nTHead=thead[0];var tbody=$this.children('tbody');if(tbody.length===0){tbody=$('<tbody/>').appendTo($this)}
oSettings.nTBody=tbody[0];var tfoot=$this.children('tfoot');if(tfoot.length===0&&captions.length>0&&(oSettings.oScroll.sX!==""||oSettings.oScroll.sY!=="")){tfoot=$('<tfoot/>').appendTo($this)}
if(tfoot.length===0||tfoot.children().length===0){$this.addClass(oClasses.sNoFooter)}
else if(tfoot.length>0){oSettings.nTFoot=tfoot[0];_fnDetectHeader(oSettings.aoFooter,oSettings.nTFoot)}
if(oInit.aaData){for(i=0;i<oInit.aaData.length;i++){_fnAddData(oSettings,oInit.aaData[i])}}
else if(oSettings.bDeferLoading||_fnDataSource(oSettings)=='dom'){_fnAddTr(oSettings,$(oSettings.nTBody).children('tr'))}
oSettings.aiDisplay=oSettings.aiDisplayMaster.slice();oSettings.bInitialised=!0;if(bInitHandedOff===!1){_fnInitialise(oSettings)}};if(oInit.bStateSave)
{features.bStateSave=!0;_fnCallbackReg(oSettings,'aoDrawCallback',_fnSaveState,'state_save');_fnLoadState(oSettings,oInit,loadedInit)}
else{loadedInit()}});_that=null;return this};var _ext;var _Api;var _api_register;var _api_registerPlural;var _re_dic={};var _re_new_lines=/[\r\n]/g;var _re_html=/<.*?>/g;var _re_date=/^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/;var _re_escape_regex=new RegExp('(\\'+['/','.','*','+','?','|','(',')','[',']','{','}','\\','$','^','-'].join('|\\')+')','g');var _re_formatted_numeric=/[',$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi;var _empty=function(d){return!d||d===!0||d==='-'?!0:!1};var _intVal=function(s){var integer=parseInt(s,100);return!isNaN(integer)&&isFinite(s)?integer:null};var _numToDecimal=function(num,decimalPoint){if(!_re_dic[decimalPoint]){_re_dic[decimalPoint]=new RegExp(_fnEscapeRegex(decimalPoint),'g')}
return typeof num==='string'&&decimalPoint!=='.'?num.replace(/\./g,'').replace(_re_dic[decimalPoint],'.'):num};var _isNumber=function(d,decimalPoint,formatted){var strType=typeof d==='string';if(_empty(d)){return!0}
if(decimalPoint&&strType){d=_numToDecimal(d,decimalPoint)}
if(formatted&&strType){d=d.replace(_re_formatted_numeric,'')}
return!isNaN(parseFloat(d))&&isFinite(d)};var _isHtml=function(d){return _empty(d)||typeof d==='string'};var _htmlNumeric=function(d,decimalPoint,formatted){if(_empty(d)){return!0}
var html=_isHtml(d);return!html?null:_isNumber(_stripHtml(d),decimalPoint,formatted)?!0:null};var _pluck=function(a,prop,prop2){var out=[];var i=0,ien=a.length;if(prop2!==undefined){for(;i<ien;i++){if(a[i]&&a[i][prop]){out.push(a[i][prop][prop2])}}}
else{for(;i<ien;i++){if(a[i]){out.push(a[i][prop])}}}
return out};var _pluck_order=function(a,order,prop,prop2)
{var out=[];var i=0,ien=order.length;if(prop2!==undefined){for(;i<ien;i++){if(a[order[i]][prop]){out.push(a[order[i]][prop][prop2])}}}
else{for(;i<ien;i++){out.push(a[order[i]][prop])}}
return out};var _range=function(len,start)
{var out=[];var end;if(start===undefined){start=0;end=len}
else{end=start;start=len}
for(var i=start;i<end;i++){out.push(i)}
return out};var _removeEmpty=function(a)
{var out=[];for(var i=0,ien=a.length;i<ien;i++){if(a[i]){out.push(a[i])}}
return out};var _stripHtml=function(d){return d.replace(_re_html,'')};var _areAllUnique=function(src){if(src.length<2){return!0}
var sorted=src.slice().sort();var last=sorted[0];for(var i=1,ien=sorted.length;i<ien;i++){if(sorted[i]===last){return!1}
last=sorted[i]}
return!0};var _unique=function(src)
{if(_areAllUnique(src)){return src.slice()}
var out=[],val,i,ien=src.length,j,k=0;again:for(i=0;i<ien;i++){val=src[i];for(j=0;j<k;j++){if(out[j]===val){continue again}}
out.push(val);k++}
return out};DataTable.util={throttle:function(fn,freq){var
frequency=freq!==undefined?freq:200,last,timer;return function(){var
that=this,now=+new Date(),args=arguments;if(last&&now<last+frequency){clearTimeout(timer);timer=setTimeout(function(){last=undefined;fn.apply(that,args)},frequency)}
else{last=now;fn.apply(that,args)}}},escapeRegex:function(val){return val.replace(_re_escape_regex,'\\$1')}};function _fnHungarianMap(o)
{var
hungarian='a aa ai ao as b fn i m o s ',match,newKey,map={};$.each(o,function(key,val){match=key.match(/^([^A-Z]+?)([A-Z])/);if(match&&hungarian.indexOf(match[1]+' ')!==-1)
{newKey=key.replace(match[0],match[2].toLowerCase());map[newKey]=key;if(match[1]==='o')
{_fnHungarianMap(o[key])}}});o._hungarianMap=map}
function _fnCamelToHungarian(src,user,force)
{if(!src._hungarianMap){_fnHungarianMap(src)}
var hungarianKey;$.each(user,function(key,val){hungarianKey=src._hungarianMap[key];if(hungarianKey!==undefined&&(force||user[hungarianKey]===undefined))
{if(hungarianKey.charAt(0)==='o')
{if(!user[hungarianKey]){user[hungarianKey]={}}
$.extend(!0,user[hungarianKey],user[key]);_fnCamelToHungarian(src[hungarianKey],user[hungarianKey],force)}
else{user[hungarianKey]=user[key]}}})}
function _fnLanguageCompat(lang)
{var defaults=DataTable.defaults.oLanguage;var defaultDecimal=defaults.sDecimal;if(defaultDecimal){_addNumericSort(defaultDecimal)}
if(lang){var zeroRecords=lang.sZeroRecords;if(!lang.sEmptyTable&&zeroRecords&&defaults.sEmptyTable==="No data available in table")
{_fnMap(lang,lang,'sZeroRecords','sEmptyTable')}
if(!lang.sLoadingRecords&&zeroRecords&&defaults.sLoadingRecords==="Loading...")
{_fnMap(lang,lang,'sZeroRecords','sLoadingRecords')}
if(lang.sInfoThousands){lang.sThousands=lang.sInfoThousands}
var decimal=lang.sDecimal;if(decimal&&defaultDecimal!==decimal){_addNumericSort(decimal)}}}
var _fnCompatMap=function(o,knew,old){if(o[knew]!==undefined){o[old]=o[knew]}};function _fnCompatOpts(init)
{_fnCompatMap(init,'ordering','bSort');_fnCompatMap(init,'orderMulti','bSortMulti');_fnCompatMap(init,'orderClasses','bSortClasses');_fnCompatMap(init,'orderCellsTop','bSortCellsTop');_fnCompatMap(init,'order','aaSorting');_fnCompatMap(init,'orderFixed','aaSortingFixed');_fnCompatMap(init,'paging','bPaginate');_fnCompatMap(init,'pagingType','sPaginationType');_fnCompatMap(init,'pageLength','iDisplayLength');_fnCompatMap(init,'searching','bFilter');if(typeof init.sScrollX==='boolean'){init.sScrollX=init.sScrollX?'100%':''}
if(typeof init.scrollX==='boolean'){init.scrollX=init.scrollX?'100%':''}
var searchCols=init.aoSearchCols;if(searchCols){for(var i=0,ien=searchCols.length;i<ien;i++){if(searchCols[i]){_fnCamelToHungarian(DataTable.models.oSearch,searchCols[i])}}}}
function _fnCompatCols(init)
{_fnCompatMap(init,'orderable','bSortable');_fnCompatMap(init,'orderData','aDataSort');_fnCompatMap(init,'orderSequence','asSorting');_fnCompatMap(init,'orderDataType','sortDataType');var dataSort=init.aDataSort;if(typeof dataSort==='number'&&!$.isArray(dataSort)){init.aDataSort=[dataSort]}}
function _fnBrowserDetect(settings)
{if(!DataTable.__browser){var browser={};DataTable.__browser=browser;var n=$('<div/>').css({position:'fixed',top:0,left:$(window).scrollLeft()*-1,height:1,width:1,overflow:'hidden'}).append($('<div/>').css({position:'absolute',top:1,left:1,width:100,overflow:'scroll'}).append($('<div/>').css({width:'100%',height:10}))).appendTo('body');var outer=n.children();var inner=outer.children();browser.barWidth=outer[0].offsetWidth-outer[0].clientWidth;browser.bScrollOversize=inner[0].offsetWidth===100&&outer[0].clientWidth!==100;browser.bScrollbarLeft=Math.round(inner.offset().left)!==1;browser.bBounding=n[0].getBoundingClientRect().width?!0:!1;n.remove()}
$.extend(settings.oBrowser,DataTable.__browser);settings.oScroll.iBarWidth=DataTable.__browser.barWidth}
function _fnReduce(that,fn,init,start,end,inc)
{var
i=start,value,isSet=!1;if(init!==undefined){value=init;isSet=!0}
while(i!==end){if(!that.hasOwnProperty(i)){continue}
value=isSet?fn(value,that[i],i,that):that[i];isSet=!0;i+=inc}
return value}
function _fnAddColumn(oSettings,nTh)
{var oDefaults=DataTable.defaults.column;var iCol=oSettings.aoColumns.length;var oCol=$.extend({},DataTable.models.oColumn,oDefaults,{"nTh":nTh?nTh:document.createElement('th'),"sTitle":oDefaults.sTitle?oDefaults.sTitle:nTh?nTh.innerHTML:'',"aDataSort":oDefaults.aDataSort?oDefaults.aDataSort:[iCol],"mData":oDefaults.mData?oDefaults.mData:iCol,idx:iCol});oSettings.aoColumns.push(oCol);var searchCols=oSettings.aoPreSearchCols;searchCols[iCol]=$.extend({},DataTable.models.oSearch,searchCols[iCol]);_fnColumnOptions(oSettings,iCol,$(nTh).data())}
function _fnColumnOptions(oSettings,iCol,oOptions)
{var oCol=oSettings.aoColumns[iCol];var oClasses=oSettings.oClasses;var th=$(oCol.nTh);if(!oCol.sWidthOrig){oCol.sWidthOrig=th.attr('width')||null;var t=(th.attr('style')||'').match(/width:\s*(\d+[pxem%]+)/);if(t){oCol.sWidthOrig=t[1]}}
if(oOptions!==undefined&&oOptions!==null)
{_fnCompatCols(oOptions);_fnCamelToHungarian(DataTable.defaults.column,oOptions);if(oOptions.mDataProp!==undefined&&!oOptions.mData)
{oOptions.mData=oOptions.mDataProp}
if(oOptions.sType)
{oCol._sManualType=oOptions.sType}
if(oOptions.className&&!oOptions.sClass)
{oOptions.sClass=oOptions.className}
if(oOptions.sClass){th.addClass(oOptions.sClass)}
$.extend(oCol,oOptions);_fnMap(oCol,oOptions,"sWidth","sWidthOrig");if(oOptions.iDataSort!==undefined)
{oCol.aDataSort=[oOptions.iDataSort]}
_fnMap(oCol,oOptions,"aDataSort")}
var mDataSrc=oCol.mData;var mData=_fnGetObjectDataFn(mDataSrc);var mRender=oCol.mRender?_fnGetObjectDataFn(oCol.mRender):null;var attrTest=function(src){return typeof src==='string'&&src.indexOf('@')!==-1};oCol._bAttrSrc=$.isPlainObject(mDataSrc)&&(attrTest(mDataSrc.sort)||attrTest(mDataSrc.type)||attrTest(mDataSrc.filter));oCol._setter=null;oCol.fnGetData=function(rowData,type,meta){var innerData=mData(rowData,type,undefined,meta);return mRender&&type?mRender(innerData,type,rowData,meta):innerData};oCol.fnSetData=function(rowData,val,meta){return _fnSetObjectDataFn(mDataSrc)(rowData,val,meta)};if(typeof mDataSrc!=='number'){oSettings._rowReadObject=!0}
if(!oSettings.oFeatures.bSort)
{oCol.bSortable=!1;th.addClass(oClasses.sSortableNone)}
var bAsc=$.inArray('asc',oCol.asSorting)!==-1;var bDesc=$.inArray('desc',oCol.asSorting)!==-1;if(!oCol.bSortable||(!bAsc&&!bDesc))
{oCol.sSortingClass=oClasses.sSortableNone;oCol.sSortingClassJUI=""}
else if(bAsc&&!bDesc)
{oCol.sSortingClass=oClasses.sSortableAsc;oCol.sSortingClassJUI=oClasses.sSortJUIAscAllowed}
else if(!bAsc&&bDesc)
{oCol.sSortingClass=oClasses.sSortableDesc;oCol.sSortingClassJUI=oClasses.sSortJUIDescAllowed}
else{oCol.sSortingClass=oClasses.sSortable;oCol.sSortingClassJUI=oClasses.sSortJUI}}
function _fnAdjustColumnSizing(settings)
{if(settings.oFeatures.bAutoWidth!==!1)
{var columns=settings.aoColumns;_fnCalculateColumnWidths(settings);for(var i=0,iLen=columns.length;i<iLen;i++)
{columns[i].nTh.style.width=columns[i].sWidth}}
var scroll=settings.oScroll;if(scroll.sY!==''||scroll.sX!=='')
{_fnScrollDraw(settings)}
_fnCallbackFire(settings,null,'column-sizing',[settings])}
function _fnVisibleToColumnIndex(oSettings,iMatch)
{var aiVis=_fnGetColumns(oSettings,'bVisible');return typeof aiVis[iMatch]==='number'?aiVis[iMatch]:null}
function _fnColumnIndexToVisible(oSettings,iMatch)
{var aiVis=_fnGetColumns(oSettings,'bVisible');var iPos=$.inArray(iMatch,aiVis);return iPos!==-1?iPos:null}
function _fnVisbleColumns(oSettings)
{var vis=0;$.each(oSettings.aoColumns,function(i,col){if(col.bVisible&&$(col.nTh).css('display')!=='none'){vis++}});return vis}
function _fnGetColumns(oSettings,sParam)
{var a=[];$.map(oSettings.aoColumns,function(val,i){if(val[sParam]){a.push(i)}});return a}
function _fnColumnTypes(settings)
{var columns=settings.aoColumns;var data=settings.aoData;var types=DataTable.ext.type.detect;var i,ien,j,jen,k,ken;var col,cell,detectedType,cache;for(i=0,ien=columns.length;i<ien;i++){col=columns[i];cache=[];if(!col.sType&&col._sManualType){col.sType=col._sManualType}
else if(!col.sType){for(j=0,jen=types.length;j<jen;j++){for(k=0,ken=data.length;k<ken;k++){if(cache[k]===undefined){cache[k]=_fnGetCellData(settings,k,i,'type')}
detectedType=types[j](cache[k],settings);if(!detectedType&&j!==types.length-1){break}
if(detectedType==='html'){break}}
if(detectedType){col.sType=detectedType;break}}
if(!col.sType){col.sType='string'}}}}
function _fnApplyColumnDefs(oSettings,aoColDefs,aoCols,fn)
{var i,iLen,j,jLen,k,kLen,def;var columns=oSettings.aoColumns;if(aoColDefs)
{for(i=aoColDefs.length-1;i>=0;i--)
{def=aoColDefs[i];var aTargets=def.targets!==undefined?def.targets:def.aTargets;if(!$.isArray(aTargets))
{aTargets=[aTargets]}
for(j=0,jLen=aTargets.length;j<jLen;j++)
{if(typeof aTargets[j]==='number'&&aTargets[j]>=0)
{while(columns.length<=aTargets[j])
{_fnAddColumn(oSettings)}
fn(aTargets[j],def)}
else if(typeof aTargets[j]==='number'&&aTargets[j]<0)
{fn(columns.length+aTargets[j],def)}
else if(typeof aTargets[j]==='string')
{for(k=0,kLen=columns.length;k<kLen;k++)
{if(aTargets[j]=="_all"||$(columns[k].nTh).hasClass(aTargets[j]))
{fn(k,def)}}}}}}
if(aoCols)
{for(i=0,iLen=aoCols.length;i<iLen;i++)
{fn(i,aoCols[i])}}}
function _fnAddData(oSettings,aDataIn,nTr,anTds)
{var iRow=oSettings.aoData.length;var oData=$.extend(!0,{},DataTable.models.oRow,{src:nTr?'dom':'data',idx:iRow});oData._aData=aDataIn;oSettings.aoData.push(oData);var nTd,sThisType;var columns=oSettings.aoColumns;for(var i=0,iLen=columns.length;i<iLen;i++)
{columns[i].sType=null}
oSettings.aiDisplayMaster.push(iRow);var id=oSettings.rowIdFn(aDataIn);if(id!==undefined){oSettings.aIds[id]=oData}
if(nTr||!oSettings.oFeatures.bDeferRender)
{_fnCreateTr(oSettings,iRow,nTr,anTds)}
return iRow}
function _fnAddTr(settings,trs)
{var row;if(!(trs instanceof $)){trs=$(trs)}
return trs.map(function(i,el){row=_fnGetRowElements(settings,el);return _fnAddData(settings,row.data,el,row.cells)})}
function _fnNodeToDataIndex(oSettings,n)
{return(n._DT_RowIndex!==undefined)?n._DT_RowIndex:null}
function _fnNodeToColumnIndex(oSettings,iRow,n)
{return $.inArray(n,oSettings.aoData[iRow].anCells)}
function _fnGetCellData(settings,rowIdx,colIdx,type)
{var draw=settings.iDraw;var col=settings.aoColumns[colIdx];var rowData=settings.aoData[rowIdx]._aData;var defaultContent=col.sDefaultContent;var cellData=col.fnGetData(rowData,type,{settings:settings,row:rowIdx,col:colIdx});if(cellData===undefined){if(settings.iDrawError!=draw&&defaultContent===null){_fnLog(settings,0,"Requested unknown parameter "+(typeof col.mData=='function'?'{function}':"'"+col.mData+"'")+" for row "+rowIdx+", column "+colIdx,4);settings.iDrawError=draw}
return defaultContent}
if((cellData===rowData||cellData===null)&&defaultContent!==null&&type!==undefined){cellData=defaultContent}
else if(typeof cellData==='function'){return cellData.call(rowData)}
if(cellData===null&&type=='display'){return''}
return cellData}
function _fnSetCellData(settings,rowIdx,colIdx,val)
{var col=settings.aoColumns[colIdx];var rowData=settings.aoData[rowIdx]._aData;col.fnSetData(rowData,val,{settings:settings,row:rowIdx,col:colIdx})}
var __reArray=/\[.*?\]$/;var __reFn=/\(\)$/;function _fnSplitObjNotation(str)
{return $.map(str.match(/(\\.|[^\.])+/g)||[''],function(s){return s.replace(/\\\./g,'.')})}
function _fnGetObjectDataFn(mSource)
{if($.isPlainObject(mSource))
{var o={};$.each(mSource,function(key,val){if(val){o[key]=_fnGetObjectDataFn(val)}});return function(data,type,row,meta){var t=o[type]||o._;return t!==undefined?t(data,type,row,meta):data}}
else if(mSource===null)
{return function(data){return data}}
else if(typeof mSource==='function')
{return function(data,type,row,meta){return mSource(data,type,row,meta)}}
else if(typeof mSource==='string'&&(mSource.indexOf('.')!==-1||mSource.indexOf('[')!==-1||mSource.indexOf('(')!==-1))
{var fetchData=function(data,type,src){var arrayNotation,funcNotation,out,innerSrc;if(src!=="")
{var a=_fnSplitObjNotation(src);for(var i=0,iLen=a.length;i<iLen;i++)
{arrayNotation=a[i].match(__reArray);funcNotation=a[i].match(__reFn);if(arrayNotation)
{a[i]=a[i].replace(__reArray,'');if(a[i]!==""){data=data[a[i]]}
out=[];a.splice(0,i+1);innerSrc=a.join('.');if($.isArray(data)){for(var j=0,jLen=data.length;j<jLen;j++){out.push(fetchData(data[j],type,innerSrc))}}
var join=arrayNotation[0].substring(1,arrayNotation[0].length-1);data=(join==="")?out:out.join(join);break}
else if(funcNotation)
{a[i]=a[i].replace(__reFn,'');data=data[a[i]]();continue}
if(data===null||data[a[i]]===undefined)
{return undefined}
data=data[a[i]]}}
return data};return function(data,type){return fetchData(data,type,mSource)}}
else{return function(data,type){return data[mSource]}}}
function _fnSetObjectDataFn(mSource)
{if($.isPlainObject(mSource))
{return _fnSetObjectDataFn(mSource._)}
else if(mSource===null)
{return function(){}}
else if(typeof mSource==='function')
{return function(data,val,meta){mSource(data,'set',val,meta)}}
else if(typeof mSource==='string'&&(mSource.indexOf('.')!==-1||mSource.indexOf('[')!==-1||mSource.indexOf('(')!==-1))
{var setData=function(data,val,src){var a=_fnSplitObjNotation(src),b;var aLast=a[a.length-1];var arrayNotation,funcNotation,o,innerSrc;for(var i=0,iLen=a.length-1;i<iLen;i++)
{arrayNotation=a[i].match(__reArray);funcNotation=a[i].match(__reFn);if(arrayNotation)
{a[i]=a[i].replace(__reArray,'');data[a[i]]=[];b=a.slice();b.splice(0,i+1);innerSrc=b.join('.');if($.isArray(val))
{for(var j=0,jLen=val.length;j<jLen;j++)
{o={};setData(o,val[j],innerSrc);data[a[i]].push(o)}}
else{data[a[i]]=val}
return}
else if(funcNotation)
{a[i]=a[i].replace(__reFn,'');data=data[a[i]](val)}
if(data[a[i]]===null||data[a[i]]===undefined)
{data[a[i]]={}}
data=data[a[i]]}
if(aLast.match(__reFn))
{data=data[aLast.replace(__reFn,'')](val)}
else{data[aLast.replace(__reArray,'')]=val}};return function(data,val){return setData(data,val,mSource)}}
else{return function(data,val){data[mSource]=val}}}
function _fnGetDataMaster(settings)
{return _pluck(settings.aoData,'_aData')}
function _fnClearTable(settings)
{settings.aoData.length=0;settings.aiDisplayMaster.length=0;settings.aiDisplay.length=0;settings.aIds={}}
function _fnDeleteIndex(a,iTarget,splice)
{var iTargetIndex=-1;for(var i=0,iLen=a.length;i<iLen;i++)
{if(a[i]==iTarget)
{iTargetIndex=i}
else if(a[i]>iTarget)
{a[i]--}}
if(iTargetIndex!=-1&&splice===undefined)
{a.splice(iTargetIndex,1)}}
function _fnInvalidate(settings,rowIdx,src,colIdx)
{var row=settings.aoData[rowIdx];var i,ien;var cellWrite=function(cell,col){while(cell.childNodes.length){cell.removeChild(cell.firstChild)}
cell.innerHTML=_fnGetCellData(settings,rowIdx,col,'display')};if(src==='dom'||((!src||src==='auto')&&row.src==='dom')){row._aData=_fnGetRowElements(settings,row,colIdx,colIdx===undefined?undefined:row._aData).data}
else{var cells=row.anCells;if(cells){if(colIdx!==undefined){cellWrite(cells[colIdx],colIdx)}
else{for(i=0,ien=cells.length;i<ien;i++){cellWrite(cells[i],i)}}}}
row._aSortData=null;row._aFilterData=null;var cols=settings.aoColumns;if(colIdx!==undefined){cols[colIdx].sType=null}
else{for(i=0,ien=cols.length;i<ien;i++){cols[i].sType=null}
_fnRowAttributes(settings,row)}}
function _fnGetRowElements(settings,row,colIdx,d)
{var
tds=[],td=row.firstChild,name,col,o,i=0,contents,columns=settings.aoColumns,objectRead=settings._rowReadObject;d=d!==undefined?d:objectRead?{}:[];var attr=function(str,td){if(typeof str==='string'){var idx=str.indexOf('@');if(idx!==-1){var attr=str.substring(idx+1);var setter=_fnSetObjectDataFn(str);setter(d,td.getAttribute(attr))}}};var cellProcess=function(cell){if(colIdx===undefined||colIdx===i){col=columns[i];contents=$.trim(cell.innerHTML);if(col&&col._bAttrSrc){var setter=_fnSetObjectDataFn(col.mData._);setter(d,contents);attr(col.mData.sort,cell);attr(col.mData.type,cell);attr(col.mData.filter,cell)}
else{if(objectRead){if(!col._setter){col._setter=_fnSetObjectDataFn(col.mData)}
col._setter(d,contents)}
else{d[i]=contents}}}
i++};if(td){while(td){name=td.nodeName.toUpperCase();if(name=="TD"||name=="TH"){cellProcess(td);tds.push(td)}
td=td.nextSibling}}
else{tds=row.anCells;for(var j=0,jen=tds.length;j<jen;j++){cellProcess(tds[j])}}
var rowNode=row.firstChild?row:row.nTr;if(rowNode){var id=rowNode.getAttribute('id');if(id){_fnSetObjectDataFn(settings.rowId)(d,id)}}
return{data:d,cells:tds}}
function _fnCreateTr(oSettings,iRow,nTrIn,anTds)
{var
row=oSettings.aoData[iRow],rowData=row._aData,cells=[],nTr,nTd,oCol,i,iLen;if(row.nTr===null)
{nTr=nTrIn||document.createElement('tr');row.nTr=nTr;row.anCells=cells;nTr._DT_RowIndex=iRow;_fnRowAttributes(oSettings,row);for(i=0,iLen=oSettings.aoColumns.length;i<iLen;i++)
{oCol=oSettings.aoColumns[i];nTd=nTrIn?anTds[i]:document.createElement(oCol.sCellType);nTd._DT_CellIndex={row:iRow,column:i};cells.push(nTd);if((!nTrIn||oCol.mRender||oCol.mData!==i)&&(!$.isPlainObject(oCol.mData)||oCol.mData._!==i+'.display')){nTd.innerHTML=_fnGetCellData(oSettings,iRow,i,'display')}
if(oCol.sClass)
{nTd.className+=' '+oCol.sClass}
if(oCol.bVisible&&!nTrIn)
{nTr.appendChild(nTd)}
else if(!oCol.bVisible&&nTrIn)
{nTd.parentNode.removeChild(nTd)}
if(oCol.fnCreatedCell)
{oCol.fnCreatedCell.call(oSettings.oInstance,nTd,_fnGetCellData(oSettings,iRow,i),rowData,iRow,i)}}
_fnCallbackFire(oSettings,'aoRowCreatedCallback',null,[nTr,rowData,iRow,cells])}
row.nTr.setAttribute('role','row')}
function _fnRowAttributes(settings,row)
{var tr=row.nTr;var data=row._aData;if(tr){var id=settings.rowIdFn(data);if(id){tr.id=id}
if(data.DT_RowClass){var a=data.DT_RowClass.split(' ');row.__rowc=row.__rowc?_unique(row.__rowc.concat(a)):a;$(tr).removeClass(row.__rowc.join(' ')).addClass(data.DT_RowClass)}
if(data.DT_RowAttr){$(tr).attr(data.DT_RowAttr)}
if(data.DT_RowData){$(tr).data(data.DT_RowData)}}}
function _fnBuildHead(oSettings)
{var i,ien,cell,row,column;var thead=oSettings.nTHead;var tfoot=oSettings.nTFoot;var createHeader=$('th, td',thead).length===0;var classes=oSettings.oClasses;var columns=oSettings.aoColumns;if(createHeader){row=$('<tr/>').appendTo(thead)}
for(i=0,ien=columns.length;i<ien;i++){column=columns[i];cell=$(column.nTh).addClass(column.sClass);if(createHeader){cell.appendTo(row)}
if(oSettings.oFeatures.bSort){cell.addClass(column.sSortingClass);if(column.bSortable!==!1){cell.attr('tabindex',oSettings.iTabIndex).attr('aria-controls',oSettings.sTableId);_fnSortAttachListener(oSettings,column.nTh,i)}}
if(column.sTitle!=cell[0].innerHTML){cell.html(column.sTitle)}
_fnRenderer(oSettings,'header')(oSettings,cell,column,classes)}
if(createHeader){_fnDetectHeader(oSettings.aoHeader,thead)}
$(thead).find('>tr').attr('role','row');$(thead).find('>tr>th, >tr>td').addClass(classes.sHeaderTH);$(tfoot).find('>tr>th, >tr>td').addClass(classes.sFooterTH);if(tfoot!==null){var cells=oSettings.aoFooter[0];for(i=0,ien=cells.length;i<ien;i++){column=columns[i];column.nTf=cells[i].cell;if(column.sClass){$(column.nTf).addClass(column.sClass)}}}}
function _fnDrawHead(oSettings,aoSource,bIncludeHidden)
{var i,iLen,j,jLen,k,kLen,n,nLocalTr;var aoLocal=[];var aApplied=[];var iColumns=oSettings.aoColumns.length;var iRowspan,iColspan;if(!aoSource)
{return}
if(bIncludeHidden===undefined)
{bIncludeHidden=!1}
for(i=0,iLen=aoSource.length;i<iLen;i++)
{aoLocal[i]=aoSource[i].slice();aoLocal[i].nTr=aoSource[i].nTr;for(j=iColumns-1;j>=0;j--)
{if(!oSettings.aoColumns[j].bVisible&&!bIncludeHidden)
{aoLocal[i].splice(j,1)}}
aApplied.push([])}
for(i=0,iLen=aoLocal.length;i<iLen;i++)
{nLocalTr=aoLocal[i].nTr;if(nLocalTr)
{while((n=nLocalTr.firstChild))
{nLocalTr.removeChild(n)}}
for(j=0,jLen=aoLocal[i].length;j<jLen;j++)
{iRowspan=1;iColspan=1;if(aApplied[i][j]===undefined)
{nLocalTr.appendChild(aoLocal[i][j].cell);aApplied[i][j]=1;while(aoLocal[i+iRowspan]!==undefined&&aoLocal[i][j].cell==aoLocal[i+iRowspan][j].cell)
{aApplied[i+iRowspan][j]=1;iRowspan++}
while(aoLocal[i][j+iColspan]!==undefined&&aoLocal[i][j].cell==aoLocal[i][j+iColspan].cell)
{for(k=0;k<iRowspan;k++)
{aApplied[i+k][j+iColspan]=1}
iColspan++}
$(aoLocal[i][j].cell).attr('rowspan',iRowspan).attr('colspan',iColspan)}}}}
function _fnDraw(oSettings)
{var aPreDraw=_fnCallbackFire(oSettings,'aoPreDrawCallback','preDraw',[oSettings]);if($.inArray(!1,aPreDraw)!==-1)
{_fnProcessingDisplay(oSettings,!1);return}
var i,iLen,n;var anRows=[];var iRowCount=0;var asStripeClasses=oSettings.asStripeClasses;var iStripes=asStripeClasses.length;var iOpenRows=oSettings.aoOpenRows.length;var oLang=oSettings.oLanguage;var iInitDisplayStart=oSettings.iInitDisplayStart;var bServerSide=_fnDataSource(oSettings)=='ssp';var aiDisplay=oSettings.aiDisplay;oSettings.bDrawing=!0;if(iInitDisplayStart!==undefined&&iInitDisplayStart!==-1)
{oSettings._iDisplayStart=bServerSide?iInitDisplayStart:iInitDisplayStart>=oSettings.fnRecordsDisplay()?0:iInitDisplayStart;oSettings.iInitDisplayStart=-1}
var iDisplayStart=oSettings._iDisplayStart;var iDisplayEnd=oSettings.fnDisplayEnd();if(oSettings.bDeferLoading)
{oSettings.bDeferLoading=!1;oSettings.iDraw++;_fnProcessingDisplay(oSettings,!1)}
else if(!bServerSide)
{oSettings.iDraw++}
else if(!oSettings.bDestroying&&!_fnAjaxUpdate(oSettings))
{return}
if(aiDisplay.length!==0)
{var iStart=bServerSide?0:iDisplayStart;var iEnd=bServerSide?oSettings.aoData.length:iDisplayEnd;for(var j=iStart;j<iEnd;j++)
{var iDataIndex=aiDisplay[j];var aoData=oSettings.aoData[iDataIndex];if(aoData.nTr===null)
{_fnCreateTr(oSettings,iDataIndex)}
var nRow=aoData.nTr;if(iStripes!==0)
{var sStripe=asStripeClasses[iRowCount%iStripes];if(aoData._sRowStripe!=sStripe)
{$(nRow).removeClass(aoData._sRowStripe).addClass(sStripe);aoData._sRowStripe=sStripe}}
_fnCallbackFire(oSettings,'aoRowCallback',null,[nRow,aoData._aData,iRowCount,j,iDataIndex]);anRows.push(nRow);iRowCount++}}
else{var sZero=oLang.sZeroRecords;if(oSettings.iDraw==1&&_fnDataSource(oSettings)=='ajax')
{sZero=oLang.sLoadingRecords}
else if(oLang.sEmptyTable&&oSettings.fnRecordsTotal()===0)
{sZero=oLang.sEmptyTable}
anRows[0]=$('<tr/>',{'class':iStripes?asStripeClasses[0]:''}).append($('<td />',{'valign':'top','colSpan':_fnVisbleColumns(oSettings),'class':oSettings.oClasses.sRowEmpty}).html(sZero))[0]}
_fnCallbackFire(oSettings,'aoHeaderCallback','header',[$(oSettings.nTHead).children('tr')[0],_fnGetDataMaster(oSettings),iDisplayStart,iDisplayEnd,aiDisplay]);_fnCallbackFire(oSettings,'aoFooterCallback','footer',[$(oSettings.nTFoot).children('tr')[0],_fnGetDataMaster(oSettings),iDisplayStart,iDisplayEnd,aiDisplay]);var body=$(oSettings.nTBody);body.children().detach();body.append($(anRows));_fnCallbackFire(oSettings,'aoDrawCallback','draw',[oSettings]);oSettings.bSorted=!1;oSettings.bFiltered=!1;oSettings.bDrawing=!1}
function _fnReDraw(settings,holdPosition)
{var
features=settings.oFeatures,sort=features.bSort,filter=features.bFilter;if(sort){_fnSort(settings)}
if(filter){_fnFilterComplete(settings,settings.oPreviousSearch)}
else{settings.aiDisplay=settings.aiDisplayMaster.slice()}
if(holdPosition!==!0){settings._iDisplayStart=0}
settings._drawHold=holdPosition;_fnDraw(settings);settings._drawHold=!1}
function _fnAddOptionsHtml(oSettings)
{var classes=oSettings.oClasses;var table=$(oSettings.nTable);var holding=$('<div/>').insertBefore(table);var features=oSettings.oFeatures;var insert=$('<div/>',{id:oSettings.sTableId+'_wrapper','class':classes.sWrapper+(oSettings.nTFoot?'':' '+classes.sNoFooter)});oSettings.nHolding=holding[0];oSettings.nTableWrapper=insert[0];oSettings.nTableReinsertBefore=oSettings.nTable.nextSibling;var aDom=oSettings.sDom.split('');var featureNode,cOption,nNewNode,cNext,sAttr,j;for(var i=0;i<aDom.length;i++)
{featureNode=null;cOption=aDom[i];if(cOption=='<')
{nNewNode=$('<div/>')[0];cNext=aDom[i+1];if(cNext=="'"||cNext=='"')
{sAttr="";j=2;while(aDom[i+j]!=cNext)
{sAttr+=aDom[i+j];j++}
if(sAttr=="H")
{sAttr=classes.sJUIHeader}
else if(sAttr=="F")
{sAttr=classes.sJUIFooter}
if(sAttr.indexOf('.')!=-1)
{var aSplit=sAttr.split('.');nNewNode.id=aSplit[0].substr(1,aSplit[0].length-1);nNewNode.className=aSplit[1]}
else if(sAttr.charAt(0)=="#")
{nNewNode.id=sAttr.substr(1,sAttr.length-1)}
else{nNewNode.className=sAttr}
i+=j}
insert.append(nNewNode);insert=$(nNewNode)}
else if(cOption=='>')
{insert=insert.parent()}
else if(cOption=='l'&&features.bPaginate&&features.bLengthChange)
{featureNode=_fnFeatureHtmlLength(oSettings)}
else if(cOption=='f'&&features.bFilter)
{featureNode=_fnFeatureHtmlFilter(oSettings)}
else if(cOption=='r'&&features.bProcessing)
{featureNode=_fnFeatureHtmlProcessing(oSettings)}
else if(cOption=='t')
{featureNode=_fnFeatureHtmlTable(oSettings)}
else if(cOption=='i'&&features.bInfo)
{featureNode=_fnFeatureHtmlInfo(oSettings)}
else if(cOption=='p'&&features.bPaginate)
{featureNode=_fnFeatureHtmlPaginate(oSettings)}
else if(DataTable.ext.feature.length!==0)
{var aoFeatures=DataTable.ext.feature;for(var k=0,kLen=aoFeatures.length;k<kLen;k++)
{if(cOption==aoFeatures[k].cFeature)
{featureNode=aoFeatures[k].fnInit(oSettings);break}}}
if(featureNode)
{var aanFeatures=oSettings.aanFeatures;if(!aanFeatures[cOption])
{aanFeatures[cOption]=[]}
aanFeatures[cOption].push(featureNode);insert.append(featureNode)}}
holding.replaceWith(insert);oSettings.nHolding=null}
function _fnDetectHeader(aLayout,nThead)
{var nTrs=$(nThead).children('tr');var nTr,nCell;var i,k,l,iLen,jLen,iColShifted,iColumn,iColspan,iRowspan;var bUnique;var fnShiftCol=function(a,i,j){var k=a[i];while(k[j]){j++}
return j};aLayout.splice(0,aLayout.length);for(i=0,iLen=nTrs.length;i<iLen;i++)
{aLayout.push([])}
for(i=0,iLen=nTrs.length;i<iLen;i++)
{nTr=nTrs[i];iColumn=0;nCell=nTr.firstChild;while(nCell){if(nCell.nodeName.toUpperCase()=="TD"||nCell.nodeName.toUpperCase()=="TH")
{iColspan=nCell.getAttribute('colspan')*1;iRowspan=nCell.getAttribute('rowspan')*1;iColspan=(!iColspan||iColspan===0||iColspan===1)?1:iColspan;iRowspan=(!iRowspan||iRowspan===0||iRowspan===1)?1:iRowspan;iColShifted=fnShiftCol(aLayout,i,iColumn);bUnique=iColspan===1?!0:!1;for(l=0;l<iColspan;l++)
{for(k=0;k<iRowspan;k++)
{aLayout[i+k][iColShifted+l]={"cell":nCell,"unique":bUnique};aLayout[i+k].nTr=nTr}}}
nCell=nCell.nextSibling}}}
function _fnGetUniqueThs(oSettings,nHeader,aLayout)
{var aReturn=[];if(!aLayout)
{aLayout=oSettings.aoHeader;if(nHeader)
{aLayout=[];_fnDetectHeader(aLayout,nHeader)}}
for(var i=0,iLen=aLayout.length;i<iLen;i++)
{for(var j=0,jLen=aLayout[i].length;j<jLen;j++)
{if(aLayout[i][j].unique&&(!aReturn[j]||!oSettings.bSortCellsTop))
{aReturn[j]=aLayout[i][j].cell}}}
return aReturn}
function _fnBuildAjax(oSettings,data,fn)
{_fnCallbackFire(oSettings,'aoServerParams','serverParams',[data]);if(data&&$.isArray(data)){var tmp={};var rbracket=/(.*?)\[\]$/;$.each(data,function(key,val){var match=val.name.match(rbracket);if(match){var name=match[0];if(!tmp[name]){tmp[name]=[]}
tmp[name].push(val.value)}
else{tmp[val.name]=val.value}});data=tmp}
var ajaxData;var ajax=oSettings.ajax;var instance=oSettings.oInstance;var callback=function(json){_fnCallbackFire(oSettings,null,'xhr',[oSettings,json,oSettings.jqXHR]);fn(json)};if($.isPlainObject(ajax)&&ajax.data)
{ajaxData=ajax.data;var newData=typeof ajaxData==='function'?ajaxData(data,oSettings):ajaxData;data=typeof ajaxData==='function'&&newData?newData:$.extend(!0,data,newData);delete ajax.data}
var baseAjax={"data":data,"success":function(json){var error=json.error||json.sError;if(error){_fnLog(oSettings,0,error)}
oSettings.json=json;callback(json)},"dataType":"json","cache":!1,"type":oSettings.sServerMethod,"error":function(xhr,error,thrown){var ret=_fnCallbackFire(oSettings,null,'xhr',[oSettings,null,oSettings.jqXHR]);if($.inArray(!0,ret)===-1){if(error=="parsererror"){_fnLog(oSettings,0,'Invalid JSON response',1)}
else if(xhr.readyState===4){_fnLog(oSettings,0,'Ajax error',7)}}
_fnProcessingDisplay(oSettings,!1)}};oSettings.oAjaxData=data;_fnCallbackFire(oSettings,null,'preXhr',[oSettings,data]);if(oSettings.fnServerData)
{oSettings.fnServerData.call(instance,oSettings.sAjaxSource,$.map(data,function(val,key){return{name:key,value:val}}),callback,oSettings)}
else if(oSettings.sAjaxSource||typeof ajax==='string')
{oSettings.jqXHR=$.ajax($.extend(baseAjax,{url:ajax||oSettings.sAjaxSource}))}
else if(typeof ajax==='function')
{oSettings.jqXHR=ajax.call(instance,data,callback,oSettings)}
else{oSettings.jqXHR=$.ajax($.extend(baseAjax,ajax));ajax.data=ajaxData}}
function _fnAjaxUpdate(settings)
{if(settings.bAjaxDataGet){settings.iDraw++;_fnProcessingDisplay(settings,!0);_fnBuildAjax(settings,_fnAjaxParameters(settings),function(json){_fnAjaxUpdateDraw(settings,json)});return!1}
return!0}
function _fnAjaxParameters(settings)
{var
columns=settings.aoColumns,columnCount=columns.length,features=settings.oFeatures,preSearch=settings.oPreviousSearch,preColSearch=settings.aoPreSearchCols,i,data=[],dataProp,column,columnSearch,sort=_fnSortFlatten(settings),displayStart=settings._iDisplayStart,displayLength=features.bPaginate!==!1?settings._iDisplayLength:-1;var param=function(name,value){data.push({'name':name,'value':value})};param('sEcho',settings.iDraw);param('iColumns',columnCount);param('sColumns',_pluck(columns,'sName').join(','));param('iDisplayStart',displayStart);param('iDisplayLength',displayLength);var d={draw:settings.iDraw,columns:[],order:[],start:displayStart,length:displayLength,search:{value:preSearch.sSearch,regex:preSearch.bRegex}};for(i=0;i<columnCount;i++){column=columns[i];columnSearch=preColSearch[i];dataProp=typeof column.mData=="function"?'function':column.mData;d.columns.push({data:dataProp,name:column.sName,searchable:column.bSearchable,orderable:column.bSortable,search:{value:columnSearch.sSearch,regex:columnSearch.bRegex}});param("mDataProp_"+i,dataProp);if(features.bFilter){param('sSearch_'+i,columnSearch.sSearch);param('bRegex_'+i,columnSearch.bRegex);param('bSearchable_'+i,column.bSearchable)}
if(features.bSort){param('bSortable_'+i,column.bSortable)}}
if(features.bFilter){param('sSearch',preSearch.sSearch);param('bRegex',preSearch.bRegex)}
if(features.bSort){$.each(sort,function(i,val){d.order.push({column:val.col,dir:val.dir});param('iSortCol_'+i,val.col);param('sSortDir_'+i,val.dir)});param('iSortingCols',sort.length)}
var legacy=DataTable.ext.legacy.ajax;if(legacy===null){return settings.sAjaxSource?data:d}
return legacy?data:d}
function _fnAjaxUpdateDraw(settings,json)
{var compat=function(old,modern){return json[old]!==undefined?json[old]:json[modern]};var data=_fnAjaxDataSrc(settings,json);var draw=compat('sEcho','draw');var recordsTotal=compat('iTotalRecords','recordsTotal');var recordsFiltered=compat('iTotalDisplayRecords','recordsFiltered');if(draw){if(draw*1<settings.iDraw){return}
settings.iDraw=draw*1}
_fnClearTable(settings);settings._iRecordsTotal=parseInt(recordsTotal,100);settings._iRecordsDisplay=parseInt(recordsFiltered,100);for(var i=0,ien=data.length;i<ien;i++){_fnAddData(settings,data[i])}
settings.aiDisplay=settings.aiDisplayMaster.slice();settings.bAjaxDataGet=!1;_fnDraw(settings);if(!settings._bInitComplete){_fnInitComplete(settings,json)}
settings.bAjaxDataGet=!0;_fnProcessingDisplay(settings,!1)}
function _fnAjaxDataSrc(oSettings,json)
{var dataSrc=$.isPlainObject(oSettings.ajax)&&oSettings.ajax.dataSrc!==undefined?oSettings.ajax.dataSrc:oSettings.sAjaxDataProp;if(dataSrc==='data'){return json.aaData||json[dataSrc]}
return dataSrc!==""?_fnGetObjectDataFn(dataSrc)(json):json}
function _fnFeatureHtmlFilter(settings)
{var classes=settings.oClasses;var tableId=settings.sTableId;var language=settings.oLanguage;var previousSearch=settings.oPreviousSearch;var features=settings.aanFeatures;var input='<input type="search" class="'+classes.sFilterInput+'"/>';var str=language.sSearch;str=str.match(/_INPUT_/)?str.replace('_INPUT_',input):str+input;var filter=$('<div/>',{'id':!features.f?tableId+'_filter':null,'class':classes.sFilter}).append($('<label/>').append(str));var searchFn=function(){var n=features.f;var val=!this.value?"":this.value;if(val!=previousSearch.sSearch){_fnFilterComplete(settings,{"sSearch":val,"bRegex":previousSearch.bRegex,"bSmart":previousSearch.bSmart,"bCaseInsensitive":previousSearch.bCaseInsensitive});settings._iDisplayStart=0;_fnDraw(settings)}};var searchDelay=settings.searchDelay!==null?settings.searchDelay:_fnDataSource(settings)==='ssp'?400:0;var jqFilter=$('input',filter).val(previousSearch.sSearch).attr('placeholder',language.sSearchPlaceholder).on('keyup.DT search.DT input.DT paste.DT cut.DT',searchDelay?_fnThrottle(searchFn,searchDelay):searchFn).on('keypress.DT',function(e){if(e.keyCode==13){return!1}}).attr('aria-controls',tableId);$(settings.nTable).on('search.dt.DT',function(ev,s){if(settings===s){try{if(jqFilter[0]!==document.activeElement){jqFilter.val(previousSearch.sSearch)}}
catch(e){}}});return filter[0]}
function _fnFilterComplete(oSettings,oInput,iForce)
{var oPrevSearch=oSettings.oPreviousSearch;var aoPrevSearch=oSettings.aoPreSearchCols;var fnSaveFilter=function(oFilter){oPrevSearch.sSearch=oFilter.sSearch;oPrevSearch.bRegex=oFilter.bRegex;oPrevSearch.bSmart=oFilter.bSmart;oPrevSearch.bCaseInsensitive=oFilter.bCaseInsensitive};var fnRegex=function(o){return o.bEscapeRegex!==undefined?!o.bEscapeRegex:o.bRegex};_fnColumnTypes(oSettings);if(_fnDataSource(oSettings)!='ssp')
{_fnFilter(oSettings,oInput.sSearch,iForce,fnRegex(oInput),oInput.bSmart,oInput.bCaseInsensitive);fnSaveFilter(oInput);for(var i=0;i<aoPrevSearch.length;i++)
{_fnFilterColumn(oSettings,aoPrevSearch[i].sSearch,i,fnRegex(aoPrevSearch[i]),aoPrevSearch[i].bSmart,aoPrevSearch[i].bCaseInsensitive)}
_fnFilterCustom(oSettings)}
else{fnSaveFilter(oInput)}
oSettings.bFiltered=!0;_fnCallbackFire(oSettings,null,'search',[oSettings])}
function _fnFilterCustom(settings)
{var filters=DataTable.ext.search;var displayRows=settings.aiDisplay;var row,rowIdx;for(var i=0,ien=filters.length;i<ien;i++){var rows=[];for(var j=0,jen=displayRows.length;j<jen;j++){rowIdx=displayRows[j];row=settings.aoData[rowIdx];if(filters[i](settings,row._aFilterData,rowIdx,row._aData,j)){rows.push(rowIdx)}}
displayRows.length=0;$.merge(displayRows,rows)}}
function _fnFilterColumn(settings,searchStr,colIdx,regex,smart,caseInsensitive)
{if(searchStr===''){return}
var data;var out=[];var display=settings.aiDisplay;var rpSearch=_fnFilterCreateSearch(searchStr,regex,smart,caseInsensitive);for(var i=0;i<display.length;i++){data=settings.aoData[display[i]]._aFilterData[colIdx];if(rpSearch.test(data)){out.push(display[i])}}
settings.aiDisplay=out}
function _fnFilter(settings,input,force,regex,smart,caseInsensitive)
{var rpSearch=_fnFilterCreateSearch(input,regex,smart,caseInsensitive);var prevSearch=settings.oPreviousSearch.sSearch;var displayMaster=settings.aiDisplayMaster;var display,invalidated,i;var filtered=[];if(DataTable.ext.search.length!==0){force=!0}
invalidated=_fnFilterData(settings);if(input.length<=0){settings.aiDisplay=displayMaster.slice()}
else{if(invalidated||force||prevSearch.length>input.length||input.indexOf(prevSearch)!==0||settings.bSorted){settings.aiDisplay=displayMaster.slice()}
display=settings.aiDisplay;for(i=0;i<display.length;i++){if(rpSearch.test(settings.aoData[display[i]]._sFilterRow)){filtered.push(display[i])}}
settings.aiDisplay=filtered}}
function _fnFilterCreateSearch(search,regex,smart,caseInsensitive)
{search=regex?search:_fnEscapeRegex(search);if(smart){var a=$.map(search.match(/"[^"]+"|[^ ]+/g)||[''],function(word){if(word.charAt(0)==='"'){var m=word.match(/^"(.*)"$/);word=m?m[1]:word}
return word.replace('"','')});search='^(?=.*?'+a.join(')(?=.*?')+').*$'}
return new RegExp(search,caseInsensitive?'i':'')}
var _fnEscapeRegex=DataTable.util.escapeRegex;var __filter_div=$('<div>')[0];var __filter_div_textContent=__filter_div.textContent!==undefined;function _fnFilterData(settings)
{var columns=settings.aoColumns;var column;var i,j,ien,jen,filterData,cellData,row;var fomatters=DataTable.ext.type.search;var wasInvalidated=!1;for(i=0,ien=settings.aoData.length;i<ien;i++){row=settings.aoData[i];if(!row._aFilterData){filterData=[];for(j=0,jen=columns.length;j<jen;j++){column=columns[j];if(column.bSearchable){cellData=_fnGetCellData(settings,i,j,'filter');if(fomatters[column.sType]){cellData=fomatters[column.sType](cellData)}
if(cellData===null){cellData=''}
if(typeof cellData!=='string'&&cellData.toString){cellData=cellData.toString()}}
else{cellData=''}
if(cellData.indexOf&&cellData.indexOf('&')!==-1){__filter_div.innerHTML=cellData;cellData=__filter_div_textContent?__filter_div.textContent:__filter_div.innerText}
if(cellData.replace){cellData=cellData.replace(/[\r\n]/g,'')}
filterData.push(cellData)}
row._aFilterData=filterData;row._sFilterRow=filterData.join('  ');wasInvalidated=!0}}
return wasInvalidated}
function _fnSearchToCamel(obj)
{return{search:obj.sSearch,smart:obj.bSmart,regex:obj.bRegex,caseInsensitive:obj.bCaseInsensitive}}
function _fnSearchToHung(obj)
{return{sSearch:obj.search,bSmart:obj.smart,bRegex:obj.regex,bCaseInsensitive:obj.caseInsensitive}}
function _fnFeatureHtmlInfo(settings)
{var
tid=settings.sTableId,nodes=settings.aanFeatures.i,n=$('<div/>',{'class':settings.oClasses.sInfo,'id':!nodes?tid+'_info':null});if(!nodes){settings.aoDrawCallback.push({"fn":_fnUpdateInfo,"sName":"information"});n.attr('role','status').attr('aria-live','polite');$(settings.nTable).attr('aria-describedby',tid+'_info')}
return n[0]}
function _fnUpdateInfo(settings)
{var nodes=settings.aanFeatures.i;if(nodes.length===0){return}
var lang=settings.oLanguage,start=settings._iDisplayStart+1,end=settings.fnDisplayEnd(),max=settings.fnRecordsTotal(),total=settings.fnRecordsDisplay(),out=total?lang.sInfo:lang.sInfoEmpty;if(total!==max){out+=' '+lang.sInfoFiltered}
out+=lang.sInfoPostFix;out=_fnInfoMacros(settings,out);var callback=lang.fnInfoCallback;if(callback!==null){out=callback.call(settings.oInstance,settings,start,end,max,total,out)}
$(nodes).html(out)}
function _fnInfoMacros(settings,str)
{var
formatter=settings.fnFormatNumber,start=settings._iDisplayStart+1,len=settings._iDisplayLength,vis=settings.fnRecordsDisplay(),all=len===-1;return str.replace(/_START_/g,formatter.call(settings,start)).replace(/_END_/g,formatter.call(settings,settings.fnDisplayEnd())).replace(/_MAX_/g,formatter.call(settings,settings.fnRecordsTotal())).replace(/_TOTAL_/g,formatter.call(settings,vis)).replace(/_PAGE_/g,formatter.call(settings,all?1:Math.ceil(start/len))).replace(/_PAGES_/g,formatter.call(settings,all?1:Math.ceil(vis/len)))}
function _fnInitialise(settings)
{var i,iLen,iAjaxStart=settings.iInitDisplayStart;var columns=settings.aoColumns,column;var features=settings.oFeatures;var deferLoading=settings.bDeferLoading;if(!settings.bInitialised){setTimeout(function(){_fnInitialise(settings)},200);return}
_fnAddOptionsHtml(settings);_fnBuildHead(settings);_fnDrawHead(settings,settings.aoHeader);_fnDrawHead(settings,settings.aoFooter);_fnProcessingDisplay(settings,!0);if(features.bAutoWidth){_fnCalculateColumnWidths(settings)}
for(i=0,iLen=columns.length;i<iLen;i++){column=columns[i];if(column.sWidth){column.nTh.style.width=_fnStringToCss(column.sWidth)}}
_fnCallbackFire(settings,null,'preInit',[settings]);_fnReDraw(settings);var dataSrc=_fnDataSource(settings);if(dataSrc!='ssp'||deferLoading){if(dataSrc=='ajax'){_fnBuildAjax(settings,[],function(json){var aData=_fnAjaxDataSrc(settings,json);for(i=0;i<aData.length;i++){_fnAddData(settings,aData[i])}
settings.iInitDisplayStart=iAjaxStart;_fnReDraw(settings);_fnProcessingDisplay(settings,!1);_fnInitComplete(settings,json)},settings)}
else{_fnProcessingDisplay(settings,!1);_fnInitComplete(settings)}}}
function _fnInitComplete(settings,json)
{settings._bInitComplete=!0;if(json||settings.oInit.aaData){_fnAdjustColumnSizing(settings)}
_fnCallbackFire(settings,null,'plugin-init',[settings,json]);_fnCallbackFire(settings,'aoInitComplete','init',[settings,json])}
function _fnLengthChange(settings,val)
{var len=parseInt(val,100);settings._iDisplayLength=len;_fnLengthOverflow(settings);_fnCallbackFire(settings,null,'length',[settings,len])}
function _fnFeatureHtmlLength(settings)
{var
classes=settings.oClasses,tableId=settings.sTableId,menu=settings.aLengthMenu,d2=$.isArray(menu[0]),lengths=d2?menu[0]:menu,language=d2?menu[1]:menu;var select=$('<select/>',{'name':tableId+'_length','aria-controls':tableId,'class':classes.sLengthSelect});for(var i=0,ien=lengths.length;i<ien;i++){select[0][i]=new Option(typeof language[i]==='number'?settings.fnFormatNumber(language[i]):language[i],lengths[i])}
var div=$('<div><label/></div>').addClass(classes.sLength);if(!settings.aanFeatures.l){div[0].id=tableId+'_length'}
div.children().append(settings.oLanguage.sLengthMenu.replace('_MENU_',select[0].outerHTML));$('select',div).val(settings._iDisplayLength).on('change.DT',function(e){_fnLengthChange(settings,$(this).val());_fnDraw(settings)});$(settings.nTable).on('length.dt.DT',function(e,s,len){if(settings===s){$('select',div).val(len)}});return div[0]}
function _fnFeatureHtmlPaginate(settings)
{var
type=settings.sPaginationType,plugin=DataTable.ext.pager[type],modern=typeof plugin==='function',redraw=function(settings){_fnDraw(settings)},node=$('<div/>').addClass(settings.oClasses.sPaging+type)[0],features=settings.aanFeatures;if(!modern){plugin.fnInit(settings,node,redraw)}
if(!features.p)
{node.id=settings.sTableId+'_paginate';settings.aoDrawCallback.push({"fn":function(settings){if(modern){var
start=settings._iDisplayStart,len=settings._iDisplayLength,visRecords=settings.fnRecordsDisplay(),all=len===-1,page=all?0:Math.ceil(start/len),pages=all?1:Math.ceil(visRecords/len),buttons=plugin(page,pages),i,ien;for(i=0,ien=features.p.length;i<ien;i++){_fnRenderer(settings,'pageButton')(settings,features.p[i],i,buttons,page,pages)}}
else{plugin.fnUpdate(settings,redraw)}},"sName":"pagination"})}
return node}
function _fnPageChange(settings,action,redraw)
{var
start=settings._iDisplayStart,len=settings._iDisplayLength,records=settings.fnRecordsDisplay();if(records===0||len===-1)
{start=0}
else if(typeof action==="number")
{start=action*len;if(start>records)
{start=0}}
else if(action=="first")
{start=0}
else if(action=="previous")
{start=len>=0?start-len:0;if(start<0)
{start=0}}
else if(action=="next")
{if(start+len<records)
{start+=len}}
else if(action=="last")
{start=Math.floor((records-1)/len)*len}
else{_fnLog(settings,0,"Unknown paging action: "+action,5)}
var changed=settings._iDisplayStart!==start;settings._iDisplayStart=start;if(changed){_fnCallbackFire(settings,null,'page',[settings]);if(redraw){_fnDraw(settings)}}
return changed}
function _fnFeatureHtmlProcessing(settings)
{return $('<div/>',{'id':!settings.aanFeatures.r?settings.sTableId+'_processing':null,'class':settings.oClasses.sProcessing}).html(settings.oLanguage.sProcessing).insertBefore(settings.nTable)[0]}
function _fnProcessingDisplay(settings,show)
{if(settings.oFeatures.bProcessing){$(settings.aanFeatures.r).css('display',show?'block':'none')}
_fnCallbackFire(settings,null,'processing',[settings,show])}
function _fnFeatureHtmlTable(settings)
{var table=$(settings.nTable);table.attr('role','grid');var scroll=settings.oScroll;if(scroll.sX===''&&scroll.sY===''){return settings.nTable}
var scrollX=scroll.sX;var scrollY=scroll.sY;var classes=settings.oClasses;var caption=table.children('caption');var captionSide=caption.length?caption[0]._captionSide:null;var headerClone=$(table[0].cloneNode(!1));var footerClone=$(table[0].cloneNode(!1));var footer=table.children('tfoot');var _div='<div/>';var size=function(s){return!s?null:_fnStringToCss(s)};if(!footer.length){footer=null}
var scroller=$(_div,{'class':classes.sScrollWrapper}).append($(_div,{'class':classes.sScrollHead}).css({overflow:'hidden',position:'relative',border:0,width:scrollX?size(scrollX):'100%'}).append($(_div,{'class':classes.sScrollHeadInner}).css({'box-sizing':'content-box',width:scroll.sXInner||'100%'}).append(headerClone.removeAttr('id').css('margin-left',0).append(captionSide==='top'?caption:null).append(table.children('thead'))))).append($(_div,{'class':classes.sScrollBody}).css({position:'relative',overflow:'auto',width:size(scrollX)}).append(table));if(footer){scroller.append($(_div,{'class':classes.sScrollFoot}).css({overflow:'hidden',border:0,width:scrollX?size(scrollX):'100%'}).append($(_div,{'class':classes.sScrollFootInner}).append(footerClone.removeAttr('id').css('margin-left',0).append(captionSide==='bottom'?caption:null).append(table.children('tfoot')))))}
var children=scroller.children();var scrollHead=children[0];var scrollBody=children[1];var scrollFoot=footer?children[2]:null;if(scrollX){$(scrollBody).on('scroll.DT',function(e){var scrollLeft=this.scrollLeft;scrollHead.scrollLeft=scrollLeft;if(footer){scrollFoot.scrollLeft=scrollLeft}})}
$(scrollBody).css(scrollY&&scroll.bCollapse?'max-height':'height',scrollY);settings.nScrollHead=scrollHead;settings.nScrollBody=scrollBody;settings.nScrollFoot=scrollFoot;settings.aoDrawCallback.push({"fn":_fnScrollDraw,"sName":"scrolling"});return scroller[0]}
function _fnScrollDraw(settings)
{var
scroll=settings.oScroll,scrollX=scroll.sX,scrollXInner=scroll.sXInner,scrollY=scroll.sY,barWidth=scroll.iBarWidth,divHeader=$(settings.nScrollHead),divHeaderStyle=divHeader[0].style,divHeaderInner=divHeader.children('div'),divHeaderInnerStyle=divHeaderInner[0].style,divHeaderTable=divHeaderInner.children('table'),divBodyEl=settings.nScrollBody,divBody=$(divBodyEl),divBodyStyle=divBodyEl.style,divFooter=$(settings.nScrollFoot),divFooterInner=divFooter.children('div'),divFooterTable=divFooterInner.children('table'),header=$(settings.nTHead),table=$(settings.nTable),tableEl=table[0],tableStyle=tableEl.style,footer=settings.nTFoot?$(settings.nTFoot):null,browser=settings.oBrowser,ie67=browser.bScrollOversize,dtHeaderCells=_pluck(settings.aoColumns,'nTh'),headerTrgEls,footerTrgEls,headerSrcEls,footerSrcEls,headerCopy,footerCopy,headerWidths=[],footerWidths=[],headerContent=[],footerContent=[],idx,correction,sanityWidth,zeroOut=function(nSizer){var style=nSizer.style;style.paddingTop="0";style.paddingBottom="0";style.borderTopWidth="0";style.borderBottomWidth="0";style.height=0};var scrollBarVis=divBodyEl.scrollHeight>divBodyEl.clientHeight;if(settings.scrollBarVis!==scrollBarVis&&settings.scrollBarVis!==undefined){settings.scrollBarVis=scrollBarVis;_fnAdjustColumnSizing(settings);return}
else{settings.scrollBarVis=scrollBarVis}
table.children('thead, tfoot').remove();if(footer){footerCopy=footer.clone().prependTo(table);footerTrgEls=footer.find('tr');footerSrcEls=footerCopy.find('tr')}
headerCopy=header.clone().prependTo(table);headerTrgEls=header.find('tr');headerSrcEls=headerCopy.find('tr');headerCopy.find('th, td').removeAttr('tabindex');if(!scrollX)
{divBodyStyle.width='100%';divHeader[0].style.width='100%'}
$.each(_fnGetUniqueThs(settings,headerCopy),function(i,el){idx=_fnVisibleToColumnIndex(settings,i);el.style.width=settings.aoColumns[idx].sWidth});if(footer){_fnApplyToChildren(function(n){n.style.width=""},footerSrcEls)}
sanityWidth=table.outerWidth();if(scrollX===""){tableStyle.width="100%";if(ie67&&(table.find('tbody').height()>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll")){tableStyle.width=_fnStringToCss(table.outerWidth()-barWidth)}
sanityWidth=table.outerWidth()}
else if(scrollXInner!==""){tableStyle.width=_fnStringToCss(scrollXInner);sanityWidth=table.outerWidth()}
_fnApplyToChildren(zeroOut,headerSrcEls);_fnApplyToChildren(function(nSizer){headerContent.push(nSizer.innerHTML);headerWidths.push(_fnStringToCss($(nSizer).css('width')))},headerSrcEls);_fnApplyToChildren(function(nToSize,i){if($.inArray(nToSize,dtHeaderCells)!==-1){nToSize.style.width=headerWidths[i]}},headerTrgEls);$(headerSrcEls).height(0);if(footer)
{_fnApplyToChildren(zeroOut,footerSrcEls);_fnApplyToChildren(function(nSizer){footerContent.push(nSizer.innerHTML);footerWidths.push(_fnStringToCss($(nSizer).css('width')))},footerSrcEls);_fnApplyToChildren(function(nToSize,i){nToSize.style.width=footerWidths[i]},footerTrgEls);$(footerSrcEls).height(0)}
_fnApplyToChildren(function(nSizer,i){nSizer.innerHTML='<div class="dataTables_sizing">'+headerContent[i]+'</div>';nSizer.childNodes[0].style.height="0";nSizer.childNodes[0].style.overflow="hidden";nSizer.style.width=headerWidths[i]},headerSrcEls);if(footer)
{_fnApplyToChildren(function(nSizer,i){nSizer.innerHTML='<div class="dataTables_sizing">'+footerContent[i]+'</div>';nSizer.childNodes[0].style.height="0";nSizer.childNodes[0].style.overflow="hidden";nSizer.style.width=footerWidths[i]},footerSrcEls)}
if(table.outerWidth()<sanityWidth)
{correction=((divBodyEl.scrollHeight>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll"))?sanityWidth+barWidth:sanityWidth;if(ie67&&(divBodyEl.scrollHeight>divBodyEl.offsetHeight||divBody.css('overflow-y')=="scroll")){tableStyle.width=_fnStringToCss(correction-barWidth)}
if(scrollX===""||scrollXInner!==""){_fnLog(settings,1,'Possible column misalignment',6)}}
else{correction='100%'}
divBodyStyle.width=_fnStringToCss(correction);divHeaderStyle.width=_fnStringToCss(correction);if(footer){settings.nScrollFoot.style.width=_fnStringToCss(correction)}
if(!scrollY){if(ie67){divBodyStyle.height=_fnStringToCss(tableEl.offsetHeight+barWidth)}}
var iOuterWidth=table.outerWidth();divHeaderTable[0].style.width=_fnStringToCss(iOuterWidth);divHeaderInnerStyle.width=_fnStringToCss(iOuterWidth);var bScrolling=table.height()>divBodyEl.clientHeight||divBody.css('overflow-y')=="scroll";var padding='padding'+(browser.bScrollbarLeft?'Left':'Right');divHeaderInnerStyle[padding]=bScrolling?barWidth+"px":"0px";if(footer){divFooterTable[0].style.width=_fnStringToCss(iOuterWidth);divFooterInner[0].style.width=_fnStringToCss(iOuterWidth);divFooterInner[0].style[padding]=bScrolling?barWidth+"px":"0px"}
table.children('colgroup').insertBefore(table.children('thead'));divBody.scroll();if((settings.bSorted||settings.bFiltered)&&!settings._drawHold){divBodyEl.scrollTop=0}}
function _fnApplyToChildren(fn,an1,an2)
{var index=0,i=0,iLen=an1.length;var nNode1,nNode2;while(i<iLen){nNode1=an1[i].firstChild;nNode2=an2?an2[i].firstChild:null;while(nNode1){if(nNode1.nodeType===1){if(an2){fn(nNode1,nNode2,index)}
else{fn(nNode1,index)}
index++}
nNode1=nNode1.nextSibling;nNode2=an2?nNode2.nextSibling:null}
i++}}
var __re_html_remove=/<.*?>/g;function _fnCalculateColumnWidths(oSettings)
{var
table=oSettings.nTable,columns=oSettings.aoColumns,scroll=oSettings.oScroll,scrollY=scroll.sY,scrollX=scroll.sX,scrollXInner=scroll.sXInner,columnCount=columns.length,visibleColumns=_fnGetColumns(oSettings,'bVisible'),headerCells=$('th',oSettings.nTHead),tableWidthAttr=table.getAttribute('width'),tableContainer=table.parentNode,userInputs=!1,i,column,columnIdx,width,outerWidth,browser=oSettings.oBrowser,ie67=browser.bScrollOversize;var styleWidth=table.style.width;if(styleWidth&&styleWidth.indexOf('%')!==-1){tableWidthAttr=styleWidth}
for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];if(column.sWidth!==null){column.sWidth=_fnConvertToWidth(column.sWidthOrig,tableContainer);userInputs=!0}}
if(ie67||!userInputs&&!scrollX&&!scrollY&&columnCount==_fnVisbleColumns(oSettings)&&columnCount==headerCells.length){for(i=0;i<columnCount;i++){var colIdx=_fnVisibleToColumnIndex(oSettings,i);if(colIdx!==null){columns[colIdx].sWidth=_fnStringToCss(headerCells.eq(i).width())}}}
else{var tmpTable=$(table).clone().css('visibility','hidden').removeAttr('id');tmpTable.find('tbody tr').remove();var tr=$('<tr/>').appendTo(tmpTable.find('tbody'));tmpTable.find('thead, tfoot').remove();tmpTable.append($(oSettings.nTHead).clone()).append($(oSettings.nTFoot).clone());tmpTable.find('tfoot th, tfoot td').css('width','');headerCells=_fnGetUniqueThs(oSettings,tmpTable.find('thead')[0]);for(i=0;i<visibleColumns.length;i++){column=columns[visibleColumns[i]];headerCells[i].style.width=column.sWidthOrig!==null&&column.sWidthOrig!==''?_fnStringToCss(column.sWidthOrig):'';if(column.sWidthOrig&&scrollX){$(headerCells[i]).append($('<div/>').css({width:column.sWidthOrig,margin:0,padding:0,border:0,height:1}))}}
if(oSettings.aoData.length){for(i=0;i<visibleColumns.length;i++){columnIdx=visibleColumns[i];column=columns[columnIdx];$(_fnGetWidestNode(oSettings,columnIdx)).clone(!1).append(column.sContentPadding).appendTo(tr)}}
$('[name]',tmpTable).removeAttr('name');var holder=$('<div/>').css(scrollX||scrollY?{position:'absolute',top:0,left:0,height:1,right:0,overflow:'hidden'}:{}).append(tmpTable).appendTo(tableContainer);if(scrollX&&scrollXInner){tmpTable.width(scrollXInner)}
else if(scrollX){tmpTable.css('width','auto');tmpTable.removeAttr('width');if(tmpTable.width()<tableContainer.clientWidth&&tableWidthAttr){tmpTable.width(tableContainer.clientWidth)}}
else if(scrollY){tmpTable.width(tableContainer.clientWidth)}
else if(tableWidthAttr){tmpTable.width(tableWidthAttr)}
var total=0;for(i=0;i<visibleColumns.length;i++){var cell=$(headerCells[i]);var border=cell.outerWidth()-cell.width();var bounding=browser.bBounding?Math.ceil(headerCells[i].getBoundingClientRect().width):cell.outerWidth();total+=bounding;columns[visibleColumns[i]].sWidth=_fnStringToCss(bounding-border)}
table.style.width=_fnStringToCss(total);holder.remove()}
if(tableWidthAttr){table.style.width=_fnStringToCss(tableWidthAttr)}
if((tableWidthAttr||scrollX)&&!oSettings._reszEvt){var bindResize=function(){$(window).on('resize.DT-'+oSettings.sInstance,_fnThrottle(function(){_fnAdjustColumnSizing(oSettings)}))};if(ie67){setTimeout(bindResize,1000)}
else{bindResize()}
oSettings._reszEvt=!0}}
var _fnThrottle=DataTable.util.throttle;function _fnConvertToWidth(width,parent)
{if(!width){return 0}
var n=$('<div/>').css('width',_fnStringToCss(width)).appendTo(parent||document.body);var val=n[0].offsetWidth;n.remove();return val}
function _fnGetWidestNode(settings,colIdx)
{var idx=_fnGetMaxLenString(settings,colIdx);if(idx<0){return null}
var data=settings.aoData[idx];return!data.nTr?$('<td/>').html(_fnGetCellData(settings,idx,colIdx,'display'))[0]:data.anCells[colIdx]}
function _fnGetMaxLenString(settings,colIdx)
{var s,max=-1,maxIdx=-1;for(var i=0,ien=settings.aoData.length;i<ien;i++){s=_fnGetCellData(settings,i,colIdx,'display')+'';s=s.replace(__re_html_remove,'');s=s.replace(/&nbsp;/g,' ');if(s.length>max){max=s.length;maxIdx=i}}
return maxIdx}
function _fnStringToCss(s)
{if(s===null){return'0px'}
if(typeof s=='number'){return s<0?'0px':s+'px'}
return s.match(/\d$/)?s+'px':s}
function _fnSortFlatten(settings)
{var
i,iLen,k,kLen,aSort=[],aiOrig=[],aoColumns=settings.aoColumns,aDataSort,iCol,sType,srcCol,fixed=settings.aaSortingFixed,fixedObj=$.isPlainObject(fixed),nestedSort=[],add=function(a){if(a.length&&!$.isArray(a[0])){nestedSort.push(a)}
else{$.merge(nestedSort,a)}};if($.isArray(fixed)){add(fixed)}
if(fixedObj&&fixed.pre){add(fixed.pre)}
add(settings.aaSorting);if(fixedObj&&fixed.post){add(fixed.post)}
for(i=0;i<nestedSort.length;i++)
{srcCol=nestedSort[i][0];aDataSort=aoColumns[srcCol].aDataSort;for(k=0,kLen=aDataSort.length;k<kLen;k++)
{iCol=aDataSort[k];sType=aoColumns[iCol].sType||'string';if(nestedSort[i]._idx===undefined){nestedSort[i]._idx=$.inArray(nestedSort[i][1],aoColumns[iCol].asSorting)}
aSort.push({src:srcCol,col:iCol,dir:nestedSort[i][1],index:nestedSort[i]._idx,type:sType,formatter:DataTable.ext.type.order[sType+"-pre"]})}}
return aSort}
function _fnSort(oSettings)
{var
i,ien,iLen,j,jLen,k,kLen,sDataType,nTh,aiOrig=[],oExtSort=DataTable.ext.type.order,aoData=oSettings.aoData,aoColumns=oSettings.aoColumns,aDataSort,data,iCol,sType,oSort,formatters=0,sortCol,displayMaster=oSettings.aiDisplayMaster,aSort;_fnColumnTypes(oSettings);aSort=_fnSortFlatten(oSettings);for(i=0,ien=aSort.length;i<ien;i++){sortCol=aSort[i];if(sortCol.formatter){formatters++}
_fnSortData(oSettings,sortCol.col)}
if(_fnDataSource(oSettings)!='ssp'&&aSort.length!==0)
{for(i=0,iLen=displayMaster.length;i<iLen;i++){aiOrig[displayMaster[i]]=i}
if(formatters===aSort.length){displayMaster.sort(function(a,b){var
x,y,k,test,sort,len=aSort.length,dataA=aoData[a]._aSortData,dataB=aoData[b]._aSortData;for(k=0;k<len;k++){sort=aSort[k];x=dataA[sort.col];y=dataB[sort.col];test=x<y?-1:x>y?1:0;if(test!==0){return sort.dir==='asc'?test:-test}}
x=aiOrig[a];y=aiOrig[b];return x<y?-1:x>y?1:0})}
else{displayMaster.sort(function(a,b){var
x,y,k,l,test,sort,fn,len=aSort.length,dataA=aoData[a]._aSortData,dataB=aoData[b]._aSortData;for(k=0;k<len;k++){sort=aSort[k];x=dataA[sort.col];y=dataB[sort.col];fn=oExtSort[sort.type+"-"+sort.dir]||oExtSort["string-"+sort.dir];test=fn(x,y);if(test!==0){return test}}
x=aiOrig[a];y=aiOrig[b];return x<y?-1:x>y?1:0})}}
oSettings.bSorted=!0}
function _fnSortAria(settings)
{var label;var nextSort;var columns=settings.aoColumns;var aSort=_fnSortFlatten(settings);var oAria=settings.oLanguage.oAria;for(var i=0,iLen=columns.length;i<iLen;i++)
{var col=columns[i];var asSorting=col.asSorting;var sTitle=col.sTitle.replace(/<.*?>/g,"");var th=col.nTh;th.removeAttribute('aria-sort');if(col.bSortable){if(aSort.length>0&&aSort[0].col==i){th.setAttribute('aria-sort',aSort[0].dir=="asc"?"ascending":"descending");nextSort=asSorting[aSort[0].index+1]||asSorting[0]}
else{nextSort=asSorting[0]}
label=sTitle+(nextSort==="asc"?oAria.sSortAscending:oAria.sSortDescending)}
else{label=sTitle}
th.setAttribute('aria-label',label)}}
function _fnSortListener(settings,colIdx,append,callback)
{var col=settings.aoColumns[colIdx];var sorting=settings.aaSorting;var asSorting=col.asSorting;var nextSortIdx;var next=function(a,overflow){var idx=a._idx;if(idx===undefined){idx=$.inArray(a[1],asSorting)}
return idx+1<asSorting.length?idx+1:overflow?null:0};if(typeof sorting[0]==='number'){sorting=settings.aaSorting=[sorting]}
if(append&&settings.oFeatures.bSortMulti){var sortIdx=$.inArray(colIdx,_pluck(sorting,'0'));if(sortIdx!==-1){nextSortIdx=next(sorting[sortIdx],!0);if(nextSortIdx===null&&sorting.length===1){nextSortIdx=0}
if(nextSortIdx===null){sorting.splice(sortIdx,1)}
else{sorting[sortIdx][1]=asSorting[nextSortIdx];sorting[sortIdx]._idx=nextSortIdx}}
else{sorting.push([colIdx,asSorting[0],0]);sorting[sorting.length-1]._idx=0}}
else if(sorting.length&&sorting[0][0]==colIdx){nextSortIdx=next(sorting[0]);sorting.length=1;sorting[0][1]=asSorting[nextSortIdx];sorting[0]._idx=nextSortIdx}
else{sorting.length=0;sorting.push([colIdx,asSorting[0]]);sorting[0]._idx=0}
_fnReDraw(settings);if(typeof callback=='function'){callback(settings)}}
function _fnSortAttachListener(settings,attachTo,colIdx,callback)
{var col=settings.aoColumns[colIdx];_fnBindAction(attachTo,{},function(e){if(col.bSortable===!1){return}
if(settings.oFeatures.bProcessing){_fnProcessingDisplay(settings,!0);setTimeout(function(){_fnSortListener(settings,colIdx,e.shiftKey,callback);if(_fnDataSource(settings)!=='ssp'){_fnProcessingDisplay(settings,!1)}},0)}
else{_fnSortListener(settings,colIdx,e.shiftKey,callback)}})}
function _fnSortingClasses(settings)
{var oldSort=settings.aLastSort;var sortClass=settings.oClasses.sSortColumn;var sort=_fnSortFlatten(settings);var features=settings.oFeatures;var i,ien,colIdx;if(features.bSort&&features.bSortClasses){for(i=0,ien=oldSort.length;i<ien;i++){colIdx=oldSort[i].src;$(_pluck(settings.aoData,'anCells',colIdx)).removeClass(sortClass+(i<2?i+1:3))}
for(i=0,ien=sort.length;i<ien;i++){colIdx=sort[i].src;$(_pluck(settings.aoData,'anCells',colIdx)).addClass(sortClass+(i<2?i+1:3))}}
settings.aLastSort=sort}
function _fnSortData(settings,idx)
{var column=settings.aoColumns[idx];var customSort=DataTable.ext.order[column.sSortDataType];var customData;if(customSort){customData=customSort.call(settings.oInstance,settings,idx,_fnColumnIndexToVisible(settings,idx))}
var row,cellData;var formatter=DataTable.ext.type.order[column.sType+"-pre"];for(var i=0,ien=settings.aoData.length;i<ien;i++){row=settings.aoData[i];if(!row._aSortData){row._aSortData=[]}
if(!row._aSortData[idx]||customSort){cellData=customSort?customData[i]:_fnGetCellData(settings,i,idx,'sort');row._aSortData[idx]=formatter?formatter(cellData):cellData}}}
function _fnSaveState(settings)
{if(!settings.oFeatures.bStateSave||settings.bDestroying)
{return}
var state={time:+new Date(),start:settings._iDisplayStart,length:settings._iDisplayLength,order:$.extend(!0,[],settings.aaSorting),search:_fnSearchToCamel(settings.oPreviousSearch),columns:$.map(settings.aoColumns,function(col,i){return{visible:col.bVisible,search:_fnSearchToCamel(settings.aoPreSearchCols[i])}})};_fnCallbackFire(settings,"aoStateSaveParams",'stateSaveParams',[settings,state]);settings.oSavedState=state;settings.fnStateSaveCallback.call(settings.oInstance,settings,state)}
function _fnLoadState(settings,oInit,callback)
{var i,ien;var columns=settings.aoColumns;var loaded=function(s){if(!s||!s.time){callback();return}
var abStateLoad=_fnCallbackFire(settings,'aoStateLoadParams','stateLoadParams',[settings,s]);if($.inArray(!1,abStateLoad)!==-1){callback();return}
var duration=settings.iStateDuration;if(duration>0&&s.time<+new Date()-(duration*1000)){callback();return}
if(s.columns&&columns.length!==s.columns.length){callback();return}
settings.oLoadedState=$.extend(!0,{},s);if(s.start!==undefined){settings._iDisplayStart=s.start;settings.iInitDisplayStart=s.start}
if(s.length!==undefined){settings._iDisplayLength=s.length}
if(s.order!==undefined){settings.aaSorting=[];$.each(s.order,function(i,col){settings.aaSorting.push(col[0]>=columns.length?[0,col[1]]:col)})}
if(s.search!==undefined){$.extend(settings.oPreviousSearch,_fnSearchToHung(s.search))}
if(s.columns){for(i=0,ien=s.columns.length;i<ien;i++){var col=s.columns[i];if(col.visible!==undefined){columns[i].bVisible=col.visible}
if(col.search!==undefined){$.extend(settings.aoPreSearchCols[i],_fnSearchToHung(col.search))}}}
_fnCallbackFire(settings,'aoStateLoaded','stateLoaded',[settings,s]);callback()}
if(!settings.oFeatures.bStateSave){callback();return}
var state=settings.fnStateLoadCallback.call(settings.oInstance,settings,loaded);if(state!==undefined){loaded(state)}}
function _fnSettingsFromNode(table)
{var settings=DataTable.settings;var idx=$.inArray(table,_pluck(settings,'nTable'));return idx!==-1?settings[idx]:null}
function _fnLog(settings,level,msg,tn)
{msg='DataTables warning: '+(settings?'table id='+settings.sTableId+' - ':'')+msg;if(tn){msg+='. For more information about this error, please see '+'http://datatables.net/tn/'+tn}
if(!level){var ext=DataTable.ext;var type=ext.sErrMode||ext.errMode;if(settings){_fnCallbackFire(settings,null,'error',[settings,tn,msg])}
if(type=='alert'){alert(msg)}
else if(type=='throw'){throw new Error(msg)}
else if(typeof type=='function'){type(settings,tn,msg)}}
else if(window.console&&console.log){console.log(msg)}}
function _fnMap(ret,src,name,mappedName)
{if($.isArray(name)){$.each(name,function(i,val){if($.isArray(val)){_fnMap(ret,src,val[0],val[1])}
else{_fnMap(ret,src,val)}});return}
if(mappedName===undefined){mappedName=name}
if(src[name]!==undefined){ret[mappedName]=src[name]}}
function _fnExtend(out,extender,breakRefs)
{var val;for(var prop in extender){if(extender.hasOwnProperty(prop)){val=extender[prop];if($.isPlainObject(val)){if(!$.isPlainObject(out[prop])){out[prop]={}}
$.extend(!0,out[prop],val)}
else if(breakRefs&&prop!=='data'&&prop!=='aaData'&&$.isArray(val)){out[prop]=val.slice()}
else{out[prop]=val}}}
return out}
function _fnBindAction(n,oData,fn)
{$(n).on('click.DT',oData,function(e){$(n).blur();fn(e)}).on('keypress.DT',oData,function(e){if(e.which===13){e.preventDefault();fn(e)}}).on('selectstart.DT',function(){return!1})}
function _fnCallbackReg(oSettings,sStore,fn,sName)
{if(fn)
{oSettings[sStore].push({"fn":fn,"sName":sName})}}
function _fnCallbackFire(settings,callbackArr,eventName,args)
{var ret=[];if(callbackArr){ret=$.map(settings[callbackArr].slice().reverse(),function(val,i){return val.fn.apply(settings.oInstance,args)})}
if(eventName!==null){var e=$.Event(eventName+'.dt');$(settings.nTable).trigger(e,args);ret.push(e.result)}
return ret}
function _fnLengthOverflow(settings)
{var
start=settings._iDisplayStart,end=settings.fnDisplayEnd(),len=settings._iDisplayLength;if(start>=end)
{start=end-len}
start-=(start%len);if(len===-1||start<0)
{start=0}
settings._iDisplayStart=start}
function _fnRenderer(settings,type)
{var renderer=settings.renderer;var host=DataTable.ext.renderer[type];if($.isPlainObject(renderer)&&renderer[type]){return host[renderer[type]]||host._}
else if(typeof renderer==='string'){return host[renderer]||host._}
return host._}
function _fnDataSource(settings)
{if(settings.oFeatures.bServerSide){return'ssp'}
else if(settings.ajax||settings.sAjaxSource){return'ajax'}
return'dom'}
var __apiStruct=[];var __arrayProto=Array.prototype;var _toSettings=function(mixed)
{var idx,jq;var settings=DataTable.settings;var tables=$.map(settings,function(el,i){return el.nTable});if(!mixed){return[]}
else if(mixed.nTable&&mixed.oApi){return[mixed]}
else if(mixed.nodeName&&mixed.nodeName.toLowerCase()==='table'){idx=$.inArray(mixed,tables);return idx!==-1?[settings[idx]]:null}
else if(mixed&&typeof mixed.settings==='function'){return mixed.settings().toArray()}
else if(typeof mixed==='string'){jq=$(mixed)}
else if(mixed instanceof $){jq=mixed}
if(jq){return jq.map(function(i){idx=$.inArray(this,tables);return idx!==-1?settings[idx]:null}).toArray()}};_Api=function(context,data)
{if(!(this instanceof _Api)){return new _Api(context,data)}
var settings=[];var ctxSettings=function(o){var a=_toSettings(o);if(a){settings=settings.concat(a)}};if($.isArray(context)){for(var i=0,ien=context.length;i<ien;i++){ctxSettings(context[i])}}
else{ctxSettings(context)}
this.context=_unique(settings);if(data){$.merge(this,data)}
this.selector={rows:null,cols:null,opts:null};_Api.extend(this,this,__apiStruct)};DataTable.Api=_Api;$.extend(_Api.prototype,{any:function()
{return this.count()!==0},concat:__arrayProto.concat,context:[],count:function()
{return this.flatten().length},each:function(fn)
{for(var i=0,ien=this.length;i<ien;i++){fn.call(this,this[i],i,this)}
return this},eq:function(idx)
{var ctx=this.context;return ctx.length>idx?new _Api(ctx[idx],this[idx]):null},filter:function(fn)
{var a=[];if(__arrayProto.filter){a=__arrayProto.filter.call(this,fn,this)}
else{for(var i=0,ien=this.length;i<ien;i++){if(fn.call(this,this[i],i,this)){a.push(this[i])}}}
return new _Api(this.context,a)},flatten:function()
{var a=[];return new _Api(this.context,a.concat.apply(a,this.toArray()))},join:__arrayProto.join,indexOf:__arrayProto.indexOf||function(obj,start)
{for(var i=(start||0),ien=this.length;i<ien;i++){if(this[i]===obj){return i}}
return-1},iterator:function(flatten,type,fn,alwaysNew){var
a=[],ret,i,ien,j,jen,context=this.context,rows,items,item,selector=this.selector;if(typeof flatten==='string'){alwaysNew=fn;fn=type;type=flatten;flatten=!1}
for(i=0,ien=context.length;i<ien;i++){var apiInst=new _Api(context[i]);if(type==='table'){ret=fn.call(apiInst,context[i],i);if(ret!==undefined){a.push(ret)}}
else if(type==='columns'||type==='rows'){ret=fn.call(apiInst,context[i],this[i],i);if(ret!==undefined){a.push(ret)}}
else if(type==='column'||type==='column-rows'||type==='row'||type==='cell'){items=this[i];if(type==='column-rows'){rows=_selector_row_indexes(context[i],selector.opts)}
for(j=0,jen=items.length;j<jen;j++){item=items[j];if(type==='cell'){ret=fn.call(apiInst,context[i],item.row,item.column,i,j)}
else{ret=fn.call(apiInst,context[i],item,i,j,rows)}
if(ret!==undefined){a.push(ret)}}}}
if(a.length||alwaysNew){var api=new _Api(context,flatten?a.concat.apply([],a):a);var apiSelector=api.selector;apiSelector.rows=selector.rows;apiSelector.cols=selector.cols;apiSelector.opts=selector.opts;return api}
return this},lastIndexOf:__arrayProto.lastIndexOf||function(obj,start)
{return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(fn)
{var a=[];if(__arrayProto.map){a=__arrayProto.map.call(this,fn,this)}
else{for(var i=0,ien=this.length;i<ien;i++){a.push(fn.call(this,this[i],i))}}
return new _Api(this.context,a)},pluck:function(prop)
{return this.map(function(el){return el[prop]})},pop:__arrayProto.pop,push:__arrayProto.push,reduce:__arrayProto.reduce||function(fn,init)
{return _fnReduce(this,fn,init,0,this.length,1)},reduceRight:__arrayProto.reduceRight||function(fn,init)
{return _fnReduce(this,fn,init,this.length-1,-1,-1)},reverse:__arrayProto.reverse,selector:null,shift:__arrayProto.shift,slice:function(){return new _Api(this.context,this)},sort:__arrayProto.sort,splice:__arrayProto.splice,toArray:function()
{return __arrayProto.slice.call(this)},to$:function()
{return $(this)},toJQuery:function()
{return $(this)},unique:function()
{return new _Api(this.context,_unique(this))},unshift:__arrayProto.unshift});_Api.extend=function(scope,obj,ext)
{if(!ext.length||!obj||(!(obj instanceof _Api)&&!obj.__dt_wrapper)){return}
var i,ien,j,jen,struct,inner,methodScoping=function(scope,fn,struc){return function(){var ret=fn.apply(scope,arguments);_Api.extend(ret,ret,struc.methodExt);return ret}};for(i=0,ien=ext.length;i<ien;i++){struct=ext[i];obj[struct.name]=typeof struct.val==='function'?methodScoping(scope,struct.val,struct):$.isPlainObject(struct.val)?{}:struct.val;obj[struct.name].__dt_wrapper=!0;_Api.extend(scope,obj[struct.name],struct.propExt)}};_Api.register=_api_register=function(name,val)
{if($.isArray(name)){for(var j=0,jen=name.length;j<jen;j++){_Api.register(name[j],val)}
return}
var i,ien,heir=name.split('.'),struct=__apiStruct,key,method;var find=function(src,name){for(var i=0,ien=src.length;i<ien;i++){if(src[i].name===name){return src[i]}}
return null};for(i=0,ien=heir.length;i<ien;i++){method=heir[i].indexOf('()')!==-1;key=method?heir[i].replace('()',''):heir[i];var src=find(struct,key);if(!src){src={name:key,val:{},methodExt:[],propExt:[]};struct.push(src)}
if(i===ien-1){src.val=val}
else{struct=method?src.methodExt:src.propExt}}};_Api.registerPlural=_api_registerPlural=function(pluralName,singularName,val){_Api.register(pluralName,val);_Api.register(singularName,function(){var ret=val.apply(this,arguments);if(ret===this){return this}
else if(ret instanceof _Api){return ret.length?$.isArray(ret[0])?new _Api(ret.context,ret[0]):ret[0]:undefined}
return ret})};var __table_selector=function(selector,a)
{if(typeof selector==='number'){return[a[selector]]}
var nodes=$.map(a,function(el,i){return el.nTable});return $(nodes).filter(selector).map(function(i){var idx=$.inArray(this,nodes);return a[idx]}).toArray()};_api_register('tables()',function(selector){return selector?new _Api(__table_selector(selector,this.context)):this});_api_register('table()',function(selector){var tables=this.tables(selector);var ctx=tables.context;return ctx.length?new _Api(ctx[0]):tables});_api_registerPlural('tables().nodes()','table().node()',function(){return this.iterator('table',function(ctx){return ctx.nTable},1)});_api_registerPlural('tables().body()','table().body()',function(){return this.iterator('table',function(ctx){return ctx.nTBody},1)});_api_registerPlural('tables().header()','table().header()',function(){return this.iterator('table',function(ctx){return ctx.nTHead},1)});_api_registerPlural('tables().footer()','table().footer()',function(){return this.iterator('table',function(ctx){return ctx.nTFoot},1)});_api_registerPlural('tables().containers()','table().container()',function(){return this.iterator('table',function(ctx){return ctx.nTableWrapper},1)});_api_register('draw()',function(paging){return this.iterator('table',function(settings){if(paging==='page'){_fnDraw(settings)}
else{if(typeof paging==='string'){paging=paging==='full-hold'?!1:!0}
_fnReDraw(settings,paging===!1)}})});_api_register('page()',function(action){if(action===undefined){return this.page.info().page}
return this.iterator('table',function(settings){_fnPageChange(settings,action)})});_api_register('page.info()',function(action){if(this.context.length===0){return undefined}
var settings=this.context[0],start=settings._iDisplayStart,len=settings.oFeatures.bPaginate?settings._iDisplayLength:-1,visRecords=settings.fnRecordsDisplay(),all=len===-1;return{"page":all?0:Math.floor(start/len),"pages":all?1:Math.ceil(visRecords/len),"start":start,"end":settings.fnDisplayEnd(),"length":len,"recordsTotal":settings.fnRecordsTotal(),"recordsDisplay":visRecords,"serverSide":_fnDataSource(settings)==='ssp'}});_api_register('page.len()',function(len){if(len===undefined){return this.context.length!==0?this.context[0]._iDisplayLength:undefined}
return this.iterator('table',function(settings){_fnLengthChange(settings,len)})});var __reload=function(settings,holdPosition,callback){if(callback){var api=new _Api(settings);api.one('draw',function(){callback(api.ajax.json())})}
if(_fnDataSource(settings)=='ssp'){_fnReDraw(settings,holdPosition)}
else{_fnProcessingDisplay(settings,!0);var xhr=settings.jqXHR;if(xhr&&xhr.readyState!==4){xhr.abort()}
_fnBuildAjax(settings,[],function(json){_fnClearTable(settings);var data=_fnAjaxDataSrc(settings,json);for(var i=0,ien=data.length;i<ien;i++){_fnAddData(settings,data[i])}
_fnReDraw(settings,holdPosition);_fnProcessingDisplay(settings,!1)})}};_api_register('ajax.json()',function(){var ctx=this.context;if(ctx.length>0){return ctx[0].json}});_api_register('ajax.params()',function(){var ctx=this.context;if(ctx.length>0){return ctx[0].oAjaxData}});_api_register('ajax.reload()',function(callback,resetPaging){return this.iterator('table',function(settings){__reload(settings,resetPaging===!1,callback)})});_api_register('ajax.url()',function(url){var ctx=this.context;if(url===undefined){if(ctx.length===0){return undefined}
ctx=ctx[0];return ctx.ajax?$.isPlainObject(ctx.ajax)?ctx.ajax.url:ctx.ajax:ctx.sAjaxSource}
return this.iterator('table',function(settings){if($.isPlainObject(settings.ajax)){settings.ajax.url=url}
else{settings.ajax=url}})});_api_register('ajax.url().load()',function(callback,resetPaging){return this.iterator('table',function(ctx){__reload(ctx,resetPaging===!1,callback)})});var _selector_run=function(type,selector,selectFn,settings,opts)
{var
out=[],res,a,i,ien,j,jen,selectorType=typeof selector;if(!selector||selectorType==='string'||selectorType==='function'||selector.length===undefined){selector=[selector]}
for(i=0,ien=selector.length;i<ien;i++){a=selector[i]&&selector[i].split&&!selector[i].match(/[\[\(:]/)?selector[i].split(','):[selector[i]];for(j=0,jen=a.length;j<jen;j++){res=selectFn(typeof a[j]==='string'?$.trim(a[j]):a[j]);if(res&&res.length){out=out.concat(res)}}}
var ext=_ext.selector[type];if(ext.length){for(i=0,ien=ext.length;i<ien;i++){out=ext[i](settings,opts,out)}}
return _unique(out)};var _selector_opts=function(opts)
{if(!opts){opts={}}
if(opts.filter&&opts.search===undefined){opts.search=opts.filter}
return $.extend({search:'none',order:'current',page:'all'},opts)};var _selector_first=function(inst)
{for(var i=0,ien=inst.length;i<ien;i++){if(inst[i].length>0){inst[0]=inst[i];inst[0].length=1;inst.length=1;inst.context=[inst.context[i]];return inst}}
inst.length=0;return inst};var _selector_row_indexes=function(settings,opts)
{var
i,ien,tmp,a=[],displayFiltered=settings.aiDisplay,displayMaster=settings.aiDisplayMaster;var search=opts.search,order=opts.order,page=opts.page;if(_fnDataSource(settings)=='ssp'){return search==='removed'?[]:_range(0,displayMaster.length)}
else if(page=='current'){for(i=settings._iDisplayStart,ien=settings.fnDisplayEnd();i<ien;i++){a.push(displayFiltered[i])}}
else if(order=='current'||order=='applied'){if(search=='none'){a=displayMaster.slice()}
else if(search=='applied'){a=displayFiltered.slice()}
else if(search=='removed'){var displayFilteredMap={};for(var i=0,ien=displayFiltered.length;i<ien;i++){displayFilteredMap[displayFiltered[i]]=null}
a=$.map(displayMaster,function(el){return!displayFilteredMap.hasOwnProperty(el)?el:null})}}
else if(order=='index'||order=='original'){for(i=0,ien=settings.aoData.length;i<ien;i++){if(search=='none'){a.push(i)}
else{tmp=$.inArray(i,displayFiltered);if((tmp===-1&&search=='removed')||(tmp>=0&&search=='applied'))
{a.push(i)}}}}
return a};var __row_selector=function(settings,selector,opts)
{var rows;var run=function(sel){var selInt=_intVal(sel);var i,ien;var aoData=settings.aoData;if(selInt!==null&&!opts){return[selInt]}
if(!rows){rows=_selector_row_indexes(settings,opts)}
if(selInt!==null&&$.inArray(selInt,rows)!==-1){return[selInt]}
else if(sel===null||sel===undefined||sel===''){return rows}
if(typeof sel==='function'){return $.map(rows,function(idx){var row=aoData[idx];return sel(idx,row._aData,row.nTr)?idx:null})}
if(sel.nodeName){var rowIdx=sel._DT_RowIndex;var cellIdx=sel._DT_CellIndex;if(rowIdx!==undefined){return aoData[rowIdx]&&aoData[rowIdx].nTr===sel?[rowIdx]:[]}
else if(cellIdx){return aoData[cellIdx.row]&&aoData[cellIdx.row].nTr===sel?[cellIdx.row]:[]}
else{var host=$(sel).closest('*[data-dt-row]');return host.length?[host.data('dt-row')]:[]}}
if(typeof sel==='string'&&sel.charAt(0)==='#'){var rowObj=settings.aIds[sel.replace(/^#/,'')];if(rowObj!==undefined){return[rowObj.idx]}}
var nodes=_removeEmpty(_pluck_order(settings.aoData,rows,'nTr'));return $(nodes).filter(sel).map(function(){return this._DT_RowIndex}).toArray()};return _selector_run('row',selector,run,settings,opts)};_api_register('rows()',function(selector,opts){if(selector===undefined){selector=''}
else if($.isPlainObject(selector)){opts=selector;selector=''}
opts=_selector_opts(opts);var inst=this.iterator('table',function(settings){return __row_selector(settings,selector,opts)},1);inst.selector.rows=selector;inst.selector.opts=opts;return inst});_api_register('rows().nodes()',function(){return this.iterator('row',function(settings,row){return settings.aoData[row].nTr||undefined},1)});_api_register('rows().data()',function(){return this.iterator(!0,'rows',function(settings,rows){return _pluck_order(settings.aoData,rows,'_aData')},1)});_api_registerPlural('rows().cache()','row().cache()',function(type){return this.iterator('row',function(settings,row){var r=settings.aoData[row];return type==='search'?r._aFilterData:r._aSortData},1)});_api_registerPlural('rows().invalidate()','row().invalidate()',function(src){return this.iterator('row',function(settings,row){_fnInvalidate(settings,row,src)})});_api_registerPlural('rows().indexes()','row().index()',function(){return this.iterator('row',function(settings,row){return row},1)});_api_registerPlural('rows().ids()','row().id()',function(hash){var a=[];var context=this.context;for(var i=0,ien=context.length;i<ien;i++){for(var j=0,jen=this[i].length;j<jen;j++){var id=context[i].rowIdFn(context[i].aoData[this[i][j]]._aData);a.push((hash===!0?'#':'')+id)}}
return new _Api(context,a)});_api_registerPlural('rows().remove()','row().remove()',function(){var that=this;this.iterator('row',function(settings,row,thatIdx){var data=settings.aoData;var rowData=data[row];var i,ien,j,jen;var loopRow,loopCells;data.splice(row,1);for(i=0,ien=data.length;i<ien;i++){loopRow=data[i];loopCells=loopRow.anCells;if(loopRow.nTr!==null){loopRow.nTr._DT_RowIndex=i}
if(loopCells!==null){for(j=0,jen=loopCells.length;j<jen;j++){loopCells[j]._DT_CellIndex.row=i}}}
_fnDeleteIndex(settings.aiDisplayMaster,row);_fnDeleteIndex(settings.aiDisplay,row);_fnDeleteIndex(that[thatIdx],row,!1);if(settings._iRecordsDisplay>0){settings._iRecordsDisplay--}
_fnLengthOverflow(settings);var id=settings.rowIdFn(rowData._aData);if(id!==undefined){delete settings.aIds[id]}});this.iterator('table',function(settings){for(var i=0,ien=settings.aoData.length;i<ien;i++){settings.aoData[i].idx=i}});return this});_api_register('rows.add()',function(rows){var newRows=this.iterator('table',function(settings){var row,i,ien;var out=[];for(i=0,ien=rows.length;i<ien;i++){row=rows[i];if(row.nodeName&&row.nodeName.toUpperCase()==='TR'){out.push(_fnAddTr(settings,row)[0])}
else{out.push(_fnAddData(settings,row))}}
return out},1);var modRows=this.rows(-1);modRows.pop();$.merge(modRows,newRows);return modRows});_api_register('row()',function(selector,opts){return _selector_first(this.rows(selector,opts))});_api_register('row().data()',function(data){var ctx=this.context;if(data===undefined){return ctx.length&&this.length?ctx[0].aoData[this[0]]._aData:undefined}
var row=ctx[0].aoData[this[0]];row._aData=data;if($.isArray(data)&&row.nTr.id){_fnSetObjectDataFn(ctx[0].rowId)(data,row.nTr.id)}
_fnInvalidate(ctx[0],this[0],'data');return this});_api_register('row().node()',function(){var ctx=this.context;return ctx.length&&this.length?ctx[0].aoData[this[0]].nTr||null:null});_api_register('row.add()',function(row){if(row instanceof $&&row.length){row=row[0]}
var rows=this.iterator('table',function(settings){if(row.nodeName&&row.nodeName.toUpperCase()==='TR'){return _fnAddTr(settings,row)[0]}
return _fnAddData(settings,row)});return this.row(rows[0])});var __details_add=function(ctx,row,data,klass)
{var rows=[];var addRow=function(r,k){if($.isArray(r)||r instanceof $){for(var i=0,ien=r.length;i<ien;i++){addRow(r[i],k)}
return}
if(r.nodeName&&r.nodeName.toLowerCase()==='tr'){rows.push(r)}
else{var created=$('<tr><td/></tr>').addClass(k);$('td',created).addClass(k).html(r)[0].colSpan=_fnVisbleColumns(ctx);rows.push(created[0])}};addRow(data,klass);if(row._details){row._details.detach()}
row._details=$(rows);if(row._detailsShow){row._details.insertAfter(row.nTr)}};var __details_remove=function(api,idx)
{var ctx=api.context;if(ctx.length){var row=ctx[0].aoData[idx!==undefined?idx:api[0]];if(row&&row._details){row._details.remove();row._detailsShow=undefined;row._details=undefined}}};var __details_display=function(api,show){var ctx=api.context;if(ctx.length&&api.length){var row=ctx[0].aoData[api[0]];if(row._details){row._detailsShow=show;if(show){row._details.insertAfter(row.nTr)}
else{row._details.detach()}
__details_events(ctx[0])}}};var __details_events=function(settings)
{var api=new _Api(settings);var namespace='.dt.DT_details';var drawEvent='draw'+namespace;var colvisEvent='column-visibility'+namespace;var destroyEvent='destroy'+namespace;var data=settings.aoData;api.off(drawEvent+' '+colvisEvent+' '+destroyEvent);if(_pluck(data,'_details').length>0){api.on(drawEvent,function(e,ctx){if(settings!==ctx){return}
api.rows({page:'current'}).eq(0).each(function(idx){var row=data[idx];if(row._detailsShow){row._details.insertAfter(row.nTr)}})});api.on(colvisEvent,function(e,ctx,idx,vis){if(settings!==ctx){return}
var row,visible=_fnVisbleColumns(ctx);for(var i=0,ien=data.length;i<ien;i++){row=data[i];if(row._details){row._details.children('td[colspan]').attr('colspan',visible)}}});api.on(destroyEvent,function(e,ctx){if(settings!==ctx){return}
for(var i=0,ien=data.length;i<ien;i++){if(data[i]._details){__details_remove(api,i)}}})}};var _emp='';var _child_obj=_emp+'row().child';var _child_mth=_child_obj+'()';_api_register(_child_mth,function(data,klass){var ctx=this.context;if(data===undefined){return ctx.length&&this.length?ctx[0].aoData[this[0]]._details:undefined}
else if(data===!0){this.child.show()}
else if(data===!1){__details_remove(this)}
else if(ctx.length&&this.length){__details_add(ctx[0],ctx[0].aoData[this[0]],data,klass)}
return this});_api_register([_child_obj+'.show()',_child_mth+'.show()'],function(show){__details_display(this,!0);return this});_api_register([_child_obj+'.hide()',_child_mth+'.hide()'],function(){__details_display(this,!1);return this});_api_register([_child_obj+'.remove()',_child_mth+'.remove()'],function(){__details_remove(this);return this});_api_register(_child_obj+'.isShown()',function(){var ctx=this.context;if(ctx.length&&this.length){return ctx[0].aoData[this[0]]._detailsShow||!1}
return!1});var __re_column_selector=/^([^:]+):(name|visIdx|visible)$/;var __columnData=function(settings,column,r1,r2,rows){var a=[];for(var row=0,ien=rows.length;row<ien;row++){a.push(_fnGetCellData(settings,rows[row],column))}
return a};var __column_selector=function(settings,selector,opts)
{var
columns=settings.aoColumns,names=_pluck(columns,'sName'),nodes=_pluck(columns,'nTh');var run=function(s){var selInt=_intVal(s);if(s===''){return _range(columns.length)}
if(selInt!==null){return[selInt>=0?selInt:columns.length+selInt]}
if(typeof s==='function'){var rows=_selector_row_indexes(settings,opts);return $.map(columns,function(col,idx){return s(idx,__columnData(settings,idx,0,0,rows),nodes[idx])?idx:null})}
var match=typeof s==='string'?s.match(__re_column_selector):'';if(match){switch(match[2]){case 'visIdx':case 'visible':var idx=parseInt(match[1],100);if(idx<0){var visColumns=$.map(columns,function(col,i){return col.bVisible?i:null});return[visColumns[visColumns.length+idx]]}
return[_fnVisibleToColumnIndex(settings,idx)];case 'name':return $.map(names,function(name,i){return name===match[1]?i:null});default:return[]}}
if(s.nodeName&&s._DT_CellIndex){return[s._DT_CellIndex.column]}
var jqResult=$(nodes).filter(s).map(function(){return $.inArray(this,nodes)}).toArray();if(jqResult.length||!s.nodeName){return jqResult}
var host=$(s).closest('*[data-dt-column]');return host.length?[host.data('dt-column')]:[]};return _selector_run('column',selector,run,settings,opts)};var __setColumnVis=function(settings,column,vis){var
cols=settings.aoColumns,col=cols[column],data=settings.aoData,row,cells,i,ien,tr;if(vis===undefined){return col.bVisible}
if(col.bVisible===vis){return}
if(vis){var insertBefore=$.inArray(!0,_pluck(cols,'bVisible'),column+1);for(i=0,ien=data.length;i<ien;i++){tr=data[i].nTr;cells=data[i].anCells;if(tr){tr.insertBefore(cells[column],cells[insertBefore]||null)}}}
else{$(_pluck(settings.aoData,'anCells',column)).detach()}
col.bVisible=vis;_fnDrawHead(settings,settings.aoHeader);_fnDrawHead(settings,settings.aoFooter);if(!settings.aiDisplay.length){$(settings.nTBody).find('td[colspan]').attr('colspan',_fnVisbleColumns(settings))}
_fnSaveState(settings)};_api_register('columns()',function(selector,opts){if(selector===undefined){selector=''}
else if($.isPlainObject(selector)){opts=selector;selector=''}
opts=_selector_opts(opts);var inst=this.iterator('table',function(settings){return __column_selector(settings,selector,opts)},1);inst.selector.cols=selector;inst.selector.opts=opts;return inst});_api_registerPlural('columns().header()','column().header()',function(selector,opts){return this.iterator('column',function(settings,column){return settings.aoColumns[column].nTh},1)});_api_registerPlural('columns().footer()','column().footer()',function(selector,opts){return this.iterator('column',function(settings,column){return settings.aoColumns[column].nTf},1)});_api_registerPlural('columns().data()','column().data()',function(){return this.iterator('column-rows',__columnData,1)});_api_registerPlural('columns().dataSrc()','column().dataSrc()',function(){return this.iterator('column',function(settings,column){return settings.aoColumns[column].mData},1)});_api_registerPlural('columns().cache()','column().cache()',function(type){return this.iterator('column-rows',function(settings,column,i,j,rows){return _pluck_order(settings.aoData,rows,type==='search'?'_aFilterData':'_aSortData',column)},1)});_api_registerPlural('columns().nodes()','column().nodes()',function(){return this.iterator('column-rows',function(settings,column,i,j,rows){return _pluck_order(settings.aoData,rows,'anCells',column)},1)});_api_registerPlural('columns().visible()','column().visible()',function(vis,calc){var ret=this.iterator('column',function(settings,column){if(vis===undefined){return settings.aoColumns[column].bVisible}
__setColumnVis(settings,column,vis)});if(vis!==undefined){this.iterator('column',function(settings,column){_fnCallbackFire(settings,null,'column-visibility',[settings,column,vis,calc])});if(calc===undefined||calc){this.columns.adjust()}}
return ret});_api_registerPlural('columns().indexes()','column().index()',function(type){return this.iterator('column',function(settings,column){return type==='visible'?_fnColumnIndexToVisible(settings,column):column},1)});_api_register('columns.adjust()',function(){return this.iterator('table',function(settings){_fnAdjustColumnSizing(settings)},1)});_api_register('column.index()',function(type,idx){if(this.context.length!==0){var ctx=this.context[0];if(type==='fromVisible'||type==='toData'){return _fnVisibleToColumnIndex(ctx,idx)}
else if(type==='fromData'||type==='toVisible'){return _fnColumnIndexToVisible(ctx,idx)}}});_api_register('column()',function(selector,opts){return _selector_first(this.columns(selector,opts))});var __cell_selector=function(settings,selector,opts)
{var data=settings.aoData;var rows=_selector_row_indexes(settings,opts);var cells=_removeEmpty(_pluck_order(data,rows,'anCells'));var allCells=$([].concat.apply([],cells));var row;var columns=settings.aoColumns.length;var a,i,ien,j,o,host;var run=function(s){var fnSelector=typeof s==='function';if(s===null||s===undefined||fnSelector){a=[];for(i=0,ien=rows.length;i<ien;i++){row=rows[i];for(j=0;j<columns;j++){o={row:row,column:j};if(fnSelector){host=data[row];if(s(o,_fnGetCellData(settings,row,j),host.anCells?host.anCells[j]:null)){a.push(o)}}
else{a.push(o)}}}
return a}
if($.isPlainObject(s)){return s.column!==undefined&&s.row!==undefined&&$.inArray(s.row,rows)!==-1?[s]:[]}
var jqResult=allCells.filter(s).map(function(i,el){return{row:el._DT_CellIndex.row,column:el._DT_CellIndex.column}}).toArray();if(jqResult.length||!s.nodeName){return jqResult}
host=$(s).closest('*[data-dt-row]');return host.length?[{row:host.data('dt-row'),column:host.data('dt-column')}]:[]};return _selector_run('cell',selector,run,settings,opts)};_api_register('cells()',function(rowSelector,columnSelector,opts){if($.isPlainObject(rowSelector)){if(rowSelector.row===undefined){opts=rowSelector;rowSelector=null}
else{opts=columnSelector;columnSelector=null}}
if($.isPlainObject(columnSelector)){opts=columnSelector;columnSelector=null}
if(columnSelector===null||columnSelector===undefined){return this.iterator('table',function(settings){return __cell_selector(settings,rowSelector,_selector_opts(opts))})}
var columns=this.columns(columnSelector);var rows=this.rows(rowSelector);var a,i,ien,j,jen;this.iterator('table',function(settings,idx){a=[];for(i=0,ien=rows[idx].length;i<ien;i++){for(j=0,jen=columns[idx].length;j<jen;j++){a.push({row:rows[idx][i],column:columns[idx][j]})}}},1);var cells=this.cells(a,opts);$.extend(cells.selector,{cols:columnSelector,rows:rowSelector,opts:opts});return cells});_api_registerPlural('cells().nodes()','cell().node()',function(){return this.iterator('cell',function(settings,row,column){var data=settings.aoData[row];return data&&data.anCells?data.anCells[column]:undefined},1)});_api_register('cells().data()',function(){return this.iterator('cell',function(settings,row,column){return _fnGetCellData(settings,row,column)},1)});_api_registerPlural('cells().cache()','cell().cache()',function(type){type=type==='search'?'_aFilterData':'_aSortData';return this.iterator('cell',function(settings,row,column){return settings.aoData[row][type][column]},1)});_api_registerPlural('cells().render()','cell().render()',function(type){return this.iterator('cell',function(settings,row,column){return _fnGetCellData(settings,row,column,type)},1)});_api_registerPlural('cells().indexes()','cell().index()',function(){return this.iterator('cell',function(settings,row,column){return{row:row,column:column,columnVisible:_fnColumnIndexToVisible(settings,column)}},1)});_api_registerPlural('cells().invalidate()','cell().invalidate()',function(src){return this.iterator('cell',function(settings,row,column){_fnInvalidate(settings,row,src,column)})});_api_register('cell()',function(rowSelector,columnSelector,opts){return _selector_first(this.cells(rowSelector,columnSelector,opts))});_api_register('cell().data()',function(data){var ctx=this.context;var cell=this[0];if(data===undefined){return ctx.length&&cell.length?_fnGetCellData(ctx[0],cell[0].row,cell[0].column):undefined}
_fnSetCellData(ctx[0],cell[0].row,cell[0].column,data);_fnInvalidate(ctx[0],cell[0].row,'data',cell[0].column);return this});_api_register('order()',function(order,dir){var ctx=this.context;if(order===undefined){return ctx.length!==0?ctx[0].aaSorting:undefined}
if(typeof order==='number'){order=[[order,dir]]}
else if(order.length&&!$.isArray(order[0])){order=Array.prototype.slice.call(arguments)}
return this.iterator('table',function(settings){settings.aaSorting=order.slice()})});_api_register('order.listener()',function(node,column,callback){return this.iterator('table',function(settings){_fnSortAttachListener(settings,node,column,callback)})});_api_register('order.fixed()',function(set){if(!set){var ctx=this.context;var fixed=ctx.length?ctx[0].aaSortingFixed:undefined;return $.isArray(fixed)?{pre:fixed}:fixed}
return this.iterator('table',function(settings){settings.aaSortingFixed=$.extend(!0,{},set)})});_api_register(['columns().order()','column().order()'],function(dir){var that=this;return this.iterator('table',function(settings,i){var sort=[];$.each(that[i],function(j,col){sort.push([col,dir])});settings.aaSorting=sort})});_api_register('search()',function(input,regex,smart,caseInsen){var ctx=this.context;if(input===undefined){return ctx.length!==0?ctx[0].oPreviousSearch.sSearch:undefined}
return this.iterator('table',function(settings){if(!settings.oFeatures.bFilter){return}
_fnFilterComplete(settings,$.extend({},settings.oPreviousSearch,{"sSearch":input+"","bRegex":regex===null?!1:regex,"bSmart":smart===null?!0:smart,"bCaseInsensitive":caseInsen===null?!0:caseInsen}),1)})});_api_registerPlural('columns().search()','column().search()',function(input,regex,smart,caseInsen){return this.iterator('column',function(settings,column){var preSearch=settings.aoPreSearchCols;if(input===undefined){return preSearch[column].sSearch}
if(!settings.oFeatures.bFilter){return}
$.extend(preSearch[column],{"sSearch":input+"","bRegex":regex===null?!1:regex,"bSmart":smart===null?!0:smart,"bCaseInsensitive":caseInsen===null?!0:caseInsen});_fnFilterComplete(settings,settings.oPreviousSearch,1)})});_api_register('state()',function(){return this.context.length?this.context[0].oSavedState:null});_api_register('state.clear()',function(){return this.iterator('table',function(settings){settings.fnStateSaveCallback.call(settings.oInstance,settings,{})})});_api_register('state.loaded()',function(){return this.context.length?this.context[0].oLoadedState:null});_api_register('state.save()',function(){return this.iterator('table',function(settings){_fnSaveState(settings)})});DataTable.versionCheck=DataTable.fnVersionCheck=function(version)
{var aThis=DataTable.version.split('.');var aThat=version.split('.');var iThis,iThat;for(var i=0,iLen=aThat.length;i<iLen;i++){iThis=parseInt(aThis[i],100)||0;iThat=parseInt(aThat[i],100)||0;if(iThis===iThat){continue}
return iThis>iThat}
return!0};DataTable.isDataTable=DataTable.fnIsDataTable=function(table)
{var t=$(table).get(0);var is=!1;if(table instanceof DataTable.Api){return!0}
$.each(DataTable.settings,function(i,o){var head=o.nScrollHead?$('table',o.nScrollHead)[0]:null;var foot=o.nScrollFoot?$('table',o.nScrollFoot)[0]:null;if(o.nTable===t||head===t||foot===t){is=!0}});return is};DataTable.tables=DataTable.fnTables=function(visible)
{var api=!1;if($.isPlainObject(visible)){api=visible.api;visible=visible.visible}
var a=$.map(DataTable.settings,function(o){if(!visible||(visible&&$(o.nTable).is(':visible'))){return o.nTable}});return api?new _Api(a):a};DataTable.camelToHungarian=_fnCamelToHungarian;_api_register('$()',function(selector,opts){var
rows=this.rows(opts).nodes(),jqRows=$(rows);return $([].concat(jqRows.filter(selector).toArray(),jqRows.find(selector).toArray()))});$.each(['on','one','off'],function(i,key){_api_register(key+'()',function(){var args=Array.prototype.slice.call(arguments);args[0]=$.map(args[0].split(/\s/),function(e){return!e.match(/\.dt\b/)?e+'.dt':e}).join(' ');var inst=$(this.tables().nodes());inst[key].apply(inst,args);return this})});_api_register('clear()',function(){return this.iterator('table',function(settings){_fnClearTable(settings)})});_api_register('settings()',function(){return new _Api(this.context,this.context)});_api_register('init()',function(){var ctx=this.context;return ctx.length?ctx[0].oInit:null});_api_register('data()',function(){return this.iterator('table',function(settings){return _pluck(settings.aoData,'_aData')}).flatten()});_api_register('destroy()',function(remove){remove=remove||!1;return this.iterator('table',function(settings){var orig=settings.nTableWrapper.parentNode;var classes=settings.oClasses;var table=settings.nTable;var tbody=settings.nTBody;var thead=settings.nTHead;var tfoot=settings.nTFoot;var jqTable=$(table);var jqTbody=$(tbody);var jqWrapper=$(settings.nTableWrapper);var rows=$.map(settings.aoData,function(r){return r.nTr});var i,ien;settings.bDestroying=!0;_fnCallbackFire(settings,"aoDestroyCallback","destroy",[settings]);if(!remove){new _Api(settings).columns().visible(!0)}
jqWrapper.off('.DT').find(':not(tbody *)').off('.DT');$(window).off('.DT-'+settings.sInstance);if(table!=thead.parentNode){jqTable.children('thead').detach();jqTable.append(thead)}
if(tfoot&&table!=tfoot.parentNode){jqTable.children('tfoot').detach();jqTable.append(tfoot)}
settings.aaSorting=[];settings.aaSortingFixed=[];_fnSortingClasses(settings);$(rows).removeClass(settings.asStripeClasses.join(' '));$('th, td',thead).removeClass(classes.sSortable+' '+classes.sSortableAsc+' '+classes.sSortableDesc+' '+classes.sSortableNone);jqTbody.children().detach();jqTbody.append(rows);var removedMethod=remove?'remove':'detach';jqTable[removedMethod]();jqWrapper[removedMethod]();if(!remove&&orig){orig.insertBefore(table,settings.nTableReinsertBefore);jqTable.css('width',settings.sDestroyWidth).removeClass(classes.sTable);ien=settings.asDestroyStripes.length;if(ien){jqTbody.children().each(function(i){$(this).addClass(settings.asDestroyStripes[i%ien])})}}
var idx=$.inArray(settings,DataTable.settings);if(idx!==-1){DataTable.settings.splice(idx,1)}})});$.each(['column','row','cell'],function(i,type){_api_register(type+'s().every()',function(fn){var opts=this.selector.opts;var api=this;return this.iterator(type,function(settings,arg1,arg2,arg3,arg4){fn.call(api[type](arg1,type==='cell'?arg2:opts,type==='cell'?opts:undefined),arg1,arg2,arg3,arg4)})})});_api_register('i18n()',function(token,def,plural){var ctx=this.context[0];var resolved=_fnGetObjectDataFn(token)(ctx.oLanguage);if(resolved===undefined){resolved=def}
if(plural!==undefined&&$.isPlainObject(resolved)){resolved=resolved[plural]!==undefined?resolved[plural]:resolved._}
return resolved.replace('%d',plural)});DataTable.version="1.10.18";DataTable.settings=[];DataTable.models={};DataTable.models.oSearch={"bCaseInsensitive":!0,"sSearch":"","bRegex":!1,"bSmart":!0};DataTable.models.oRow={"nTr":null,"anCells":null,"_aData":[],"_aSortData":null,"_aFilterData":null,"_sFilterRow":null,"_sRowStripe":"","src":null,"idx":-1};DataTable.models.oColumn={"idx":null,"aDataSort":null,"asSorting":null,"bSearchable":null,"bSortable":null,"bVisible":null,"_sManualType":null,"_bAttrSrc":!1,"fnCreatedCell":null,"fnGetData":null,"fnSetData":null,"mData":null,"mRender":null,"nTh":null,"nTf":null,"sClass":null,"sContentPadding":null,"sDefaultContent":null,"sName":null,"sSortDataType":'std',"sSortingClass":null,"sSortingClassJUI":null,"sTitle":null,"sType":null,"sWidth":null,"sWidthOrig":null};DataTable.defaults={"aaData":null,"aaSorting":[[0,'asc']],"aaSortingFixed":[],"ajax":null,"aLengthMenu":[100,250,500],"aoColumns":null,"aoColumnDefs":null,"aoSearchCols":[],"asStripeClasses":null,"bAutoWidth":!0,"bDeferRender":!1,"bDestroy":!1,"bFilter":!0,"bInfo":!0,"bLengthChange":!0,"bPaginate":!0,"bProcessing":!1,"bRetrieve":!1,"bScrollCollapse":!1,"bServerSide":!1,"bSort":!0,"bSortMulti":!0,"bSortCellsTop":!1,"bSortClasses":!0,"bStateSave":!1,"fnCreatedRow":null,"fnDrawCallback":null,"fnFooterCallback":null,"fnFormatNumber":function(toFormat){return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},"fnHeaderCallback":null,"fnInfoCallback":null,"fnInitComplete":null,"fnPreDrawCallback":null,"fnRowCallback":null,"fnServerData":null,"fnServerParams":null,"fnStateLoadCallback":function(settings){try{return JSON.parse((settings.iStateDuration===-1?sessionStorage:localStorage).getItem('DataTables_'+settings.sInstance+'_'+location.pathname))}catch(e){}},"fnStateLoadParams":null,"fnStateLoaded":null,"fnStateSaveCallback":function(settings,data){try{(settings.iStateDuration===-1?sessionStorage:localStorage).setItem('DataTables_'+settings.sInstance+'_'+location.pathname,JSON.stringify(data))}catch(e){}},"fnStateSaveParams":null,"iStateDuration":7200,"iDeferLoading":null,"iDisplayLength":100,"iDisplayStart":0,"iTabIndex":0,"oClasses":{},"oLanguage":{"oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"ابتدا","sLast":"انتها","sNext":"بعدی","sPrevious":"قبلی"},"sEmptyTable":"اطلاعاتی برای نمایش وجود ندارد","sInfo":"نمایش _START_ تا _END_ از _TOTAL_ دیتا","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(فیلتر شده از _MAX_ دیتا)","sInfoPostFix":"","sDecimal":"","sThousands":",","sLengthMenu":"نمایش _MENU_ دیتا","sLoadingRecords":"درحال بارگذاری...","sProcessing":"در حال پردازش","sSearch":"جستجو:","sSearchPlaceholder":"","sUrl":"","sZeroRecords":"دیتایی یافت نشد!"},"oSearch":$.extend({},DataTable.models.oSearch),"sAjaxDataProp":"data","sAjaxSource":null,"sDom":"lfrtip","searchDelay":null,"sPaginationType":"simple_numbers","sScrollX":"","sScrollXInner":"","sScrollY":"","sServerMethod":"GET","renderer":null,"rowId":"DT_RowId"};_fnHungarianMap(DataTable.defaults);DataTable.defaults.column={"aDataSort":null,"iDataSort":-1,"asSorting":['asc','desc'],"bSearchable":!0,"bSortable":!0,"bVisible":!0,"fnCreatedCell":null,"mData":null,"mRender":null,"sCellType":"td","sClass":"","sContentPadding":"","sDefaultContent":null,"sName":"","sSortDataType":"std","sTitle":null,"sType":null,"sWidth":null};_fnHungarianMap(DataTable.defaults.column);DataTable.models.oSettings={"oFeatures":{"bAutoWidth":null,"bDeferRender":null,"bFilter":null,"bInfo":null,"bLengthChange":null,"bPaginate":null,"bProcessing":null,"bServerSide":null,"bSort":null,"bSortMulti":null,"bSortClasses":null,"bStateSave":null},"oScroll":{"bCollapse":null,"iBarWidth":0,"sX":null,"sXInner":null,"sY":null},"oLanguage":{"fnInfoCallback":null},"oBrowser":{"bScrollOversize":!1,"bScrollbarLeft":!1,"bBounding":!1,"barWidth":0},"ajax":null,"aanFeatures":[],"aoData":[],"aiDisplay":[],"aiDisplayMaster":[],"aIds":{},"aoColumns":[],"aoHeader":[],"aoFooter":[],"oPreviousSearch":{},"aoPreSearchCols":[],"aaSorting":null,"aaSortingFixed":[],"asStripeClasses":null,"asDestroyStripes":[],"sDestroyWidth":0,"aoRowCallback":[],"aoHeaderCallback":[],"aoFooterCallback":[],"aoDrawCallback":[],"aoRowCreatedCallback":[],"aoPreDrawCallback":[],"aoInitComplete":[],"aoStateSaveParams":[],"aoStateLoadParams":[],"aoStateLoaded":[],"sTableId":"","nTable":null,"nTHead":null,"nTFoot":null,"nTBody":null,"nTableWrapper":null,"bDeferLoading":!1,"bInitialised":!1,"aoOpenRows":[],"sDom":null,"searchDelay":null,"sPaginationType":"two_button","iStateDuration":0,"aoStateSave":[],"aoStateLoad":[],"oSavedState":null,"oLoadedState":null,"sAjaxSource":null,"sAjaxDataProp":null,"bAjaxDataGet":!0,"jqXHR":null,"json":undefined,"oAjaxData":undefined,"fnServerData":null,"aoServerParams":[],"sServerMethod":null,"fnFormatNumber":null,"aLengthMenu":null,"iDraw":0,"bDrawing":!1,"iDrawError":-1,"_iDisplayLength":100,"_iDisplayStart":0,"_iRecordsTotal":0,"_iRecordsDisplay":0,"oClasses":{},"bFiltered":!1,"bSorted":!1,"bSortCellsTop":null,"oInit":null,"aoDestroyCallback":[],"fnRecordsTotal":function()
{return _fnDataSource(this)=='ssp'?this._iRecordsTotal*1:this.aiDisplayMaster.length},"fnRecordsDisplay":function()
{return _fnDataSource(this)=='ssp'?this._iRecordsDisplay*1:this.aiDisplay.length},"fnDisplayEnd":function()
{var
len=this._iDisplayLength,start=this._iDisplayStart,calc=start+len,records=this.aiDisplay.length,features=this.oFeatures,paginate=features.bPaginate;if(features.bServerSide){return paginate===!1||len===-1?start+records:Math.min(start+len,this._iRecordsDisplay)}
else{return!paginate||calc>records||len===-1?records:calc}},"oInstance":null,"sInstance":null,"iTabIndex":0,"nScrollHead":null,"nScrollFoot":null,"aLastSort":[],"oPlugins":{},"rowIdFn":null,"rowId":null};DataTable.ext=_ext={buttons:{},classes:{},build:"bs4/dt-1.10.18/r-2.2.2/rr-1.2.4/sl-1.2.6",errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:DataTable.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:DataTable.version};$.extend(_ext,{afnFiltering:_ext.search,aTypes:_ext.type.detect,ofnSearch:_ext.type.search,oSort:_ext.type.order,afnSortData:_ext.order,aoFeatures:_ext.feature,oApi:_ext.internal,oStdClasses:_ext.classes,oPagination:_ext.pager});$.extend(DataTable.ext.classes,{"sTable":"dataTable","sNoFooter":"no-footer","sPageButton":"paginate_button","sPageButtonActive":"current","sPageButtonDisabled":"disabled","sStripeOdd":"odd","sStripeEven":"even","sRowEmpty":"dataTables_empty","sWrapper":"dataTables_wrapper","sFilter":"dataTables_filter","sInfo":"dataTables_info","sPaging":"dataTables_paginate paging_","sLength":"dataTables_length","sProcessing":"dataTables_processing","sSortAsc":"sorting_asc","sSortDesc":"sorting_desc","sSortable":"sorting","sSortableAsc":"sorting_asc_disabled","sSortableDesc":"sorting_desc_disabled","sSortableNone":"sorting_disabled","sSortColumn":"sorting_","sFilterInput":"","sLengthSelect":"","sScrollWrapper":"dataTables_scroll","sScrollHead":"dataTables_scrollHead","sScrollHeadInner":"dataTables_scrollHeadInner","sScrollBody":"dataTables_scrollBody","sScrollFoot":"dataTables_scrollFoot","sScrollFootInner":"dataTables_scrollFootInner","sHeaderTH":"","sFooterTH":"","sSortJUIAsc":"","sSortJUIDesc":"","sSortJUI":"","sSortJUIAscAllowed":"","sSortJUIDescAllowed":"","sSortJUIWrapper":"","sSortIcon":"","sJUIHeader":"","sJUIFooter":""});var extPagination=DataTable.ext.pager;function _numbers(page,pages){var
numbers=[],buttons=extPagination.numbers_length,half=Math.floor(buttons/2),i=1;if(pages<=buttons){numbers=_range(0,pages)}
else if(page<=half){numbers=_range(0,buttons-2);numbers.push('ellipsis');numbers.push(pages-1)}
else if(page>=pages-1-half){numbers=_range(pages-(buttons-2),pages);numbers.splice(0,0,'ellipsis');numbers.splice(0,0,0)}
else{numbers=_range(page-half+2,page+half-1);numbers.push('ellipsis');numbers.push(pages-1);numbers.splice(0,0,'ellipsis');numbers.splice(0,0,0)}
numbers.DT_el='span';return numbers}
$.extend(extPagination,{simple:function(page,pages){return['previous','next']},full:function(page,pages){return['first','previous','next','last']},numbers:function(page,pages){return[_numbers(page,pages)]},simple_numbers:function(page,pages){return['previous',_numbers(page,pages),'next']},full_numbers:function(page,pages){return['first','previous',_numbers(page,pages),'next','last']},first_last_numbers:function(page,pages){return['first',_numbers(page,pages),'last']},_numbers:_numbers,numbers_length:7});$.extend(!0,DataTable.ext.renderer,{pageButton:{_:function(settings,host,idx,buttons,page,pages){var classes=settings.oClasses;var lang=settings.oLanguage.oPaginate;var aria=settings.oLanguage.oAria.paginate||{};var btnDisplay,btnClass,counter=0;var attach=function(container,buttons){var i,ien,node,button;var clickHandler=function(e){_fnPageChange(settings,e.data.action,!0)};for(i=0,ien=buttons.length;i<ien;i++){button=buttons[i];if($.isArray(button)){var inner=$('<'+(button.DT_el||'div')+'/>').appendTo(container);attach(inner,button)}
else{btnDisplay=null;btnClass='';switch(button){case 'ellipsis':container.append('<span class="ellipsis">&#x2026;</span>');break;case 'first':btnDisplay=lang.sFirst;btnClass=button+(page>0?'':' '+classes.sPageButtonDisabled);break;case 'previous':btnDisplay=lang.sPrevious;btnClass=button+(page>0?'':' '+classes.sPageButtonDisabled);break;case 'next':btnDisplay=lang.sNext;btnClass=button+(page<pages-1?'':' '+classes.sPageButtonDisabled);break;case 'last':btnDisplay=lang.sLast;btnClass=button+(page<pages-1?'':' '+classes.sPageButtonDisabled);break;default:btnDisplay=button+1;btnClass=page===button?classes.sPageButtonActive:'';break}
if(btnDisplay!==null){node=$('<a>',{'class':classes.sPageButton+' '+btnClass,'aria-controls':settings.sTableId,'aria-label':aria[button],'data-dt-idx':counter,'tabindex':settings.iTabIndex,'id':idx===0&&typeof button==='string'?settings.sTableId+'_'+button:null}).html(btnDisplay).appendTo(container);_fnBindAction(node,{action:button},clickHandler);counter++}}}};var activeEl;try{activeEl=$(host).find(document.activeElement).data('dt-idx')}
catch(e){}
attach($(host).empty(),buttons);if(activeEl!==undefined){$(host).find('[data-dt-idx='+activeEl+']').focus()}}}});$.extend(DataTable.ext.type.detect,[function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _isNumber(d,decimal)?'num'+decimal:null},function(d,settings)
{if(d&&!(d instanceof Date)&&!_re_date.test(d)){return null}
var parsed=Date.parse(d);return(parsed!==null&&!isNaN(parsed))||_empty(d)?'date':null},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _isNumber(d,decimal,!0)?'num-fmt'+decimal:null},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _htmlNumeric(d,decimal)?'html-num'+decimal:null},function(d,settings)
{var decimal=settings.oLanguage.sDecimal;return _htmlNumeric(d,decimal,!0)?'html-num-fmt'+decimal:null},function(d,settings)
{return _empty(d)||(typeof d==='string'&&d.indexOf('<')!==-1)?'html':null}]);$.extend(DataTable.ext.type.search,{html:function(data){return _empty(data)?data:typeof data==='string'?data.replace(_re_new_lines," ").replace(_re_html,""):''},string:function(data){return _empty(data)?data:typeof data==='string'?data.replace(_re_new_lines," "):data}});var __numericReplace=function(d,decimalPlace,re1,re2){if(d!==0&&(!d||d==='-')){return-Infinity}
if(decimalPlace){d=_numToDecimal(d,decimalPlace)}
if(d.replace){if(re1){d=d.replace(re1,'')}
if(re2){d=d.replace(re2,'')}}
return d*1};function _addNumericSort(decimalPlace){$.each({"num":function(d){return __numericReplace(d,decimalPlace)},"num-fmt":function(d){return __numericReplace(d,decimalPlace,_re_formatted_numeric)},"html-num":function(d){return __numericReplace(d,decimalPlace,_re_html)},"html-num-fmt":function(d){return __numericReplace(d,decimalPlace,_re_html,_re_formatted_numeric)}},function(key,fn){_ext.type.order[key+decimalPlace+'-pre']=fn;if(key.match(/^html\-/)){_ext.type.search[key+decimalPlace]=_ext.type.search.html}})}
$.extend(_ext.type.order,{"date-pre":function(d){var ts=Date.parse(d);return isNaN(ts)?-Infinity:ts},"html-pre":function(a){return _empty(a)?'':a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+''},"string-pre":function(a){return _empty(a)?'':typeof a==='string'?a.toLowerCase():!a.toString?'':a.toString()},"string-asc":function(x,y){return((x<y)?-1:((x>y)?1:0))},"string-desc":function(x,y){return((x<y)?1:((x>y)?-1:0))}});_addNumericSort('');$.extend(!0,DataTable.ext.renderer,{header:{_:function(settings,cell,column,classes){$(settings.nTable).on('order.dt.DT',function(e,ctx,sorting,columns){if(settings!==ctx){return}
var colIdx=column.idx;cell.removeClass(column.sSortingClass+' '+classes.sSortAsc+' '+classes.sSortDesc).addClass(columns[colIdx]=='asc'?classes.sSortAsc:columns[colIdx]=='desc'?classes.sSortDesc:column.sSortingClass)})},jqueryui:function(settings,cell,column,classes){$('<div/>').addClass(classes.sSortJUIWrapper).append(cell.contents()).append($('<span/>').addClass(classes.sSortIcon+' '+column.sSortingClassJUI)).appendTo(cell);$(settings.nTable).on('order.dt.DT',function(e,ctx,sorting,columns){if(settings!==ctx){return}
var colIdx=column.idx;cell.removeClass(classes.sSortAsc+" "+classes.sSortDesc).addClass(columns[colIdx]=='asc'?classes.sSortAsc:columns[colIdx]=='desc'?classes.sSortDesc:column.sSortingClass);cell.find('span.'+classes.sSortIcon).removeClass(classes.sSortJUIAsc+" "+classes.sSortJUIDesc+" "+classes.sSortJUI+" "+classes.sSortJUIAscAllowed+" "+classes.sSortJUIDescAllowed).addClass(columns[colIdx]=='asc'?classes.sSortJUIAsc:columns[colIdx]=='desc'?classes.sSortJUIDesc:column.sSortingClassJUI)})}}});var __htmlEscapeEntities=function(d){return typeof d==='string'?d.replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'):d};DataTable.render={number:function(thousands,decimal,precision,prefix,postfix){return{display:function(d){if(typeof d!=='number'&&typeof d!=='string'){return d}
var negative=d<0?'-':'';var flo=parseFloat(d);if(isNaN(flo)){return __htmlEscapeEntities(d)}
flo=flo.toFixed(precision);d=Math.abs(flo);var intPart=parseInt(d,100);var floatPart=precision?decimal+(d-intPart).toFixed(precision).substring(2):'';return negative+(prefix||'')+intPart.toString().replace(/\B(?=(\d{3})+(?!\d))/g,thousands)+floatPart+(postfix||'')}}},text:function(){return{display:__htmlEscapeEntities}}};function _fnExternApiFunc(fn)
{return function(){var args=[_fnSettingsFromNode(this[DataTable.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return DataTable.ext.internal[fn].apply(this,args)}}
$.extend(DataTable.ext.internal,{_fnExternApiFunc:_fnExternApiFunc,_fnBuildAjax:_fnBuildAjax,_fnAjaxUpdate:_fnAjaxUpdate,_fnAjaxParameters:_fnAjaxParameters,_fnAjaxUpdateDraw:_fnAjaxUpdateDraw,_fnAjaxDataSrc:_fnAjaxDataSrc,_fnAddColumn:_fnAddColumn,_fnColumnOptions:_fnColumnOptions,_fnAdjustColumnSizing:_fnAdjustColumnSizing,_fnVisibleToColumnIndex:_fnVisibleToColumnIndex,_fnColumnIndexToVisible:_fnColumnIndexToVisible,_fnVisbleColumns:_fnVisbleColumns,_fnGetColumns:_fnGetColumns,_fnColumnTypes:_fnColumnTypes,_fnApplyColumnDefs:_fnApplyColumnDefs,_fnHungarianMap:_fnHungarianMap,_fnCamelToHungarian:_fnCamelToHungarian,_fnLanguageCompat:_fnLanguageCompat,_fnBrowserDetect:_fnBrowserDetect,_fnAddData:_fnAddData,_fnAddTr:_fnAddTr,_fnNodeToDataIndex:_fnNodeToDataIndex,_fnNodeToColumnIndex:_fnNodeToColumnIndex,_fnGetCellData:_fnGetCellData,_fnSetCellData:_fnSetCellData,_fnSplitObjNotation:_fnSplitObjNotation,_fnGetObjectDataFn:_fnGetObjectDataFn,_fnSetObjectDataFn:_fnSetObjectDataFn,_fnGetDataMaster:_fnGetDataMaster,_fnClearTable:_fnClearTable,_fnDeleteIndex:_fnDeleteIndex,_fnInvalidate:_fnInvalidate,_fnGetRowElements:_fnGetRowElements,_fnCreateTr:_fnCreateTr,_fnBuildHead:_fnBuildHead,_fnDrawHead:_fnDrawHead,_fnDraw:_fnDraw,_fnReDraw:_fnReDraw,_fnAddOptionsHtml:_fnAddOptionsHtml,_fnDetectHeader:_fnDetectHeader,_fnGetUniqueThs:_fnGetUniqueThs,_fnFeatureHtmlFilter:_fnFeatureHtmlFilter,_fnFilterComplete:_fnFilterComplete,_fnFilterCustom:_fnFilterCustom,_fnFilterColumn:_fnFilterColumn,_fnFilter:_fnFilter,_fnFilterCreateSearch:_fnFilterCreateSearch,_fnEscapeRegex:_fnEscapeRegex,_fnFilterData:_fnFilterData,_fnFeatureHtmlInfo:_fnFeatureHtmlInfo,_fnUpdateInfo:_fnUpdateInfo,_fnInfoMacros:_fnInfoMacros,_fnInitialise:_fnInitialise,_fnInitComplete:_fnInitComplete,_fnLengthChange:_fnLengthChange,_fnFeatureHtmlLength:_fnFeatureHtmlLength,_fnFeatureHtmlPaginate:_fnFeatureHtmlPaginate,_fnPageChange:_fnPageChange,_fnFeatureHtmlProcessing:_fnFeatureHtmlProcessing,_fnProcessingDisplay:_fnProcessingDisplay,_fnFeatureHtmlTable:_fnFeatureHtmlTable,_fnScrollDraw:_fnScrollDraw,_fnApplyToChildren:_fnApplyToChildren,_fnCalculateColumnWidths:_fnCalculateColumnWidths,_fnThrottle:_fnThrottle,_fnConvertToWidth:_fnConvertToWidth,_fnGetWidestNode:_fnGetWidestNode,_fnGetMaxLenString:_fnGetMaxLenString,_fnStringToCss:_fnStringToCss,_fnSortFlatten:_fnSortFlatten,_fnSort:_fnSort,_fnSortAria:_fnSortAria,_fnSortListener:_fnSortListener,_fnSortAttachListener:_fnSortAttachListener,_fnSortingClasses:_fnSortingClasses,_fnSortData:_fnSortData,_fnSaveState:_fnSaveState,_fnLoadState:_fnLoadState,_fnSettingsFromNode:_fnSettingsFromNode,_fnLog:_fnLog,_fnMap:_fnMap,_fnBindAction:_fnBindAction,_fnCallbackReg:_fnCallbackReg,_fnCallbackFire:_fnCallbackFire,_fnLengthOverflow:_fnLengthOverflow,_fnRenderer:_fnRenderer,_fnDataSource:_fnDataSource,_fnRowAttributes:_fnRowAttributes,_fnExtend:_fnExtend,_fnCalculateEnd:function(){}});$.fn.dataTable=DataTable;DataTable.$=$;$.fn.dataTableSettings=DataTable.settings;$.fn.dataTableExt=DataTable.ext;$.fn.DataTable=function(opts){return $(this).dataTable(opts).api()};$.each(DataTable,function(prop,val){$.fn.DataTable[prop]=val});return $.fn.dataTable}));(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net'],function($){return factory($,window,document)})}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$}
return factory($,root,root.document)}}
else{factory(jQuery,window,document)}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;$.extend(!0,DataTable.defaults,{dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>"+"<'row'<'col-sm-12'tr>>"+"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",renderer:'bootstrap'});$.extend(DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap4",sFilterInput:"form-control form-control-sm",sLengthSelect:"custom-select custom-select-sm form-control form-control-sm",sProcessing:"dataTables_processing card",sPageButton:"paginate_button page-item"});DataTable.ext.renderer.pageButton.bootstrap=function(settings,host,idx,buttons,page,pages){var api=new DataTable.Api(settings);var classes=settings.oClasses;var lang=settings.oLanguage.oPaginate;var aria=settings.oLanguage.oAria.paginate||{};var btnDisplay,btnClass,counter=0;var attach=function(container,buttons){var i,ien,node,button;var clickHandler=function(e){e.preventDefault();if(!$(e.currentTarget).hasClass('disabled')&&api.page()!=e.data.action){api.page(e.data.action).draw('page')}};for(i=0,ien=buttons.length;i<ien;i++){button=buttons[i];if($.isArray(button)){attach(container,button)}
else{btnDisplay='';btnClass='';switch(button){case 'ellipsis':btnDisplay='&#x2026;';btnClass='disabled';break;case 'first':btnDisplay=lang.sFirst;btnClass=button+(page>0?'':' disabled');break;case 'previous':btnDisplay=lang.sPrevious;btnClass=button+(page>0?'':' disabled');break;case 'next':btnDisplay=lang.sNext;btnClass=button+(page<pages-1?'':' disabled');break;case 'last':btnDisplay=lang.sLast;btnClass=button+(page<pages-1?'':' disabled');break;default:btnDisplay=button+1;btnClass=page===button?'active':'';break}
if(btnDisplay){node=$('<li>',{'class':classes.sPageButton+' '+btnClass,'id':idx===0&&typeof button==='string'?settings.sTableId+'_'+button:null}).append($('<a>',{'href':'#','aria-controls':settings.sTableId,'aria-label':aria[button],'data-dt-idx':counter,'tabindex':settings.iTabIndex,'class':'page-link'}).html(btnDisplay)).appendTo(container);settings.oApi._fnBindAction(node,{action:button},clickHandler);counter++}}}};var activeEl;try{activeEl=$(host).find(document.activeElement).data('dt-idx')}
catch(e){}
attach($(host).empty().html('<ul class="pagination"/>').children('ul'),buttons);if(activeEl!==undefined){$(host).find('[data-dt-idx='+activeEl+']').focus()}};return DataTable}));(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net'],function($){return factory($,window,document)})}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$}
return factory($,root,root.document)}}
else{factory(jQuery,window,document)}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;var Responsive=function(settings,opts){if(!DataTable.versionCheck||!DataTable.versionCheck('1.10.10')){throw 'DataTables Responsive requires DataTables 1.10.10 or newer'}
this.s={dt:new DataTable.Api(settings),columns:[],current:[]};if(this.s.dt.settings()[0].responsive){return}
if(opts&&typeof opts.details==='string'){opts.details={type:opts.details}}
else if(opts&&opts.details===!1){opts.details={type:!1}}
else if(opts&&opts.details===!0){opts.details={type:'inline'}}
this.c=$.extend(!0,{},Responsive.defaults,DataTable.defaults.responsive,opts);settings.responsive=this;this._constructor()};$.extend(Responsive.prototype,{_constructor:function()
{var that=this;var dt=this.s.dt;var dtPrivateSettings=dt.settings()[0];var oldWindowWidth=$(window).width();dt.settings()[0]._responsive=this;$(window).on('resize.dtr orientationchange.dtr',DataTable.util.throttle(function(){var width=$(window).width();if(width!==oldWindowWidth){that._resize();oldWindowWidth=width}}));dtPrivateSettings.oApi._fnCallbackReg(dtPrivateSettings,'aoRowCreatedCallback',function(tr,data,idx){if($.inArray(!1,that.s.current)!==-1){$('>td, >th',tr).each(function(i){var idx=dt.column.index('toData',i);if(that.s.current[idx]===!1){$(this).css('display','none')}})}});dt.on('destroy.dtr',function(){dt.off('.dtr');$(dt.table().body()).off('.dtr');$(window).off('resize.dtr orientationchange.dtr');$.each(that.s.current,function(i,val){if(val===!1){that._setColumnVis(i,!0)}})});this.c.breakpoints.sort(function(a,b){return a.width<b.width?1:a.width>b.width?-1:0});this._classLogic();this._resizeAuto();var details=this.c.details;if(details.type!==!1){that._detailsInit();dt.on('column-visibility.dtr',function(){if(that._timer){clearTimeout(that._timer)}
that._timer=setTimeout(function(){that._timer=null;that._classLogic();that._resizeAuto();that._resize();that._redrawChildren()},100)});dt.on('draw.dtr',function(){that._redrawChildren()});$(dt.table().node()).addClass('dtr-'+details.type)}
dt.on('column-reorder.dtr',function(e,settings,details){that._classLogic();that._resizeAuto();that._resize()});dt.on('column-sizing.dtr',function(){that._resizeAuto();that._resize()});dt.on('preXhr.dtr',function(){var rowIds=[];dt.rows().every(function(){if(this.child.isShown()){rowIds.push(this.id(!0))}});dt.one('draw.dtr',function(){that._resizeAuto();that._resize();dt.rows(rowIds).every(function(){that._detailsDisplay(this,!1)})})});dt.on('init.dtr',function(e,settings,details){that._resizeAuto();that._resize();if($.inArray(!1,that.s.current)){dt.columns.adjust()}});this._resize()},_columnsVisiblity:function(breakpoint)
{var dt=this.s.dt;var columns=this.s.columns;var i,ien;var order=columns.map(function(col,idx){return{columnIdx:idx,priority:col.priority}}).sort(function(a,b){if(a.priority!==b.priority){return a.priority-b.priority}
return a.columnIdx-b.columnIdx});var display=$.map(columns,function(col,i){if(dt.column(i).visible()===!1){return'not-visible'}
return col.auto&&col.minWidth===null?!1:col.auto===!0?'-':$.inArray(breakpoint,col.includeIn)!==-1});var requiredWidth=0;for(i=0,ien=display.length;i<ien;i++){if(display[i]===!0){requiredWidth+=columns[i].minWidth}}
var scrolling=dt.settings()[0].oScroll;var bar=scrolling.sY||scrolling.sX?scrolling.iBarWidth:0;var widthAvailable=dt.table().container().offsetWidth-bar;var usedWidth=widthAvailable-requiredWidth;for(i=0,ien=display.length;i<ien;i++){if(columns[i].control){usedWidth-=columns[i].minWidth}}
var empty=!1;for(i=0,ien=order.length;i<ien;i++){var colIdx=order[i].columnIdx;if(display[colIdx]==='-'&&!columns[colIdx].control&&columns[colIdx].minWidth){if(empty||usedWidth-columns[colIdx].minWidth<0){empty=!0;display[colIdx]=!1}
else{display[colIdx]=!0}
usedWidth-=columns[colIdx].minWidth}}
var showControl=!1;for(i=0,ien=columns.length;i<ien;i++){if(!columns[i].control&&!columns[i].never&&display[i]===!1){showControl=!0;break}}
for(i=0,ien=columns.length;i<ien;i++){if(columns[i].control){display[i]=showControl}
if(display[i]==='not-visible'){display[i]=!1}}
if($.inArray(!0,display)===-1){display[0]=!0}
return display},_classLogic:function()
{var that=this;var calc={};var breakpoints=this.c.breakpoints;var dt=this.s.dt;var columns=dt.columns().eq(0).map(function(i){var column=this.column(i);var className=column.header().className;var priority=dt.settings()[0].aoColumns[i].responsivePriority;if(priority===undefined){var dataPriority=$(column.header()).data('priority');priority=dataPriority!==undefined?dataPriority*1:10000}
return{className:className,includeIn:[],auto:!1,control:!1,never:className.match(/\bnever\b/)?!0:!1,priority:priority}});var add=function(colIdx,name){var includeIn=columns[colIdx].includeIn;if($.inArray(name,includeIn)===-1){includeIn.push(name)}};var column=function(colIdx,name,operator,matched){var size,i,ien;if(!operator){columns[colIdx].includeIn.push(name)}
else if(operator==='max-'){size=that._find(name).width;for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].width<=size){add(colIdx,breakpoints[i].name)}}}
else if(operator==='min-'){size=that._find(name).width;for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].width>=size){add(colIdx,breakpoints[i].name)}}}
else if(operator==='not-'){for(i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].name.indexOf(matched)===-1){add(colIdx,breakpoints[i].name)}}}};columns.each(function(col,i){var classNames=col.className.split(' ');var hasClass=!1;for(var k=0,ken=classNames.length;k<ken;k++){var className=$.trim(classNames[k]);if(className==='all'){hasClass=!0;col.includeIn=$.map(breakpoints,function(a){return a.name});return}
else if(className==='none'||col.never){hasClass=!0;return}
else if(className==='control'){hasClass=!0;col.control=!0;return}
$.each(breakpoints,function(j,breakpoint){var brokenPoint=breakpoint.name.split('-');var re=new RegExp('(min\\-|max\\-|not\\-)?('+brokenPoint[0]+')(\\-[_a-zA-Z0-9])?');var match=className.match(re);if(match){hasClass=!0;if(match[2]===brokenPoint[0]&&match[3]==='-'+brokenPoint[1]){column(i,breakpoint.name,match[1],match[2]+match[3])}
else if(match[2]===brokenPoint[0]&&!match[3]){column(i,breakpoint.name,match[1],match[2])}}})}
if(!hasClass){col.auto=!0}});this.s.columns=columns},_detailsDisplay:function(row,update)
{var that=this;var dt=this.s.dt;var details=this.c.details;if(details&&details.type!==!1){var res=details.display(row,update,function(){return details.renderer(dt,row[0],that._detailsObj(row[0]))});if(res===!0||res===!1){$(dt.table().node()).triggerHandler('responsive-display.dt',[dt,row,res,update])}}},_detailsInit:function()
{var that=this;var dt=this.s.dt;var details=this.c.details;if(details.type==='inline'){details.target='td:first-child, th:first-child'}
dt.on('draw.dtr',function(){that._tabIndexes()});that._tabIndexes();$(dt.table().body()).on('keyup.dtr','td, th',function(e){if(e.keyCode===13&&$(this).data('dtr-keyboard')){$(this).click()}});var target=details.target;var selector=typeof target==='string'?target:'td, th';$(dt.table().body()).on('click.dtr mousedown.dtr mouseup.dtr',selector,function(e){if(!$(dt.table().node()).hasClass('collapsed')){return}
if($.inArray($(this).closest('tr').get(0),dt.rows().nodes().toArray())===-1){return}
if(typeof target==='number'){var targetIdx=target<0?dt.columns().eq(0).length+target:target;if(dt.cell(this).index().column!==targetIdx){return}}
var row=dt.row($(this).closest('tr'));if(e.type==='click'){that._detailsDisplay(row,!1)}
else if(e.type==='mousedown'){$(this).css('outline','none')}
else if(e.type==='mouseup'){$(this).blur().css('outline','')}})},_detailsObj:function(rowIdx)
{var that=this;var dt=this.s.dt;return $.map(this.s.columns,function(col,i){if(col.never||col.control){return}
return{title:dt.settings()[0].aoColumns[i].sTitle,data:dt.cell(rowIdx,i).render(that.c.orthogonal),hidden:dt.column(i).visible()&&!that.s.current[i],columnIndex:i,rowIndex:rowIdx}})},_find:function(name)
{var breakpoints=this.c.breakpoints;for(var i=0,ien=breakpoints.length;i<ien;i++){if(breakpoints[i].name===name){return breakpoints[i]}}},_redrawChildren:function()
{var that=this;var dt=this.s.dt;dt.rows({page:'current'}).iterator('row',function(settings,idx){var row=dt.row(idx);that._detailsDisplay(dt.row(idx),!0)})},_resize:function()
{var that=this;var dt=this.s.dt;var width=$(window).width();var breakpoints=this.c.breakpoints;var breakpoint=breakpoints[0].name;var columns=this.s.columns;var i,ien;var oldVis=this.s.current.slice();for(i=breakpoints.length-1;i>=0;i--){if(width<=breakpoints[i].width){breakpoint=breakpoints[i].name;break}}
var columnsVis=this._columnsVisiblity(breakpoint);this.s.current=columnsVis;var collapsedClass=!1;for(i=0,ien=columns.length;i<ien;i++){if(columnsVis[i]===!1&&!columns[i].never&&!columns[i].control&&!dt.column(i).visible()===!1){collapsedClass=!0;break}}
$(dt.table().node()).toggleClass('collapsed',collapsedClass);var changed=!1;var visible=0;dt.columns().eq(0).each(function(colIdx,i){if(columnsVis[i]===!0){visible++}
if(columnsVis[i]!==oldVis[i]){changed=!0;that._setColumnVis(colIdx,columnsVis[i])}});if(changed){this._redrawChildren();$(dt.table().node()).trigger('responsive-resize.dt',[dt,this.s.current]);if(dt.page.info().recordsDisplay===0){$('td',dt.table().body()).eq(0).attr('colspan',visible)}}},_resizeAuto:function()
{var dt=this.s.dt;var columns=this.s.columns;if(!this.c.auto){return}
if($.inArray(!0,$.map(columns,function(c){return c.auto}))===-1){return}
if(!$.isEmptyObject(_childNodeStore)){$.each(_childNodeStore,function(key){var idx=key.split('-');_childNodesRestore(dt,idx[0]*1,idx[1]*1)})}
var tableWidth=dt.table().node().offsetWidth;var columnWidths=dt.columns;var clonedTable=dt.table().node().cloneNode(!1);var clonedHeader=$(dt.table().header().cloneNode(!1)).appendTo(clonedTable);var clonedBody=$(dt.table().body()).clone(!1,!1).empty().appendTo(clonedTable);var headerCells=dt.columns().header().filter(function(idx){return dt.column(idx).visible()}).to$().clone(!1).css('display','table-cell').css('min-width',0);$(clonedBody).append($(dt.rows({page:'current'}).nodes()).clone(!1)).find('th, td').css('display','');var footer=dt.table().footer();if(footer){var clonedFooter=$(footer.cloneNode(!1)).appendTo(clonedTable);var footerCells=dt.columns().footer().filter(function(idx){return dt.column(idx).visible()}).to$().clone(!1).css('display','table-cell');$('<tr/>').append(footerCells).appendTo(clonedFooter)}
$('<tr/>').append(headerCells).appendTo(clonedHeader);if(this.c.details.type==='inline'){$(clonedTable).addClass('dtr-inline collapsed')}
$(clonedTable).find('[name]').removeAttr('name');$(clonedTable).css('position','relative')
var inserted=$('<div/>').css({width:1,height:1,overflow:'hidden',clear:'both'}).append(clonedTable);inserted.insertBefore(dt.table().node());headerCells.each(function(i){var idx=dt.column.index('fromVisible',i);columns[idx].minWidth=this.offsetWidth||0});inserted.remove()},_setColumnVis:function(col,showHide)
{var dt=this.s.dt;var display=showHide?'':'none';$(dt.column(col).header()).css('display',display);$(dt.column(col).footer()).css('display',display);dt.column(col).nodes().to$().css('display',display);if(!$.isEmptyObject(_childNodeStore)){dt.cells(null,col).indexes().each(function(idx){_childNodesRestore(dt,idx.row,idx.column)})}},_tabIndexes:function()
{var dt=this.s.dt;var cells=dt.cells({page:'current'}).nodes().to$();var ctx=dt.settings()[0];var target=this.c.details.target;cells.filter('[data-dtr-keyboard]').removeData('[data-dtr-keyboard]');if(typeof target==='number'){dt.cells(null,target,{page:'current'}).nodes().to$().attr('tabIndex',ctx.iTabIndex).data('dtr-keyboard',1)}
else{if(target==='td:first-child, th:first-child'){target='>td:first-child, >th:first-child'}
$(target,dt.rows({page:'current'}).nodes()).attr('tabIndex',ctx.iTabIndex).data('dtr-keyboard',1)}}});Responsive.breakpoints=[{name:'desktop',width:Infinity},{name:'tablet-l',width:1024},{name:'tablet-p',width:768},{name:'mobile-l',width:480},{name:'mobile-p',width:320}];Responsive.display={childRow:function(row,update,render){if(update){if($(row.node()).hasClass('parent')){row.child(render(),'child').show();return!0}}
else{if(!row.child.isShown()){row.child(render(),'child').show();$(row.node()).addClass('parent');return!0}
else{row.child(!1);$(row.node()).removeClass('parent');return!1}}},childRowImmediate:function(row,update,render){if((!update&&row.child.isShown())||!row.responsive.hasHidden()){row.child(!1);$(row.node()).removeClass('parent');return!1}
else{row.child(render(),'child').show();$(row.node()).addClass('parent');return!0}},modal:function(options){return function(row,update,render){if(!update){var close=function(){modal.remove();$(document).off('keypress.dtr')};var modal=$('<div class="dtr-modal"/>').append($('<div class="dtr-modal-display"/>').append($('<div class="dtr-modal-content"/>').append(render())).append($('<div class="dtr-modal-close">&times;</div>').click(function(){close()}))).append($('<div class="dtr-modal-background"/>').click(function(){close()})).appendTo('body');$(document).on('keyup.dtr',function(e){if(e.keyCode===27){e.stopPropagation();close()}})}
else{$('div.dtr-modal-content').empty().append(render())}
if(options&&options.header){$('div.dtr-modal-content').prepend('<h2>'+options.header(row)+'</h2>')}}}};var _childNodeStore={};function _childNodes(dt,row,col){var name=row+'-'+col;if(_childNodeStore[name]){return _childNodeStore[name]}
var nodes=[];var children=dt.cell(row,col).node().childNodes;for(var i=0,ien=children.length;i<ien;i++){nodes.push(children[i])}
_childNodeStore[name]=nodes;return nodes}
function _childNodesRestore(dt,row,col){var name=row+'-'+col;if(!_childNodeStore[name]){return}
var node=dt.cell(row,col).node();var store=_childNodeStore[name];var parent=store[0].parentNode;var parentChildren=parent.childNodes;var a=[];for(var i=0,ien=parentChildren.length;i<ien;i++){a.push(parentChildren[i])}
for(var j=0,jen=a.length;j<jen;j++){node.appendChild(a[j])}
_childNodeStore[name]=undefined}
Responsive.renderer={listHiddenNodes:function(){return function(api,rowIdx,columns){var ul=$('<ul data-dtr-index="'+rowIdx+'" class="dtr-details"/>');var found=!1;var data=$.each(columns,function(i,col){if(col.hidden){$('<li data-dtr-index="'+col.columnIndex+'" data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+'<span class="dtr-title">'+col.title+'</span> '+'</li>').append($('<span class="dtr-data"/>').append(_childNodes(api,col.rowIndex,col.columnIndex))).appendTo(ul);found=!0}});return found?ul:!1}},listHidden:function(){return function(api,rowIdx,columns){var data=$.map(columns,function(col){return col.hidden?'<li data-dtr-index="'+col.columnIndex+'" data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+'<span class="dtr-title">'+col.title+'</span> '+'<span class="dtr-data">'+col.data+'</span>'+'</li>':''}).join('');return data?$('<ul data-dtr-index="'+rowIdx+'" class="dtr-details"/>').append(data):!1}},tableAll:function(options){options=$.extend({tableClass:''},options);return function(api,rowIdx,columns){var data=$.map(columns,function(col){return'<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+'<td>'+col.title+':'+'</td> '+'<td>'+col.data+'</td>'+'</tr>'}).join('');return $('<table class="'+options.tableClass+' dtr-details" width="100%"/>').append(data)}}};Responsive.defaults={breakpoints:Responsive.breakpoints,auto:!0,details:{display:Responsive.display.childRow,renderer:Responsive.renderer.listHidden(),target:0,type:'inline'},orthogonal:'display'};var Api=$.fn.dataTable.Api;Api.register('responsive()',function(){return this});Api.register('responsive.index()',function(li){li=$(li);return{column:li.data('dtr-index'),row:li.parent().data('dtr-index')}});Api.register('responsive.rebuild()',function(){return this.iterator('table',function(ctx){if(ctx._responsive){ctx._responsive._classLogic()}})});Api.register('responsive.recalc()',function(){return this.iterator('table',function(ctx){if(ctx._responsive){ctx._responsive._resizeAuto();ctx._responsive._resize()}})});Api.register('responsive.hasHidden()',function(){var ctx=this.context[0];return ctx._responsive?$.inArray(!1,ctx._responsive.s.current)!==-1:!1});Api.registerPlural('columns().responsiveHidden()','column().responsiveHidden()',function(){return this.iterator('column',function(settings,column){return settings._responsive?settings._responsive.s.current[column]:!1},1)});Responsive.version='2.2.2';$.fn.dataTable.Responsive=Responsive;$.fn.DataTable.Responsive=Responsive;$(document).on('preInit.dt.dtr',function(e,settings,json){if(e.namespace!=='dt'){return}
if($(settings.nTable).hasClass('responsive')||$(settings.nTable).hasClass('dt-responsive')||settings.oInit.responsive||DataTable.defaults.responsive){var init=settings.oInit.responsive;if(init!==!1){new Responsive(settings,$.isPlainObject(init)?init:{})}}});return Responsive}));(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net'],function($){return factory($,window,document)})}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$}
return factory($,root,root.document)}}
else{factory(jQuery,window,document)}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;var RowReorder=function(dt,opts){if(!DataTable.versionCheck||!DataTable.versionCheck('1.10.8')){throw 'DataTables RowReorder requires DataTables 1.10.8 or newer'}
this.c=$.extend(!0,{},DataTable.defaults.rowReorder,RowReorder.defaults,opts);this.s={bodyTop:null,dt:new DataTable.Api(dt),getDataFn:DataTable.ext.oApi._fnGetObjectDataFn(this.c.dataSrc),middles:null,scroll:{},scrollInterval:null,setDataFn:DataTable.ext.oApi._fnSetObjectDataFn(this.c.dataSrc),start:{top:0,left:0,offsetTop:0,offsetLeft:0,nodes:[]},windowHeight:0,documentOuterHeight:0,domCloneOuterHeight:0};this.dom={clone:null,dtScroll:$('div.dataTables_scrollBody',this.s.dt.table().container())};var settings=this.s.dt.settings()[0];var exisiting=settings.rowreorder;if(exisiting){return exisiting}
settings.rowreorder=this;this._constructor()};$.extend(RowReorder.prototype,{_constructor:function()
{var that=this;var dt=this.s.dt;var table=$(dt.table().node());if(table.css('position')==='static'){table.css('position','relative')}
$(dt.table().container()).on('mousedown.rowReorder touchstart.rowReorder',this.c.selector,function(e){if(!that.c.enable){return}
if($(e.target).is(that.c.excludedChildren)){return!0}
var tr=$(this).closest('tr');var row=dt.row(tr);if(row.any()){that._emitEvent('pre-row-reorder',{node:row.node(),index:row.index()});that._mouseDown(e,tr);return!1}});dt.on('destroy.rowReorder',function(){$(dt.table().container()).off('.rowReorder');dt.off('.rowReorder')})},_cachePositions:function()
{var dt=this.s.dt;var headerHeight=$(dt.table().node()).find('thead').outerHeight();var nodes=$.unique(dt.rows({page:'current'}).nodes().toArray());var tops=$.map(nodes,function(node,i){return $(node).position().top-headerHeight});var middles=$.map(tops,function(top,i){return tops.length<i-1?(top+tops[i+1])/2:(top+top+$(dt.row(':last-child').node()).outerHeight())/2});this.s.middles=middles;this.s.bodyTop=$(dt.table().body()).offset().top;this.s.windowHeight=$(window).height();this.s.documentOuterHeight=$(document).outerHeight()},_clone:function(target)
{var dt=this.s.dt;var clone=$(dt.table().node().cloneNode(!1)).addClass('dt-rowReorder-float').append('<tbody/>').append(target.clone(!1));var tableWidth=target.outerWidth();var tableHeight=target.outerHeight();var sizes=target.children().map(function(){return $(this).width()});clone.width(tableWidth).height(tableHeight).find('tr').children().each(function(i){this.style.width=sizes[i]+'px'});clone.appendTo('body');this.dom.clone=clone;this.s.domCloneOuterHeight=clone.outerHeight()},_clonePosition:function(e)
{var start=this.s.start;var topDiff=this._eventToPage(e,'Y')-start.top;var leftDiff=this._eventToPage(e,'X')-start.left;var snap=this.c.snapX;var left;var top=topDiff+start.offsetTop;if(snap===!0){left=start.offsetLeft}
else if(typeof snap==='number'){left=start.offsetLeft+snap}
else{left=leftDiff+start.offsetLeft}
if(top<0){top=0}
else if(top+this.s.domCloneOuterHeight>this.s.documentOuterHeight){top=this.s.documentOuterHeight-this.s.domCloneOuterHeight}
this.dom.clone.css({top:top,left:left})},_emitEvent:function(name,args)
{this.s.dt.iterator('table',function(ctx,i){$(ctx.nTable).triggerHandler(name+'.dt',args)})},_eventToPage:function(e,pos)
{if(e.type.indexOf('touch')!==-1){return e.originalEvent.touches[0]['page'+pos]}
return e['page'+pos]},_mouseDown:function(e,target)
{var that=this;var dt=this.s.dt;var start=this.s.start;var offset=target.offset();start.top=this._eventToPage(e,'Y');start.left=this._eventToPage(e,'X');start.offsetTop=offset.top;start.offsetLeft=offset.left;start.nodes=$.unique(dt.rows({page:'current'}).nodes().toArray());this._cachePositions();this._clone(target);this._clonePosition(e);this.dom.target=target;target.addClass('dt-rowReorder-moving');$(document).on('mouseup.rowReorder touchend.rowReorder',function(e){that._mouseUp(e)}).on('mousemove.rowReorder touchmove.rowReorder',function(e){that._mouseMove(e)});if($(window).width()===$(document).width()){$(document.body).addClass('dt-rowReorder-noOverflow')}
var scrollWrapper=this.dom.dtScroll;this.s.scroll={windowHeight:$(window).height(),windowWidth:$(window).width(),dtTop:scrollWrapper.length?scrollWrapper.offset().top:null,dtLeft:scrollWrapper.length?scrollWrapper.offset().left:null,dtHeight:scrollWrapper.length?scrollWrapper.outerHeight():null,dtWidth:scrollWrapper.length?scrollWrapper.outerWidth():null}},_mouseMove:function(e)
{this._clonePosition(e);var bodyY=this._eventToPage(e,'Y')-this.s.bodyTop;var middles=this.s.middles;var insertPoint=null;var dt=this.s.dt;var body=dt.table().body();for(var i=0,ien=middles.length;i<ien;i++){if(bodyY<middles[i]){insertPoint=i;break}}
if(insertPoint===null){insertPoint=middles.length}
if(this.s.lastInsert===null||this.s.lastInsert!==insertPoint){if(insertPoint===0){this.dom.target.prependTo(body)}
else{var nodes=$.unique(dt.rows({page:'current'}).nodes().toArray());if(insertPoint>this.s.lastInsert){this.dom.target.insertAfter(nodes[insertPoint-1])}
else{this.dom.target.insertBefore(nodes[insertPoint])}}
this._cachePositions();this.s.lastInsert=insertPoint}
this._shiftScroll(e)},_mouseUp:function(e)
{var that=this;var dt=this.s.dt;var i,ien;var dataSrc=this.c.dataSrc;this.dom.clone.remove();this.dom.clone=null;this.dom.target.removeClass('dt-rowReorder-moving');$(document).off('.rowReorder');$(document.body).removeClass('dt-rowReorder-noOverflow');clearInterval(this.s.scrollInterval);this.s.scrollInterval=null;var startNodes=this.s.start.nodes;var endNodes=$.unique(dt.rows({page:'current'}).nodes().toArray());var idDiff={};var fullDiff=[];var diffNodes=[];var getDataFn=this.s.getDataFn;var setDataFn=this.s.setDataFn;for(i=0,ien=startNodes.length;i<ien;i++){if(startNodes[i]!==endNodes[i]){var id=dt.row(endNodes[i]).id();var endRowData=dt.row(endNodes[i]).data();var startRowData=dt.row(startNodes[i]).data();if(id){idDiff[id]=getDataFn(startRowData)}
fullDiff.push({node:endNodes[i],oldData:getDataFn(endRowData),newData:getDataFn(startRowData),newPosition:i,oldPosition:$.inArray(endNodes[i],startNodes)});diffNodes.push(endNodes[i])}}
var eventArgs=[fullDiff,{dataSrc:dataSrc,nodes:diffNodes,values:idDiff,triggerRow:dt.row(this.dom.target)}];this._emitEvent('row-reorder',eventArgs);var update=function(){if(that.c.update){for(i=0,ien=fullDiff.length;i<ien;i++){var row=dt.row(fullDiff[i].node);var rowData=row.data();setDataFn(rowData,fullDiff[i].newData);dt.columns().every(function(){if(this.dataSrc()===dataSrc){dt.cell(fullDiff[i].node,this.index()).invalidate('data')}})}
that._emitEvent('row-reordered',eventArgs);dt.draw(!1)}};if(this.c.editor){this.c.enable=!1;this.c.editor.edit(diffNodes,!1,$.extend({submit:'changed'},this.c.formOptions)).multiSet(dataSrc,idDiff).one('preSubmitCancelled.rowReorder',function(){that.c.enable=!0;that.c.editor.off('.rowReorder');dt.draw(!1)}).one('submitUnsuccessful.rowReorder',function(){dt.draw(!1)}).one('submitSuccess.rowReorder',function(){update()}).one('submitComplete',function(){that.c.enable=!0;that.c.editor.off('.rowReorder')}).submit()}
else{update()}},_shiftScroll:function(e)
{var that=this;var dt=this.s.dt;var scroll=this.s.scroll;var runInterval=!1;var scrollSpeed=5;var buffer=65;var windowY=e.pageY-document.body.scrollTop,windowVert,dtVert;if(windowY<buffer){windowVert=scrollSpeed*-1}
else if(windowY>scroll.windowHeight-buffer){windowVert=scrollSpeed}
if(scroll.dtTop!==null&&e.pageY<scroll.dtTop+buffer){dtVert=scrollSpeed*-1}
else if(scroll.dtTop!==null&&e.pageY>scroll.dtTop+scroll.dtHeight-buffer){dtVert=scrollSpeed}
if(windowVert||dtVert){scroll.windowVert=windowVert;scroll.dtVert=dtVert;runInterval=!0}
else if(this.s.scrollInterval){clearInterval(this.s.scrollInterval);this.s.scrollInterval=null}
if(!this.s.scrollInterval&&runInterval){this.s.scrollInterval=setInterval(function(){if(scroll.windowVert){document.body.scrollTop+=scroll.windowVert}
if(scroll.dtVert){var scroller=that.dom.dtScroll[0];if(scroll.dtVert){scroller.scrollTop+=scroll.dtVert}}},20)}}});RowReorder.defaults={dataSrc:0,editor:null,enable:!0,formOptions:{},selector:'td:first-child',snapX:!1,update:!0,excludedChildren:'a'};var Api=$.fn.dataTable.Api;Api.register('rowReorder()',function(){return this});Api.register('rowReorder.enable()',function(toggle){if(toggle===undefined){toggle=!0}
return this.iterator('table',function(ctx){if(ctx.rowreorder){ctx.rowreorder.c.enable=toggle}})});Api.register('rowReorder.disable()',function(){return this.iterator('table',function(ctx){if(ctx.rowreorder){ctx.rowreorder.c.enable=!1}})});RowReorder.version='1.2.4';$.fn.dataTable.RowReorder=RowReorder;$.fn.DataTable.RowReorder=RowReorder;$(document).on('init.dt.dtr',function(e,settings,json){if(e.namespace!=='dt'){return}
var init=settings.oInit.rowReorder;var defaults=DataTable.defaults.rowReorder;if(init||defaults){var opts=$.extend({},init,defaults);if(init!==!1){new RowReorder(settings,opts)}}});return RowReorder}));(function(factory){if(typeof define==='function'&&define.amd){define(['jquery','datatables.net'],function($){return factory($,window,document)})}
else if(typeof exports==='object'){module.exports=function(root,$){if(!root){root=window}
if(!$||!$.fn.dataTable){$=require('datatables.net')(root,$).$}
return factory($,root,root.document)}}
else{factory(jQuery,window,document)}}(function($,window,document,undefined){'use strict';var DataTable=$.fn.dataTable;DataTable.select={};DataTable.select.version='1.2.6';DataTable.select.init=function(dt){var ctx=dt.settings()[0];var init=ctx.oInit.select;var defaults=DataTable.defaults.select;var opts=init===undefined?defaults:init;var items='row';var style='api';var blurable=!1;var info=!0;var selector='td, th';var className='selected';var setStyle=!1;ctx._select={};if(opts===!0){style='os';setStyle=!0}
else if(typeof opts==='string'){style=opts;setStyle=!0}
else if($.isPlainObject(opts)){if(opts.blurable!==undefined){blurable=opts.blurable}
if(opts.info!==undefined){info=opts.info}
if(opts.items!==undefined){items=opts.items}
if(opts.style!==undefined){style=opts.style;setStyle=!0}
if(opts.selector!==undefined){selector=opts.selector}
if(opts.className!==undefined){className=opts.className}}
dt.select.selector(selector);dt.select.items(items);dt.select.style(style);dt.select.blurable(blurable);dt.select.info(info);ctx._select.className=className;$.fn.dataTable.ext.order['select-checkbox']=function(settings,col){return this.api().column(col,{order:'index'}).nodes().map(function(td){if(settings._select.items==='row'){return $(td).parent().hasClass(settings._select.className)}else if(settings._select.items==='cell'){return $(td).hasClass(settings._select.className)}
return!1})};if(!setStyle&&$(dt.table().node()).hasClass('selectable')){dt.select.style('os')}};function cellRange(dt,idx,last)
{var indexes;var columnIndexes;var rowIndexes;var selectColumns=function(start,end){if(start>end){var tmp=end;end=start;start=tmp}
var record=!1;return dt.columns(':visible').indexes().filter(function(i){if(i===start){record=!0}
if(i===end){record=!1;return!0}
return record})};var selectRows=function(start,end){var indexes=dt.rows({search:'applied'}).indexes();if(indexes.indexOf(start)>indexes.indexOf(end)){var tmp=end;end=start;start=tmp}
var record=!1;return indexes.filter(function(i){if(i===start){record=!0}
if(i===end){record=!1;return!0}
return record})};if(!dt.cells({selected:!0}).any()&&!last){columnIndexes=selectColumns(0,idx.column);rowIndexes=selectRows(0,idx.row)}
else{columnIndexes=selectColumns(last.column,idx.column);rowIndexes=selectRows(last.row,idx.row)}
indexes=dt.cells(rowIndexes,columnIndexes).flatten();if(!dt.cells(idx,{selected:!0}).any()){dt.cells(indexes).select()}
else{dt.cells(indexes).deselect()}}
function disableMouseSelection(dt)
{var ctx=dt.settings()[0];var selector=ctx._select.selector;$(dt.table().container()).off('mousedown.dtSelect',selector).off('mouseup.dtSelect',selector).off('click.dtSelect',selector);$('body').off('click.dtSelect'+dt.table().node().id)}
function enableMouseSelection(dt)
{var container=$(dt.table().container());var ctx=dt.settings()[0];var selector=ctx._select.selector;var matchSelection;container.on('mousedown.dtSelect',selector,function(e){if(e.shiftKey||e.metaKey||e.ctrlKey){container.css('-moz-user-select','none').one('selectstart.dtSelect',selector,function(){return!1})}
if(window.getSelection){matchSelection=window.getSelection()}}).on('mouseup.dtSelect',selector,function(){container.css('-moz-user-select','')}).on('click.dtSelect',selector,function(e){var items=dt.select.items();var idx;if(window.getSelection){var selection=window.getSelection();if(!selection.anchorNode||$(selection.anchorNode).closest('table')[0]===dt.table().node()){if(selection!==matchSelection){return}}}
var ctx=dt.settings()[0];var wrapperClass=dt.settings()[0].oClasses.sWrapper.replace(/ /g,'.');if($(e.target).closest('div.'+wrapperClass)[0]!=dt.table().container()){return}
var cell=dt.cell($(e.target).closest('td, th'));if(!cell.any()){return}
var event=$.Event('user-select.dt');eventTrigger(dt,event,[items,cell,e]);if(event.isDefaultPrevented()){return}
var cellIndex=cell.index();if(items==='row'){idx=cellIndex.row;typeSelect(e,dt,ctx,'row',idx)}
else if(items==='column'){idx=cell.index().column;typeSelect(e,dt,ctx,'column',idx)}
else if(items==='cell'){idx=cell.index();typeSelect(e,dt,ctx,'cell',idx)}
ctx._select_lastCell=cellIndex});$('body').on('click.dtSelect'+dt.table().node().id,function(e){if(ctx._select.blurable){if($(e.target).parents().filter(dt.table().container()).length){return}
if($(e.target).parents('html').length===0){return}
if($(e.target).parents('div.DTE').length){return}
clear(ctx,!0)}})}
function eventTrigger(api,type,args,any)
{if(any&&!api.flatten().length){return}
if(typeof type==='string'){type=type+'.dt'}
args.unshift(api);$(api.table().node()).trigger(type,args)}
function info(api)
{var ctx=api.settings()[0];if(!ctx._select.info||!ctx.aanFeatures.i){return}
if(api.select.style()==='api'){return}
var rows=api.rows({selected:!0}).flatten().length;var columns=api.columns({selected:!0}).flatten().length;var cells=api.cells({selected:!0}).flatten().length;var add=function(el,name,num){el.append($('<span class="select-item"/>').append(api.i18n('select.'+name+'s',{_:'%d '+name+'s selected',0:'',1:'1 '+name+' selected'},num)))};$.each(ctx.aanFeatures.i,function(i,el){el=$(el);var output=$('<span class="select-info"/>');add(output,'row',rows);add(output,'column',columns);add(output,'cell',cells);var exisiting=el.children('span.select-info');if(exisiting.length){exisiting.remove()}
if(output.text()!==''){el.append(output)}})}
function init(ctx){var api=new DataTable.Api(ctx);ctx.aoRowCreatedCallback.push({fn:function(row,data,index){var i,ien;var d=ctx.aoData[index];if(d._select_selected){$(row).addClass(ctx._select.className)}
for(i=0,ien=ctx.aoColumns.length;i<ien;i++){if(ctx.aoColumns[i]._select_selected||(d._selected_cells&&d._selected_cells[i])){$(d.anCells[i]).addClass(ctx._select.className)}}},sName:'select-deferRender'});api.on('preXhr.dt.dtSelect',function(){var rows=api.rows({selected:!0}).ids(!0).filter(function(d){return d!==undefined});var cells=api.cells({selected:!0}).eq(0).map(function(cellIdx){var id=api.row(cellIdx.row).id(!0);return id?{row:id,column:cellIdx.column}:undefined}).filter(function(d){return d!==undefined});api.one('draw.dt.dtSelect',function(){api.rows(rows).select();if(cells.any()){cells.each(function(id){api.cells(id.row,id.column).select()})}})});api.on('draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt info.dt',function(){info(api)});api.on('destroy.dtSelect',function(){disableMouseSelection(api);api.off('.dtSelect')})}
function rowColumnRange(dt,type,idx,last)
{var indexes=dt[type+'s']({search:'applied'}).indexes();var idx1=$.inArray(last,indexes);var idx2=$.inArray(idx,indexes);if(!dt[type+'s']({selected:!0}).any()&&idx1===-1){indexes.splice($.inArray(idx,indexes)+1,indexes.length)}
else{if(idx1>idx2){var tmp=idx2;idx2=idx1;idx1=tmp}
indexes.splice(idx2+1,indexes.length);indexes.splice(0,idx1)}
if(!dt[type](idx,{selected:!0}).any()){dt[type+'s'](indexes).select()}
else{indexes.splice($.inArray(idx,indexes),1);dt[type+'s'](indexes).deselect()}}
function clear(ctx,force)
{if(force||ctx._select.style==='single'){var api=new DataTable.Api(ctx);api.rows({selected:!0}).deselect();api.columns({selected:!0}).deselect();api.cells({selected:!0}).deselect()}}
function typeSelect(e,dt,ctx,type,idx)
{var style=dt.select.style();var isSelected=dt[type](idx,{selected:!0}).any();if(style==='os'){if(e.ctrlKey||e.metaKey){dt[type](idx).select(!isSelected)}
else if(e.shiftKey){if(type==='cell'){cellRange(dt,idx,ctx._select_lastCell||null)}
else{rowColumnRange(dt,type,idx,ctx._select_lastCell?ctx._select_lastCell[type]:null)}}
else{var selected=dt[type+'s']({selected:!0});if(isSelected&&selected.flatten().length===1){dt[type](idx).deselect()}
else{selected.deselect();dt[type](idx).select()}}}else if(style=='multi+shift'){if(e.shiftKey){if(type==='cell'){cellRange(dt,idx,ctx._select_lastCell||null)}
else{rowColumnRange(dt,type,idx,ctx._select_lastCell?ctx._select_lastCell[type]:null)}}
else{dt[type](idx).select(!isSelected)}}
else{dt[type](idx).select(!isSelected)}}
$.each([{type:'row',prop:'aoData'},{type:'column',prop:'aoColumns'}],function(i,o){DataTable.ext.selector[o.type].push(function(settings,opts,indexes){var selected=opts.selected;var data;var out=[];if(selected!==!0&&selected!==!1){return indexes}
for(var i=0,ien=indexes.length;i<ien;i++){data=settings[o.prop][indexes[i]];if((selected===!0&&data._select_selected===!0)||(selected===!1&&!data._select_selected)){out.push(indexes[i])}}
return out})});DataTable.ext.selector.cell.push(function(settings,opts,cells){var selected=opts.selected;var rowData;var out=[];if(selected===undefined){return cells}
for(var i=0,ien=cells.length;i<ien;i++){rowData=settings.aoData[cells[i].row];if((selected===!0&&rowData._selected_cells&&rowData._selected_cells[cells[i].column]===!0)||(selected===!1&&(!rowData._selected_cells||!rowData._selected_cells[cells[i].column]))){out.push(cells[i])}}
return out});var apiRegister=DataTable.Api.register;var apiRegisterPlural=DataTable.Api.registerPlural;apiRegister('select()',function(){return this.iterator('table',function(ctx){DataTable.select.init(new DataTable.Api(ctx))})});apiRegister('select.blurable()',function(flag){if(flag===undefined){return this.context[0]._select.blurable}
return this.iterator('table',function(ctx){ctx._select.blurable=flag})});apiRegister('select.info()',function(flag){if(info===undefined){return this.context[0]._select.info}
return this.iterator('table',function(ctx){ctx._select.info=flag})});apiRegister('select.items()',function(items){if(items===undefined){return this.context[0]._select.items}
return this.iterator('table',function(ctx){ctx._select.items=items;eventTrigger(new DataTable.Api(ctx),'selectItems',[items])})});apiRegister('select.style()',function(style){if(style===undefined){return this.context[0]._select.style}
return this.iterator('table',function(ctx){ctx._select.style=style;if(!ctx._select_init){init(ctx)}
var dt=new DataTable.Api(ctx);disableMouseSelection(dt);if(style!=='api'){enableMouseSelection(dt)}
eventTrigger(new DataTable.Api(ctx),'selectStyle',[style])})});apiRegister('select.selector()',function(selector){if(selector===undefined){return this.context[0]._select.selector}
return this.iterator('table',function(ctx){disableMouseSelection(new DataTable.Api(ctx));ctx._select.selector=selector;if(ctx._select.style!=='api'){enableMouseSelection(new DataTable.Api(ctx))}})});apiRegisterPlural('rows().select()','row().select()',function(select){var api=this;if(select===!1){return this.deselect()}
this.iterator('row',function(ctx,idx){clear(ctx);ctx.aoData[idx]._select_selected=!0;$(ctx.aoData[idx].nTr).addClass(ctx._select.className)});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['row',api[i]],!0)});return this});apiRegisterPlural('columns().select()','column().select()',function(select){var api=this;if(select===!1){return this.deselect()}
this.iterator('column',function(ctx,idx){clear(ctx);ctx.aoColumns[idx]._select_selected=!0;var column=new DataTable.Api(ctx).column(idx);$(column.header()).addClass(ctx._select.className);$(column.footer()).addClass(ctx._select.className);column.nodes().to$().addClass(ctx._select.className)});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['column',api[i]],!0)});return this});apiRegisterPlural('cells().select()','cell().select()',function(select){var api=this;if(select===!1){return this.deselect()}
this.iterator('cell',function(ctx,rowIdx,colIdx){clear(ctx);var data=ctx.aoData[rowIdx];if(data._selected_cells===undefined){data._selected_cells=[]}
data._selected_cells[colIdx]=!0;if(data.anCells){$(data.anCells[colIdx]).addClass(ctx._select.className)}});this.iterator('table',function(ctx,i){eventTrigger(api,'select',['cell',api[i]],!0)});return this});apiRegisterPlural('rows().deselect()','row().deselect()',function(){var api=this;this.iterator('row',function(ctx,idx){ctx.aoData[idx]._select_selected=!1;$(ctx.aoData[idx].nTr).removeClass(ctx._select.className)});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['row',api[i]],!0)});return this});apiRegisterPlural('columns().deselect()','column().deselect()',function(){var api=this;this.iterator('column',function(ctx,idx){ctx.aoColumns[idx]._select_selected=!1;var api=new DataTable.Api(ctx);var column=api.column(idx);$(column.header()).removeClass(ctx._select.className);$(column.footer()).removeClass(ctx._select.className);api.cells(null,idx).indexes().each(function(cellIdx){var data=ctx.aoData[cellIdx.row];var cellSelected=data._selected_cells;if(data.anCells&&(!cellSelected||!cellSelected[cellIdx.column])){$(data.anCells[cellIdx.column]).removeClass(ctx._select.className)}})});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['column',api[i]],!0)});return this});apiRegisterPlural('cells().deselect()','cell().deselect()',function(){var api=this;this.iterator('cell',function(ctx,rowIdx,colIdx){var data=ctx.aoData[rowIdx];data._selected_cells[colIdx]=!1;if(data.anCells&&!ctx.aoColumns[colIdx]._select_selected){$(data.anCells[colIdx]).removeClass(ctx._select.className)}});this.iterator('table',function(ctx,i){eventTrigger(api,'deselect',['cell',api[i]],!0)});return this});function i18n(label,def){return function(dt){return dt.i18n('buttons.'+label,def)}}
function namespacedEvents(config){var unique=config._eventNamespace;return'draw.dt.DT'+unique+' select.dt.DT'+unique+' deselect.dt.DT'+unique}
function enabled(dt,config){if($.inArray('rows',config.limitTo)!==-1&&dt.rows({selected:!0}).any()){return!0}
if($.inArray('columns',config.limitTo)!==-1&&dt.columns({selected:!0}).any()){return!0}
if($.inArray('cells',config.limitTo)!==-1&&dt.cells({selected:!0}).any()){return!0}
return!1}
var _buttonNamespace=0;$.extend(DataTable.ext.buttons,{selected:{text:i18n('selected','Selected'),className:'buttons-selected',limitTo:['rows','columns','cells'],init:function(dt,node,config){var that=this;config._eventNamespace='.select'+(_buttonNamespace++);dt.on(namespacedEvents(config),function(){that.enable(enabled(dt,config))});this.disable()},destroy:function(dt,node,config){dt.off(config._eventNamespace)}},selectedSingle:{text:i18n('selectedSingle','Selected single'),className:'buttons-selected-single',init:function(dt,node,config){var that=this;config._eventNamespace='.select'+(_buttonNamespace++);dt.on(namespacedEvents(config),function(){var count=dt.rows({selected:!0}).flatten().length+dt.columns({selected:!0}).flatten().length+dt.cells({selected:!0}).flatten().length;that.enable(count===1)});this.disable()},destroy:function(dt,node,config){dt.off(config._eventNamespace)}},selectAll:{text:i18n('selectAll','Select all'),className:'buttons-select-all',action:function(){var items=this.select.items();this[items+'s']().select()}},selectNone:{text:i18n('selectNone','Deselect all'),className:'buttons-select-none',action:function(){clear(this.settings()[0],!0)},init:function(dt,node,config){var that=this;config._eventNamespace='.select'+(_buttonNamespace++);dt.on(namespacedEvents(config),function(){var count=dt.rows({selected:!0}).flatten().length+dt.columns({selected:!0}).flatten().length+dt.cells({selected:!0}).flatten().length;that.enable(count>0)});this.disable()},destroy:function(dt,node,config){dt.off(config._eventNamespace)}}});$.each(['Row','Column','Cell'],function(i,item){var lc=item.toLowerCase();DataTable.ext.buttons['select'+item+'s']={text:i18n('select'+item+'s','Select '+lc+'s'),className:'buttons-select-'+lc+'s',action:function(){this.select.items(lc)},init:function(dt){var that=this;dt.on('selectItems.dt.DT',function(e,ctx,items){that.active(items===lc)})}}});$(document).on('preInit.dt.dtSelect',function(e,ctx){if(e.namespace!=='dt'){return}
DataTable.select.init(new DataTable.Api(ctx))});return DataTable.select}))